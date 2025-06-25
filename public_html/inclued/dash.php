<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include "db_connection.php";

$username = $_SESSION['username'];

// Kullanıcının bilgilerini çekme
$user_query = "SELECT * FROM kusers WHERE username = '$username'";
$user_result = $conn->query($user_query);

if ($user_result !== false && $user_result->num_rows > 0) {
    // Kullanıcının tüm bilgilerini al
    $user_data = $user_result->fetch_assoc();
    $user_id = $user_data['id'];

    // Kartvizit bilgilerini çekme
    $kartvizit_query = "SELECT * FROM kartvizit WHERE user_id = $user_id";
    $kartvizit_result = $conn->query($kartvizit_query);
} else {
    echo "Error: Unable to fetch kusers data.";
    exit();
}
?>
