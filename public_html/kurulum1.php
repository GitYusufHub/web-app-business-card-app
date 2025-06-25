<?php
// Veritabanı bağlantısını içe aktar
require_once('db_connection.php');

// ID'yi kontrol et
if(isset($_GET['id'])) {
    $id = $_GET['id'];

    // ID'ye sahip bir satırın olup olmadığını kontrol et
    $check_query = "SELECT * FROM kusers WHERE id=$id";
    $result = $conn->query($check_query);

    if ($result->num_rows > 0) {
        // ID'ye sahip bir satır bulundu, işlem yapılamaz mesajını göster
        echo "İşlem yapılamaz. Bu ID'ye sahip bir kullanıcı zaten var.";
    } else {
        // Formu göster
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <title>DijiKart Kurulum</title>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">

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
        font-weight: 500;
        font-size: 30px;
        margin-bottom: 30px;   
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
        </head>
        <body>
        <div class="main">
            <img class="logo" src="https://dijikart.net/upload/logom.png" alt="">
            <br>
            <br>
            <h1> Hesap Oluşturun. (1/3)</h1>
            <form action="kurulum1.php?id=<?php echo $id; ?>" method="post">
                <input type="text" id="username" class="input-box" name="username" placeholder="Kullanıcı adınızı girin" required>
                <br><input type="email" class="input-box" id="email" name="email" placeholder="E Posta adresinizi girin" required>
                <br><input type="number" class="input-box" id="tel" name="phone" placeholder="Telefon numaranızı girin" required><br>
                <input type="password" class="input-box" id="password" name="password" placeholder="Parolanızı girin" required><br>
                <button type="submit" class="submit">Devam et<i class="fa-solid fa-angle-right"></i></button>
            </form>
        </div>
        </body>
        </html>
        <?php
    }
} else {
    // ID belirtilmediği için hata mesajı göster
    die("Hata: ID belirtilmedi.");
}

// Formdan gelen verileri işleme
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Şifreyi hash'le
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    // SQL sorgusu ile yeni satır ekleme
    $sql = "INSERT INTO kusers (id, username, email, password) VALUES ('$id', '$username', '$email', '$hashed_password')";
    
    if ($conn->query($sql) === TRUE) {
        // Yeni kullanıcı başarıyla eklendi, kurulum2.php sayfasına yönlendir
        header("Location: kurulum2.php?id=$id");
        exit(); // Header yönlendirmesinden sonra kodun devam etmemesi için
    } else {
        echo "Hata: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
