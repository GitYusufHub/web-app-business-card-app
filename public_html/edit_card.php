<?php
session_start();

// Kullanıcı oturum açmamışsa login.php sayfasına yönlendir
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include 'db_connection.php'; // Veritabanı bağlantısını dosyaya dahil et

$username = $_SESSION['username'];

// Kullanıcı ID'sini `username` üzerinden çekme
$user_query = "SELECT id FROM kusers WHERE username = '$username'";
$user_result = $conn->query($user_query);

if ($user_result->num_rows > 0) {
    $user_row = $user_result->fetch_assoc();
    $user_id = $user_row['id'];
} else {
    echo "Kullanıcı bulunamadı.";
    exit();
}

// Kullanıcı bilgilerini çekme
$sql = "SELECT * FROM kartvizit WHERE user_id = '$user_id'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $name = $row['name'];
    $title = $row['title'];
    $phone = $row['phone'];
    $email = $row['email'];
    $web = $row['web'];
    $hakkimda = $row['hakkimda'];
    $sos_1 = $row['sos_1'];
    $sos_2 = $row['sos_2'];
    $sos_3 = $row['sos_3'];
    $sos_4 = $row['sos_4'];
    $sos_5 = $row['sos_5'];
    $sos_6 = $row['sos_6'];
    $iban_name = $row['iban_name'];
    $iban = $row['iban'];
    $iban2_name = $row['iban2_name'];
    $iban2 = $row['iban2'];
    $iban3_name = $row['iban3_name'];
    $iban3 = $row['iban3'];
    $iname = $row['iname'];
    $isektor = $row['isektor'];
    $itel = $row['itel'];
    $iposta = $row['iposta'];
    $iweb = $row['iweb'];
    $iadress = $row['iadress'];
    $theme_id = $row['theme_id'];
    // img_name boşsa varsayılan user.jpg gösterilsin
    $img_name = !empty($row['img_name']) ? $row['img_name'] : 'user.jpg';
} else {
    echo "Kullanıcı bulunamadı.";
    exit();
}

