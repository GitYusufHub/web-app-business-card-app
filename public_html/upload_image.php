<?php
session_start();
include 'db_connection.php'; // Veritabanı bağlantısı

$user_id = $_SESSION['user_id'];

if (isset($_FILES['profil_img'])) {
    $uploadDir = 'Upload/Profil/';
    $imageFileType = 'jpg'; // Blob ile gelen resim hep jpg olacak
    $imgName = uniqid() . '.' . $imageFileType; // Rastgele isim oluşturma
    $targetFilePath = $uploadDir . $imgName;

    // Dosyayı yükleyelim
    if (move_uploaded_file($_FILES['profil_img']['tmp_name'], $targetFilePath)) {
        // Önceki dosya varsa sil
        $sql = "SELECT img_name FROM kartvizit WHERE user_id = '$user_id'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        if (!empty($row['img_name']) && $row['img_name'] !== 'user.jpg' && file_exists($uploadDir . $row['img_name'])) {
            unlink($uploadDir . $row['img_name']);
        }

        // Veritabanını güncelle
        $sql = "UPDATE kartvizit SET img_name = '$imgName' WHERE user_id = '$user_id'";
        $conn->query($sql);

        echo "Resim başarıyla yüklendi.";
    } else {
        echo "Yükleme sırasında hata oluştu.";
    }
}
?>
