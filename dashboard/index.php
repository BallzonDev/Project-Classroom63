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

// Query เพื่อดึงข้อมูลประกาศล่าสุดจากฐานข้อมูล
$stmt = $pdo->query('SELECT * FROM announcements ORDER BY created_at DESC LIMIT 1');
$announcement = $stmt->fetch(PDO::FETCH_ASSOC);

// Query เพื่อดึงข้อมูลนักเรียนทั้งหมดจากฐานข้อมูล
$stmt = $pdo->query('SELECT * FROM students');
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
                <?php if ($isAdmin): ?>
                    <a href="../dashboard/announcement.php">ประกาศ</a>
                <?php endif; ?>
                <a style="background-color: #da1919;" href="../login-register/logout.php">ออกจากระบบ</a>
            </nav>
            <div class="hamburger" id="hamburger">&#9776;</div> <!-- Hamburger Icon -->
        </header>

        <main class="main-content">
            <section class="overview">
                <div class="card">
                    <h3>รายชื่อนักเรียน</h3>
                    <p>นักเรียนทั้งหมด: 38 คน</p>
                </div>
                <div class="card">
                    <h3>ประกาศสำคัญ</h3>
                    <!-- แสดงข้อมูลประกาศจากฐานข้อมูล -->
                    <?php if ($announcement): ?>
                        <p><?php echo htmlspecialchars($announcement['title']); ?></p>
                        <p><?php echo nl2br(htmlspecialchars($announcement['content'])); ?></p>
                    <?php else: ?>
                        <p>ไม่มีประกาศสำคัญในขณะนี้</p>
                    <?php endif; ?>
                </div>
            </section>

            <section class="content">
                <input type="text" id="searchInput" placeholder="พิมพ์ค้นหารายชื่อที่นี่..." onkeyup="filterTable()">
                <div class="bg-table">
                    <table id="studentTable">
                        <thead>
                            <tr>
                                <th>เลขที่</th>
                                <th>รหัสนักเรียน</th>
                                <th>ชื่อ-นามสกุล</th>
                                <th>ระดับชั้น</th>
                                <th>สถานะการเรียน</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // ดึงข้อมูลนักเรียนจากฐานข้อมูล
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                // กำหนดคลาสสีสำหรับสถานะการเรียน
                                $statusClass = '';
                                if ($row['status'] === 'เรียน') {
                                    $statusClass = 'study';
                                } elseif ($row['status'] === 'ไม่เรียน') {
                                    $statusClass = 'not-study';
                                } else {
                                    $statusClass = 'no-data';
                                }

                                echo "<tr>
                                        <td>{$row['student_number']}</td>
                                        <td>{$row['student_id']}</td>
                                        <td>{$row['full_name']}</td>
                                        <td>{$row['grade_level']}</td>
                                        <td class='status {$statusClass}'>{$row['status']}</td>
                                      </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </section>
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
