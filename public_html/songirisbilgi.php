

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DijiKart Portal</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />    
</head>
<style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
body{
    margin: 0;
    user-select: none;
    background-color: white;
    font-family: "Poppins", sans-serif;
}

.navs{
  display: flex;
  align-items: center;
  margin-left: 10px;
  margin-right: 10px;
}
.navs h1{
  font-family: "Poppins", sans-serif;
  font-weight: 600;
  font-style: normal;
  font-size: 30px;
}

.navs #left{
    margin-left: 15px;
    margin-right: 10px;
    font-size: 25px;
}

.content{
    margin-left: 20px;
    margin-right: 30px;
    margin-top: -25px;
}

.content img{
    width: 90%;
    margin: 10px;
}


.kutu1{
    width: 100%;
    height: 60px;
    background-color: #F5F6F7;
    color: black;
    border-radius: 8px;
    display: flex;
    align-items: center;
    margin-bottom: 10px;
}

.kutu1 i{
    margin: 10px;
    font-size: 20px;
}

.kutu1 p{
    font-size: 15px;
    font-weight: 500;
}

.content a{
    text-decoration: none;
    color: black;
}

</style>
<body>
    <div class="navs">
        <a href="hesabim.php"><i class="fa-solid fa-arrow-left" id="left"></i></a> 
         <h1>Son Giriş Bilgileri</h1>
     </div>
     <div class="content">
        <img src="assets/img/107173356.jpg" alt="">
        <p>Burada <b>Portal'a</b> giriş bilgileriniz tutulmaktadır.</p>


        <?php
        session_start();
        require_once('db_connection.php');

        // Eğer oturumda kullanıcı kimliği varsa ve bir kullanıcı oturumda ise
        if(isset($_SESSION['user_id'])) {
            // Kullanıcı kimliğini al
            $user_id = $_SESSION['user_id'];

            // Son 5 günün verilerini almak için tarih aralığı belirle
            $start_date = date('Y-m-d', strtotime("-5 days")); // Son 5 günün başlangıç tarihi
            $end_date = date('Y-m-d'); // Bugünün tarihi

            // Veritabanından son 5 günün en son giriş bilgilerini sorgula
            $sql = "SELECT DATE(login_time) AS log_date, MAX(login_time) AS last_login, user_ip 
                    FROM klog 
                    WHERE user_id = $user_id 
                    AND login_time BETWEEN '$start_date 00:00:00' AND '$end_date 23:59:59' 
                    GROUP BY log_date";
            $result = $conn->query($sql);

            // Verileri ekrana yazdır
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo '<div class="kutu1">';
                    echo '<i class="fa-solid fa-arrow-right-to-bracket"></i>';
                    echo '<p>' . $row['last_login'] . ' - ' .  $row['user_ip'] . '</p>';
                    echo '</div>';
                }
            } else {
                echo "Son 5 gün içinde hiç giriş yapılmamış.";
            }
        } else {
            echo "Oturum açılmamış.";
        }

        // Veritabanı bağlantısını kapat
        $conn->close();
?>


</body>
</html>



            
    </div>
</body>
</html>