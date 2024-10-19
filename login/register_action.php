<?php
// include_once('./function.php');
// $objCon = connectDB();

include('../connect.php');

$data = $_POST;
$u_fullname = $data['u_fullname'];
$u_username = $data['u_username'];
$u_password = md5($data['u_password']); // เข้ารหัสด้วย md5
$u_level = $data['u_level'];

$strSQL = "INSERT INTO 
score_user(
    `u_fullname`,
    `u_username`,
    `u_password`, 
    `u_level`
) VALUES (
    '$u_fullname', 
    '$u_username', 
    '$u_password', 
    '$u_level'
)";

$objQuery = mysqli_query($conn, $strSQL) or die(mysqli_error($conn));
if ($objQuery) {
    echo '<script>alert("ลงทะเบียนเรียบร้อยแล้ว");window.location="login.php";</script>';
} else {
    echo '<script>alert("พบข้อผิดพลาด");window.location="register.php";</script>';
}