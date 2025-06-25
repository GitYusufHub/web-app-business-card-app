<?php
session_start();
include "db_connection.php";

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $card_id = $_GET['id'];

    $sql = "SELECT * FROM kartvizit WHERE id = $card_id";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $name = $row['name'];
        $title = $row['title'];
        $phone = $row['phone'];
        $email = $row['email'];
        $hakkimda = $row['hakkimda'];
        $web = $row['web'];
        $sos_1 = $row['sos_1'];
        $sos_2 = $row['sos_2'];
        $sos_3 = $row['sos_3'];
        $sos_4 = $row['sos_4'];
        $iban = $row['iban'];
        $theme_id = $row['theme_id'];

        // Tema CSS dosyasını eklemek için
        if (isset($theme_id)) {
            $theme_query = "SELECT css_file FROM themes WHERE id = $theme_id";
            $theme_result = $conn->query($theme_query);
            if ($theme_result->num_rows == 1) {
                $theme_row = $theme_result->fetch_assoc();
                $css_file = $theme_row['css_file'];
                echo "<link rel='stylesheet' type='text/css' href='$css_file'>";
            }
        }
    } else {
        echo "No card found.";
        exit();
    }
} else {
    echo "Invalid request.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Card</title>

	 <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
  <style>
    .modal {
      display: none; /* Başlangıçta modal gizli olsun */
      position: fixed; /* Pencerenin ortasında görünsün */
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      background-color:; /* Arkaplanı biraz opak yap */
      z-index: 999; /* Diğer elemanların üzerine çıksın */
      padding: 20px;
      border-radius: 10px;
      opacity: 0;
      transition: opacity 0.3s ease;
    }

    .modal-content {
      background-color:#FFFFFF90;
      border-radius: 10px;
      padding: 20px;
      text-align: center;
    }

    .close {
      color: #aaa;
      float: right;
      font-size: 28px;
      font-weight: bold;
      cursor: pointer;
    }

    .close:hover,
    .close:focus {
      color: black;
      text-decoration: none;
    }

    .modal.active {
      display: block;
      opacity: 1;
    }
	
    #qrButton {
      background-color: rgba(0, 0, 0, 0); /* Buton arka planını şeffaf yap */
      border: 0px solid #000; /* Buton kenarlık rengi */
      padding: 10px 20px; /* Buton iç boşluğu */
      cursor: pointer;
    }

    #qrButton:hover {
      background-color: rgba(0, 0, 0, 0.1); /* Butona hover olduğunda arka plan rengini hafifçe değiştir */
    }
  </style>

<body>
   

  <div class="profile">


    <div class="icons">
     <button id="qrButton"><i class="fa-solid fa-qrcode" id="qr" ></i></button> <div id="qrModal" class="modal">
    <div class="modal-content">
      <span class="close">&times;</span>
      <div id="qrCode"></div>
    </div>
  </div>
      <a href="kartlarım.php"><i class="fa-solid fa-pen" id="edit"></i></a>
    </div>

    <div class="yuvarlak">
      <img src="images/profile1.jpg" alt="">
      <div class="baslik">
        <h3><?php echo $name; ?></h3>
        <img class="verified" src="images/verified1.png" alt="">
      </div>
      <h4><?php echo $title; ?></h4>
    </div>
    <div class="socailm">
      <a href="https://www.instagram.com/<?php echo $sos_1; ?>"><i class="fa-brands fa-instagram"></i></a>
      <a href="https://twitter.com/<?php echo $sos_3; ?>"><i class="fa-brands fa-x-twitter"></i></a>
      <a href="https://www.facebook.com/<?php echo $sos_2; ?>"><i class="fa-brands fa-facebook-f"></i></a>
      <a href="https://www.tiktok.com/@<?php echo $sos_4; ?>"><i class="fa-brands fa-tiktok"></i></a>
      <a href="#"><i class="fa-brands fa-threads"></i></a>
      <a href="#"><i class="fa-brands fa-telegram"></i></a>
    </div>	
    <div class="bio">
      <p><?php echo $hakkimda; ?></p>
    </div>
    <div class="blg">
      <div class="blgd">
        <i class="fa-solid fa-phone-volume"></i>
       <p><a href="tel:<?php echo $phone; ?>" style="color:black; text-decoration:none;">+90 <?php echo $phone; ?></a></p>
      </div>
      <div class="blgd">
        <i class="fa-solid fa-envelope"></i>
        <p><a href="mailto:<?php echo $email; ?>" style="color:black; text-decoration:none;" ><?php echo $email; ?></a>	</p>
      </div>
      <div class="blgd">
        <i class="fa-solid fa-globe"></i>
        <p><a href="https://<?php echo $web; ?>"style="color:black; text-decoration:none;"><?php echo $web; ?></a></p>
      </div>
    </div>
    <div class="bnk">
      <h1>Banka Bilgileri</h1>
      <div class="cizgiler"></div>
      <div class="ibn">
        <h2>Garanti Bankası</h2>
        <p>TR<?php echo $iban; ?></p>
      </div>
      <div class="ibn">
        <h2>İş Bankası</h2>
        <p>TR<?php echo $iban; ?></p>
      </div>
      <div class="ibn">
        <h2>Ziraat Bankası</h2>
        <p>TR<?php echo $iban; ?></p>
      </div>
    </div>
    <div class="ypn">
      <img src="images/djk.png" alt="">
      <p>Bu profil <b><a href="https://altf4teknoloji.com/">ALTF4 TEKNOLOJİ</a></b> tarafından <b>DijiKart</b> projesi
        altında yapılmıştır.</p>
    </div>
  </div>
  </div>
     <script>
  function showImage() {
  document.getElementById("loader-container").style.display = "none";
  document.getElementById("image-container").style.display = "block";
}

  
  </script>
 <script src="script.js"></script>
</body>
</html>
