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
session_start();
include '../sql/db_config.php'; // เชื่อมต่อฐานข้อมูล

$isAdmin = isset($_SESSION['role']) && $_SESSION['role'] === 'admin';

// รับ ID ของนักเรียนที่ต้องการแก้ไขจาก URL
if (isset($_GET['id'])) {
    $student_id = $_GET['id'];

    // Query เพื่อดึงข้อมูลนักเรียนจากฐานข้อมูล
    $stmt = $pdo->prepare('SELECT * FROM student_payment WHERE id = :id');
    $stmt->execute(['id' => $student_id]);
    $student = $stmt->fetch(PDO::FETCH_ASSOC);

    // ถ้าไม่พบข้อมูลนักเรียน
    if (!$student) {
        echo "ไม่พบข้อมูลนักเรียน";
        exit;
    }
} else {
    echo "ไม่มีการระบุ ID ของนักเรียน";
    exit;
}

// ตรวจสอบว่าแบบฟอร์มถูกส่งหรือไม่
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // รับข้อมูลจากแบบฟอร์ม
    $amount_paid = $_POST['amount_paid'];
    $amount_due = $_POST['amount_due'];
    $payment_status = $_POST['payment_status'];

    // Update ข้อมูลในฐานข้อมูล
    $stmt = $pdo->prepare('UPDATE student_payment SET amount_paid = :amount_paid,amount_due = :amount_due, payment_status = :payment_status WHERE id = :id');
    $stmt->execute([
        'amount_due' => $amount_due,
        'amount_paid' => $amount_paid,
        'payment_status' => $payment_status,
        'id' => $student_id
    ]);

    // รีไดเรคกลับไปที่หน้าเดิมหลังจากอัพเดต
    header('Location: ../dashboard/student_payment.php');
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
                <h2>แก้ไขข้อมูลการจ่ายเงินของนักเรียน</h2>
                <form action="edit_payment.php?id=<?php echo $student['id']; ?>" method="POST">
                    <div class="form-group">
                        <label for="student_id">รหัสนักเรียน:</label>
                        <input type="text" id="student_id" name="student_id" value="<?php echo $student['student_id']; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="full_name">ชื่อ-นามสกุล:</label>
                        <input type="text" id="full_name" name="full_name" value="<?php echo $student['full_name']; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="amount_paid">จ่ายแล้ว (บาท):</label>
                        <input type="number" id="amount_paid" name="amount_paid" value="<?php echo $student['amount_paid']; ?>" step="0.01" required>
                    </div>
                    <div class="form-group">
                        <label for="amount_due">ยังไม่จ่าย (บาท):</label>
                        <input type="number" id="amount_due" name="amount_due" value="<?php echo $student['amount_due']; ?>" step="0.01" required>
                    </div>
                    <div class="form-group">
                        <label for="payment_status">สถานะการจ่ายเงิน:</label>
                        <select id="payment_status" name="payment_status">
                            <option value="จ่ายครบแล้ว" <?php echo ($student['payment_status'] === 'จ่ายครบแล้ว') ? 'selected' : ''; ?>>จ่ายครบแล้ว</option>
                            <option value="ยังไม่จ่าย" <?php echo ($student['payment_status'] === 'ยังไม่จ่าย') ? 'selected' : ''; ?>>ยังไม่จ่าย</option>
                            <option value="จ่ายยังไม่ครบ" <?php echo ($student['payment_status'] === 'จ่ายยังไม่ครบ') ? 'selected' : ''; ?>>จ่ายยังไม่ครบ</option>
                        </select>
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
