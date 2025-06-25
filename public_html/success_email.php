<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Şifrenizi mi Unuttunuz? - DijiKart</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.6.0/css/all.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    </head>
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            user-select: none;
            font-family: "Poppins", sans-serif;
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

        @media screen and (max-width: 768px) {
            .main .logo {
                width: 35%;
                height: auto;
            }

            .main input, .main .submit {
                width: 90%;
            }

            .btns button,a{
                width: 50%;

            }

            .imgs img{
            width: 100%;
            }
        }

        .mailimg{
            width: 50%;
        }

        button{
            width: 20%;
            height: 40px;
            color: white;
            background-color: #c2363a;
            font-weight: 600;
            border: none;
            border-radius:5px;
            font-family: 'Poppins', sans-serif;
            margin-top:5px;
        }

        p{
            margin-left: 5px;
            margin-right: 5px;
        }
    </style>
    <body>
    <div class="main">
            <img class="logo" src="https://portal.dijikart.net/assets/logom.png" alt="">
            <br>
            <div class="msj">
                <div class="imgs">
                <img class="mailimg" src="assets/resetpass.jpg" alt="">
                </div>
            <h1>E Postanızı kontrol edin!</h1>
            <p>Şifre sıfırlama linkiniz e posta adresinize gönderildi. E postadaki linke tıklayarak şifrenizi değiştirebilirsiniz.</p>
            <div class="btns">
            <a href="login.php"><button>Giriş Sayfasına dön</button></a>
            </div>
            </div>
    </div> 
    </body>
</html>
