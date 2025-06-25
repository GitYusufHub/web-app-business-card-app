<?php
session_start();
require 'vendor/autoload.php';
include 'db_connection.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];

    // E-posta adresi doğrulama
    $stmt = $conn->prepare("SELECT id, email FROM kusers WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    
    // Sonuçları almak için bind_result kullanıyoruz
    $stmt->bind_result($user_id, $user_email);
    $user = null;
    
    if ($stmt->fetch()) {
        // Kullanıcı bulunduysa, bilgileri diziye aktar
        $user = [
            'id' => $user_id,
            'email' => $user_email
        ];
    }

    // Sonuçları serbest bırakın ve sorguyu kapatın
    $stmt->close();

    if ($user) {
        // Şifre sıfırlama tokeni oluşturun ve veritabanına kaydedin
        $reset_token = bin2hex(random_bytes(50));
        $expires = date("Y-m-d H:i:s", strtotime('+10 minutes'));

        // Yeni bir prepare işlemi ile update sorgusu çalıştırın
        $stmt = $conn->prepare("UPDATE kusers SET reset_token = ?, reset_expires = ? WHERE email = ?");
        $stmt->bind_param("sss", $reset_token, $expires, $email);
        $stmt->execute();
        $stmt->close();

        // Şifre sıfırlama linkini oluşturun
        $reset_link = "https://portal.dijikart.net/reset_password.php?token=" . $reset_token;

        // HTML e-posta içeriği
        $email_content = '
        <!DOCTYPE html>
        <html lang="tr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Şifre Sıfırlama</title>
            <style>
                body { font-family: "Poppins", sans-serif; background-color: #f8f9fa; color: #333333; text-align: center; padding: 20px; }
                .container { max-width: 600px; margin: 0 auto; background-color: #ffffff; padding: 30px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); }
                .logo { font-size: 28px; font-weight: bold; color: #d9534f; margin-bottom: 20px; }
                .header { font-size: 22px; font-weight: 700; color: #333333; margin-bottom: 10px; }
                .subheader { font-size: 16px; font-weight: 500; color: #777777; margin-bottom: 30px; }
                .btn { display: inline-block; padding: 15px 25px; font-size: 16px; color: #ffffff; background-color: #d9534f; border-radius: 5px; text-decoration: none; font-weight: bold; margin-bottom: 20px; }
                .note { font-size: 14px; color: #d9534f; margin-bottom: 30px; }
                .footer { font-size: 12px; color: #777777; margin-top: 20px; }
            </style>
        </head>
        <body>
            <div class="container">
                <div class="logo"><img style="width:50%;" src="https://portal.dijikart.net/assets/logom.png" alt="Logo"></div>
                <div class="header">Şifrenizi mi unuttunuz?</div>
                <div class="subheader">Sorun değil, hepimizin başına gelir.</div>
                <p>Şifrenizi sıfırlamak için aşağıdaki butona tıklayın!</p>
                <p class="note">Bu bağlantı 10 dakika boyunca geçerlidir.</p>
                <a href="' . $reset_link . '" class="btn">ŞİFRENİ SIFIRLA</a>
                <div class="footer">
                    Herhangi bir sorunuz varsa veya daha fazla yardıma ihtiyacınız varsa, lütfen bu e-postayı yanıtlayarak veya destek sayfamızı ziyaret ederek destek ekibimizle iletişime geçmekten çekinmeyin.
                </div>
            </div>
        </body>
        </html>';

        // PHPMailer kullanarak e-posta gönderimi
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'mail.dijikart.net';
            $mail->SMTPAuth = true;
            $mail->Username = 'noreply@dijikart.net';
            $mail->Password = 'Zirve1234';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('noreply@dijikart.net', 'DijiKart');
            $mail->addAddress($email);
            $mail->Subject = '=?UTF-8?B?' . base64_encode('Şifre Sıfırlama Bağlantınız') . '?=';
            $mail->isHTML(true);
            $mail->Body = $email_content;

            $mail->send();

            // Başarı durumunda success_email.php sayfasına yönlendirin
            header("Location: success_email.php");
            exit;
        } catch (Exception $e) {
            $_SESSION['message'] = "E-posta gönderilemedi: {$mail->ErrorInfo}";
            $_SESSION['msg_type'] = "error";
        }
    } else {
        $_SESSION['message'] = "Bu e-posta adresiyle kayıtlı bir kullanıcı bulunamadı.";
        $_SESSION['msg_type'] = "error";
    }
    header("Location: forgot_password.php"); // Hata durumunda aynı sayfada kalın
    exit;
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Şifrenizi mi Unuttunuz? - DijiKart</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body { display: flex; align-items: center; justify-content: center; height: 100vh; margin: 0; /* user-select: none; */ }
        .main { text-align: center; }
        .main .logo { width: 18%; height: auto; }
        .main h1 { font-family: 'Poppins', sans-serif; font-weight: 500; font-size: 30px; margin-bottom: 30px; }
        .main input { font-size: 16px; color: #333; outline: none; width: 50%; height: 48px; border-radius: 10px; text-indent: 15px; border: 1px solid #ccc; font-family: 'Poppins', sans-serif; font-weight: 400; margin-bottom: 20px; }
        .main input:focus, .main input:hover { border: 1px solid #246bfd; }
        .main .submit { background-color: #246BFD; color: white; font-weight: 600; font-size: 16px; outline: none; width: 50%; height: 48px; border-radius: 10px; text-indent: 15px; border: 1px solid #ccc; font-family: 'Poppins', sans-serif; margin-bottom: 20px; }
        .alert { position: fixed; top: -100px; left: 50%; transform: translateX(-50%); width: 90%; max-width: 400px; padding: 20px; border-radius: 5px; text-align: center; font-family: 'Poppins', sans-serif; font-size: 16px; transition: top 0.5s ease-in-out; }
        .alert.show { top: 20px; }
        .alert.success { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .alert.error { background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        @media only screen and (max-width: 600px) { .main .logo { width: 35%; } .main input, .main .submit { width: 90%; } }
    </style>
</head>
<body>

<div class="main">
    <img class="logo" src="https://portal.dijikart.net/assets/logom.png" alt="">
    <h1>Şifrenizi mi Unuttunuz?</h1>

    <!-- Alert Box for Success/Error Messages -->
    <?php if (isset($_SESSION['message'])): ?>
        <div class="alert <?php echo $_SESSION['msg_type']; ?> show" id="alertBox">
            <?php echo $_SESSION['message']; ?>
        </div>
        <?php unset($_SESSION['message']); unset($_SESSION['msg_type']); ?>
    <?php endif; ?>

    <form action="forgot_password.php" method="post">
        <input type="email" id="email" name="email" required placeholder="E-posta adresinizi girin" class="input-box">
        <button type="submit" class="submit"><i class="fa-solid fa-envelope"></i> Şifre Sıfırlama Linki Gönder</button>
    </form>

    <p><a href="login.php">Giriş Sayfasına Dön</a></p>
</div>

<script>
    window.onload = function () {
        var alertBox = document.getElementById('alertBox');
        if (alertBox) {
            setTimeout(function() {
                alertBox.classList.remove("show");
            }, 3000);
        }
    };
</script>

</body>
</html>
