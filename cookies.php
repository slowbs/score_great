<?php
// URL ที่จะทำการ POST
$url = 'https://authenservice.nhso.go.th/authencode/public/api/authen-by-username';

// ข้อมูลที่จะทำการ POST ในรูปแบบ JSON
$data = [
    'username' => '57112581150212', // แทนที่ด้วย username ของคุณ
    'password' => 'johnaones4404'  // แทนที่ด้วย password ของคุณ
];

// แปลงข้อมูลเป็น JSON
$jsonData = json_encode($data);

// ตั้งค่าการ POST ด้วย curl
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Content-Length: ' . strlen($jsonData)
]);

// เปิดการใช้งาน header ในการตอบกลับ
curl_setopt($ch, CURLOPT_HEADER, true);

// ส่งคำขอและรับการตอบกลับ (รวมทั้ง header และ body)
$response = curl_exec($ch);

// ตรวจสอบว่ามีข้อผิดพลาดหรือไม่
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
} else {
    // แยก header และ body ออกจากกัน
    $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
    $header = substr($response, 0, $header_size);
    $body = substr($response, $header_size);

    // แสดงผลการตอบกลับจาก API
    echo "Response from API Body:\n" . $body;

    // ค้นหาและแสดงคุกกี้ทั้งหมดใน header
    echo "\nSESSION Cookie from Header:\n";
    if (preg_match('/Set-Cookie:\s*(SESSION=[^;]*)/mi', $header, $matches)) {
        echo $matches[1] . "\n";
    } else {
        echo "SESSION Cookie ไม่พบใน header";
    }
}

// ปิดการใช้งาน curl
curl_close($ch);
