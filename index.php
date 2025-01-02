<?php
// الاتصال بقاعدة البيانات
$conn = new mysqli('localhost', 'root', '', 'blog');
if ($conn->connect_error) {
    die("فشل الاتصال: " . $conn->connect_error);
}

// التعامل مع إرسال الرسائل
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["name"], $_POST["message"])) {
    $name = $_POST["name"];
    $message = $_POST["message"];

    $sql = "INSERT INTO messages (name, message) VALUES ('$name', '$message')";

    if ($conn->query($sql) === TRUE) {
        echo "تم نشر الرسالة بنجاح.";
    } else {
        echo "حدث خطأ: " . $conn->error;
    }
}

// جلب الرسائل من قاعدة البيانات
$sql = "SELECT * FROM messages ORDER BY date DESC";
$result = $conn->query($sql);
$messages = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $messages[] = $row;
    }
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مكتب المحاسب القانوني عبدالعزيز عمران</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #1e1e2f;
            color: #fff;
        }

        header {
            background-color: #2d4059;
            color: #fff;
            padding: 20px 0;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.5);
        }

        header h1 {
            margin: 0;
            font-size: 2.5rem;
            font-weight: bold;
        }

        nav {
            background-color: #1b2838;
            padding: 10px 0;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.5);
        }

        nav ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
        }

        nav ul li {
            margin: 0 15px;
        }

        nav ul li a {
            color: #fff;
            text-decoration: none;
            font-size: 1.2rem;
            transition: color 0.3s;
        }

        nav ul li a:hover {
            color: #28a745;
        }

        .container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin: 20px;
            padding: 10px;
        }

        .box {
            background-color: #2d4059;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
            text-align: center;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .box:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.7);
        }

        .box h3 {
            margin-top: 0;
            color: #28a745;
            font-size: 1.8rem;
        }

        .box p, .box ul {
            color: #d1d1d1;
            line-height: 1.6;
        }

        .box ul {
            list-style: none;
            padding: 0;
        }

        .box ul li {
            margin: 10px 0;
        }

        .contact-icons {
            display: flex;
            justify-content: center;
            gap: 15px;
        }

        .contact-icons a {
            color: #28a745;
            font-size: 2.5rem;
            text-decoration: none;
            transition: color 0.3s, transform 0.3s;
        }

        .contact-icons a:hover {
            color: #fff;
            transform: scale(1.1);
        }

        footer {
            background-color: #1b2838;
            color: #d1d1d1;
            text-align: center;
            padding: 10px 0;
            margin-top: 20px;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <header>
        <h1>مكتب المحاسب القانوني عبدالعزيز عمران</h1>
    </header>
    <nav>
        <ul>
            <li><a href="#about">خبر اكثر</a></li>
            <li><a href="#services">من</a></li>
            <li><a href="#contact">٢٢سنه</a></li>
        </ul>
    </nav>
    <div class="container">
        <!-- نموذج إرسال الرسالة -->
        <div class="box">
            <h3>أرسل رسالتك</h3>
            <form method="POST" action="">
                <label for="name">اسمك:</label>
                <input type="text" id="name" name="name" required><br><br>
                <label for="message">رسالتك:</label>
                <textarea id="message" name="message" rows="4" required></textarea><br><br>
                <button type="submit">نشر</button>
            </form>
        </div>

        <!-- عرض الرسائل -->
        <div class="box">
            <h3>الرسائل</h3>
            <?php if (!empty($messages)): ?>
                <?php foreach ($messages as $message): ?>
                    <div class="message">
                        <p><strong><?php echo $message["name"]; ?></strong> - <?php echo $message["date"]; ?></p>
                        <p><?php echo $message["message"]; ?></p>
                        <a href="edit_message.php?id=<?php echo $message["id"]; ?>">تعديل</a> | 
                        <a href="delete_message.php?id=<?php echo $message["id"]; ?>">حذف</a>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>لا توجد رسائل حالياً.</p>
            <?php endif; ?>
        </div>
    </div>
    <footer>
        <p>نتشرف بالتعامل معكم وهنكون عند حسن ظنكم ان شاء الله</p>
    </footer>
</body>
</html>