// Form gönderildiğinde
$guncelleme_basarili = false; // Başarılı olup olmadığını izlemek için bir değişken
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Profil resmi yükleme
    if (isset($_FILES["profil_img"]) && $_FILES["profil_img"]["error"] == 0) {
        $uploadDir = "Upload/Profil/";
        $imageFileType = strtolower(pathinfo($_FILES["profil_img"]["name"], PATHINFO_EXTENSION));
        $imgName = uniqid() . "." . $imageFileType; // Rastgele isim oluşturma
        $targetFilePath = $uploadDir . $imgName;
        $uploadOk = 1;

        // Resim dosyası mı kontrol et
        $check = getimagesize($_FILES["profil_img"]["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            $uploadOk = 0;
        }

        // Dosya boyutunu kontrol et
        if ($_FILES["profil_img"]["size"] > 5000000) {
            $uploadOk = 0;
        }

        // İzin verilen dosya uzantılarını kontrol et
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
            $uploadOk = 0;
        }

        // Dosyayı yükle
        if ($uploadOk == 1) {
            // Önceki dosya varsa sil
            if (!empty($img_name) && $img_name !== 'user.jpg' && file_exists($uploadDir . $img_name)) {
                unlink($uploadDir . $img_name);
            }

            if (move_uploaded_file($_FILES["profil_img"]["tmp_name"], $targetFilePath)) {
                // Veritabanında ilgili satırı güncelle
                $sql = "UPDATE kartvizit SET img_name = '$imgName' WHERE user_id = '$user_id'";
                $conn->query($sql);
                // Yükleme başarılı olduğunda sayfayı yenile
                header("Location: " . $_SERVER['PHP_SELF']);
                exit();
            }
        }
    }

    // Profil resmini silme işlemi
    if (isset($_POST['delete_img'])) {
        $uploadDir = "Upload/Profil/";
        // Eski resim dosyasını sil
        if (!empty($img_name) && $img_name !== 'user.jpg' && file_exists($uploadDir . $img_name)) {
            unlink($uploadDir . $img_name); // Eski resmi sil
        }
        // Veritabanında img_name'i null yap
        $sql = "UPDATE kartvizit SET img_name = NULL WHERE user_id = '$user_id'";
        $conn->query($sql);
        // Silme işlemi sonrası sayfayı yenile
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }

    // İBAN alanlarına "TR" ekle
    $iban = $_POST['iban'];
    $iban2 = $_POST['iban2'];
    $iban3 = $_POST['iban3'];

    // Eğer TR ile başlamıyorsa ekleyelim
    if (substr($iban, 0, 2) !== 'TR') {
        $iban = 'TR' . $iban;
    }
    if (!empty($iban2) && substr($iban2, 0, 2) !== 'TR') {
        $iban2 = 'TR' . $iban2;
    }
    if (!empty($iban3) && substr($iban3, 0, 2) !== 'TR') {
        $iban3 = 'TR' . $iban3;
    }

    // Diğer form verilerini güncelle
    $name = $_POST['name'];
    $title = $_POST['title'];
    $phone = $_POST['phone']; // Telefonu burada alacağız
    $email = $_POST['email'];
    $web = $_POST['web'];
    $hakkimda = $_POST['hakkimda'];
    $sos_1 = $_POST['sos_1'];
    $sos_2 = $_POST['sos_2'];
    $sos_3 = $_POST['sos_3'];
    $sos_4 = $_POST['sos_4'];
    $sos_5 = $_POST['sos_5'];
    $sos_6 = $_POST['sos_6'];
    $iban_name = $_POST['iban_name'];
    $iban2_name = $_POST['iban2_name'];
    $iban3_name = $_POST['iban3_name'];
    $iname = $_POST['iname'];
    $isektor = $_POST['isektor'];
    $itel = $_POST['itel'];
    $iposta = $_POST['iposta'];
    $iweb = $_POST['iweb'];
    $iadress = $_POST['iadress'];
    $theme_id = $_POST['theme'];

    $sql = "UPDATE kartvizit SET 
        name = '$name', 
        title = '$title', 
        phone = '$phone', 
        email = '$email', 
        web = '$web', 
        hakkimda = '$hakkimda', 
        sos_1 = '$sos_1', 
        sos_2 = '$sos_2', 
        sos_3 = '$sos_3', 
        sos_4 = '$sos_4',
        sos_5 = '$sos_5',
        sos_6 = '$sos_6',
        iban_name = '$iban_name',
        iban = '$iban', 
        iban2_name = '$iban2_name',
        iban2 = '$iban2', 
        iban3_name = '$iban3_name',
        iban3 = '$iban3',
        iname = '$iname',
        isektor = '$isektor',
        itel = '$itel',
        iposta = '$iposta',
        iweb = '$iweb',
        iadress = '$iadress',
        theme_id = '$theme_id'
        WHERE user_id = '$user_id'";

    if ($conn->query($sql) === TRUE) {
        $guncelleme_basarili = true; // Başarılı güncelleme
    } else {
        echo "Hata: " . $sql . "<br>" . $conn->error;
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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
<style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

        * {
            font-family: "Poppins", sans-serif;
            user-select: none;
        }

        body {
            margin: 0;
            padding: 0;
        }

        .profile-img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        .ppkutu {
            width: 100%;
            height: 200px;
            background-color: #F5F6F7;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            margin-top: -45px;
        }

        .ppkutu img {
            padding-top: 15px;
        }

        .navs {
            display: flex;
            align-items: center;
        }

        .navs a {
            text-decoration: none;
            color: black;
        }

        .k {
            width: 40px;
            height: 40px;
            background-color: #F5F6F7;
            border-radius: 10px;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 10px;
        }

        .k i {
            font-size: 20px;
        }

        .navs h1 {
            font-weight: 600;
            font-size: 28px;
        }

        .fbtn {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .fbtn button {
            border: none;
            width: 40%;
            height: 40px;
            border-radius: 10px;
            margin-top: 10px;
        }

        #yukle {
            color: white;
            background-color: red;
            margin-right: 10px;
        }

        #sil {
            color: white;
            background-color: blue;
        }

        .hidden-input {
            display: none;
        }
		 #successNotification {
            display: none;
            position: fixed;
            top: 20px;
            right: 20px;
            background-color: #4CAF50;
            color: white;
            padding: 15px;
            border-radius: 5px;
            z-index: 9999;
        }
