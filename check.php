<?php
// เริ่ม Session
session_start();

// ตรวจสอบสถานะการเข้าสู่ระบบ
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // ถ้ายังไม่ได้เข้าสู่ระบบ ให้ redirect ไปยังหน้า login
    header('Location: login.php');
    exit;
}

// หากผู้ใช้เข้าสู่ระบบแล้ว คุณสามารถดำเนินการต่อไปได้ตามต้องการ
// ยังคงเขียนโค้ดที่ต้องการทำในส่วนนี้
?>
