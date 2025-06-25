<link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.2/css/all.css">

<style>
   @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

footer{
    position: fixed;
    bottom: 0;
    left: 0;
    width: 100%;
    background-color: white;
    border-top: 1px solid #ddd;
    font-family: "Poppins", sans-serif;
    user-select: none;
}

.nav{
    list-style: none;
    display: flex;
    flex-direction: row;
    justify-content: space-around;
    align-items: center;
    padding: 0;
}

.nav li a{
    text-decoration: none;
    color: black;
    display: block;
    align-items: center;
    justify-content: center;
    text-align: center;
}

.nav li a p{
    font-size: 13px;
    margin: 0;
}

.nav li a img{
    color: black;
}

.nav li a i{
    font-size:25px;
    color: red;
}
.ana{
    width: 55px;
    height: 55px;
    border-radius: 100%;
    background-color: blueviolet;
    display: flex;
    align-items: center;
    justify-content: center;
}

.ana img{
    width: 30px;
    height: 30px;
}
</style>
<footer>
    <ul class="nav">
        <li> 
            <a href="anasayfa.php">
            <i class="fa-light fa-house"></i>
            <p>Anasayfa</p>
            </a>
        </li>
        <li>
            <a href="kartlarım.php">
                <img src="assets/icons/kartlarım.png" alt="">
                <p>Kartlarım</p>
                </a>
        </li>
        <li>
            <a href="kategori.php">
                <div class="ana">
                    <img src="assets/icons/kategori.png" alt="">
                </div>
                
                </a>
        </li>
        <li>
            <a href="magaza.php">
                <img src="assets/icons/magaza.png" alt="">
                <p>Mağaza</p>
                </a>
        </li>
        <li>
            <a href="hesabim.php">
                <img src="assets/icons/hesabım.png" alt="">
                <p>Hesabım</p>
                </a>
        </li>
    </ul>
</footer>