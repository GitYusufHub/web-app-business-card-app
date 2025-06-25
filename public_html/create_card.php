<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
include "db_connection.php";

$username = $_SESSION['username'];
$user_id_query = "SELECT id FROM kusers WHERE username = '$username'";
$result = $conn->query($user_id_query);
$user_id_row = $result->fetch_assoc();
$user_id = $user_id_row['id'];

// Kullanıcının zaten bir kartviziti var mı kontrol et
$existing_card_query = "SELECT id FROM kartvizit WHERE user_id = $user_id";
$existing_card_result = $conn->query($existing_card_query);
if ($existing_card_result->num_rows > 0) {
    echo "Zaten bir kartvizitiniz var.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $title = $_POST['title'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $hakkimda = $_POST['hakkimda'];
    $web = $_POST['web'];
    $sos_1 = $_POST['sos_1'];
    $sos_2 = $_POST['sos_2'];
    $sos_3 = $_POST['sos_3'];
    $sos_4 = $_POST['sos_4'];
    
    $iban_name = $_POST['iban_name'];
    $iban = $_POST['iban'];
    $iban2_name = $_POST['iban2_name'];
    $iban2 = $_POST['iban2'];
    $iban3_name = $_POST['iban3_name'];
    $iban3 = $_POST['iban3'];
    
    $theme_id = $_POST['theme'];

    $insert_query = "INSERT INTO kartvizit (name, title, phone, email, hakkimda, web, sos_1, sos_2, sos_3, sos_4, iban_name, iban, iban2_name, iban2, iban3_name, iban3, theme_id, user_id) 
    VALUES ('$name', '$title', '$phone', '$email', '$hakkimda', '$web', '$sos_1', '$sos_2', '$sos_3', '$sos_4', '$iban_name', '$iban', '$iban2_name', '$iban2', '$iban3_name', '$iban3', '$theme_id', '$user_id')";

    if ($conn->query($insert_query) === TRUE) {
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Error: " . $insert_query . "<br>" . $conn->error;
    }
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DijiKart - Profil Düzenle</title>
    <link rel="stylesheet" href="style/profildzn.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
</head>
<body>
    <div class="nav">
        <a href="kartlarım.php"><i class="fa-solid fa-arrow-left" id="left"></i></a>
        <h1>Profil Düzenle</h1>
    </div>
    <div class="content">
        <h1>KİŞİSEL BİLGİLER</h1>
        <form action="" method="post">
            <div class="file-upload">
                <input type="file" id="real-file" hidden="hidden" />
                <span id="custom-text">Fotoğraf Seç</span>
                <button type="button" id="custom-button">Seç</button>
            </div>
            <div class="form">
                <h3>Ad Soyad</h3>
                <input type="text" id="name" name="name" required><br>
            </div>
            <div class="form">
                <h3>Ünvan / Meslek</h3>
                <input type="text" id="title" name="title"><br>
            </div>
            <div class="form">
                <h3>Telefon</h3>
                <input type="tel" id="phone" name="phone"><br>
            </div>
            <div class="form">
                <h3>E Posta</h3>
                <input type="email" id="email" name="email" required><br>
            </div>
            <div class="form">
                <h3>Website</h3>
                <input type="text" id="web" name="web"><br>
            </div>
            <div class="form">
                <h3>Hakkımda</h3>
                <input type="text" id="hakkimda" name="hakkimda"><br>
            </div>

            <h1>SOSYAL MEDYA</h1>
            <div class="file-upload" style="margin-top: 10px; margin-bottom: 30px;">
                <button type="button" id="custom-button1"><i class="fa-brands fa-instagram" style="font-size: 30px;"></i></button>
                <input type="text" id="sos_1" name="sos_1"><br>
            </div>
            <div class="file-upload" style="margin-top: -20px; margin-bottom: 30px;">
                <button type="button" id="custom-button1"><i class="fa-brands fa-facebook-f" style="font-size: 30px;"></i></button>
                <input type="text" id="sos_2" name="sos_2"><br>
            </div>
            <div class="file-upload" style="margin-top: -20px; margin-bottom: 30px;">
                <button type="button" id="custom-button1"><i class="fa-brands fa-x-twitter" style="font-size: 30px;"></i></button>
                <input type="text" id="sos_3" name="sos_3"><br>
            </div>
            <div class="file-upload" style="margin-top: -20px; margin-bottom: 30px;">
                <button type="button" id="custom-button1"><i class="fa-brands fa-tiktok" style="font-size: 30px;"></i></button>
                <input type="text" id="sos_4" name="sos_4"><br>
            </div>

            <h1>BANKA BİLGİLERİ</h1>

            <!-- First Bank -->
            <h3>IBAN 1</h3>
            <select name="iban_name" id="iban_name" required>
                <option value="" selected="selected">Banka Seçin</option>
                <option value="Garanti BBVA">Garanti BBVA</option>
                <option value="Türkiye İş Bankası">Türkiye İş Bankası</option>
                <option value="Akbank">Akbank</option>
                <option value="Ziraat Bankası">Ziraat Bankası</option>
                <option value="Halkbank">Halkbank</option>
                <option value="VakıfBank">VakıfBank</option>
                <option value="Yapı Kredi">Yapı Kredi</option>
            </select>
            <input type="text" id="iban" name="iban"><br>

            <!-- Second Bank -->
            <h3>IBAN 2</h3>
            <select name="iban2_name" id="iban2_name">
                <option value="" selected="selected">Banka Seçin</option>
                <option value="Garanti BBVA">Garanti BBVA</option>
                <option value="Türkiye İş Bankası">Türkiye İş Bankası</option>
                <option value="Akbank">Akbank</option>
                <option value="Ziraat Bankası">Ziraat Bankası</option>
                <option value="Halkbank">Halkbank</option>
                <option value="VakıfBank">VakıfBank</option>
                <option value="Yapı Kredi">Yapı Kredi</option>
            </select>
            <input type="text" id="iban2" name="iban2"><br>

            <!-- Third Bank -->
            <h3>IBAN 3</h3>
            <select name="iban3_name" id="iban3_name">
                <option value="" selected="selected">Banka Seçin</option>
                <option value="Garanti BBVA">Garanti BBVA</option>
                <option value="Türkiye İş Bankası">Türkiye İş Bankası</option>
                <option value="Akbank">Akbank</option>
                <option value="Ziraat Bankası">Ziraat Bankası</option>
                <option value="Halkbank">Halkbank</option>
                <option value="VakıfBank">VakıfBank</option>
                <option value="Yapı Kredi">Yapı Kredi</option>
            </select>
            <input type="text" id="iban3" name="iban3"><br>

            <label for="theme">Tema:</label><br>
            <select id="theme" name="theme" required>
                <option value="">Tema Seçin</option>
                <?php
                $theme_query = "SELECT * FROM themes";
                $theme_result = $conn->query($theme_query);
                if ($theme_result->num_rows > 0) {
                    while ($row = $theme_result->fetch_assoc()) {
                        echo "<option value='" . $row['id'] . "'>" . $row['theme_name'] . "</option>";
                    }
                } else {
                    echo "<option value=''>Tema mevcut değil. Lütfen tema ekleyin.</option>";
                }
                ?>
            </select>

            <input type="submit" value="Create Card">
        </form>
    </div>
</body>
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
</script>
</html>
