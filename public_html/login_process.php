<?php
session_start();
include "db_connection.php";

// Form verilerini al
$username = $_POST['username'];
$password = $_POST['password'];

// Kullanıcıyı veritabanından kontrol et
$stmt = $conn->prepare("SELECT id, username, password FROM kusers WHERE username=?");
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $stmt->bind_result($user_id, $username, $hashed_password);
    $stmt->fetch();
    // Kullanıcı adı doğruysa, şifreyi doğrula
    if (password_verify($password, $hashed_password)) {
        // Giriş bilgilerini kaydet
        $login_time = date("Y-m-d H:i:s");
        $device_info = $_SERVER['HTTP_USER_AGENT'];
        $user_ip = $_SERVER['REMOTE_ADDR'];

        // Giriş bilgilerini 'klog' tablosuna ekle
        $insert_stmt = $conn->prepare("INSERT INTO klog (user_id, login_time, device_info, user_ip) VALUES (?, ?, ?, ?)");
        $insert_stmt->bind_param("isss", $user_id, $login_time, $device_info, $user_ip);
        if ($insert_stmt->execute()) {
            // Oturumu başlat
            $_SESSION['user_id'] = $user_id;
            $_SESSION['username'] = $username;
            header("Location: anasayfa.php");
            exit();
        } else {
            echo "Giriş bilgileri kaydedilirken bir hata oluştu";
        }
    } else {
        echo "Kullanıcı adı veya şifre hatalı";
    }
} else {
    echo "Kullanıcı adı veya şifre hatalı";
}

$stmt->close();
$conn->close();
?>
