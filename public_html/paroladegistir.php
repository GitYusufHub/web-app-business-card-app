<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DijiKart Portal</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />    
</head>
<style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
body{
    margin: 0;
    user-select: none;
    background-color: white;
    font-family: "Poppins", sans-serif;
}

.navs{
  display: flex;
  align-items: center;
  margin-left: 10px;
  margin-right: 10px;
}
.navs h1{
  font-family: "Poppins", sans-serif;
  font-weight: 600;
  font-style: normal;
  font-size: 30px;
}

.navs #left{
    margin-left: 15px;
    margin-right: 10px;
    font-size: 25px;
}

.content{
    margin-left: 20px;
    margin-right: 30px;
    margin-top: -25px;
}

.content form{
    margin-bottom: 30px;
}

.content select{
    width: 103%;
    height: 45px;
    background-color: #F5F6F7;
    border: none;
    border-radius: 8px;
    padding-left: 10px;
    font-family: "Poppins", sans-serif;
    font-size: 15px;
    font-weight:400;
    font-style: normal;
    margin-bottom: 10px;
    margin-top: 10px;
}

.content img{
    width: 90%;
    margin: 10px;
}


.form h3{
    font-family: "Poppins", sans-serif;
    font-size: 15px;
    font-weight:400;
    font-style: normal;
}

.form input{
    width: 100%;
    height: 45px;
    background-color: #F5F6F7;
    border: none;
    border-radius: 8px;
    padding-left: 10px;
}

.submit{
    width: 100%;
    height: 50px;
    background-color: #539DF3;
    border-radius: 8px;
    border: none;
    margin-bottom: 20px;
    color: white;
    font-family: "Poppins", sans-serif;
    font-size: 20px;
    font-weight: 700;
    font-style: normal;
}

</style>
<body>
    <div class="navs">
        <a href="hesabim.php"><i class="fa-solid fa-arrow-left" id="left"></i></a> 
         <h1>Şifre Değiştir</h1>
     </div>
     <div class="content">
        <img src="assets/img/10173532.jpg" alt="">
        <form action="sifre_degistir.php" method="post">
        <div class="form">
            <h3>Eski Şifre</h3>
            <input type="password" id="old_password" name="old_password" required>
        </div>
        <div class="form">
            <h3>Yeni Şifre</h3>
            <input type="password" id="new_password" name="new_password" required>
        </div>
        <div class="form">
            <h3>Yeni Şifre (Tekrar)</h3>
            <input type="password" id="confirm_password" name="confirm_password" required>
        </div>
        <p><b style="color: red;">Not:</b> Şifreleriniz <b>Gizlilik Politikamız</b> gereği şifrelenmektedir.</p>
        <input class="submit" type="submit" value="Şifreyi Değiştir">  

    </form>
     </div>
</body>
</html>

