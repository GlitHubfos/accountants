<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {
    $id = $_POST["id"];
    $name = $_POST["name"];
    $message = $_POST["message"];

    // الاتصال بقاعدة البيانات
    $conn = new mysqli('localhost', 'root', '', 'blog');
    if ($conn->connect_error) {
        die("فشل الاتصال: " . $conn->connect_error);
    }

    $sql = "UPDATE messages SET name='$name', message='$message' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "تم تحديث الرسالة بنجاح.";
    } else {
        echo "حدث خطأ: " . $conn->error;
    }

    $conn->close();
}
?>
