<?php
include "db.php";


if (isset($_GET['id'])) {
    $id = $_GET['id'];


    $sql = "DELETE FROM words WHERE id = $id";

    if ($conn->query($sql) === TRUE) {

        header("Location: index.php");
    } else {
        echo "Lỗi khi xóa: " . $conn->error;
    }
} else {

    header("Location: index.php");
}
?>