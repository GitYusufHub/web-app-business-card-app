<?php
// URL'deki id parametresini al
$id = isset($_GET['id']) ? $_GET['id'] : null;

// Eğer id parametresi varsa, card.php sayfasına yönlendir
if ($id !== null) {
    header("Location: card.php?id=$id");
    exit(); // Yönlendirmeden sonra script'in çalışmasını durdur
} else {
    // Eğer id parametresi yoksa hata mesajı göster
    echo "Geçersiz id parametresi.";
}
?>
