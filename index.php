<?php
include "db.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $word = $_POST['word'];
    $meaning = $_POST['meaning'];
    $type = $_POST['type'];
    $example = $_POST['example'];

    $sql = "INSERT INTO words (word, meaning, type, example)
            VALUES ('$word', '$meaning', '$type', '$example')";

    if ($conn->query($sql) === TRUE) {
        echo "Thêm từ thành công!";
    } else {
        echo "Lỗi: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Từ điển</title>
</head>
<body>

<h2>Thêm từ mới</h2>

<form method="post">
    <input type="text" name="word" placeholder="Word">
    <br>

    <textarea name="meaning" placeholder="Meaning"></textarea>
    <br>

    <input type="text" name="type" placeholder="Type">
    <br>

    <textarea name="example" placeholder="Example"></textarea>
    <br>

    <button type="submit">Add word</button>
</form>
<hr>
<h2>Tìm kiếm thuật ngữ</h2>
<form method="GET" action="">
    <input type="text" name="query" placeholder="Nhập từ cần tìm..." value="<?php echo isset($_GET['query']) ? $_GET['query'] : ''; ?>">
    <button type="submit">Tìm</button>
    <a href="index.php"><button type="button">Xóa lọc</button></a>
</form>
<hr>
<h2>Danh sách từ</h2>

<?php
// 1. Mặc định là lấy tất cả từ mới nhất lên đầu
$sql = "SELECT * FROM words";

// 2. Kiểm tra: Nếu m có nhập gì đó vào ô tìm kiếm (query)
if (isset($_GET['query']) && !empty($_GET['query'])) {
    $q = $_GET['query'];
    // Sửa câu lệnh SQL: Tìm trong cột 'word' HOẶC 'meaning' có chứa chữ m nhập
   $sql = "SELECT * FROM words WHERE word LIKE '%$q%'";
}

// 3. Luôn sắp xếp theo ID giảm dần
$sql .= " ORDER BY id DESC";

// 4. Chạy câu lệnh SQL đã chốt
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1' cellpadding='8'>";
    echo "<tr>
            <th>ID</th>
            <th>Word</th>
            <th>Meaning</th>
            <th>Type</th>
            <th>Example</th>
          </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['word'] . "</td>";
        echo "<td>" . $row['meaning'] . "</td>";
        echo "<td>" . $row['type'] . "</td>";
        echo "<td>" . $row['example'] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "Không tìm thấy kết quả nào phù hợp.";
}
?>

</body>
</html>
