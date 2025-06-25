<?php include 'inclued/dash.php';?>
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
  font-weight: 600;
  font-style: normal;
  font-size: 25px;
}

.content{
    margin-top: 10px;
    margin-bottom: -5px;
    display: flex;
    align-items: center;
    justify-content: center;

}

.kutu {
    width: 43%;
    height: 230px;
    background-color: #F5F6F7;
    border-radius: 10px;
    display:flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    margin-bottom: 5px;
    margin-left: 5px;
}

.kutu img{
 width: 140px;
 height: auto;
 background-color: 8px;
 border-radius: 5px;
}

.kutu h1{
    font-size: 20px;
    text-align: center;
    font-weight: 500;
}

.kutu .btn{
    width: 110px;
    height: 50px auto;
    border-radius: 5px;
    text-align: center;
    background-color: blueviolet;
    color: white;
    font-weight: 700;
}

.input-box{
    width: 88%;
    height: 40px;
    background-color: #F5F6F7;
    margin-left: 5px;
    border-radius: 5px;
}

.input-box i {
  top: 100px;
  left: 25px;
  font-size: 20px;
  color: #707070;
  position: absolute;
  transform: translateY(-50%);
}
.input-box input {
  height: 100%;
  width: 100%;
  outline: none;
  font-size: 18px;
  font-weight: 600;
  border: none;
  padding: 0 155px 0 40px;
  background-color: transparent;
}

</style>
<body>
    <div class="navs">
        <h1>Mağaza</h1>
    </div>
    <div class="content">
        <div class="kutu">
            <img src="assets/img/kart.jpg" alt="">
                <h1>Siyah NFC Kartvizit</h1>
                <div class="btn">
                    SATIN AL
                </div>
        </div>
        <div class="kutu">
            <img src="assets/img/kart.jpg" alt="">
                <h1>Siyah NFC Kartvizit</h1>
                <div class="btn">
                    SATIN AL
                </div>
        </div>
    </div>
    <div class="content">
        <div class="kutu">
            <img src="assets/img/kart.jpg" alt="">
                <h1>Siyah NFC Kartvizit</h1>
                <div class="btn">
                    SATIN AL
                </div>
        </div>
        <div class="kutu">
            <img src="assets/img/kart.jpg" alt="">
                <h1>Siyah NFC Kartvizit</h1>
                <div class="btn">
                    SATIN AL
                </div>
        </div> 
    </div>
    <footer>
<?php include 'navbar.php';?>
</footer>
</body>
</html>