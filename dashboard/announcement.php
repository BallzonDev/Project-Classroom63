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

$isAdmin = isset($_SESSION['role']) && $_SESSION['role'] === 'admin';

// Query เพื่อดึงข้อมูลประกาศทั้งหมดจากฐานข้อมูล
$stmt = $pdo->query('SELECT * FROM announcements ORDER BY created_at DESC');

// ลบประกาศ
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $stmt = $pdo->prepare('DELETE FROM announcements WHERE id = ?');
    $stmt->execute([$delete_id]);
    header('Location: announcements.php'); // รีเฟรชหน้าหลังจากลบเสร็จ
    exit;
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
                <?php if ($isAdmin): ?>
                    <a href="../dashboard/announcement.php">ประกาศ</a>
                <?php endif; ?>
                <a style="background-color: #da1919;" href="../login-register/logout.php">ออกจากระบบ</a>
            </nav>
            <div class="hamburger" id="hamburger">&#9776;</div> <!-- Hamburger Icon -->
        </header>

        <main class="main-content">
            <h2>ประกาศทั้งหมด</h2>
            <div class="announcement-list">
                <?php while ($announcement = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                    <div class="announcement-item">
                        <h3><?php echo htmlspecialchars($announcement['title']); ?></h3>
                        <p><?php echo nl2br(htmlspecialchars($announcement['content'])); ?></p>
                        <span>ประกาศเมื่อ: <?php echo $announcement['created_at']; ?></span>

                        <div class="edit-delete-btns">
                            <!-- ปุ่มสำหรับแก้ไข -->
                            <a href="../admin/edit_announcement.php?id=<?php echo $announcement['id']; ?>" class="edit-btn">แก้ไข</a>

                            <!-- ปุ่มสำหรับลบ -->
                            <a href="../admin/delete_announcement.php?id=<?php echo $announcement['id']; ?>" class="delete-btn">ลบ</a>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
            <a href="../admin/add_announcement.php" class="add-announcement-btn">เพิ่มประกาศใหม่</a>
        </main>
    </div>
    <script>
        // เปิด/ปิดเมนูเมื่อคลิกที่ hamburger
        const hamburger = document.getElementById('hamburger');
        const nav = document.querySelector('.nav');

        hamburger.addEventListener('click', () => {
            nav.classList.toggle('active');
        });

        function filterTable() {
            const input = document.getElementById("searchInput");
            const filter = input.value.toLowerCase();
            const table = document.getElementById("studentTable");
            const rows = table.getElementsByTagName("tr");

            for (let i = 1; i < rows.length; i++) { // เริ่มที่แถวที่ 1
                const cells = rows[i].getElementsByTagName("td");
                let match = false;

                for (let j = 0; j < cells.length; j++) {
                    if (cells[j].innerText.toLowerCase().includes(filter)) {
                        match = true;
                        break;
                    }
                }
                rows[i].style.display = match ? "" : "none";
            }
        }
    </script>
</body>
</html>
