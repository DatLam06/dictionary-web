<?php
include "db.php";

// 1. LẤY ID TỪ URL (Chạy ngay khi vừa mở trang)
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Lấy dữ liệu cũ để điền vào form (Dùng tên biến khác để tránh nhầm)
    $sql_get_data = "SELECT * FROM words WHERE id = $id";
    $result_get_data = $conn->query($sql_get_data);
    $data = $result_get_data->fetch_assoc();
} else {
    die("Không tìm thấy ID!");
}

// 2. XỬ LÝ KHI BẤM NÚT CẬP NHẬT (Chỉ chạy khi có POST)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $word = $_POST['word'];
    $meaning = $_POST['meaning'];
    $type = $_POST['type'];
    $example = $_POST['example'];

    // Câu lệnh SQL UPDATE
    $sql_update = "UPDATE words SET word='$word', meaning='$meaning', type='$type', example='$example' WHERE id=$id";

    if ($conn->query($sql_update) === TRUE) {
        header("Location: index.php");
        exit();
    } else {
        echo "Lỗi cập nhật: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head><meta charset="UTF-8"><title>Sửa từ</title></head>
<body>
    <h2>Sửa từ vựng</h2>
    <form method="POST">
        <input type="text" name="word" value="<?php echo $data['word']; ?>" required><br><br>
        <textarea name="meaning"><?php echo $data['meaning']; ?></textarea><br><br>
        <input type="text" name="type" value="<?php echo $data['type']; ?>"><br><br>
        <textarea name="example"><?php echo $data['example']; ?></textarea><br><br>
        
        <button type="submit">Lưu thay đổi</button>
        <a href="index.php">Hủy</a>
    </form>
</body>
</html>