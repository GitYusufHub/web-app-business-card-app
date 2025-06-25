<?php



session_start();

// Veritabanı bağlantısını yap
require_once 'db_connection.php';

// Dosya yükleme işlemi
if(isset($_FILES['file']) && !empty($_FILES['file']['name'])) {
    $file = $_FILES['file'];

    // Dosya adından uzantıyı al
    $file_extension = pathinfo($file['name'], PATHINFO_EXTENSION);

    // Dosya adını yeniden adlandırma
    $user_id = $_SESSION['user_id'];
    $username = $_SESSION['username'];
    $file_name = $user_id . '_' . $username . '.' . $file_extension; // Yeni dosya adı
    $target_dir = "upload/Profil/";
    $target_file = $target_dir . $file_name;

    // Dosyayı upload klasörüne taşıma
    if (move_uploaded_file($file['tmp_name'], $target_file)) {
        // Veritabanına dosya adını ve kullanıcı ID'sini ekleme
        $sql = "UPDATE kartvizit SET img_name = '$file_name' WHERE id = '$user_id'";
        if ($conn->query($sql) === TRUE) {
            echo "Profil fotoğrafı başarıyla yüklendi ve veritabanına kaydedildi.";
        } else {
            echo "Veritabanına kaydedilirken bir hata oluştu: " . $conn->error;
        }
    } else {
        echo "Dosya yükleme hatası.";
    }
}

// Veritabanı bağlantısını kapat
$conn->close();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Fotoğrafı Yükleme</title>
</head>
<body>
    <form action="dnm.php" method="post" enctype="multipart/form-data">
        <input type="file" id="real-file" name="file" style="display: none;" />
        <button type="button" id="custom-button">Dosya Seç</button>
        <span id="custom-text">Dosya seçilmedi</span>
        <button type="submit">Yükle</button>
    </form>

    <script>
        const realFileBtn = document.getElementById("real-file");
        const customBtn = document.getElementById("custom-button");
        const customTxt = document.getElementById("custom-text");

        customBtn.addEventListener("click", function() {
            realFileBtn.click();
        });

        realFileBtn.addEventListener("change", function() {
            if (realFileBtn.value) {
                customTxt.innerHTML = realFileBtn.value.match(/[\/\\]([^\/\\]+)$/)[1];
            } else {
                customTxt.innerHTML = "Dosya seçilmedi";
            }
        });
    </script>
</body>
</html>
