<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" >
    <title>DijiKart Kayıt Ol!</title>
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
    padding-left: 10px;
    padding-right: 10px;
    }

    .main{
    text-align: center;
    }

    .main img{
    width: 20%;
    height: auto;
    }

    .main h1{
    font-family: 'Poppins', sans-serif;
    font-weight: 500;
    font-size: 30px;
    margin-bottom: 30px;   
    }

    .main .submit{
    background-color: #246BFD;
    color: white;
    font-weight: 600;
    font-size: 16px;
    outline: none;
    width: 52%;
    height: 48px;
    border-radius: 10px;
    text-indent: 15px;
    border: 1px solid #ccc;
    font-family: 'Poppins', sans-serif;
    margin-bottom: 20px;
    }

    .submit:focus{
        border: 3px solid #ccc;
        outline: none;
        border-color: #ccc;
    }

    .main p{
    font-family: 'Poppins', sans-serif;
    }

    @media only screen and (max-width: 600px) {

        .main img{
            width: 35%;
            height: auto;
        }       
    }

</style>
    <div class="main">
        <img src="https://dijikart.net/upload/logom.png" alt="">
        <h1><b>Kurulum Gerekli!</b></h1>
        <p>Dijital Kartvizit kullanabilmeniz için bazı bilgilere ihtiyacımız var.</p>
        <p>Kurulum işlemi 3 Adımda gerçekleşecek. <br> Bu adımlardaki bilgilerin doğruluğunu kontrol ederek ilerleyiniz.</p>
        <br>
        <?php
            // URL'den id almak için $_GET kullanılır
            $id = $_GET['id'] ?? ''; // Eğer id tanımlı değilse boş bir değer atanır
            // $id'yi diğer sayfaya aktarmak için a etiketi içine yazılır
            echo '<a href="kurulum1.php?id=' . $id . '"> <button type="submit" class="submit">Hadi Başlayalm <i class="fa-solid fa-arrow-right"></i></button></a>';
        ?>     
    </div>

</body>
</html>
