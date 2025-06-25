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
  }

  .navs i{
  font-size: 32px;
  position: fixed;
  top: 7%;
  right: 30px;
  transform: translateY(-50%);
  color: #0069d9;
  }

  .navs a{
    color: red;
  }

  .content{
    margin: 10px;
  }

  .kutu2{
    width: 100%;
    height: 110px;
    background-color: #F5F6F7;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: space-between;
  }


  .kutu2:hover{
    border: 2px solid #0069d9;
  }

.imgs{
    display: flex;
}

.imgs img{
  width: 135px;
  height: auto;
  border-radius: 5px;
  margin: 10px;
}

.sag{
    display: flex;

}

.content a{
    color: black;
    text-decoration: none;
}

.yazi{
  margin-top: 15px;
}

.yazi h1{
    font-size: 120%;
    font-family: "Poppins", sans-serif;
    font-weight: 700;
}

.yazi p{
    font-family: "Poppins", sans-serif;
    margin-top: -15px;
      font-size: 95%;
}

.sol i{
    font-size: 25px;
    position: fixed;
    right: 35px;
    transform: translateY(-50%);    
  }

</style>
<body>
    <div class="navs">
        <h1>Kartlarım</h1>
       <a href="create_card.php"> <i class="fa-solid fa-circle-plus"></i></a>
    </div>
 <div class="content">
        <?php
        session_start();
        if (!isset($_SESSION['username'])) {
            header("Location: login.php");
            exit();
        }
        include "db_connection.php";

        $username = $_SESSION['username'];
        $user_id_query = "SELECT id FROM kusers WHERE username = '$username'";
        $result = $conn->query($user_id_query);

        if ($result !== false && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $user_id = $row['id'];

                // Kullanıcının kartvizitlerini sorgula
                $sql = "SELECT * FROM kartvizit WHERE user_id = $user_id";
                $kartvizit_result = $conn->query($sql);

                if ($kartvizit_result !== false && $kartvizit_result->num_rows > 0) {
                    while ($kartvizit_row = $kartvizit_result->fetch_assoc()) {
        ?>

        <a href="dashboard.php?id=<?php echo $kartvizit_row['id']; ?>">
         <div class="kutu2">
            <div class="sag">
                <div class="imgs">
                    <img src="assets/img/kart.jpg" alt="">
                    </div>
                    <div class="yazi">
                        <h1><?php echo $kartvizit_row['name']; ?></h1>
                        <p>Serial: 66:FF:8B:04 <b><?php echo $kartvizit_row['serial']; ?></b></p>
                    </div>
            </div>
            <div class="sol">
                <i class="fa-solid fa-angle-right"></i>
            </div>
        </div>
       </a>


        <?php
                    }
                } else {
                    echo "<p>Kart Bulunamadı. Sağ üst köşeden kart ekleyin.</p>";
                }
            }
        }
        ?>
    </div>
	</div>
    <footer>
<?php include 'navbar.php';?>
</footer>
</body>
</html
