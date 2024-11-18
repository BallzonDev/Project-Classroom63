<?php
// เปิดการแสดงข้อผิดพลาดทั้งหมด
error_reporting(E_ALL);
ini_set('display_errors', 1);

// ตั้งค่าการเชื่อมต่อฐานข้อมูล
$host = 'localhost';    // หรือที่อยู่เซิร์ฟเวอร์ฐานข้อมูล
$dbname = 'test';       // ชื่อฐานข้อมูล
$username = 'root';     // ชื่อผู้ใช้ฐานข้อมูล
$password = '';         // รหัสผ่านฐานข้อมูล

// ตัวเลือกเพิ่มเติม
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,   // ให้แจ้งข้อผิดพลาด
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,  // ดึงข้อมูลเป็นรูปแบบ Associative Array
    PDO::ATTR_EMULATE_PREPARES => false,  // ปิดการใช้งาน prepare emulation
];

// เชื่อมต่อฐานข้อมูลด้วย PDO
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password, $options);
    $pdo->exec("SET NAMES 'utf8'");
    // ถ้าการเชื่อมต่อสำเร็จ
    echo "<p style='display: none;'>เชื่อมต่อฐานข้อมูลสำเร็จ</p>";  // เพิ่มข้อความนี้เพื่อแสดงบนหน้าจอ
} catch (PDOException $e) {
    // ถ้ามีข้อผิดพลาด
    echo "ไม่สามารถเชื่อมต่อฐานข้อมูลได้: " . $e->getMessage();
}
?>