<?php

$servername = "localhost";
$username = "dijikart_admin"; // Veritabanı kullanıcı adı
$password = "Diji1453?"; // Veritabanı şifre
$dbname = "dijikart_vt";

// URL'den gelen ID'yi al
$id = isset($_GET['id']) ? $_GET['id'] : '';

// Veritabanı bağlantısını oluştur
$conn = new mysqli($servername, $username, $password, $dbname);

// Bağlantıyı kontrol et
if ($conn->connect_error) {
    die("Veritabanına bağlanılamadı: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Form gönderildiğinde güncelleme işlemini gerçekleştir
    $name = $_POST['name'];
    $title = $_POST['title'];
    $hakkimda = $_POST['hakkimda'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $web = $_POST['web'] ?? '';   
    $sos_1 = $_POST['sos1'] ?? '';
    $sos_2 = $_POST['sos2'] ?? '';   
    $sos_3 = $_POST['sos3'] ?? '';
    $sos_4 = $_POST['sos4'] ?? '';
    $sos_5 = $_POST['sos5'] ?? '';
    $sos_6 = $_POST['sos6'] ?? '';
    
    $theme_id = 1; // Theme ID'si 1 olarak ayarlanıyor
    
    $sql = "UPDATE kartvizit SET name=?, title=?, hakkimda=?, phone=?, email=?, web=?, sos_1=?, sos_2=?, sos_3=?, sos_4=?, sos_5=?, sos_6=?, theme_id=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssssssii", $name, $title, $hakkimda, $phone, $email, $web, $sos_1, $sos_2, $sos_3, $sos_4, $sos_5, $sos_6, $theme_id, $id);

    if($stmt->execute()) {
        echo "Güncelleme başarıyla gerçekleştirildi.";
        header("Location: kurulum3.php?id=$id");
        exit();
    } else {
        echo "Hata: " . $stmt->error;
    }
}

// ID'yi kontrol et
$sql = "SELECT name, title, email, phone, hakkimda FROM kartvizit WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->store_result();

// ID varsa formu göster
if ($stmt->num_rows > 0) {
    $stmt->bind_result($name, $title, $email, $phone, $hakkimda);
    $stmt->fetch();
    // NULL kontrolü yap
    if ($name === null || $title === null || $hakkimda === null) {
?>
<!DOCTYPE html>
<html>
<head>
    <title>DijiKart Kurulum</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>  
<body>
    <div class="main">
        <img class="logo" src="https://dijikart.net/upload/logom.png" alt="">
        <h1> Profil Oluşturun (2/3)</h1>
        <form action="kurulum2.php?id=<?php echo $id; ?>" method="post">
            <input type="text" id="name" class="input-box" name="name" placeholder="Ad Soyad" value="<?php echo $name; ?>" required>
            <input type="text" id="title" class="input-box" name="title" placeholder="Ünvan/Meslek" value="<?php echo $title; ?>" required>
            <input type="text" id="hakkimda" class="input-box" name="hakkimda" placeholder="Hakkımda" value="<?php echo $hakkimda; ?>" required>
            <br><input type="tel" class="input-box" id="phone" name="phone" placeholder="Telefon" value="<?php echo $phone; ?>" required>
            <br><input type="email" class="input-box" id="email" name="email" placeholder="E Posta adresinizi girin" value="<?php echo $email; ?>">
            <input type="text" id="web" class="input-box" name="web" placeholder="Webiste" value="<?php echo $web; ?>">
            <input type="text" id="sos1" class="input-box" name="sos1" placeholder="İnstagram kullanıcı adı" value="<?php echo $sos_1; ?>">
            <input type="text" id="sos2" class="input-box" name="sos2" placeholder="Facebook kullanıcı adı" value="<?php echo $sos_2; ?>">
            <input type="text" id="sos3" class="input-box" name="sos3" placeholder="Twittwer (x) kullanıcı adı" value="<?php echo $sos_3; ?>">
            <input type="tel" id="sos4" class="input-box" name="sos4" placeholder="WhatsApp Numara" value="<?php echo $sos_4; ?>">
            <input type="text" id="sos5" class="input-box" name="sos5" placeholder="Linkedin kullanıcı adı" value="<?php echo $sos_5; ?>">
            <input type="text" id="sos6" class="input-box" name="sos6" placeholder="Telegram kullanıcı adı" value="<?php echo $sos_6; ?>">
            <button type="submit" class="submit">Devam et<i class="fa-solid fa-angle-right"></i></button>
        </form>
    </div>
</body>
</html>

<?php
    } else {
        echo "Eksik bilgi, işlem yapılamaz.";
    }
} else {
    echo "ID bulunamadı.";
}

// Bağlantıyı kapat
$stmt->close();
$conn->close();
?>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap');

    body {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 140vh; /* Ekran yüksekliğinin tamamını kapla */
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