<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include "db_connection.php";

$username = $_SESSION['username'];

// Kullanıcının bilgilerini çekme
$user_query = "SELECT * FROM kusers WHERE username = '$username'";
$user_result = $conn->query($user_query);

if ($user_result !== false && $user_result->num_rows > 0) {
    // Kullanıcının tüm bilgilerini al
    $user_data = $user_result->fetch_assoc();
    $user_id = $user_data['id'];

    // Kartvizit bilgilerini çekme
    $kartvizit_query = "SELECT * FROM kartvizit WHERE user_id = $user_id";
    $kartvizit_result = $conn->query($kartvizit_query);
} else {
    echo "Error: Unable to fetch kusers data.";
    exit();
}
?>



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
        user-select: none;
        background-color: white;
        font-family: "Poppins", sans-serif;
    }

        .content {
        margin-right: 10px;
        background-color: white;
    }

    .navs{
    display: flex;
    align-items: center;
    margin-left: 10px;
    margin-right: 10px;
    margin-top: -10px;


    }
    .navs h1{
    font-weight: 600;
    font-style: normal;
    }

    .pp {
        width: 97%;
        height: 100px;
        background-color: #F5F6F7;
        border-radius: 8px;
        margin: 10px;
        display: flex;
        align-items: center;
        margin-top: -10px;
    }

    .pp img {
        width: 75px;
        height: 75px;
        border-radius: 10%;
        margin-right: 20px;
        margin-left: 10px;
    }

    .pp .text {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
    }

    .pp h1 {
        font-size: 25px;
        font-weight: 400;
        font-style: normal;
    }

    .pp p{
        font-size: 13px;
        font-weight: 400;
        font-style: normal;
        margin-top: -20px;
    }

    .content ul{
        list-style: none;
        margin-left: -30px;
    }

    .content li{
        width: 95%;
        height: 60px;
        background-color: #F5F6F7;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        padding-left: 20px;
        border-radius: 8px;
        font-size: 18px;
    }

    .content i{
        margin-right: 10px;
    }



    .content .cbtn{
        width: 100%;
        height: 60px;
        background-color: #539DF3 ;
        border: none;
        border-radius: 8px;
        margin-left: 10px;
        font-size: 23px;
        color: white;
        font-weight: 700;
        text-align: center;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .cbtn a{
        text-decoration: none;
        color: white;
    }

    .btnh a{
        text-decoration:  none;
        color: black;
    }

    .buttonlar ul{
        display: flex;
        text-align: center;
        font-weight: 700;
    }

    .buttonlar li{
        width: 95%;
        height: 60px;
        background-color: #F5F6F7;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        border-radius: 8px;
        font-size: 18px;
        list-style: none;
    }

    #bmenu{
        background-color: red;
        color: white;
        text-align: center;
        margin-left: -10px;
        margin-right: 5px;

    }

    #bcikis{
        background-color: #0069d9;
        color: white;
    }

    .buttonlar a{
        text-decoration: none;
        text-align: center;

    }

    .bmenu{
        width: 95%;
        height: 60px;
        margin-right: 5px;
        text-align: center;


    }

    .bcikis{
        width: 95%;
        height: 60px;
        margin-right:10px;
        text-align: center;

    }


</style>
<body>
    <div class="content">
        <div class="navs">
            <h1>Hesabım</h1>
            <i class="fa-solid fa-circle-shop"></i>
        </div>
        <div class="pp">
            <img src="assets/img/pp.jpg" alt="">
            <div class="text">
                <h1><b><?php echo htmlspecialchars($user_data['username'], ENT_QUOTES, 'UTF-8'); ?></b></h1>
                <p>Kullanıcı id: <b>#<?php echo htmlspecialchars($user_id, ENT_QUOTES, 'UTF-8'); ?></b></p>
            </div>
        </div>
        <ul class="btnh">
            <a href="hesapbilgileri.php">
                <li> 
                    <i class="fa-solid fa-pen"></i>
                    Bilgilerim
                </li>
            </a>
            <a href="paroladegistir.php">
                <li>
                    <i class="fa-solid fa-lock"></i>
                    Şifre Değiştir
                </li>
            </a>
            <a href="songirisbilgi.php">
                <li>
                    <i class="fa-solid fa-right-to-bracket"></i>
                    Son Giriş Bilgileri
                </li>
            </a>
            <a href="soru.php">
                <li>
                    <i class="fa-solid fa-question"></i>
                    Sıkça Sorulan Sorular
                </li>
            </a>
            <a href="desteka.php">
                <li>
                    <i class="fa-solid fa-headset"></i>
                    Destek ve İletişim
                </li>
            </a>
        </ul>
        <div class="buttonlar">
            <ul>            
                <a class="bcikis" href="logout.php">
                    <li id="bcikis">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        Çıkış Yap
                    </li>
                </a> 
            </ul>
        </div>
    </div>
<br>
<br>
<br>
    <footer>
        <?php include 'navbar.php'; ?>
    </footer>
</body>
</html>