</style>
</head>
<body>
<div id="successNotification">
    Profil başarıyla güncellendi.
</div>

<script>
    // PHP tarafından güncelleme başarılı ise bildirim gösterilsin
    var guncellemeBasarili = <?php echo json_encode($guncelleme_basarili); ?>;
    if (guncellemeBasarili) {
        var notification = document.getElementById('successNotification');
        notification.style.display = 'block';
        setTimeout(function() {
            notification.style.display = 'none';
        }, 3000); // 3 saniye sonra kaybolacak
    }
</script>

    <div class="navs">
        <a href="dashboard.php?id=<?php echo $_SESSION['user_id']; ?>">
            <div class="k">
                <i class="fa-solid fa-arrow-left" id="left"></i>
            </div>
        </a>
        <h1>Profil Düzenle</h1>
    </div>
    <div class="content">
        <br>
        <br>
        <form action="" method="post" enctype="multipart/form-data">
            <br>
            <div class="ppkutu">
            <div>
                <img id="cropImage" src="Upload/Profil/<?php echo $img_name; ?>" alt="Profil Resmi" class="profile-img">
            </div>
            <div class="fbtn">
                <input type="file" id="fileInput" class="hidden-input" name="profil_img" accept="image/*" onchange="loadImage(event)">
                <button type="button" id="yukle" class="file-upload-button" onclick="triggerFileUpload()">
                    <i class="fa-solid fa-arrow-up-from-bracket"></i> Dosya Yükle
                </button>
                <button type="submit" id="sil" name="delete_img">
                    <i class="fa-solid fa-trash"></i> Sil
                </button>
            </div>
        </div>

        <!-- Modal Penceresi -->
        <div id="cropModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2>Resmi Kırp</h2>
                <img id="imageToCrop" style="width: 80%;">
                <br>
                <button type="button" id="cropButton" style="width: 150px;
                height: 40px;
                color: white;
                background-color: red;
                border-radius: 5px;
                border: none;
                ">Kırp ve Yükle</button>
            </div>
        </div>

        <!-- Modal için stil -->
        <style>
            /* Modal stil */
            .modal {
                display: none; 
                position: fixed; 
                z-index: 1; 
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                overflow: auto;
                background-color: rgb(0,0,0);
                background-color: rgba(0,0,0,0.4);
            }

            /* Modal içerik kutusu */
            .modal-content {
                background-color: #fefefe;
                margin: 15% auto;
                padding: 20px;
                border: 1px solid #888;
                width: 80%;
                max-width: 500px;
                text-align: center;
            }

            /* Kapatma butonu */
            .close {
                color: #aaa;
                float: right;
                font-size: 28px;
                font-weight: bold;
            }

            .close:hover,
            .close:focus {
                color: black;
                text-decoration: none;
                cursor: pointer;
            }
        </style>

            <div class="form">
                <h3>Ad Soyad</h3>
                <input type="text" id="name" name="name" value="<?php echo $name; ?>"><br>
            </div>
            <div class="form">
                <h3>Ünvan / Meslek</h3>
                <input type="text" id="title" name="title" value="<?php echo $title; ?>"><br>
            </div>
            <div class="form">
                <h3>Telefon</h3>
                <input type="tel" id="phone" name="phone" value="<?php echo $phone; ?>" pattern="\+90\d{10}" placeholder="+90 "><br>
                </div>
            <div class="form">
                <h3>E Posta</h3>
                <input type="email" id="email" name="email" value="<?php echo $email; ?>"><br>
            </div>
            <div class="form">
                <h3>Website</h3>
                <input type="text" id="web" name="web" value="<?php echo $web; ?>"><br>
            </div>
            <div class="form">
                <h3>Hakkımda</h3>
                <input type="text" id="hakkimda" name="hakkimda" value="<?php echo $hakkimda; ?>"><br>
            </div>
            <h1>SOSYAL MEDYA</h1>
            <div class="file-upload" style="margin-top: 10px; margin-bottom: 30px;">
                <button type="button" id="custom-button1">
                    <i class="fa-brands fa-instagram" style="font-size: 30px;"></i>
                </button>
                <input type="text" id="sos_1" name="sos_1" style="margin-left: 12px;" placeholder="İnstagram Kullanıcıadı" value="<?php echo $sos_1; ?>"><br>
            </div>
            <div class="file-upload" style="margin-top: -20px; margin-bottom: 30px;">
                <button type="button" id="custom-button1">
                    <i class="fa-brands fa-x-twitter" style="font-size: 30px;"></i>
                </button>
                <input type="text" id="sos_2" name="sos_2" style="margin-left: 12px;" placeholder="X Kullanıcıadı" value="<?php echo $sos_2; ?>"><br>
            </div>
            <div class="file-upload" style="margin-top: -20px; margin-bottom: 30px;">
                <button type="button" id="custom-button1">
                    <i class="fa-brands fa-facebook-f" style="font-size: 28px;"></i>
                </button>
                <input type="text" id="sos_3" name="sos_3" style="margin-left: 12px;" placeholder="Facebook Kullanıcıadı" value="<?php echo $sos_3; ?>"><br>
            </div>
            <div class="file-upload" style="margin-top: -20px; margin-bottom: 30px;">
                <button type="button" id="custom-button1">
                    <i class="fa-brands fa-whatsapp" style="font-size: 30px;"></i>
                </button>
                <input type="tel" id="sos_4" name="sos_4" style="margin-left: 12px;" placeholder="WhatsApp Numarası" value="<?php echo $sos_4; ?>"><br>
            </div>
            <div class="file-upload" style="margin-top: -20px; margin-bottom: 30px;">
                <button type="button" id="custom-button1">
                    <i class="fa-brands fa-linkedin-in" style="font-size: 30px;"></i>
                </button>
                <input type="text" id="sos_5" name="sos_5" style="margin-left: 12px;" placeholder="Linkedin Kullanıcıadı" value="<?php echo $sos_5; ?>"><br>
            </div>
            <div class="file-upload" style="margin-top: -20px; margin-bottom: 30px;">
                <button type="button" id="custom-button1">
                    <i class="fa-brands fa-telegram" style="font-size: 30px;"></i>
                </button>
                <input type="text" id="sos_6" name="sos_6" style="margin-left: 12px;" placeholder="Telegram Kullanıcıadı" value="<?php echo $sos_6; ?>"><br>
            </div>

            <h1>BANKA BİLGİLERİ</h1>
            <p style="color:black;">İBAN bilgisi girerken başına <b>TR</b> ibaresi koymanıza gerek yoktur.</p>
            <select name="iban_name" id="iban_name">
                <option value="" selected="selected">Banka Seçin</option>
                <option value="Garanti BBVA" <?php echo ($iban_name == 'Garanti BBVA') ? 'selected' : ''; ?>>Garanti BBVA</option>
                <option value="Türkiye İş Bankası" <?php echo ($iban_name == 'Türkiye İş Bankası') ? 'selected' : ''; ?>>Türkiye İş Bankası</option>
                <option value="Akbank" <?php echo ($iban_name == 'Akbank') ? 'selected' : ''; ?>>Akbank</option>
                <option value="Ziraat Bankası" <?php echo ($iban_name == 'Ziraat Bankası') ? 'selected' : ''; ?>>Ziraat Bankası</option>
                <option value="Halkbank" <?php echo ($iban_name == 'Halkbank') ? 'selected' : ''; ?>>Halkbank</option>
                <option value="VakıfBank" <?php echo ($iban_name == 'VakıfBank') ? 'selected' : ''; ?>>VakıfBank</option>
                <option value="Yapı Kredi" <?php echo ($iban_name == 'Yapı Kredi') ? 'selected' : ''; ?>>Yapı Kredi</option>
                <option value="QNB Finansbank" <?php echo ($iban3_name == 'QNB Finansbank') ? 'selected' : ''; ?>>QNB Finansbank</option>
                <option value="TEB" <?php echo ($iban3_name == 'TEB') ? 'selected' : ''; ?>>TEB</option>
                <option value="DenizBank" <?php echo ($iban3_name == 'DenizBank') ? 'selected' : ''; ?>>DenizBank</option>
                <option value="ING Bank" <?php echo ($iban3_name == 'ING Bank') ? 'selected' : ''; ?>>ING Bank</option>
                <option value="Kuveyt Türk" <?php echo ($iban3_name == 'Kuveyt Türk') ? 'selected' : ''; ?>>Kuveyt Türk</option>
                <option value="Papara" <?php echo ($iban3_name == 'Papara') ? 'selected' : ''; ?>>Papara</option>
                <option value="Tosla" <?php echo ($iban3_name == 'Tosla') ? 'selected' : ''; ?>>Tosla</option>
                <option value="İninal" <?php echo ($iban3_name == 'İninal') ? 'selected' : ''; ?>>İninal</option>
                <option value="Paycell" <?php echo ($iban3_name == 'Paycell') ? 'selected' : ''; ?>>Paycell</option>
            </select>
            <input type="text" id="iban" name="iban" value="<?php echo $iban; ?>" onblur="addTRPrefix('iban')"><br>
            <br>

            <select name="iban2_name" id="iban2_name">
                <option value="" selected="selected">Banka Seçin</option>
                <option value="Garanti BBVA" <?php echo ($iban2_name == 'Garanti BBVA') ? 'selected' : ''; ?>>Garanti BBVA</option>
                <option value="Türkiye İş Bankası" <?php echo ($iban2_name == 'Türkiye İş Bankası') ? 'selected' : ''; ?>>Türkiye İş Bankası</option>
                <option value="Akbank" <?php echo ($iban2_name == 'Akbank') ? 'selected' : ''; ?>>Akbank</option>
                <option value="Ziraat Bankası" <?php echo ($iban2_name == 'Ziraat Bankası') ? 'selected' : ''; ?>>Ziraat Bankası</option>
                <option value="Halkbank" <?php echo ($iban2_name == 'Halkbank') ? 'selected' : ''; ?>>Halkbank</option>
                <option value="VakıfBank" <?php echo ($iban2_name == 'VakıfBank') ? 'selected' : ''; ?>>VakıfBank</option>
                <option value="Yapı Kredi" <?php echo ($iban2_name == 'Yapı Kredi') ? 'selected' : ''; ?>>Yapı Kredi</option>
                <option value="QNB Finansbank" <?php echo ($iban3_name == 'QNB Finansbank') ? 'selected' : ''; ?>>QNB Finansbank</option>
                <option value="TEB" <?php echo ($iban3_name == 'TEB') ? 'selected' : ''; ?>>TEB</option>
                <option value="DenizBank" <?php echo ($iban3_name == 'DenizBank') ? 'selected' : ''; ?>>DenizBank</option>
                <option value="ING Bank" <?php echo ($iban3_name == 'ING Bank') ? 'selected' : ''; ?>>ING Bank</option>
                <option value="Kuveyt Türk" <?php echo ($iban3_name == 'Kuveyt Türk') ? 'selected' : ''; ?>>Kuveyt Türk</option>
                <option value="Papara" <?php echo ($iban3_name == 'Papara') ? 'selected' : ''; ?>>Papara</option>
                <option value="Tosla" <?php echo ($iban3_name == 'Tosla') ? 'selected' : ''; ?>>Tosla</option>
                <option value="İninal" <?php echo ($iban3_name == 'İninal') ? 'selected' : ''; ?>>İninal</option>
                <option value="Paycell" <?php echo ($iban3_name == 'Paycell') ? 'selected' : ''; ?>>Paycell</option>
            </select>
            <input type="text" id="iban2" name="iban2" value="<?php echo $iban2; ?>" onblur="addTRPrefix('iban2')"><br>
            <br>

            <select name="iban3_name" id="iban3_name">
                <option value="" selected="selected">Banka Seçin</option>
                <option value="Garanti BBVA" <?php echo ($iban3_name == 'Garanti BBVA') ? 'selected' : ''; ?>>Garanti BBVA</option>
                <option value="Türkiye İş Bankası" <?php echo ($iban3_name == 'Türkiye İş Bankası') ? 'selected' : ''; ?>>Türkiye İş Bankası</option>
                <option value="Akbank" <?php echo ($iban3_name == 'Akbank') ? 'selected' : ''; ?>>Akbank</option>
                <option value="Ziraat Bankası" <?php echo ($iban3_name == 'Ziraat Bankası') ? 'selected' : ''; ?>>Ziraat Bankası</option>
                <option value="Halkbank" <?php echo ($iban3_name == 'Halkbank') ? 'selected' : ''; ?>>Halkbank</option>
                <option value="VakıfBank" <?php echo ($iban3_name == 'VakıfBank') ? 'selected' : ''; ?>>VakıfBank</option>
                <option value="Yapı Kredi" <?php echo ($iban3_name == 'Yapı Kredi') ? 'selected' : ''; ?>>Yapı Kredi</option>
                <option value="QNB Finansbank" <?php echo ($iban3_name == 'QNB Finansbank') ? 'selected' : ''; ?>>QNB Finansbank</option>
                <option value="TEB" <?php echo ($iban3_name == 'TEB') ? 'selected' : ''; ?>>TEB</option>
                <option value="DenizBank" <?php echo ($iban3_name == 'DenizBank') ? 'selected' : ''; ?>>DenizBank</option>
                <option value="ING Bank" <?php echo ($iban3_name == 'ING Bank') ? 'selected' : ''; ?>>ING Bank</option>
                <option value="Kuveyt Türk" <?php echo ($iban3_name == 'Kuveyt Türk') ? 'selected' : ''; ?>>Kuveyt Türk</option>
                <option value="Papara" <?php echo ($iban3_name == 'Papara') ? 'selected' : ''; ?>>Papara</option>
                <option value="Tosla" <?php echo ($iban3_name == 'Tosla') ? 'selected' : ''; ?>>Tosla</option>
                <option value="İninal" <?php echo ($iban3_name == 'İninal') ? 'selected' : ''; ?>>İninal</option>
                <option value="Paycell" <?php echo ($iban3_name == 'Paycell') ? 'selected' : ''; ?>>Paycell</option>
            </select>
            <input type="text" id="iban3" name="iban3" value="<?php echo $iban3; ?>" onblur="addTRPrefix('iban3')"><br>
            <br>

            <h1>ŞİRKET BİLGİLERİ</h1>
                
            <div class="form">
                <h3>Şirket Adı</h3>
                <input type="text" id="iname" name="iname" value="<?php echo $iname; ?>"><br>
            </div>

            <div class="form">
                <h3>Sektör</h3>
                <input type="text" id="isektor" name="isektor" value="<?php echo $isektor; ?>"><br>
            </div>

            <div class="form">
                <h3>Telefon</h3>
                <input type="tel" id="itel" name="itel" value="<?php echo $itel; ?>"><br>
            </div>

            <div class="form">
                <h3>E Posta</h3>
                <input type="mail" id="iposta" name="iposta" value="<?php echo $iposta; ?>"><br>
            </div>

            <div class="form">
                <h3>Website</h3>
                <input type="text" id="iweb" name="iweb" value="<?php echo $iweb; ?>"><br>
            </div>

            <div class="form">
                <h3>Adress</h3>
                <input type="text" id="iadress" name="iadress" value="<?php echo $iadress; ?>"><br>
            </div>
            <br>
            <h1>GÖRÜNÜM</h1>
            <h3 style="font-family: Poppins, sans-serif; font-size: 18px; font-weight:500; margin-bottom: 0px; margin-left:5px;" for="theme">Tema</h3>
            <select id="theme" name="theme">
            <option value="">Tema Seçin</option required>
            <?php
            // Fetch themes from the database
            $theme_query = "SELECT * FROM themes";
            $theme_result = $conn->query($theme_query);
            if ($theme_result->num_rows > 0) {
                while ($row = $theme_result->fetch_assoc()) {
                    $selected = ($row['id'] == $theme_id) ? 'selected' : '';
                        echo "<option value='" . $row['id'] . "' $selected>" . $row['theme_name'] . "</option>";
                }
            } else {
                    echo "<option value=''>No themes available. Please add themes.</option>";
                }
            ?>
            </select>
            <input class="submit" type="submit" value="Güncelle">

        </form>
    </div>
    <script>
        function triggerFileUpload() {
            document.getElementById('fileInput').click();
        }

        // Sayfa yüklendiğinde İBAN inputlarının başına "TR" ekle
        window.onload = function() {
                addTRPrefix('iban');
                addTRPrefix('iban2');
                addTRPrefix('iban3');
            }

        // İBAN inputlarına otomatik "TR" ekleyen fonksiyon
        function addTRPrefix(inputId) {
            var inputElement = document.getElementById(inputId);
            var currentValue = inputElement.value.trim();
            if (currentValue !== "" && !currentValue.startsWith("TR")) {
                inputElement.value = "TR " + currentValue;
            }
        }

        // Form submit edildiğinde TR'nin olduğundan emin ol
        function ensureTROnSubmit() {
            addTRPrefix('iban');
            addTRPrefix('iban2');
            addTRPrefix('iban3');
        }

        // Sayfa yüklendiğinde telefon input'una varsayılan olarak "+90" ekleyelim
        window.onload = function() {
            var phoneInput = document.getElementById('phone');
            if (!phoneInput.value.startsWith('+90')) {
                phoneInput.value = '+90';
            }
        };

        let cropper;
        const cropModal = document.getElementById('cropModal');
        const cropImage = document.getElementById('cropImage');
        const imageToCrop = document.getElementById('imageToCrop');
        const cropButton = document.getElementById('cropButton');
        const closeModal = document.getElementsByClassName('close')[0];

        // Dosya seçildiğinde resmi yükleyip cropper modalını açalım
        function loadImage(event) {
            const file = event.target.files[0];
            const reader = new FileReader();
            reader.onload = function(e) {
                imageToCrop.src = e.target.result;
                cropModal.style.display = 'block'; // Modalı aç
                cropper = new Cropper(imageToCrop, {
                    aspectRatio: 1, // Kırpma oranı 1:1 (500x500 için uygun)
                    viewMode: 2
                });
            };
            reader.readAsDataURL(file);
        }

        // Modalı kapatma işlemi
        closeModal.onclick = function() {
            cropModal.style.display = 'none';
            if (cropper) {
                cropper.destroy(); // CropperJS'yi kapat
            }
        };

        // Kırpma işlemi ve resmi sunucuya yükleme
        cropButton.addEventListener('click', function() {
            const canvas = cropper.getCroppedCanvas({
                width: 500,
                height: 500
            });

            // Kırpılan resmi blob olarak al ve sunucuya yükle
            canvas.toBlob(function(blob) {
                const formData = new FormData();
                formData.append('profil_img', blob, 'profile.jpg');

                // AJAX ile resmi yükleyelim
                fetch('upload_image.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(data => {
                    cropModal.style.display = 'none'; // Modalı kapat
                    cropper.destroy(); // CropperJS'yi yok et
                    cropImage.src = URL.createObjectURL(blob); // Kırpılan resmi göster
                    alert('Resim başarıyla yüklendi!');
                })
                .catch(error => {
                    console.error('Hata:', error);
                });
            });
        });

        // Dosya yükleme butonunu tetikleyen fonksiyon
        function triggerFileUpload() {
            document.getElementById('fileInput').click();
        }

        // Kullanıcı modalın dışına tıklarsa modalı kapatalım
        window.onclick = function(event) {
            if (event.target == cropModal) {
                cropModal.style.display = 'none';
                if (cropper) {
                    cropper.destroy(); // CropperJS'yi kapat
                }
            }
        }




    </script>
</body>
</html>
<?php
$conn->close();
?>