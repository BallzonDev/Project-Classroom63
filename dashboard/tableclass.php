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
session_start(); // เริ่มเซสชันเพื่อเข้าถึงข้อมูลของผู้ใช้
include '../sql/db_config.php'; // เชื่อมต่อฐานข้อมูล
// ตรวจสอบว่าเป็น admin หรือไม่
$isAdmin = isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
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

            <section class="content">
                <input type="text" id="searchInput" placeholder="พิมพ์ค้นหาที่นี่..." onkeyup="filterTable()">
                <div class="bg-table">
                    <table id="studentTable">
                        <thead>
                            <tr>
                                <th>ชั่วโมง</th>
                                <th>1</th>
                                <th>2</th>
                                <th>3</th>
                                <th>4</th>
                                <th>5</th>
                                <th>6</th>
                                <th>7</th>
                                <th>8</th>
                            </tr>
                            <tr>
                                <th>วัน/เวลา</th>
                                <th>8:15-9:15</th>
                                <th>9:15-10:15</th>
                                <th>10:15-11:15</th>
                                <th>11:15-12:00</th>
                                <th>12:00-13:05</th>
                                <th>13:05-14:05</th>
                                <th>14:05-15:05</th>
                                <th>15:05-16:05</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>จันทร์</td>
                                <td>ภาษาอังกฤษ<br>ครูชรัญญา<br>ย26</td>
                                <td>ภาษาไทย<br>ครูธารทิพย์<br>121</td>
                                <td>คณิตศาสตร์เพิ่มเติม<br>ครูนิภา<br>624</td>
                                <td>คณิตศาสตร์เพิ่มเติม<br>ครูนิภา<br>624</td>
                                <td>พักเที่ยง</td>
                                <td>พละ<br>ครูธณวรรษ<br>สน.2</td>
                                <td>อังกฤษ<br>ครูเพียงนภา<br>ย25</td>
                                <td>ดนตรี<br>ครูปรมะ<br>ศ2</td>
                            </tr>
    
                            <tr>
                                <td>อังคาร</td>
                                <td>ประวัติศาสตร์<br>ครูพงศ์ภัค<br>234</td>
                                <td>คณิตศาสตร์พื้นฐาน<br>ครูนิภา<br>624</td>
                                <td>การงาน<br>ครูสุภัคสิริ<br>ฝ12</td>
                                <td>อังกฤษ<br>ครูเพียงนภา<br>ย25</td>
                                <td>พักเที่ยง</td>
                                <td>Code<br>ครูสันติ<br>COM1</td>
                                <td>Website<br>ครูเบญญาภา<br>COM3</td>
                                <td>Website<br>ครูเบญญาภา<br>COM3</td>
                            </tr>
    
                            <tr>
                                <td>พุธ</td>
                                <td>กิจกรรม<br>ชุมนุม</td>
                                <td>สุขศึกษา<br>ครูอำไพ<br>ย24</td>
                                <td>คณิตศาสตร์เพิ่มเติม<br>ครูนิภา<br>624</td>
                                <td>คณิตศาสตร์เพิ่มเติม<br>ครูนิภา<br>624</td>
                                <td>พักเที่ยง</td>
                                <td>แนะแนว<br>ครูอรพรรณ<br>438</td>
                                <td>Website<br>ครูเบญญาภา<br>COM3</td>
                                <td>Website<br>ครูเบญญาภา<br>COM3</td>
                            </tr>
    
                            <tr>
                                <td>พฤหัสฯ</td>
                                <td>ไฟฟ้า<br>ครูเสาวคนธ์<br>ฝ22</td>
                                <td>ไฟฟ้า<br>ครูเสาวคนธ์<br>ฝ22</td>
                                <td>Code<br>ครูสันติ<br>COM1</td>
                                <td>Code<br>ครูสันติ<br>COM1</td>
                                <td>พักเที่ยง</td>
                                <td>ภาษาไทย<br>ครูธารทิพย์<br>121</td>
                                <td>ภาษาอังกฤษ<br>ครูชรัญญา<br>ย26</td>
                                <td>สังคม<br>ครูชัญญาวีร์<br>235</td>
                            </tr>
    
                            <tr>
                                <td>ศุกร์</td>
                                <td>กิจกรรม<br>โฮมรูม</td>
                                <td>ประวัติศาสตร์<br>ครูพงศ์ภัค<br>234</td>
                                <td>IT<br>ครูผจญ<br>COM1</td>
                                <td>IT<br>ครูผจญ<br>COM1</td>
                                <td>พักเที่ยง</td>
                                <td>คณิตศาสตร์พื้นฐาน<br>ครูนิภา<br>624</td>
                                <td>กิจกรรม<br>โฮมรูม</td>
                                <td>กิจกรรม<br>คุณธรรม<br>จริยธรรม</td>
                            </tr>
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
