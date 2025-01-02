<?php
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $id = $_GET["id"];

    // الاتصال بقاعدة البيانات
    $conn = new mysqli('localhost', 'root', '', 'blog');
    if ($conn->connect_error) {
        die("فشل الاتصال: " . $conn->connect_error);
    }

    // جلب الرسالة من قاعدة البيانات
    $sql = "SELECT * FROM messages WHERE id = $id";
    $result = $conn->query($sql);
    $message = $result->fetch_assoc();

    if ($message) {
        echo '<form method="POST" action="update_message.php">
                <input type="hidden" name="id" value="' . $message["id"] . '">
                <label for="name">اسمك:</label>
                <input type="text" id="name" name="name" value="' . $message["name"] . '" required><br><br>
                <label for="message">رسالتك:</label>
                <textarea id="message" name="message" rows="4" required>' . $message["message"] . '</textarea><br><br>
                <button type="submit">تحديث</button>
              </form>';
    } else {
        echo "الرسالة غير موجودة.";
    }

    $conn->close();
}
?>
