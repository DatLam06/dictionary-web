<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dictionary_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

echo "Kết nối database thành công!";
