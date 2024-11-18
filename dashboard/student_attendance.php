<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CLASSROOM63</title>
    <link rel="stylesheet" href="../css/styles.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="icon" href="../img/logo.png" type="image/png">
    <link rel="apple-touch-icon" href="../img/logo.png">
</head>

<?php
session_start(); // เริ่มเซสชันเพื่อเข้าถึงข้อมูลของผู้ใช้
include '../sql/db_config.php'; // เชื่อมต่อฐานข้อมูล

// กำหนดจำนวนวันเรียนทั้งหมด
$total_days = 20;

$isAdmin = isset($_SESSION['role']) && $_SESSION['role'] === 'admin';

// ดึงข้อมูลการมาเรียนของนักเรียนจากฐานข้อมูล
$stmt = $pdo->query('SELECT * FROM student_attendance');
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
                <h3>การมาเรียนและการขาดเรียน</h3>
                <!-- กราฟแผนภูมิแท่ง -->
                <canvas id="attendanceBarChart"></canvas>
            </div>
            <div class="card">
                <!-- กราฟแผนภูมิวงกลม -->
                <canvas id="attendancePieChart"></canvas>
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
                                <th>มาเรียน/ครั้ง</th>
                                <th>ร้อยละ</th>
                                <?php if ($isAdmin): ?>
                                    <th>การจัดการ</th> <!-- แสดงช่องนี้เฉพาะเมื่อเป็นแอดมิน -->
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // แสดงข้อมูลการมาเรียนของนักเรียน
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                // คำนวณร้อยละการมาเรียน
                                $attendance_percentage = ($row['attendance_count'] / $total_days) * 100;

                                // เพิ่มปุ่มแก้ไขและลบ
                                echo "<tr>
                                        <td>{$row['id']}</td>
                                        <td>{$row['student_id']}</td>
                                        <td>{$row['full_name']}</td>
                                        <td>{$row['attendance_count']}</td>
                                        <td>" . number_format($attendance_percentage, 2) . "%</td>";
                                        if ($isAdmin) {
                                        echo "<td><a href='../admin/edit_attendance.php?id={$row['id']}' class='btn-edit'>แก้ไข</a>
                                            <a href='../admin/delete_attendance.php?id={$row['id']}' class='btn-delete' onclick='return confirm(\"คุณต้องการลบข้อมูลนี้หรือไม่?\")'>รีเซ็ท</a>
                                        </td>";
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
        // ดึงข้อมูลจาก PHP สำหรับกราฟ
        const totalDays = <?php echo $total_days; ?>;
        const studentData = <?php
            // ดึงข้อมูลจากฐานข้อมูลในรูปแบบ JSON
            $stmt = $pdo->query('SELECT SUM(attendance_count) as total_present, COUNT(id) as total_students FROM student_attendance');
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            $totalPresent = $data['total_present'];
            $totalStudents = $data['total_students'];
            $totalAbsent = ($totalStudents * $total_days) - $totalPresent;
            echo json_encode([
                'totalPresent' => $totalPresent,
                'totalAbsent' => $totalAbsent
            ]);
        ?>;

        // สร้างกราฟแผนภูมิแท่ง
        const ctxBar = document.getElementById('attendanceBarChart').getContext('2d');
        const attendanceBarChart = new Chart(ctxBar, {
            type: 'bar',
            data: {
                labels: ['มาเรียน', 'ขาดเรียน'],
                datasets: [{
                    label: 'จำนวนนักเรียน (ครั้ง)',
                    data: [studentData.totalPresent, studentData.totalAbsent],
                    backgroundColor: ['rgba(54, 162, 235, 0.7)', 'rgba(255, 99, 132, 0.7)'],
                    borderColor: ['rgba(54, 162, 235, 1)', 'rgba(255, 99, 132, 1)'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // สร้างกราฟแผนภูมิวงกลม
        const ctxPie = document.getElementById('attendancePieChart').getContext('2d');
        const attendancePieChart = new Chart(ctxPie, {
        type: 'pie',
        data: {
            labels: ['มาเรียน', 'ขาดเรียน'],
            datasets: [{
                data: [studentData.totalPresent, studentData.totalAbsent],
                backgroundColor: ['rgba(54, 162, 235, 0.7)', 'rgba(255, 99, 132, 0.7)'],
                borderColor: ['rgba(54, 162, 235, 1)', 'rgba(255, 99, 132, 1)'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false, // ปิดการคงอัตราส่วน
            plugins: {
                legend: {
                    position: 'bottom', // ย้ายตำแหน่ง legend ถ้าจำเป็น
                }
            }
        }
    });

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

            for (let i = 1; i < rows.length; i++) {
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
