<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CLASSROOM63</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="icon" href="../img/logo.png" type="image/png">
    <link rel="apple-touch-icon" href="../img/logo.png">
</head>

<?php
session_start(); // เริ่มต้น session

include '../sql/db_config.php'; // เชื่อมต่อฐานข้อมูล

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // รับข้อมูลจากฟอร์ม
    $title = $_POST['title'];
    $content = $_POST['content'];

    // ตรวจสอบว่ามีข้อมูลหรือไม่
    if ($title && $content) {
        // Query เพื่อเพิ่มประกาศใหม่
        $stmt = $pdo->prepare('INSERT INTO announcements (title, content) VALUES (?, ?)');
        $stmt->execute([$title, $content]);
        header('Location: ../dashboard/announcement.php'); // กลับไปยังหน้าประกาศหลังจากเพิ่มเสร็จ
        exit;
    } else {
        $error = 'กรุณากรอกข้อมูลให้ครบถ้วน';
    }
}
?>

<body>
    <div class="announcement-container">
        <header class="header">
            <div class="logo">CLASSROOM63</div>
            <nav class="nav">
                <a href="../dashboard/index.php">หน้าแรก</a>
                <a href="../dashboard/tableclass.php">ตารางเรียน</a>
                <a href="../dashboard/student_payment.php">การเงินห้อง</a>
                <a href="../dashboard/student_attendance.php">การมาเรียน</a>
                <a href="../dashboard/test.php">ประกาศ</a>
                <a style="background-color: #da1919;" href="../login-register/logout.php">ออกจากระบบ</a>
            </nav>
        </header>

        <main class="main-content">
            <h2>เพิ่มประกาศใหม่</h2>

            <?php if (isset($error)): ?>
                <div class="error"><?php echo $error; ?></div>
            <?php endif; ?>

            <form action="add_announcement.php" method="POST">
                <label for="title" class="form-label">หัวข้อประกาศ:</label>
                <input type="text" id="title" name="title" required>

                <label for="content" class="form-label">รายละเอียดประกาศ:</label>
                <textarea id="content" name="content" required></textarea>

                <button type="submit">เพิ่มประกาศ</button>
            </form>
        </main>
    </div>
</body>
</html>
