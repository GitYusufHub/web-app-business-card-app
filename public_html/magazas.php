<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DijiKart Mağaza</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<style>
    body, html {
    height: 100%;
    margin: 0;
    display: flex;
    justify-content: center;
    align-items: center;
}

.video-container {
    position: relative;
    width: 100%; /* Video genişliği ayarlayabilirsiniz */
    max-width: 2000px; /* Maksimum genişlik ayarlayabilirsiniz */
}

video {
    width: 100%;
    height: auto;
    position: relative;
    left: 50%;
    transform: translateX(-50%);
}

.overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: transparent;
    pointer-events: none; /* Overlay'e tıklanmasını önlemek */
}

h1{
    font-size: 30px;
    text-align: center;
    font-family: "Poppins", sans-serif;
    font-weight: 800;
    font-style: normal;
}

p{
    font-size: 17px;
    text-align: center;
    font-family: "Poppins", sans-serif;
    margin-top: -15px;
}
</style>
<body>
    <div class="video-container">
        <video autoplay loop muted>
            <source src="assets/video2.mp4" type="video/mp4">
        </video>
        <h1>Yapım Aşamasında!</h1>
        <p>Mağaza sekmesi yakında aktif olacaktır.</p>
        <div class="overlay"></div>
    </div>
    <footer>
    <?php include 'navbar.php';?>
    </footer>
</body>
</html>
