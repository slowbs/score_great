<?php
session_start(); // เปิดใช้งาน session
if (isset($_SESSION['user_login'])) { // ถ้าเข้าระบบอยู่
    header("location: index.php"); // redirect ไปยังหน้า index.php
    exit;
}

// include_once("./function.php");
// $objCon = connectDB(); // เชื่อมต่อฐานข้อมูล

include('../connect.php');
$username = mysqli_real_escape_string($conn, $_POST['username']); // รับค่า username
$password = mysqli_real_escape_string($conn, $_POST['password']); // รับค่า password

$strSQL = "SELECT * FROM score_user WHERE u_username = '$username' AND u_password = md5('$password')";
$objQuery = mysqli_query($conn, $strSQL);
$row = mysqli_num_rows($objQuery);
if($row) {
    $res = mysqli_fetch_assoc($objQuery);
    $_SESSION['user_login'] = array(
        'id' => $res['u_id'],
        'fullname' => $res['u_fullname'],
        'level' => $res['u_level']
    );
    echo '<script>alert("ยินดีต้อนรับคุณ ', $res['u_fullname'],'");window.location="index.php";</script>';
} else {
    echo '<script>alert("username หรือ password ไม่ถูกต้อง!!");window.location="login.php";</script>';
}