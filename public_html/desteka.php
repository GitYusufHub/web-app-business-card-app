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

.content p{
    text-align: center;
}

.content select{
    width: 103%;
    height: 45px;
    background-color: #F5F6F7;
    border: none;
    border-radius: 8px;
    padding-left: 10px;
    font-family: "Poppins", sans-serif;
    font-size: 15px;
    font-weight:400;
    font-style: normal;
    margin-bottom: 10px;
    margin-top: 10px;
}

.content img{
    width: 90%;
    margin: 10px;
}


.kutu1{
    width: 100%;
    height: 50px;
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
    font-size: 18px;
    font-weight: 600;
}

.content a{
    text-decoration: none;
    color: black;
}

</style>
<body>
    <div class="navs">
        <a href="hesabim.php"><i class="fa-solid fa-arrow-left" id="left"></i></a> 
         <h1>Destek ve İletişim</h1>
     </div>
     <div class="content">
        <img src="assets/img/5124556.jpg" alt="">
        <p>Teknik Destek veya Sorularınız için her zaman (7 gün 24 saat boyunca) bize aşağıdaki iletişim bilgilerinden ulaşabilirsiniz.        </p>
        <a href="tel:+90 541 114 5824">
        <div class="kutu1">
            <i class="fa-solid fa-phone-volume"></i>
            <p>+90 541 114 5824</p>  
        </div>
        </a>
        <a href="https://wa.me/5398276725">
            <div class="kutu1">
                <i class="fa-brands fa-square-whatsapp"></i>
                <p>+90 539 827 6725</p>  
            </div>
        </a> 
        <a href="mailto:destek@dijikart.net">
            <div class="kutu1">
                <i class="fa-solid fa-envelope"></i>
                <p>destek@dijikart.net</p>  
            </div>
        </a>
    </div>
</body>
</html>