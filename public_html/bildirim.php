<?php ob_start(); session_start(); include ('inclued/dash.php');?>

<?php 
ob_start(); 
session_start(); 
include ('inclued/dash.php');

// Veritabanı bağlantısı için gerekli bilgileri dahil et
include 'db_connection.php';

// Veritabanı bağlantısını yaptıktan sonra UTF-8 karakter setini ayarlayın
mysqli_set_charset($conn, "utf8");

// Veritabanından duyuruları seçme
$sql_select = "SELECT * FROM duyurular";
$result_select = mysqli_query($conn, $sql_select);

// Veritabanı bağlantısını kapat
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DijiKart Portal</title>
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.2/css/all.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">
</head>
<style>
    *{
    font-family: "Poppins", sans-serif;
    user-select: none;
}

body {
    margin: 0;
    padding: 0;
}

.navbar {
    background-color: white;
    color: black;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 20px;
    padding-top: 30px;
}

.back-btn a {
    text-decoration: none;
    color: black;
}

.navbar-title {
    text-align: center;
    width: 100%; /* Başlığın genişliğini ayarlayın */
}

.navbar-title h1 {
    font-weight: 500;
    margin: 0;
    display: inline-block; /* Başlığın satırı sona erdiğinde düzgün bir şekilde ortalanmasını sağlar */
}

.back-btn i{
    font-size: 25px;
}

.main{
    display: flex;
    align-items: center;
    text-align: center;
    justify-content: center;
    height: 90vh; /* Sayfa yüksekliği kadar ayarlanabilir */
}

.bildirimGizle i{
font-size: 200px;
color: #ebebed;
}

.bildirimGizle h1{
    font-size: 25px;

}

.bildirimGizle p{
    font-size: 15px;
}

.mains{
    margin: 20px;
}

.bildirimGoster{
    width: 100%;
    height: 25%;
    background-color: #ebebed;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 10px;
}

.bildirimGoster i{
    font-size: 25px;
    margin: 20px;
}

.bildirimGoster h1{
    font-size: 20px;
    margin-bottom: -18px;
}

.bildirimGoster p{
    font-size: 15px;
}
</style>

<body>
    <nav class="navbar">
        <div class="back-btn">
            <a href="anasayfa.php"><i class="fa-light fa-arrow-left"></i></a>
        </div>
        <div class="navbar-title">
            <h1>Bildirimler</h1>
        </div>
    </nav>

    <div class="mains">
        <?php while ($row = mysqli_fetch_assoc($result_select)) { ?>
        <div class="bildirimGoster">
            <i class="fa-duotone fa-bell"></i>
            <div class="text">
                <h1><?php echo htmlspecialchars($row['baslik'], ENT_QUOTES, 'UTF-8'); ?></h1>
                <p><?php echo htmlspecialchars($row['konu'], ENT_QUOTES, 'UTF-8'); ?></p>
            </div>
        </div>
        <?php } ?>

        <?php while ($row = mysqli_fetch_assoc($result_select)) { ?>
            <strong>Başlık:</strong> <?php echo htmlspecialchars($row['baslik'], ENT_QUOTES, 'UTF-8'); ?><br>
            <strong>Konu:</strong> <?php echo htmlspecialchars($row['konu'], ENT_QUOTES, 'UTF-8'); ?><br>
            <strong>Tarih:</strong> <?php echo htmlspecialchars($row['tarih'], ENT_QUOTES, 'UTF-8'); ?><br>
            <strong>Süresi:</strong> <?php echo htmlspecialchars($row['suresi'], ENT_QUOTES, 'UTF-8'); ?>
        <?php } ?>
    </div>
</body>
<script>
// JS kodlarınız burada olacak
</script>
</html>
