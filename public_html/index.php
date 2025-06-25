<?php
session_start();

// user_id ve username sessionlarının var olup olmadığını kontrol et
if (!isset($_SESSION['user_id']) || !isset($_SESSION['username'])) {
    // Eğer session yoksa login.php'ye yönlendir
    header("Location: login.php");
    exit(); // Yönlendirmeden sonra kodun devam etmemesi için exit() kullanılır
} else {
    // Eğer sessionlar mevcutsa anasayfa.php'ye yönlendir
    header("Location: anasayfa.php");
    exit();
}
?>
