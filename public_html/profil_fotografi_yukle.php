 <?php
    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            echo "Sadece JPG, JPEG, PNG dosyaları yüklenebilir.";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            echo "Dosya yüklenemedi.";
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                echo "Dosya ". basename( $_FILES["fileToUpload"]["name"]). " başarıyla yüklendi.";
                
                $user_id = $_SESSION["user_id"];
                $img_name = basename($_FILES["fileToUpload"]["name"]);
                
                $servername = "localhost";
                $username = "kullanici_adi";
                $password = "sifre";
                $dbname = "veritabani_adi";

                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Bağlantı hatası: " . $conn->connect_error);
                }

                $update_sql = "UPDATE kusers SET img_name = '$img_name' WHERE id = $user_id";
                
                if ($conn->query($update_sql) === TRUE) {
                    echo "Profil fotoğrafı başarıyla kaydedildi";
                } else {
                    echo "Hata: " . $conn->error;
                }
                $conn->close();
            } else {
                echo "Dosya yüklenirken bir hata oluştu.";
            }
        }
    }
    ?>