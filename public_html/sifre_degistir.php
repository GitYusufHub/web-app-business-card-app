<?php
session_start();
$servername = "localhost";
$username = "dijikart_admin";
$password = "Diji1453?";
$dbname = "dijikart_vt";

// Bağlantı oluşturma
$conn = new mysqli($servername, $username, $password, $dbname);

// Hata kontrolü
if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

// Form gönderildiğinde işlemleri gerçekleştir
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $old_password = $_POST["old_password"];
    $new_password = $_POST["new_password"];
    $confirm_password = $_POST["confirm_password"];

    // Kullanıcıyı oturumdan al
    $user_id = $_SESSION["user_id"];

    // Eski şifre doğru mu kontrol et
    $sql = "SELECT password FROM kusers WHERE id = $user_id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hashed_password = $row["password"];
        if (password_verify($old_password, $hashed_password)) {
            // Eğer eski şifre doğruysa, yeni şifreyi güncelle
            if ($new_password == $confirm_password) {
                $hashed_new_password = password_hash($new_password, PASSWORD_DEFAULT);
                $update_sql = "UPDATE kusers SET password = '$hashed_new_password' WHERE id = $user_id";
                if ($conn->query($update_sql) === TRUE) {
                    echo "Şifre başarıyla güncellendi";
                } else {
                    echo "Hata: " . $conn->error;
                }
            } else {
                echo "Yeni şifreler eşleşmiyor";
            }
        } else {
            echo "Eski şifre yanlış";
        }
    } else {
        echo "Kullanıcı bulunamadı";
    }
}
$conn->close();
?>
