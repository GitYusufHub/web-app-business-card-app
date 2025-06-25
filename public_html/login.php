<?php
session_start();

// Kullanıcı zaten oturum açtıysa, anasayfa.php'ye yönlendir
if (isset($_SESSION['username'])) {
    header("Location: anasayfa.php");
    exit();
}

// Veritabanı bağlantısını içe aktar
include "db_connection.php";

// Form verilerini al
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Kullanıcıyı veritabanından kontrol et
    $stmt = $conn->prepare("SELECT id, username, password FROM kusers WHERE username=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($user_id, $username, $hashed_password);
        $stmt->fetch();
        // Kullanıcı adı doğruysa, şifreyi doğrula
        if (password_verify($password, $hashed_password)) {
            // Giriş bilgilerini kaydet
            $login_time = date("Y-m-d H:i:s");
            $device_info = $_SERVER['HTTP_USER_AGENT'];
            $user_ip = $_SERVER['REMOTE_ADDR'];

            // Giriş bilgilerini 'klog' tablosuna ekle
            $insert_stmt = $conn->prepare("INSERT INTO klog (user_id, login_time, device_info, user_ip) VALUES (?, ?, ?, ?)");
            $insert_stmt->bind_param("isss", $user_id, $login_time, $device_info, $user_ip);
            if ($insert_stmt->execute()) {
                // Oturumu başlat
                $_SESSION['user_id'] = $user_id;
                $_SESSION['username'] = $username;
                $_SESSION['message'] = "Başarıyla giriş yaptınız!";
                $_SESSION['msg_type'] = "success";
                header("Location: anasayfa.php");
                exit();
            } else {
                $_SESSION['message'] = "Giriş bilgileri kaydedilirken bir hata oluştu";
                $_SESSION['msg_type'] = "error";
            }
        } else {
            $_SESSION['message'] = "Kullanıcı adı veya şifre hatalı";
            $_SESSION['msg_type'] = "error";
        }
    } else {
        $_SESSION['message'] = "Kullanıcı adı veya şifre hatalı";
        $_SESSION['msg_type'] = "error";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DijiKart Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap');

        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            user-select: none;
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

        .google {
            background-color: white;
            color: #333;
            font-weight: 600;
            font-size: 16px;
            outline: none;
            width: 40%;
            height: 50px;
            border-radius: 10px;
            text-indent: 15px;
            border: 1px solid #ccc;
            font-family: 'Poppins', sans-serif;
            margin: 10px auto;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .google:hover {
            background-color: #eeebeb;
        }

        .google img {
            width: 25px;
            text-align: center;
            margin-right: 10px;
        }

        .google p {
            font-size: 19px;
            margin: 0;
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

        .alert {
            position: fixed;
            top: -100px;
            left: 50%;
            transform: translateX(-50%);
            width: 90%;
            max-width: 400px;
            padding: 20px;
            border-radius: 5px;
            text-align: center;
            font-family: 'Poppins', sans-serif;
            font-size: 16px;
            transition: top 0.5s ease-in-out;
        }

        .alert.show {
            top: 20px;
        }

        .alert.success {
            background-color: red;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert.error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        @media only screen and (max-width: 600px) {
            .main .logo {
                width: 35%;
                height: auto;
            }

            .main input, .google, .main .submit {
                width: 90%;
            }
        }
    </style>
</head>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <link rel="apple-touch-icon" href="diji.png">

    <!-- Inline Manifest for PWA -->
    <script type="application/json" id="manifest">
        {
        "name": "DijiKart",
        "short_name": "DijiKart",
        "description": "DijiKart Web Uygulaması",
        "start_url": "/",
        "display": "standalone",
        "background_color": "#FFFFFF",
        "theme_color": "#000000",
        "icons": [
            {
            "src": "diji.png",
            "sizes": "192x192",
            "type": "image/png"
            },
            {
            "src": "diji.png",
            "sizes": "512x512",
            "type": "image/png"
            }
        ]
        }
    </script>

    <!-- Basic Styling for Popup Guide -->
    <style>
      
        #addToHomeScreen {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            color: #fff;
            z-index: 1000;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }
        #addToHomeScreen img {
            width: 100px;
            margin-bottom: 20px;
        }
        #addToHomeScreen button {
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
        }
    </style>

<body>

<div class="main">
    <img class="logo" src="assets/logom.png" alt="">
    <h1>Tekrar Hoşgeldiniz!</h1>

    <!-- Bildirim Alanı -->
    <div id="alertBox" class="alert"></div>

       <!--  <button onclick="showAddToHomeScreen()" class="google">
            <img src="assets/apple.png" alt="">
            <p>Ana Ekrana Ekle</p>
            </button>
                <div id="addToHomeScreen">
                <img src="assets/logom.png" alt="DijiKart Logo">
                <p>Uygulamamızı ana ekrana ekleyerek daha hızlı erişim sağlayabilirsiniz! <br>
                Lütfen tarayıcı menüsünden 'Paylaş' simgesine dokunun ve ardından 'Ana Ekrana Ekle' seçeneğini seçin.</p>
         <button onclick="hideAddToHomeScreen()">Kapat</button>
    </div>

    <script>
        // Show Add to Home Screen Guide
        function showAddToHomeScreen() {
            document.getElementById("addToHomeScreen").style.display = "flex";
        }

        // Hide Add to Home Screen Guide
        function hideAddToHomeScreen() {
            document.getElementById("addToHomeScreen").style.display = "none";
        }

        // Inject Manifest into Head
        const manifestData = document.getElementById('manifest').textContent;
        const manifestBlob = new Blob([manifestData], { type: 'application/json' });
        const manifestURL = URL.createObjectURL(manifestBlob);
        const link = document.createElement('link');
        link.rel = 'manifest';
        link.href = manifestURL;
        document.head.appendChild(link);
    </script> -->

    <form action="login.php" method="post">
        <input type="text" id="username" name="username" required class="input-box" placeholder="Kullanıcı Adınızı Girin">
        <input type="password" id="password" name="password" required class="input-box" placeholder="Parolanızı girin...">
        <button type="submit" value="Login" class="submit"><i class="fa-solid fa-unlock-keyhole"></i> Giriş Yap</button>
        <a href="forgot_password.php"><p>Şifrenizi mi Unuttunuz?</p></a>
    </form>

</div>

<script>
    // PHP'den gelen session mesajını al ve göster
    window.onload = function () {
        <?php if (isset($_SESSION['message'])): ?>
        var alertBox = document.getElementById('alertBox');
        alertBox.innerHTML = "<?php echo $_SESSION['message']; ?>";
        alertBox.classList.add("<?php echo $_SESSION['msg_type']; ?>");
        alertBox.classList.add("show");

        // 3 saniye sonra bildirimi kaldır
        setTimeout(function() {
            alertBox.classList.remove("show");
        }, 3000);

        // Mesaj gösterildikten sonra session temizle
        <?php unset($_SESSION['message']); unset($_SESSION['msg_type']); ?>
        <?php endif; ?>
    };
</script>

</body>
</html>
