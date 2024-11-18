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

// ตรวจสอบว่ามี ID ของนักเรียนใน URL หรือไม่
if (isset($_GET['id'])) {
    $attendance_id = $_GET['id'];

    // ดึงข้อมูลการมาเรียนของนักเรียน
    $stmt = $pdo->prepare('SELECT * FROM student_attendance WHERE id = :id');
    $stmt->execute(['id' => $attendance_id]);
    $attendance = $stmt->fetch(PDO::FETCH_ASSOC);

    // ถ้าไม่พบข้อมูลนักเรียน
    if (!$attendance) {
        echo "ไม่พบข้อมูลการมาเรียน";
        exit;
    }
} else {
    echo "ไม่มีการระบุ ID ของการมาเรียน";
    exit;
}

// ตรวจสอบว่าแบบฟอร์มถูกส่งหรือไม่
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // รับข้อมูลจากฟอร์ม
    $attendance_count = $_POST['attendance_count'];

    // Update ข้อมูลการมาเรียนในฐานข้อมูล
    $stmt = $pdo->prepare('UPDATE student_attendance SET attendance_count = :attendance_count WHERE id = :id');
    $stmt->execute([
        'attendance_count' => $attendance_count,
        'id' => $attendance_id
    ]);

    // รีไดเรคกลับไปยังหน้า student_attendance.php
    header('Location: ../dashboard/student_attendance.php');
    exit;
}
?>

<body>
    <div class="table-container">
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
                <a style="background-color: #da1919;" href="../login-register/logout.php">ออกจากระบบ</a>
            </nav>
        </header>

        <main class="main-content">
            <section class="content">
                <h2>แก้ไขข้อมูลการมาเรียน</h2>
                <form action="edit_attendance.php?id=<?php echo $attendance['id']; ?>" method="POST">
                    <div class="form-group">
                        <label for="student_id">รหัสนักเรียน:</label>
                        <input type="text" id="student_id" name="student_id" value="<?php echo $attendance['student_id']; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="full_name">ชื่อ-นามสกุล:</label>
                        <input type="text" id="full_name" name="full_name" value="<?php echo $attendance['full_name']; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="attendance_count">จำนวนครั้งที่มาเรียน:</label>
                        <input type="number" id="attendance_count" name="attendance_count" value="<?php echo $attendance['attendance_count']; ?>" required>
                    </div>
                    <div class="form-group">
                        <button type="submit">บันทึกการแก้ไข</button>
                    </div>
                </form>
            </section>
        </main>
    </div>
</body>
</html>
