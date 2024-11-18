<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
session_start();
include '../sql/db_config.php';


if (isset($_GET['id'])) {
    $stmt = $pdo->prepare('DELETE FROM announcements WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    echo "<script>
        Swal.fire({
            title: 'ลบข้อมูลสำเร็จ',
            text: 'โปรดรอสักครู่...',
            icon: 'success',
            timer: 1000, // ตั้งเวลาของ SweetAlert2 ให้แสดง 2 วินาที
            showConfirmButton: false
        }).then(function() {
            window.location = '../dashboard/announcement.php'; // เส้นทางไปหน้า user
        });
    </script>";
    exit;
}
?>
