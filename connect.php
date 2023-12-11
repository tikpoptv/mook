<?php
// เชื่อมต่อกับฐานข้อมูล
$servername = "ชื่อเซิร์ฟเวอร์";
$username = "ชื่อผู้ใช้";
$password = "รหัสผ่าน";
$dbname = "ชื่อฐานข้อมูล";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// ตรวจสอบการเชื่อมต่อ
if (!$conn) {
    die("การเชื่อมต่อล้มเหลว: " . mysqli_connect_error());
}

// รับค่าจากฟอร์มการเข้าสู่ระบบ
$username = $_POST['ชื่อผู้ใช้'];
$password = $_POST['รหัสผ่าน'];

// เข้ารหัสรหัสผ่าน (เพื่อเปรียบเทียบกับรหัสผ่านที่เก็บในฐานข้อมูล)
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// คำสั่ง SQL เพื่อเลือกข้อมูลผู้ใช้จากฐานข้อมูล
$sql = "SELECT * FROM ชื่อตาราง WHERE username = '$username'";
$result = mysqli_query($conn, $sql);

if ($result) {
    // ตรวจสอบว่ามีข้อมูลผู้ใช้หรือไม่
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        // เปรียบเทียบรหัสผ่านที่เข้ารหัสกับรหัสผ่านที่เก็บในฐานข้อมูล
        if (password_verify($password, $row['password'])) {
            // รหัสผ่านถูกต้อง
            echo "เข้าสู่ระบบสำเร็จ";
            // ทำสิ่งที่ต้องการหลังจากเข้าสู่ระบบ เช่น สร้าง session, redirect หน้าไปหน้าหลัก ฯลฯ
        } else {
            // รหัสผ่านไม่ถูกต้อง
            echo "รหัสผ่านไม่ถูกต้อง";
        }
    } else {
        // ไม่พบผู้ใช้ในฐานข้อมูล
        echo "ไม่พบผู้ใช้";
    }
} else {
    echo "ข้อผิดพลาดในการดึงข้อมูล: " . mysqli_error($conn);
}

// ปิดการเชื่อมต่อ
mysqli_close($conn);
?>
