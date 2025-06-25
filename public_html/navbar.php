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
        font-size:24px;
        color: black;
    }

    .ana{
        width: 55px;
        height: 55px;
        border-radius: 100%;
        background-color: #0069d9;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .ana i{

    font-size:27px;
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
            <a href="kartlarim.php">
            <i class="fa-light fa-credit-card-blank"></i>
            <p>Kartlarım</p>
                </a>
        </li>
    <!--    <li>
            <a href="hizli.php">
                <div class="ana">
                <i style="color: white;" class="fa-regular fa-grid-2"></i>
                </div>
                
                </a>
        </li> -->
        <li>
            <a href="magazas.php">
            <i class="fa-light fa-bag-shopping"></i>
            <p>Mağaza</p>
                </a>
        </li>
        <li>
            <a href="hesabim.php">
            <i class="fa-light fa-user"></i>
                <p>Hesabım</p>
                </a>
        </li>
    </ul>
</footer>