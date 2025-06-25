<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DijiKart Portal</title>
    <link rel="stylesheet" href="hizlimenu.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.2/css/all.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

</head>
<style>
*{
  font-family: "Poppins", sans-serif;
    user-select: none;
}

    body{
  background-color: #f5f7f9;
}

.search {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 50px;
    background-color: white;
    padding: 10px;
    z-index: 1000; /* Üstte kalması için z-index kullanılabilir */
}

/* SEARCH */
.input-box {
    position: relative;
    height: 50px;
    width: 95%;
    background: #f5f7f9;
    border-radius: 25px;
  }

  .input-box:hover {
      border: 2px solid #007bff; 
    }
  
  .input-box i,
  .input-box .button {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
  }
  .input-box i {
    left: 15px;
    font-size: 15px;
    color: #707070;
  }
  .input-box input {
    height: 100%;
    width: 100%;
    outline: none;
    font-size: 15px;
    font-weight: 400;
    border: none;
    padding: 0 155px 0 40px;
    background-color: transparent;
    color: #707070;
  }

.menu{
  margin-top: 80px;
}

.menu .kutular{
display: flex;
align-items: center;
justify-content: center;
}

.menu .kutu1{
  width: 45%;
  height: 170px;
  background-color: white;
  margin-right: 10px; 
  border-radius: 8px;
  box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.04);
  

}

.kutu1 img{
  width: 80%;
  margin-left:15px;
}

.kutu1 p{
  text-align:center;
  margin-top: -20px;
}

.kutu1:hover{
  border: 2px solid #007bff; 
}

.kutu2:hover{
  border: 2px solid #007bff; 
}

.menu .kutular2{
  display: flex;
  align-items: center;
  justify-content: center; 
}

.menu .kutu2{
  width: 45%;
  height: 100px;
  background-color: white;
  margin-right: 10px; 
  border-radius: 8px;
  margin-top: 10px;
  box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.04);
  display: flex;
  align-items:center;
  justify-content: center;
}


.kutu2 img{
  width: 40%;
  margin-right: -25px;
  margin-left: 5px;
}

.kutu2 p{
  text-align:center;
}
/* MENU END */

</style>
<body>
    <div class="main">
        <div class="search">
            <div class="input-box">
                <i class="fa-light fa-magnifying-glass"></i>
                <input type="text" placeholder="Arayın..." />
            </div>
        </div>

        <div class="menu">
            <div class="kutular">
                <div class="kutu1">
                  <img src="/assets/img/9098111.png" alt="">
                  <p>Nasıl Çalışır?</p>
                </div>
                <div class="kutu1" >
                <img src="/assets/img/9816286.png" alt="">
                  <p>Kampanyalar</p>
                </div>
            </div>

            <div class="kutular" style=" margin-top: 10px; ">
            <div class="kutu1">
                <img src="/assets/img/9098122.png" alt="">
                  <p>Kart İstatistikleri</p>
                </div>

                <div class="kutu1">
                  <img src="/assets/img/6306507.png" alt="">
                  <p>Kart İşlemleri</p>
                </div>
            </div>

            <div class="kutular2">
                <div class="kutu2">
                <img src="/assets/img/5226583.png" alt="" style=" margin-right: -5px;  margin-left: -15px;">
                  <p>Yakında!</p>
                </div>
                <div class="kutu2">
                <img src="/assets/img/5226583.png" alt="" style=" margin-right: -5px;  margin-left: -15px;">
                  <p>Yakında!</p>
                </div>
            </div>

            <div class="kutular2">
                <div class="kutu2">
                <img src="/assets/img/5226583.png" alt="" style=" margin-right: -5px;  margin-left: -15px;">
                  <p>Yakında!</p>
                </div>
                <div class="kutu2">
                <img src="/assets/img/991452.png" alt="">
                  <p>Destek ve İletşim</p>
                </div>
            </div>

        </div>
    </div>
</body>
<footer>
<?php include 'navbar.php';?>
</footer>
<script>
    var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";  
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
}
window.onload= function () {
 setInterval(function(){ 
     plusSlides(1);
 }, 3000);
 }

</script>

</html>