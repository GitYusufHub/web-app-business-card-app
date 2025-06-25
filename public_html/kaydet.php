<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Veritabanı bilgileri
$servername = "localhost";
$username = "dijikart_admin";
$password = "Diji1453?";
$dbname = "dijikart_vt";

// POST isteği kontrolü
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // NFC kartının seri numarasını al
    $serialNumber = $_POST["serialNumber"];

    // Veritabanına bağlan
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Bağlantıyı kontrol et
    if ($conn->connect_error) {
        die("Veritabanına bağlantı hatası: " . $conn->connect_error);
    }

    // NFC kartının veritabanında olup olmadığını kontrol et
    $sql = "SELECT * FROM kartvizit1 WHERE serial_number = '$serialNumber'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Kart veritabanında mevcut, kart sahibinin adını ve mesleğini al
        $row = $result->fetch_assoc();
        $name = $row["name"];
        $profession = $row["profession"];

        // Okutulma tarihini ve saatini al
        $scanDate = date("Y-m-d");
        $scanTime = date("H:i:s");

        // Veritabanına okutulma tarihini ve saati kaydet
        $sql = "UPDATE kartvizit1 SET scan_date = '$scanDate', scan_time = '$scanTime' WHERE serial_number = '$serialNumber'";
        if ($conn->query($sql) === TRUE) {
            // Kart sahibine selam ver
            echo "Hoş geldiniz, $name! NFC kartınız $scanDate tarihinde $scanTime saatinde başarıyla okutuldu.";
        } else {
            echo "Veritabanına tarih kaydı yapılırken bir hata oluştu: " . $conn->error;
        }
    } else {
        // Kart veritabanında mevcut değil
        echo "Tanımsız NFC kartı. Lütfen kaydınızı yaptırınız.";
    }

    // Veritabanı bağlantısını kapat
    $conn->close();
} else {
    // POST isteği yoksa hata döndür
    echo "Geçersiz istek";
}
?>
