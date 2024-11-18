<?php
include '../sql/db_config.php'; // เชื่อมต่อฐานข้อมูล

// ตรวจสอบว่ามี ID ของการมาเรียนใน URL หรือไม่
if (isset($_GET['id'])) {
    $attendance_id = $_GET['id'];

    // รีเซ็ทจำนวนการมาเรียนของนักเรียน
    $stmt = $pdo->prepare('UPDATE student_attendance SET attendance_count = 0 WHERE id = :id');
    $stmt->execute(['id' => $attendance_id]);

    // รีไดเรคกลับไปยังหน้า student_attendance.php
    header('Location: ../dashboard/student_attendance.php');
    exit;
} else {
    echo "ไม่มีการระบุ ID ของการมาเรียน";
    exit;
}
?>
