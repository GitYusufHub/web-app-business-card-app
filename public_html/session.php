<?php ob_start(); session_start(); include ('inclued/dash.php');?>

<?php
// Session'daki tüm değerleri yazdır
echo "<pre>";
print_r($_SESSION);
echo "</pre>";
?>
