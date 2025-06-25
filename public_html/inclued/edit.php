<?/*php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
include "db_connection.php";
error_reporting(0);
$path = "upload/";
$width = 500;
$height = 500;
$table = "kartvizit";

// Kullanıcının ID'sini al
$username = $_SESSION['username'];
$user_id_query = "SELECT id FROM users WHERE username = '$username'";
$result = $conn->query($user_id_query);
$user_id_row = $result->fetch_assoc();
$user_id = $user_id_row['id'];

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $card_id = $_GET['id'];

    // Kullanıcının kartvizitini al
    $sql = "SELECT * FROM kartvizit WHERE id = $card_id AND user_id = $user_id";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $name = $row['name'];
        $title = $row['title'];
        $phone = $row['phone'];
        $email = $row['email'];
        $hakkimda = $row['hakkimda'];
        $web = $row['web'];
        $sos_1 = $row['sos_1'];
        $sos_2 = $row['sos_2'];
        $sos_3 = $row['sos_3'];
        $sos_4 = $row['sos_4'];
        $iban = $row['iban'];
        $theme_id = $row['theme_id'];
    } else {
        echo "No card found or you don't have permission to edit this card.";
        exit();
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update"])) {
    $id = $_GET["id"];
    $data = $_POST;
    if ($_FILES["file"]["size"] > 0) {
        // Dosya yükleme işlemleri
        $filename = $_FILES["file"]["name"];
        $file_basename = substr($filename, 0, strripos($filename, '.')); // get file extention
        $file_ext = substr($filename, strripos($filename, '.')); // get file name
        $filesize = $_FILES["file"]["size"];
        $allowed_file_types = array('.png','.jpg','.gif','.jpeg');  

        if (in_array($file_ext,$allowed_file_types) && ($filesize < 5000000)) {   
            // Yükleme yapılabilir
            $newfilename = $file_basename . "-" . date("s") . $file_ext;
            if (file_exists($path . $newfilename)) {
                echo "bu dosya zaten mevcut.";
            } else {
                move_uploaded_file($_FILES["file"]["tmp_name"], $path . $newfilename);
                echo "dosya başarıyla yüklendi.";
                resize_crop_image($width, $height, $path.$newfilename, $path.$newfilename);
                $data['img_url'] = $newfilename;
                $where = array("id" => $id);
                $sql = update($table, $data, $where);
                if ($conn->query($sql) === TRUE) {
                    $_SESSION['alert'] = "Güncelleme işlemi başarılı";
                    $_SESSION['type'] = "success";
                    $_SESSION['icon'] = "edit";
                    header("Location: " . $page_url);
                } else {
                    echo "Error updating record: " . $conn->error;
                }
            }
        } elseif (empty($file_basename)) {   
            echo "lütfen bir dosya seçiniz.";
        } elseif ($filesize > 5000000) {   
            echo "dosya boyutunuz çok büyük.";
        } else {
            echo "desteklenen dosya türleri: " . implode(', ', $allowed_file_types);
            unlink($_FILES["file"]["tmp_name"]);
        }
    } else {
        // Dosya yükleme yapılmamış, sadece veri güncelleme işlemi yapılacak
        $where = array("id" => $id);
        $sql = update($table, $data, $where);
        if ($conn->query($sql) === TRUE) {
            $_SESSION['alert'] = "Güncelleme işlemi başarılı";
            $_SESSION['type'] = "success";
            $_SESSION['icon'] = "edit";
            header("Location: " . $page_url);
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }
} else {
    echo "Geçersiz istek.";
    exit();
}
*/
?>
<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
include "db_connection.php";

// Kullanıcının ID'sini al
$username = $_SESSION['username'];
$user_id_query = "SELECT id FROM kusers WHERE username = '$username'";
$result = $conn->query($user_id_query);
$user_id_row = $result->fetch_assoc();
$user_id = $user_id_row['id'];

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $card_id = $_GET['id'];

    // Kullanıcının kartvizitini al
    $sql = "SELECT * FROM kartvizit WHERE id = $card_id AND user_id = $user_id";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $name = $row['name'];
        $title = $row['title'];
        $phone = $row['phone'];
        $email = $row['email'];
        $hakkimda = $row['hakkimda'];
        $web = $row['web'];
        $sos_1 = $row['sos_1'];
        $sos_2 = $row['sos_2'];
        $sos_3 = $row['sos_3'];
        $sos_4 = $row['sos_4'];
        $iban = $row['iban'];
        $theme_id = $row['theme_id'];
    } else {
        echo "No card found or you don't have permission to edit this card.";
        exit();
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $title = $_POST['title'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $hakkimda = $_POST['hakkimda'];
    $web = $_POST['web'];
    $sos_1 = $_POST['sos_1'];
    $sos_2 = $_POST['sos_2'];
    $sos_3 = $_POST['sos_3'];
    $sos_4 = $_POST['sos_4'];
    $iban = $_POST['iban'];
    $theme_id = $_POST['theme'];
    $card_id = $_POST['card_id'];

    $update_query = "UPDATE kartvizit SET name='$name', title='$title', phone='$phone', email='$email', hakkimda='$hakkimda',web='$web', sos_1='$sos_1', sos_2='$sos_2', sos_3='$sos_3', sos_4='$sos_4', iban='$iban', theme_id='$theme_id' WHERE id='$card_id' AND user_id='$user_id'";
    if ($conn->query($update_query) === TRUE) {
        header("Location: kartlarım.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
} else {
    echo "Invalid request.";
    exit();
}
?>
