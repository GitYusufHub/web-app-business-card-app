<?php
session_start();
// Oturumu sonlandır ve giriş sayfasına yönlendir
session_unset();
session_destroy();
header("Location: login.php");
exit();
?>
