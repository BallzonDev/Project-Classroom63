<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
session_start(); // เริ่มต้น session

include '../sql/db_config.php'; // รวมไฟล์การเชื่อมต่อฐานข้อมูล

// ตรวจสอบว่ามีการส่งข้อมูลแบบ POST หรือไม่
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // ตรวจสอบว่ามีการส่งข้อมูลใน POST หรือไม่
    if (isset($_POST['username'], $_POST['user_id'], $_POST['password'], $_POST['email'])) {
        $username = $_POST['username'];
        $user_id = $_POST['user_id'];
        $password = $_POST['password'];
        $email = $_POST['email'];

        // เข้ารหัสรหัสผ่าน
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // เตรียม SQL query สำหรับบันทึกข้อมูลผู้ใช้ใหม่
        $sql = "INSERT INTO users (username, user_id, password, email) VALUES (:username, :user_id, :password, :email)";

        try {
            // เตรียม query
            $stmt = $pdo->prepare($sql);

            // ผูกค่าพารามิเตอร์กับตัวแปร
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_STR);
            $stmt->bindParam(':password', $hashed_password, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);

            // ดำเนินการ query
            $stmt->execute();

            echo "<script>
            Swal.fire({
                title: 'สมัครสมาชิกสำเร็จ!',
                text: 'โปรดรอสักครู่...',
                icon: 'success',
                timer: 2000, // ตั้งเวลาของ SweetAlert2 ให้แสดง 2 วินาที
                showConfirmButton: false
            }).then(function() {
                // เปลี่ยนหน้าไปยัง URL ใหม่หลังจากที่ SweetAlert2 ปิด
                window.location = '../login-register/login.html'; // เปลี่ยน URL ที่นี่
            });
        </script>";
        } catch (PDOException $e) {
            echo "เกิดข้อผิดพลาดในการสมัครสมาชิก: " . $e->getMessage();
        }
    } else {
        echo "กรุณากรอกข้อมูลให้ครบถ้วน!";
    }
}
?>
