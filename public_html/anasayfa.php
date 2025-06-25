<?php ob_start(); session_start(); include ('inclued/dash.php');?>
<?php
// Veritabanı bağlantısı için gerekli bilgileri dahil et
include 'db_connection.php';

// Veritabanından duyuruları seçme
$sql_select = "SELECT * FROM duyurular";
$result_select = mysqli_query($conn, $sql_select);

// Veritabanı bağlantısını kapat
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DijiKart Portal</title>
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.2/css/all.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<style>

    *{
        font-family: "Poppins", sans-serif;
        user-select: none;
    }

    body{

        margin: 0;
        user-select: none;
        font-family: "Poppins", sans-serif;
    }

    .ust {
        width: 100%;
        height: 290px;
        background: -webkit-linear-gradient(38deg, #394b9f,#3c6cbc,#448ece,#4a9cda,#4cabe0);/* Chrome 10-25, Safari 5.1-6 */
        background: linear-gradient(38deg, #394b9f,#3c6cbc,#448ece,#4a9cda,#4cabe0);/* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */                                             
    }

    .navbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px;
        color: white;
    }

    .navbar img {
        width: 170px;
        margin-top: 10px;
    }

    .icons {
        display: flex;
    }

    .icon {
        margin-left: 10px;
    }

    .noti {
        width: 45px;
        height: 45px;
        background-color: rgba(255, 255, 255, 0.1);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
    }

    .noti i {
        font-size: 20px;
        color: white;
    }

    /* İkonlar sağa yapışık olacak */
    .icons {
        margin-left: auto;
    }

    .card{
        margin: 10px;
    }

    .cards{
        width: auto;
        height: 100px;
        background-color: rgba(255, 255, 255, 0.1);
        border-radius: 8px;
        display: flex;
        align-items: center;
    }

    .sayilar{
        display: flex;
        margin-top: 7px; 
    }

    .sayi{
        width: 100%;
        height: 75px;
        background-color: rgba(255, 255, 255, 0.1);
        border-radius: 5px;
        text-align: center;
        margin: 5px;
    }

    .sayi h1{
        font-size: 35px;
        font-weight: 700;
        color: white;
        margin-bottom: -20px;
        margin-top: 0px;
    }

    .sayi p{
        font-size: 12px;
        font-weight: 400;
        color: white;
    }

    .pp {
        display: flex;
        align-items: center;
    }

    .pp img {
        width: 60px;
        height: 60px;
        border-radius: 100%;
        margin-right: 10px;
        margin-left: 20px;
    }

    .pp .text {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        color: white;
    }

    .pp h1 {
        font-size: 25px;
        font-weight: 400;
        font-style: normal;
    }

    .pp p {
        font-size: 13px;
        font-weight: 400;
        font-style: normal;
        margin-top: -23px;
    }

    .bld{
        margin: 10px;
    }
    
    .dogrula{
        width: auto;
        height: 90px;
        background-color: #F5F6F7;
        border-radius: 8px;
        display: flex;
        align-items: center;
    }

    .dogrula i{
        font-size: 30px;
        color: blueviolet;
        margin: 20px;
    }

    .txt h1{
        font-size: 20px;
        color: black;
    }

    .txt p{
        margin-top: -15px;
        font-size: 12px;
        color: black;
    }


    #left{
    float: right;
    }

    .wrapper{
    display: inline-flex;
    height: 100px;
    width: 100%;
    align-items: center;
    justify-content: space-evenly;
    border-radius: 5px;
    padding: 0px 0px;
    margin-top: -25px;
  }
  .wrapper .option{
    background: #fff;
    height: 40%;
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: space-evenly;
    margin: 0 10px;
    border-radius: 5px;
    cursor: pointer;
    padding: 0 10px;
    transition: all 0.3s ease;
  }
  .wrapper .option .dot{
    height: 20px;
    width: 20px;
    background: #d9d9d9;
    border-radius: 50%;
    position: relative;
  }
  .wrapper .option .dot::before{
    position: absolute;
    content: "";
    top: 4px;
    left: 4px;
    width: 12px;
    height: 12px;
    background: #0069d9;
    border-radius: 50%;
    opacity: 0;
    transform: scale(1.5);
    transition: all 0.3s ease;
  }

    .wrapper .option .dot,
    .wrapper .option .dot::before {
        display: none; /* Yuvarlak şekilleri gizle */
    }


  input[type="radio"] {
    display: none;
  }
  
  #option-1:checked:checked ~ .option-1,
  #option-2:checked:checked ~ .option-2,
  #option-3:checked:checked ~ .option-3{
    border-color: #0069d9;
    background: #0069d9;
  }
  #option-1:checked:checked ~ .option-1 .dot,
  #option-2:checked:checked ~ .option-2 .dot,
  #option-3:checked:checked ~ .option-3 .dot{
    background: #fff;
  }
  #option-1:checked:checked ~ .option-1 .dot::before,
  #option-2:checked:checked ~ .option-2 .dot::before,
  #option-3:checked:checked ~ .option-3 .dot::before{
    opacity: 1;
    transform: scale(1);
  }
  .wrapper .option span{
    font-size: 16px;
    color: #808080;
  }
  #option-1:checked:checked ~ .option-1 span,
  #option-2:checked:checked ~ .option-2 span,
  #option-3:checked:checked ~ .option-3 span{
    color: #fff;
  }

  .cont{
    margin-left: 15px;
    margin-top: -20px;
    display: flex;
    flex-direction: column;
  }

  .icerik{
    display: flex;
    align-items: center;
  }

  .icerik img{
    width: 45%;
    height: 250x;
    border-radius: 8px;
    margin: 5px;
  }

