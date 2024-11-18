document.addEventListener('DOMContentLoaded', function () {
    const tableRows = document.querySelectorAll('tbody tr'); // เลือกแถวทั้งหมดใน tbody

    tableRows.forEach(row => {
        const firstCell = row.cells[0]; // เซลล์แรกที่เป็นชื่อวัน
        if (firstCell) {
            // ไฮไลต์เซลล์วันจันทร์ถึงศุกร์ในคอลัมน์แรก
            const daysToHighlight = ['จันทร์', 'อังคาร', 'พุธ', 'พฤหัสฯ', 'ศุกร์'];
            if (daysToHighlight.includes(firstCell.innerText)) {
                firstCell.style.backgroundColor = '#333'; // พื้นหลังสีม่วง
                firstCell.style.color = '#ffeb3b'; // ตัวอักษรสีเหลือง
                firstCell.style.fontWeight = 'bold';
                firstCell.style.padding = '5px'; // เพิ่ม padding ให้เซลล์
            }
        }

        // ไฮไลต์เซลล์ที่มีข้อความว่า "พักเที่ยง"
        const cells = row.querySelectorAll('td');
        cells.forEach(cell => {
            if (cell.innerText === 'พักเที่ยง') {
                cell.style.backgroundColor = '#333'; // สีเหลืองทอง
                cell.style.color = '#ffeb3b'; // ตัวอักษรสีม่วง
                cell.style.fontWeight = 'bold';
            }
        });
    });
});