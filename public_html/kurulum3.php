<?php

$servername = "localhost";
$username = "dijikart_admin"; // Veritabanı kullanıcı adı
$password = "Diji1453?"; // Veritabanı şifre
$dbname = "dijikart_vt";

// URL'den gelen ID'yi al
$id = isset($_GET['id']) && !empty($_GET['id']) ? $_GET['id'] : '';

// ID geçersizse işlem yapılmaz
if (empty($id)) {
    die("Geçersiz ID.");
}

// Veritabanı bağlantısını oluştur
$conn = new mysqli($servername, $username, $password, $dbname);

// Bağlantıyı kontrol et
if ($conn->connect_error) {
    die("Veritabanına bağlanılamadı: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Form gönderildiğinde güncelleme işlemini gerçekleştir
    $iname = $_POST['iname'];
    $isektor = $_POST['isektor'];
    $itel = $_POST['itel'];
    $iposta = $_POST['iposta'];
    $iweb = $_POST['iweb'];
    $iadress = $_POST['iadress'];

    // SQL sorgusu ve güncelleme işlemi
    $sql = "UPDATE kartvizit SET iname=?, isektor=?, itel=?, iposta=?, iweb=?, iadress=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssi", $iname, $isektor, $itel, $iposta, $iweb, $iadress, $id);

    // Güncelleme işleminin başarılı olup olmadığını kontrol et
    if ($stmt->execute()) {
        echo "Güncelleme başarıyla gerçekleştirildi.";
        header("Location: kurulum4.php?id=$id");
        exit();
    } else {
        echo "Hata: " . $stmt->error;
    }
}

// ID'yi kontrol et
$sql = "SELECT iname, isektor, itel, iposta, iweb, iadress FROM kartvizit WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->store_result();

// ID varsa formu göster
if ($stmt->num_rows > 0) {
    $stmt->bind_result($iname, $isektor, $itel, $iposta, $iweb, $iadress);
    $stmt->fetch();

    // NULL veya boş değer kontrolü yap
    if (empty($iname) || empty($isektor) || empty($itel)) {
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
        <h1> Şirket Bilgilerinizi Girin! (3/3)</h1>
        <form action="kurulum3.php?id=<?php echo $id; ?>" method="post">
            <input type="text" id="iname" class="input-box" name="iname" placeholder="Şirket İsmi" value="<?php echo $iname; ?>" required>
            <input type="text" id="isektor" class="input-box" name="isektor" placeholder="Sektör" value="<?php echo $isektor; ?>" required>
            <input type="tel" id="itel" class="input-box" name="itel" placeholder="Telefon" value="<?php echo $itel; ?>" required>
            <input type="email" id="iposta" class="input-box" name="iposta" placeholder="E Posta" value="<?php echo $iposta; ?>">
            <input type="url" id="iweb" class="input-box" name="iweb" placeholder="Website" value="<?php echo $iweb; ?>">
            <input type="text" id="iadress" class="input-box" name="iadress" placeholder="Adres" value="<?php echo $iadress; ?>">
            <button type="submit" class="submit">Devam et<i class="fa-solid fa-angle-right"></i></button>
        </form>
        <a href="kurulum4.php?id=<?php echo $id; ?>">
        <button style="background-color: #f8f8f8;
    color: BLACK;
    font-weight: 500;
    font-size: 16px;
    outline: none;
    width: 87%;
    height: 48px;
    border-radius: 10px;
    Border: none;
    text-indent: 15px;
    font-family: 'Poppins', sans-serif;
    margin-bottom: 20px;">Atla</button>
        </a>
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