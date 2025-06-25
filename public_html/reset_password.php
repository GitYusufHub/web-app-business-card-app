<?php
// Hata gösterimini etkinleştirin
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'db_connection.php'; // Veritabanı bağlantısı dosyasını dahil edin
$alertMessage = '';

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Token doğrulama ve süresi kontrolü
    $stmt = $conn->prepare("SELECT id, email FROM kusers WHERE reset_token = ? AND reset_expires > NOW()");
    if (!$stmt) {
        exit("SQL sorgusu hatası oluştu: " . $conn->error);
    }

    $stmt->bind_param("s", $token);
    $stmt->execute();

    // Sonuçları almak için bind_result kullanın
    $stmt->bind_result($user_id, $user_email);
    $user = null;

    if ($stmt->fetch()) {
        // Kullanıcı bulundu, bilgileri diziye aktar
        $user = [
            'id' => $user_id,
            'email' => $user_email
        ];
    }
    $stmt->close();

    if ($user) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $password = $_POST['password'];
            $password_confirm = $_POST['password_confirm'];

            // Şifrelerin eşleşip eşleşmediğini kontrol et
            if ($password === $password_confirm) {
                $new_password = password_hash($password, PASSWORD_BCRYPT);

                // Şifreyi güncelle ve tokeni geçersiz hale getir
                $stmt = $conn->prepare("UPDATE kusers SET password = ?, reset_token = NULL, reset_expires = NULL WHERE id = ?");
                if (!$stmt) {
                    exit("Güncelleme sorgusu hatası oluştu: " . $conn->error);
                }

                $stmt->bind_param("si", $new_password, $user_id);
                $stmt->execute();
                $stmt->close();

                // Başarı mesajı ve yönlendirme
                $alertMessage = "<div class='alert success'>Şifreniz başarıyla sıfırlandı. <br> Giriş sayfasına yönlendiriliyorsunuz...</div>";
                echo "<script>
                    setTimeout(function() {
                        window.location.href = 'login.php';
                    }, 5000);
                </script>";
            } else {
                $alertMessage = "<div class='alert error'>Şifreler eşleşmiyor. Lütfen tekrar deneyin.</div>";
                $user = null; // Hata durumunda formun görüntülenmemesi için $user değerini null yap
            }
        }
    } else {
        $alertMessage = "<div class='alert error'>Bu bağlantı geçersiz veya süresi dolmuş.</div>";
        $user = null; // Hata durumunda formun görüntülenmemesi için $user değerini null yap
    }
} else {
    $alertMessage = "<div class='alert error'>Geçersiz istek.</div>";
    $user = null; // Hata durumunda formun görüntülenmemesi için $user değerini null yap
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Şifrenizi mi Unuttunuz? - DijiKart</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<div class="main">
    <?php if ($alertMessage): ?>
        <?= $alertMessage ?>
    <?php else: ?>
        <img class="logo" src="https://portal.dijikart.net/assets/logom.png" alt="">
        <h1>Şifre Sıfırlama Sayfası</h1>

        <!-- Şifre sıfırlama formu -->
        <?php if (isset($user)): ?>
        <form method="post" action="">
            <input type="password" name="password" placeholder="Yeni Şifre" required>
            <input type="password" name="password_confirm" placeholder="Yeni Şifre (Tekrar)" required>
            <button type="submit" class="submit">Şifreyi Sıfırla</button>
        </form>
        <?php endif; ?>
    <?php endif; ?>
</div>

<style>
    .alert {
        font-family: 'Poppins', sans-serif;
        margin: 20px 0;
        padding: 10px;
        border-radius: 5px;
        text-align: center;
    }
    .alert.success {
        background-color: #ff4c4c;
        color: #fff;
        border: 1px solid #ff4c4c;
    }
    .alert.error {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }

    @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap');

    body {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
        margin: 0;
     /*   user-select: none; */
    }

    .main {
        text-align: center;
    }

    .main .logo {
        width: 18%;
        height: auto;
    }

    .main h1 {
        font-family: 'Poppins', sans-serif;
        font-weight: 500;
        font-size: 30px;
        margin-bottom: 30px;
    }

    .main input {
        font-size: 16px;
        color: #333;
        outline: none;
        width: 50%;
        height: 48px;
        border-radius: 10px;
        text-indent: 15px;
        border: 1px solid #ccc;
        font-family: 'Poppins', sans-serif;
        font-weight: 400;
        margin-bottom: 20px;
    }

    .main input:focus,
    .main input:hover {
        border: 1px solid #246bfd;
    }

    .main .submit {
        background-color: #246BFD;
        color: white;
        font-weight: 600;
        font-size: 16px;
        outline: none;
        width: 50%;
        height: 48px;
        border-radius: 10px;
        text-indent: 15px;
        border: 1px solid #ccc;
        font-family: 'Poppins', sans-serif;
        margin-bottom: 20px;
    }

    .main p {
        font-family: 'Poppins', sans-serif;
    }

    @media only screen and (max-width: 600px) {
        .main .logo {
            width: 35%;
            height: auto;
        }

        .main input, .main .submit {
            width: 90%;
        }
    }
</style>
