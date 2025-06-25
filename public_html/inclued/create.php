<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
include "db_connection.php";

$username = $_SESSION['username'];
$user_id_query = "SELECT id FROM kusers WHERE username = '$username'";
$result = $conn->query($user_id_query);
$user_id_row = $result->fetch_assoc();
$user_id = $user_id_row['id'];

// Kullanıcının zaten bir kartviziti var mı kontrol et
$existing_card_query = "SELECT id FROM kartvizit WHERE user_id = $user_id";
$existing_card_result = $conn->query($existing_card_query);
if ($existing_card_result->num_rows > 0) {
    echo "zaten bir kartvizitiniz var";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    $insert_query = "INSERT INTO kartvizit (name, title, phone, email, hakkimda, web, sos_1, sos_2, sos_3, sos_4, iban,theme_id, user_id) VALUES ('$name', '$title', '$phone', '$email','$hakkimda','$web','$sos_1','$sos_2','$sos_3','$sos_4','$iban', '$theme_id', '$user_id')";
    if ($conn->query($insert_query) === TRUE) {
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Error: " . $insert_query . "<br>" . $conn->error;
    }
}
?>