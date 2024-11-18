<?php
session_start(); // เริ่มต้น session

// ลบข้อมูล session
session_unset();
session_destroy();

// เปลี่ยนเส้นทางไปยังหน้า login

header('Location: login.html');
exit;
?>
