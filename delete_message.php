<?php
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $id = $_GET["id"];

    // الاتصال بقاعدة البيانات
    $conn = new mysqli('localhost', 'root', '', 'blog');
    if ($conn->connect_error) {
        die("فشل الاتصال: " . $conn->connect_error);
    }

    $sql = "DELETE FROM messages WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "تم حذف الرسالة بنجاح.";
    } else {
        echo "حدث خطأ: " . $conn->error;
    }

    $conn->close();
}
?>
