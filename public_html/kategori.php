<!DOCTYPE html>
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
    background-color: white;
    font-family: "Poppins", sans-serif;
}

.navs{
  display: flex;
  align-items: center;
  justify-content: center;
  margin-left: 10px;
  margin-right: 10px;
  text-align: center;
}
.navs h1{
  font-weight: 600;
  font-style: normal;
  font-size: 25px;
}

.content{
    margin-top: 30px;
    padding: 0;
}

.kutular{
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 20px;
}

.kutu{
    width: 150px;
    height: 170px;
    color: white;
    background-color: #3c7fff;
    border-radius: 5px;
    margin-left: 10px;
}

.kutular a{
    text-decoration: none;
    display: flex;
    align-items: center;
    justify-content: center;
}

.kutu p{
    text-align: center;
    font-size: 20px;
}

.kutu i{
    font-size: 60px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-top: 20px;
}

</style>
<body>
    <div class="content">
    <div class="navs">
            <h1><i class="fa-solid fa-bolt"></i> Hızlı Menü</h1>
        </div>
        <div class="kutular">
            <a href="#">
            <div class="kutu">
                <i class="fa-solid fa-question"></i>
                <p>Nasıl <br> Çalışır?</p>
            </div>
            </a>
            <a href="#">
                <div class="kutu">
                    <i class="fa-solid fa-bullhorn"></i>
                    <p>Kampanya indirimler</p>
                </div>
                </a>
        </div>
        <div class="kutular">
            <a href="#">
            <div class="kutu">
                <i class="fa-solid fa-chart-pie"></i>
                <p>Kart İstatistikleri</p>
            </div>
            </a>
            <a href="dashboard.php">
                <div class="kutu">
                    <i class="fa-solid fa-gears"></i>
                    <p>Kart <br> İşlemleri</p>
                </div>
                </a>
        </div>
        <div class="kutular">
            <a href="desteka.php">
            <div class="kutu">
                <i class="fa-solid fa-headset"></i>
                <p>Destek ve İletişim</p>
            </div>
            </a>
            <a href="#">
                <div class="kutu">
                <i class="fa-solid fa-spinner"></i>
                    <p>Yakında!</p>
                </div>
                </a>
        </div>
    </div>
</body>
<footer>
<?php include 'navbar.php';?>
</footer>
</html>