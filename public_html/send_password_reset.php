<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Şifrenizi mi Unuttunuz? - DijiKart</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        /* Reusing the same styles from login page */
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
            background-color: #d4edda;
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

            .main input, .main .submit {
                width: 90%;
            }
        }
    </style>
</head>
<body>

<div class="main">
    <img class="logo" src="assets/logom.png" alt="">
    <h1>Şifrenizi mi Unuttunuz?</h1>

    <!-- Alert Box for Success/Error Messages -->
    <div id="alertBox" class="alert"></div>

    <form action="send_password_reset.php" method="post">
        <input type="email" id="email" name="email" required placeholder="E-posta adresinizi girin" class="input-box">
        <button type="submit" value="Reset Password" class="submit"><i class="fa-solid fa-envelope"></i> Şifre Sıfırlama Linki Gönder</button>
    </form>

    <p><a href="login.php">Giriş Sayfasına Dön</a></p>
</div>

<script>
    // Display session messages if any
    window.onload = function () {
        <?php if (isset($_SESSION['message'])): ?>
        var alertBox = document.getElementById('alertBox');
        alertBox.innerHTML = "<?php echo $_SESSION['message']; ?>";
        alertBox.classList.add("<?php echo $_SESSION['msg_type']; ?>");
        alertBox.classList.add("show");

        setTimeout(function() {
            alertBox.classList.remove("show");
        }, 3000);

        <?php unset($_SESSION['message']); unset($_SESSION['msg_type']); ?>
        <?php endif; ?>
    };
</script>

</body>
</html>
