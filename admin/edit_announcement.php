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

// ตรวจสอบว่าเป็น admin หรือไม่
$isAdmin = isset($_SESSION['role']) && $_SESSION['role'] === 'admin';

if (isset($_GET['id'])) {
    // ดึงข้อมูลประกาศที่จะแก้ไข
    $stmt = $pdo->prepare('SELECT * FROM announcements WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $announcement = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // รับข้อมูลจากฟอร์ม
        $title = $_POST['title'];
        $content = $_POST['content'];

        // อัปเดตประกาศในฐานข้อมูล
        if ($title && $content) {
            $stmt = $pdo->prepare('UPDATE announcements SET title = ?, content = ? WHERE id = ?');
            $stmt->execute([$title, $content, $_GET['id']]);
            header('Location: ../dashboard/announcement.php');
            exit;
        } else {
            $error = 'กรุณากรอกข้อมูลให้ครบถ้วน';
        }
    }
}
?>

<body>
    <div class="announcement-container">
        <header class="header">
        <div class="logo">
                CLASSROOM63 
                <?php if ($isAdmin): ?>
                    <span class="admin-mode">( คุณอยู่ในโหมดผู้ดูแล )</span>
                <?php endif; ?>
            </div>
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
            <h2>แก้ไขประกาศ</h2>
            <?php if (isset($error)): ?>
                <div class="error"><?php echo $error; ?></div>
            <?php endif; ?>

            <form action="edit_announcement.php?id=<?php echo $_GET['id']; ?>" method="POST">
                <label for="title">หัวข้อประกาศ:</label>
                <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($announcement['title']); ?>" required>

                <label for="content">รายละเอียดประกาศ:</label>
                <textarea id="content" name="content" required><?php echo htmlspecialchars($announcement['content']); ?></textarea>

                <button type="submit">บันทึกการแก้ไข</button>
            </form>
        </main>
    </div>
</body>
</html>
