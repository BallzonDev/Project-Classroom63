<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
session_start(); // เริ่มต้น session

include '../sql/db_config.php'; // รวมไฟล์การเชื่อมต่อฐานข้อมูล

// ตรวจสอบว่ามีการส่งข้อมูลแบบ POST หรือไม่
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // ตรวจสอบว่ามีข้อมูลใน POST หรือไม่
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // เตรียม SQL query สำหรับตรวจสอบข้อมูลผู้ใช้
        $sql = "SELECT * FROM users WHERE username = :username";

        try {
            // เตรียม query
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->execute();

            // ตรวจสอบว่ามีผู้ใช้หรือไม่
            if ($stmt->rowCount() > 0) {
                $user = $stmt->fetch();

                // ตรวจสอบรหัสผ่าน
                if (password_verify($password, $user['password'])) {
                    // ถ้ารหัสผ่านถูกต้องให้สร้าง session
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['role'] = $user['role']; // เก็บ role ของผู้ใช้

                    // ตรวจสอบว่า role เป็น admin หรือไม่
                    if ($user['role'] == 'admin') {
                        // ถ้าเป็น admin ให้เปลี่ยนเส้นทางไปยัง dashboard ของ admin
                        echo "<script>
                            Swal.fire({
                                title: 'เข้าสู่ระบบสำเร็จ',
                                text: 'โปรดรอสักครู่...',
                                icon: 'success',
                                timer: 2000, // ตั้งเวลาของ SweetAlert2 ให้แสดง 2 วินาที
                                showConfirmButton: false
                            }).then(function() {
                                window.location = '../dashboard/index.php'; // เส้นทางไปหน้า admin
                            });
                        </script>";
                    } else {
                        // ถ้าไม่ใช่ admin ให้เปลี่ยนเส้นทางไปยังหน้า user
                        echo "<script>
                            Swal.fire({
                                title: 'เข้าสู่ระบบสำเร็จ',
                                text: 'โปรดรอสักครู่...',
                                icon: 'success',
                                timer: 2000, // ตั้งเวลาของ SweetAlert2 ให้แสดง 2 วินาที
                                showConfirmButton: false
                            }).then(function() {
                                window.location = '../dashboard/index.php'; // เส้นทางไปหน้า user
                            });
                        </script>";
                    }
                } else {
                    // หากรหัสผ่านไม่ถูกต้อง
                    echo "<script>
                        Swal.fire({
                            title: 'รหัสผ่านไม่ถูกต้อง!',
                            text: 'โปรดลองอีกครั้ง...',
                            icon: 'error',
                            timer: 2000, // ตั้งเวลาของ SweetAlert2 ให้แสดง 2 วินาที
                            showConfirmButton: false
                        }).then(function() {
                            window.location = '../login-register/login.html'; // เปลี่ยน URL ที่นี่
                        });
                    </script>";
                }
            } else {
                // หากไม่พบผู้ใช้ในฐานข้อมูล
                echo "<script>
                    Swal.fire({
                        title: 'ไม่พบผู้ใช้!',
                        text: 'โปรดลองอีกครั้ง...',
                        icon: 'error',
                        timer: 2000, // ตั้งเวลาของ SweetAlert2 ให้แสดง 2 วินาที
                        showConfirmButton: false
                    }).then(function() {
                        window.location = '../login-register/login.html'; // เปลี่ยน URL ที่นี่
                    });
                </script>";
            }
        } catch (PDOException $e) {
            // หากเกิดข้อผิดพลาดในการ query
            echo "เกิดข้อผิดพลาดในการตรวจสอบข้อมูล: " . $e->getMessage();
        }
    } else {
        // หากไม่พบข้อมูลที่ส่งมา (user และ password)
        echo "<script>
            Swal.fire({
                title: 'กรุณากรอกชื่อผู้ใช้และรหัสผ่าน!',
                text: 'โปรดลองอีกครั้ง...',
                icon: 'info',
                timer: 2000, // ตั้งเวลาของ SweetAlert2 ให้แสดง 2 วินาที
                showConfirmButton: false
            }).then(function() {
                window.location = '../login-register/login.html'; // เปลี่ยน URL ที่นี่
            });
        </script>";
    }
}
?>