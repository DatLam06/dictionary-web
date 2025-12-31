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
<h2>Danh sách từ</h2>

<?php
$result = $conn->query("SELECT * FROM words ORDER BY id DESC");

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
    echo "Chưa có từ nào.";
}
?>

</body>
</html>