</style>
<body>
    <div class="main">
        <div class="ust">
            <nav class="navbar">
                <img src="assets/logo1.png" alt="Logo">
                <div class="icons">

                <a href="bildirim.php" style="text-decoration: none;">

                    <div class="icon">
                        <div class="noti">
                            <i class="fa-solid fa-bell"></i>
                        </div>
                    </div>

                </a>


                    <a href="hesabim.php">

                    <div class="icon">
                        <div class="noti">
                            <i class="fa-solid fa-user"></i>
                        </div>
                    </div>

                    </a>

                </div>
            </nav>
            <div class="card">
                <div class="cards">
                    <div class="pp">
                        <img src="assets/pp.jpg" alt="">
                        <div class="text">
                        
                        <h1>Merhaba, <b>
                        <?php 
            $username = htmlspecialchars($_SESSION['username']); // Oturumdan kullanıcı adı verisi alınıyor
            $ilk_kelime = explode(' ', $username)[0]; // İlk kelimeyi almak için boşluk karakterine göre ayır ve ilk elemanı al

            echo $ilk_kelime; 
            ?>   
                    </b>
                </h1>
                            <p>Umarız güzel bir gün geçiriyorsunuzdur!</p>
                     
                        </div>
                    </div>
                </div>
                <div class="sayilar">
                    <div class="sayi">
                        <h1>0</h1>
                        <p>NFC OKUTMA</p>
                    </div>
                    <div class="sayi">
                        <h1>0</h1>
                        <p>QR OKUTMA</p>
                    </div>
                    <div class="sayi">
                        <h1>0</h1>
                        <p>TOPLAM OKUTMA</p>
                    </div>
                    
                  <!--  <div class="sayi">
                        <h1>250</h1>
                        <p>ÜRÜN SAYISI</p>
                    </div>-->
                </div>
            </div>
        </div>
        <div class="content" style="margin-top: 10px;">
            <div class="wrapper">
                <input type="radio" name="select" id="option-1" checked>
                <input type="radio" name="select" id="option-2">
                <input type="radio" name="select" id="option-3">
                <label for="option-1" class="option option-1">
                  <div class="dot"></div>
                  <span>Tümü</span>
                </label>
                <label for="option-2" class="option option-2">
                  <div class="dot"></div>
                  <span>Kampanyalar</span>
                </label>
                <label for="option-3" class="option option-3">
                    <div class="dot"></div>
                    <span>Haberler</span>
                  </label>
              </div>
              <div class="cont">
                <div class="icerik">
                    <img src="assets/afis.png" alt="">
                    <img src="assets/afis.png" alt="">
                </div>
                <div class="icerik" style="margin-bottom: 100px;">
                    <img src="assets/afis.png" alt="">
                    <img src="assets/afis.png" alt="">
                </div>
              </div>

        </div>
    </div>
</body>
<footer>
<?php include 'navbar.php';?>
</footer>
<script>
document.addEventListener("DOMContentLoaded", function() {
  startCountdown();
});

function startCountdown() {
  var boxes = document.querySelectorAll(".sayi");
  var maxCount = 0;

  boxes.forEach(function(box) {
    var count = parseInt(box.querySelector("h1").textContent);
    if (count > maxCount) {
      maxCount = count;
    }
  });

  boxes.forEach(function(box) {
    var maxCount = parseInt(box.querySelector("h1").textContent);
    var display = box.querySelector("h1");
    var count = 0;
    var interval = setInterval(function() {
      if (count > maxCount) {
        clearInterval(interval);
      } else {
        display.textContent = count.toString().padStart(3, '0');
        count++;
      }
    }, 1);
  });
}

</script>
 <script>
        // Menüyü açma/kapatma işlevi
        function toggleMenu() {
            var menu = document.getElementById("menu");
            menu.classList.toggle("active");
        }
    </script>
</html>