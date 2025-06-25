<?php
session_start(); // Session'ı başlat

// Kullanıcı oturum açmamışsa login.php sayfasına yönlendir
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include 'db_connection.php'; // Veritabanı bağlantı dosyasını çağır

// Oturumdan username'i al
$username = $_SESSION['username'];

// Kullanıcı bilgilerini veritabanından al
$sql = "SELECT * FROM kusers WHERE username='$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $user_data = $result->fetch_assoc();
    $userID = $user_data['id'];
    $username = $user_data['username'];
    $phone = $user_data['phone'];
    $email = $user_data['email'];
    $adress = $user_data['adress'];
} else {
    echo "Kullanıcı bulunamadı";
    exit();
}

// Hata mesajı için değişken
$error_message = "";

// Form gönderildiğinde veritabanını güncelle
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Form verilerini al
    $newUsername = $_POST['username'];
    $newTelefon = $_POST['phone'];
    $newEposta = $_POST['email'];
    $newAdress = $_POST['adress'];

    // Aynı kullanıcı adı olup olmadığını kontrol et
    $check_username_sql = "SELECT id FROM kusers WHERE username='$newUsername' AND id != '$userID'";
    $check_username_result = $conn->query($check_username_sql);

    if ($check_username_result->num_rows > 0) {
        $error_message = "Bu kullanıcı adı zaten alınmış!";
    } else {
        // Veritabanında kullanıcı bilgilerini güncelle
        $update_sql = "UPDATE kusers SET username='$newUsername', phone='$newTelefon', email='$newEposta', adress='$newAdress' WHERE id='$userID'";
        if ($conn->query($update_sql) === TRUE) {
            // Sayfayı yeniden yönlendir
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        } else {
            echo "Hata: " . $update_sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>

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
        margin-top: 8px;
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
        font-size: 18px;
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
        font-weight: 500;
        font-style: normal;
    }


    .file-upload {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        height: 50px;
        background-color: #F5F6F7;
        border-radius: 8px;
        justify-content: space-between;
    }

    #custom-button {
        padding: 13px;
        background-color: #539DF3;
        color: white;
        border: none;
        cursor: pointer;
        font-family: "Poppins", sans-serif;
        font-size: 15px;
        font-weight:600;
        font-style: normal;
        border-radius: 0 10px 10px 0;
        margin-right: -10px;
        width: 15%;
    }

    #custom-button1 {
        background-color: #539DF3;
        color: white;
        border: none;
        cursor: pointer;
        font-family: "Poppins", sans-serif;
        font-size: 15px;
        font-weight:600;
        font-style: normal;
        border-radius: 10px 0 0 10px;
        margin-right: -10px;
        width: 13%;
        height: 100%;
    }
    
    #custom-text {
        margin-left: 10px;
        font-family: "Poppins", sans-serif;
        font-size: 15px;
        font-weight:400;
        font-style: normal;
    }
</style>

<body>
    <div class="navs">
        <a href="hesabim.php"><i class="fa-solid fa-arrow-left" id="left"></i></a> 
        <h1>Bilgileri Düzenle</h1>
    </div>
    <div class="content">
        
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form">
            <input style="font-weight: 700;" type="text" id="inputField" value="<?php echo $userID; ?>" disabled>
        </div>
        <br>

        <?php if (!empty($error_message)): ?>
            <p style="color: red;"><?php echo $error_message; ?></p>
        <?php endif; ?>

        <div class="form">
            <h3>Ad Soyad</h3>
            <input type="text" id="username" name="username" value="<?php echo $username; ?>">
        </div>
        <div class="form">
            <h3>Telefon</h3>
            <input type="tel" name="phone" value="<?php echo $phone; ?>">
        </div>
        <div class="form">
            <h3>E Posta</h3>
            <input type="email" name="email" value="<?php echo $email; ?>">
        </div>
        <div class="form">
            <h3>Adress</h3>
            <input type="text" name="adress" value="<?php echo $adress; ?>">
        </div>
        <p><b style="color: red;">Not:</b> Bu bilgiler bizim size ulaşmamız için gereklidir. Profil Sayfasına işlenmez.</p>
        <input class="submit" type="submit" value="Bilgileri Güncelle">
    </form>
    </div>
       <script>
        const realFileBtn = document.getElementById("real-file");
        const customBtn = document.getElementById("custom-button");
        const customTxt = document.getElementById("custom-text");
    
        customBtn.addEventListener("click", function() {
        realFileBtn.click();
        });
    
        realFileBtn.addEventListener("change", function() {
        if (realFileBtn.value) {
            customTxt.innerHTML = realFileBtn.value.match(/[\/\\]([\w\d\s\.\-\(\)]+)$/)[1]; // Dosya adını alır ve gösterir
        } else {
            customTxt.innerHTML = "Fotoğraf Seç";
        }
        });

        //İD İNPUT

        document.addEventListener("DOMContentLoaded", function() {
    var inputField = document.getElementById("inputField");

    // Input alanının başına varsayılan değeri (#) ekleyin
    inputField.value = "#" + inputField.value;

    // Kullanıcının input alanına herhangi bir tuşa basarak yazı yazmasını engelleyin
    inputField.addEventListener("keypress", function(event) {
        event.preventDefault();
    });
});
    </script>
</body>
</html>
