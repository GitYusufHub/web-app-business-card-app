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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DijiKart Portal</title>
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.2/css/all.css">
</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

body{
    margin: 0;
    user-select: none;
    font-family: "Poppins", sans-serif;
}


.navs{
    display: flex;
    align-items: center;
    justify-content: center;
    width: auto;
    height: 70px;
    background-color: #F5F6F7;
    justify-content: space-between;


}

.navs img{
    width: 120px;
}

.navs i{
    font-size: 25px;
    margin-left: 20px;
    margin-right: 20px;
}


.content {
    margin-left: 10px;
    margin-right: 10px;
    margin-top: 10px;
}

.pp {
    display: flex;
    align-items: center;
}

.pp img {
    width: 65px;
    height: 65px;
    border-radius: 100%;
    margin-right: 10px;
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

.ist{
    width: 100%;
    margin: 0 auto;
    display: flex;
    flex-wrap: wrap;
}

.box{
    box-sizing: border-box;
    width: 47%;
    height: 80px;
    padding: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-top: 10px;
    border-radius: 5px;
    margin-left: 5px;
}

.box h1{
    color: white;
    font-size: 45px;
    margin-right: 5px;
}

.box p{
    color: white;
    font-size: 16px;
    line-height: 0.9;
}

#kutu1{
background-color: #000000;
}

#kutu2{
    background-color: #75CC7F;
}

#kutu3{
    background-color: #FF0000;
}

#kutu4{
    background-color: #005eff;
}


.bldkutu{
display: flex;
align-items: center ;
background-color:#F5F6F7;
border-radius: 7px;
margin-bottom: 10px;
}

.bldkutu i{
    margin-left: 10px; ;
    margin-right: 10px;
    font-size: 20px;
}

.bldkutu p{
    font-size: 16px;
}
.menu-button {
            position: fixed;
            top: 20px;
            right: 20px;
            background-color: transparent;
            border: none;
            cursor: pointer;
            z-index: 999;
        }
        .menu {
            position: fixed;
            top: 0;
            right: 0;
            width: 300px;
            height: 100%;
            background-color:#000000CC; /* Şeffaf arka plan */
            backdrop-filter: blur(5px);
            padding: 20px;
            transform: translateX(100%);
            transition: transform 0.3s ease;
            z-index: 998;
			color:white;
        }
        .menu.active {
            transform: translateX(0);
        }
        .menu ul {
            list-style-type: none;
            padding: 0;
        }
        .menu li {
            margin-bottom: 10px;
        }
        .close-button {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 20px;
            cursor: pointer;
        }
		/*making bell shape with one div */
.bell {
  border: 2.17px solid white;
  border-radius: 10px 10px 0 0;
  width: 15px;
  height: 17px;
  background: transparent;
  display: block;
  position: relative;
  top: -3px;
}
.bell::before,
.bell::after {
  content: "";
  background: white;
  display: block;
  position: absolute;
  left: 50%;
  transform: translateX(-50%);
  height: 2.17px;
}
.bell::before {
  top: 100%;
  width: 20px;
}
.bell::after {
  top: calc(100% + 4px);
  width: 7px;
}
/*container main styling*/
.notification {
  background: transparent;
  border: none;
  padding: 15px 15px;
  border-radius: 50px;
  cursor: pointer;
  transition: 300ms;
  position: relative;
  display: flex;
  align-items: center;
  justify-content: center;
}
/*notifications number with before*/
.notification::before {
  content: "1";
  color: white;
  font-size: 10px;
  width: 12px;
  height: 12px;
  border-radius: 50%;
  background-color: red;
  position: absolute;
  right: 8px;
  top: 8px;
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 1000;
}
/*container background hover effect*/
.notification:hover {
  background: rgba(170, 170, 170, 0.062);
}
/*container animations*/
.notification:hover > .bell-container {
  animation: bell-animation 650ms ease-out 0s 1 normal both;
}
/*bell ring and scale animation*/
@keyframes bell-animation {
  20% {
    transform: rotate(15deg);
  }

  40% {
    transform: rotate(-15deg);
    scale: 1.1;
  }
  60% {
    transform: rotate(10deg);
    scale: 1.1;
  }
  80% {
    transform: rotate(-10deg);
  }
  0%,
  100% {
    transform: rotate(0deg);
  }
}

</style>
<body>
    <div class="navs">
    <i class="fa-regular fa-bars-sort"></i>

        <img src="assets/img/logo.png" alt="">

		<div class="notification" onclick="toggleMenu()">
      <div class="bell-container">
            <div class="bell"></div>
          </div>
        </div>
        </div>
	<div class="menu" id="menu">
        <span class="close-button" onclick="toggleMenu()">&times;</span>
        <h3>Duyurular</h3>
        <ul>
            <?php while ($row = mysqli_fetch_assoc($result_select)) { ?>
                <li>
                    <strong>Başlık:</strong> <?php echo $row['baslik']; ?><br>
                    <strong>Konu:</strong> <?php echo $row['konu']; ?><br>
                    <strong>Tarih:</strong> <?php echo $row['tarih']; ?><br>
                    <strong>Süresi:</strong> <?php echo $row['suresi']; ?>
                    <hr>
                </li>
            <?php } ?>
        </ul>
    </div>
    <div class="content">
        <div class="pp">
            <img src="assets/img/pp.jpg" alt="">
            <div class="text">
			
            <h1>Merhaba, <b>
            <?php 
            $username = htmlspecialchars($_SESSION['username']); // Oturumdan kullanıcı adı verisi alınıyor
            $ilk_kelime = explode(' ', $username)[0]; // İlk kelimeyi almak için boşluk karakterine göre ayır ve ilk elemanı al

            echo $ilk_kelime; 
            ?>
        </b></h1>
                <p>Umarız güzel bir gün geçiriyorsunuzdur!</p>
         
			</div>
        </div>
        <div class="ist">
            <div class="box" id="kutu1">
                <h1 id="max-count" >355</h1>
                <p>NFC OKUTMA</p>
            </div>
            <div class="box" id="kutu2">
                <h1 id="max-count">417</h1>
                <p>QR OKUTMA</p>
            </div>
            <div class="box" id="kutu3">
                <h1 id="max-count">772</h1>
                <p>TOPLAM OKUTMA</p>
            </div>
            <div class="box" id="kutu4">
                <h1 id="max-count">15</h1>
                <p>ÜRÜN SAYISI</p>
            </div>
        </div>
        <div class="bldrm">
            <h2>Bildirimler</h2>
		<?php
        // Veritabanı bağlantısı için gerekli bilgileri dahil et
        include 'db_connection.php';

        // Kullanıcıları seç
        $sql = "SELECT * FROM duyurular";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
        ?>
            <div class="bldkutu">
                <i class="fa-solid fa-bell"></i>
                <p> <?php echo htmlspecialchars($row['baslik']); ?></p>
            </div>
               <?php
            }
        } else {
            echo "<tr><td colspan='6'>Kullanıcı bulunamadı.</td></tr>";
        }

        // Veritabanı bağlantısını kapat
        mysqli_close($conn);
        ?>
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
  var boxes = document.querySelectorAll(".box");
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