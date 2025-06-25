<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DijiKart kurulum</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap');

    body {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh; /* Ekran yüksekliğinin tamamını kapla */
        margin: 0;
        user-select: none;
    }

    .main{
        text-align: center;
    }

    .main .logo{
        width: 25%;
        height: auto;
    }

    .main h1{
        font-family: 'Poppins', sans-serif;
        font-weight: 600;
        font-size: 30px;
        margin-bottom: 10px;   
    }

    .google {
        background-color: white;
        color: #333;
        font-weight: 600;
        font-size: 16px;
        outline: none;
        width: 76%;
        height: 50px;
        border-radius: 10px;
        text-indent: 15px;
        border: 1px solid #ccc;
        font-family: 'Poppins', sans-serif;
        margin: 10px auto; /* Yatayda ortalamak için margin ekleyin */
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .google:hover {
        background-color: #eeebeb;
    }

    .google img {
        width: 25px;
        text-align: center;
        margin-right: 10px; /* Görsel ile metin arasına bir boşluk eklemek için margin-right ekleyin */
    }

    .google p {
        font-size: 19px;
        margin: 0; /* Paragrafın varsayılan margin'ini sıfırlayın */
    }
    .main input{
        font-size: 16px;
        color: #333;
        outline: none;
        width: 75%;
        height: 48px;
        border-radius: 10px;
        text-indent: 15px;
        border: 1px solid #ccc;
        font-family: 'Poppins', sans-serif;
        font-weight: 400;
        margin-bottom: 20px;
    }

    .main input:focus{
        border: 1px solid #246bfd
    }

    .main input:hover{
        border: 1px solid #246bfd
    }

    .main .submit{

        background-color: #246BFD;
        color: white;
        font-weight: 600;
        font-size: 16px;
        outline: none;
        width: 76%;
        height: 48px;
        border-radius: 10px;
        text-indent: 15px;
        border: 1px solid #ccc;
        font-family: 'Poppins', sans-serif;
        margin-bottom: 20px;
    }

    .main p{
        font-family: 'Poppins', sans-serif;
        padding-left: 10px;
        padding-right: 10px;
    }


    @media only screen and (max-width: 600px) {

    .main .logo{
        width: 35%;
        height: auto;
    }       


    .main input{
        width: 90%;
        height: 48px;
    }

    .google {
        width: 90%;
        height: 50px;
    }

    .main .submit{
        width: 90%;
        height: 48px; 
    }

    }
</style>
    <div class="main">
        <img class="logo" src="https://dijikart.net/upload/logom.png" alt="">
        <br>
        <br>
        <br>
        <h1> Kurulum Tamamlandı!</h1>
        <h4 style="        font-family: 'Poppins', sans-serif;
        font-weight: 500;
        font-size: 18px;
        margin-bottom: 10px; ">Tebrikler 🎉 , artık siz de bir <br> DijiKart üyesisiniz.</h4>
        <p>Sisteme giriş yapmak ve kullanmaya başlamak için aşağıdaki <b>Giriş Yap</b> butonuna tıklayın.</p>
	    <a href="index.php"><button type="submit" class="submit">Giriş Yap<i class="fa-solid fa-angle-right"></i></button></a>
        </form>
    </div>
</body>
</html>
