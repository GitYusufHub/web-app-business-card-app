<?php include 'register_process.php';?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DijiKart Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap');

body {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100vh; /* Ekran yüksekliğinin tamamını kapla */
    margin: 0;
    user-select: none;
  }

  .main{
    text-align: center;
  }

.main .logo{
    width: 25%;
    height: auto;
}

.main h1{
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
    width: 76%;
    height: 50px;
    border-radius: 10px;
    text-indent: 15px;
    border: 1px solid #ccc;
    font-family: 'Poppins', sans-serif;
    margin: 10px auto; /* Yatayda ortalamak için margin ekleyin */
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
    margin-right: 10px; /* Görsel ile metin arasına bir boşluk eklemek için margin-right ekleyin */
}

.google p {
    font-size: 19px;
    margin: 0; /* Paragrafın varsayılan margin'ini sıfırlayın */
}
.main input{
    font-size: 16px;
    color: #333;
    outline: none;
    width: 75%;
    height: 48px;
    border-radius: 10px;
    text-indent: 15px;
    border: 1px solid #ccc;
    font-family: 'Poppins', sans-serif;
    font-weight: 400;
    margin-bottom: 20px;
}

.main input:focus{
    border: 1px solid #246bfd
}

.main input:hover{
    border: 1px solid #246bfd
}

.main .submit{

    background-color: #246BFD;
    color: white;
    font-weight: 600;
    font-size: 16px;
    outline: none;
    width: 76%;
    height: 48px;
    border-radius: 10px;
    text-indent: 15px;
    border: 1px solid #ccc;
    font-family: 'Poppins', sans-serif;
    margin-bottom: 20px;
}

.main p{
    font-family: 'Poppins', sans-serif;
}


@media only screen and (max-width: 600px) {

.main .logo{
    width: 35%;
    height: auto;
}       


.main input{
    width: 90%;
    height: 48px;
}

.google {
    width: 90%;
    height: 50px;
}

.main .submit{
    width: 90%;
    height: 48px; 
}

}
    </style>
    <div class="main">
        <img class="logo" src="assets/yenilogo.png" alt="">
        <h1>Kayıt Ol!</h1>
        <form action="register.php" method="post">
        <input type="text" id="username" class="input-box" name="username" placeholder="Kulanıcı adını girin" required>
 		<br><input type="email" class="input-box" id="email" name="email"placeholder="e-posta adresinizi  girin" required><br>
		<input type="password" class="input-box" id="password" name="password" placeholder="şifrenizi" required><br>
	    <button type="submit" class="submit"><i class="fa-solid fa-unlock-keyhole"></i> Kayıt Ol</button>
        </form>
		  <!-- Hata mesajlarını burada göster -->
    <span style="color: red;"><?php echo $username_error; ?></span><br>
    <span style="color: red;"><?php echo $password_error; ?></span><br>
        <p>DijiKart sistemine kayıtlıysan <a href="login.php" style="color: black; text-decoration: none; font-weight: 600;">Giriş Yap!</a></p>
    </div>
</body>
</html>
