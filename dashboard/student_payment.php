<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CLASSROOM63</title>
    <link rel="stylesheet" href="../css/styles.css">
    <script src="../js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="icon" href="../img/logo.png" type="image/png">
    <link rel="apple-touch-icon" href="../img/logo.png">
</head>

<?php
session_start(); // เริ่มเซสชันเพื่อเข้าถึงข้อมูลของผู้ใช้

include '../sql/db_config.php'; // เชื่อมต่อฐานข้อมูล

// ตรวจสอบว่าผู้ใช้เป็นแอดมินหรือไม่
$isAdmin = isset($_SESSION['role']) && $_SESSION['role'] === 'admin';

// Query เพื่อดึงข้อมูลยอดเงินทั้งหมด
$stmt = $pdo->query('SELECT SUM(amount_paid) AS total_paid FROM student_payment');
$row = $stmt->fetch(PDO::FETCH_ASSOC);

// คำนวณยอดรวมทั้งหมด
$total_paid = $row['total_paid'];
$remaining_balance = $total_paid;
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
                    <h3>ยอดเงินห้อง</h3>
                    <p>ยอดคงเหลือ: ฿<?php echo number_format($remaining_balance, 2); ?></p>
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
                            <th>จ่ายแล้ว</th>
                            <th>ยังไม่จ่าย</th>
                            <th>สถานะการจ่ายเงิน</th>
                            <?php if ($isAdmin): ?>
                                <th>แก้ไข</th> <!-- แสดงช่องนี้เฉพาะเมื่อเป็นแอดมิน -->
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // ดึงข้อมูลนักเรียนจากฐานข้อมูล
                        $stmt = $pdo->query('SELECT * FROM student_payment');
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            // กำหนดคลาสสีสำหรับสถานะการจ่ายเงิน
                            $statusClass = '';
                            if ($row['payment_status'] === 'จ่ายครบแล้ว') {
                                $statusClass = 'pay';  // สีเขียว
                            } elseif ($row['payment_status'] === 'ยังไม่จ่าย') {
                                $statusClass = 'not-pay';  // สีแดง
                            } elseif ($row['payment_status'] === 'จ่ายยังไม่ครบ') {
                                $statusClass = 'not-normal-pay';  // สีเหลือง
                            } else {
                                $statusClass = 'no-data';  // กำหนดเป็นค่าเริ่มต้น
                            }

                            // แสดงข้อมูลในแต่ละแถว พร้อมปุ่มแก้ไขและลบเฉพาะแอดมิน
                            echo "<tr>
                                    <td>{$row['id']}</td>
                                    <td>{$row['student_id']}</td>
                                    <td>{$row['full_name']}</td>
                                    <td>" . number_format($row['amount_paid'], 2) . "</td>
                                    <td>" . number_format($row['amount_due'], 2) . "</td>
                                    <td class='status {$statusClass}'>{$row['payment_status']}</td>";
                                    
                            if ($isAdmin) {
                                echo "<td><a href='../admin/edit_payment.php?id={$row['id']}' class='btn-edit'>แก้ไข</a></td>"; // แสดงปุ่มแก้ไขสำหรับแอดมิน
                            }
                            echo "</tr>";
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
