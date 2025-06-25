<?php
session_start();

// Kullanıcı zaten oturum açtıysa, anasayfa.php'ye yönlendir
if (isset($_SESSION['username'])) {
    header("Location: anasayfa.php");
    exit();
}

include "db_connection.php";

// Başlangıçta hata mesajlarını boş olarak tanımlayalım
$username_error = "";
$password_error = "";

// Form verilerini al
$username = $_POST['username'] ?? '';
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Kullanıcı adının benzersiz olduğunu kontrol et
    $stmt = $conn->prepare("SELECT username FROM kusers WHERE username=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $username_error = "Bu kullanıcı adı zaten kullanılıyor.";
    } else {
        // Şifre güvenlik kontrolü: En az 6 karakter, büyük/küçük harf uyumu
        if (strlen($password) < 6 || !preg_match('/[A-Z]/', $password) || !preg_match('/[a-z]/', $password)) {
            $password_error = "Şifre en az 6 karakter uzunluğunda olmalı ve büyük/küçük harf içermelidir.";
        } else {
            // Şifreyi hash'le
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Kullanıcıyı veritabanına ekle
            $stmt = $conn->prepare("INSERT INTO kusers (username, email, password) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $username, $email, $hashed_password);

            if ($stmt->execute()) {
                $_SESSION['username'] = $username;
                echo '<script>setTimeout(function(){window.location.href="anasayfa.php";}, 3000);</script>';
                exit();
            } else {
                echo "Hata: " . $stmt->error;
            }
        }
    }

    $stmt->close();
}

$conn->close();
?>
