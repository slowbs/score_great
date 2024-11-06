<?php
// URL ที่จะทำการ GET
$url = 'https://authenservice.nhso.go.th/authencode/api/authencode-report?hcode=24678&provinceCode=8300&zoneCode=11&claimDateFrom=2024-10-16&claimDateTo=2024-10-16&size=1000&claimType=PG0060001';

// ตั้งค่าการ GET ด้วย curl
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // รับการตอบกลับเป็นข้อความแทนการแสดงผลทันที

// ส่งคำขอและรับการตอบกลับ
$response = curl_exec($ch);

// ตรวจสอบว่ามีข้อผิดพลาดหรือไม่
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
} else {
    // แสดงผลการตอบกลับจาก API
    echo 'Response from API: ' . $response;
}

// ปิดการใช้งาน curl
curl_close($ch);
?>
