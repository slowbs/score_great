<?php
// header('Content-Type: application/json, charset=utf-8');
session_start();
if (!isset($_SESSION['user_login'])) { // ถ้าไม่ได้เข้าระบบอยู่
    header("location: login.php"); // redirect ไปยังหน้า login.php
    exit;
}
header("Cache-Control: no cache");

// include_once("./function.php");
// $objCon = connectDB(); // เชื่อมต่อฐานข้อมูล

$input1 = $_POST['selected_date1'];
$input2 = $_POST['selected_date2'];

$date1 = str_replace('/', '-', $input1);
$date2 = str_replace('/', '-', $input2);
$date_forget1 = date("Y-n-j", strtotime($date1));
$date_forget2 = date("Y-n-j", strtotime($date2));

$_SESSION['date_forget1'] = $date_forget1;
$_SESSION['date_forget2'] = $date_forget2;

$beyear = date('Y', strtotime($date_forget1)) + 543;
// $filename = date("d-m-Y", strtotime($date));
// $date_name = date("d/m/Y", strtotime($date));

// echo $input1;
// echo $date1;
// echo $date_forget1;


// echo 'filename : ' . $filename . '<br>';
// echo 'date_forget : ' . $date_forget . '<br>';
// echo 'date_name : ' . $date_name . '<br>';

include '../connect.php';

// $sql = "SELECT * FROM `new_score` WHERE date(date_created) BETWEEN '$date_forget1' AND '$date_forget2'";
// $sql = "SELECT TRUNCATE(sum(score3)/count(*),2) as sum3,
// TRUNCATE(sum(score4)/count(*),2) as sum4, TRUNCATE(sum(score5)/count(*),2) as sum5,
// TRUNCATE(sum(score6)/count(*),2) as sum6, TRUNCATE(sum(score7)/count(*),2) as sum7,
// TRUNCATE(sum(score8)/count(*),2) as sum8, TRUNCATE(sum(score9)/count(*),2) as sum9,
// TRUNCATE((sum(score3)/count(*))/5*100,2) as per3, TRUNCATE((sum(score4)/count(*))/5*100,2) as per4,
// TRUNCATE((sum(score5)/count(*))/5*100,2) as per5, TRUNCATE((sum(score6)/count(*))/5*100,2) as per6,
// TRUNCATE((sum(score7)/count(*))/5*100,2) as per7, TRUNCATE((sum(score8)/count(*))/5*100,2) as per8,
// TRUNCATE((sum(score9)/count(*))/5*100,2) as per9, COUNT(*) as total_no
//  FROM `new_score` WHERE date(date_created) BETWEEN '$date_forget1' AND '$date_forget2'";

$sql = "SELECT TRUNCATE((sum(score3)/count(*) + sum(score4)/count(*) + sum(score5)/count(*) + 
sum(score6)/count(*) + sum(score7)/count(*) + sum(score8)/count(*) + sum(score9)/count(*))/7,2) as sum,
TRUNCATE(TRUNCATE((sum(score3)/count(*) + sum(score4)/count(*) + sum(score5)/count(*) + 
sum(score6)/count(*) + sum(score7)/count(*) + sum(score8)/count(*) + sum(score9)/count(*))/7,2)/5*100,2) as per, 
COUNT(*) as total_no
FROM `new_score` WHERE date(date_created) BETWEEN '$date_forget1' AND '$date_forget2'";

// $result = mysqli_query($conn, $sql);
// if (mysqli_num_rows($result) > 0) {
// 	while ($row = $result->fetch_assoc()) {
// 		echo json_encode([
// 			'message' => 'test ทดสอบ',
// 			'result' => $row
// 		], JSON_UNESCAPED_UNICODE);
//         // echo $row["sum1"];
// 	}
// }

$query = mysqli_query($conn, $sql);
$result = mysqli_fetch_all($query, MYSQLI_ASSOC);
// echo json_encode([
//     'message' => 'test ทดสอบ',
//     'result' => $result
// ], JSON_UNESCAPED_UNICODE);
$sum = $result[0]['sum'];
$per = $result[0]['per'];

?>

<?php include "../header.php"; ?>

<body>
    <nav class="navbar navbar-light static-top" style="background-color :navy">
        <div class="container">
            <a class="navbar-brand" href="#!" style="color:white; font-weight:bold">โรงพยาบาลองค์การบริหารส่วนจังหวัดภูเก็ต</a>
            <!-- <img src="assets/img/PPAOH_Hospital.jpeg" alt="Girl in a jacket" width="50" height="60"> -->
        </div>
    </nav>
    <header class="masthead" style="padding-bottom: 0" ;>
        <div class="container position-relative">
            <div class="row justify-content-center">
                <div class="col-xl-6">
                    <div class="text-center">
                        <h2 class="mb-1">รายงานสรุปคะแนน</h2>
                        <h4 class="mb-1">ตั้งแต่วันที่ <?php echo date('d/m', strtotime($date_forget1)) . "/" . $beyear
                                                            . " - " . date('d/m', strtotime($date_forget2)) . "/" . $beyear; ?></h2>
                    </div>
                </div>
            </div>
            <table class="table table-bordered border-success">
                <thead>
                    <tr>
                        <th scope="col" class="text-center" style="width: 7%">ลำดับ</th>
                        <th scope="col" class="text-center">รายการ</th>
                        <th scope="col" class="text-center" colspan="3">ผลการตอบ (จำนวน <?php echo $result[0]['total_no']; ?> ครั้ง)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row" class="text-center" rowspan="2">1</th>
                        <th rowspan="2"><a href="#">จำนวนครั้งที่เข้าใช้บริการ</a></th>
                        <th class="text-center" style="width: 18%">ครั้งแรก</th>
                        <th class="text-center" style="width: 18%">มากกว่า 2 ครั้ง</th>
                        <th class="text-center" style="width: 18%">มากกว่า 5 ครั้ง</th>
                    </tr>
                    <tr>
                        <?php
                        $sql = "SELECT count(*) as result FROM `new_score` WHERE score1 = 3 AND date(date_created) BETWEEN '$date_forget1' AND '$date_forget2'
                        UNION ALL
                        SELECT count(*) FROM `new_score` WHERE score1 = 2 AND date(date_created) BETWEEN '$date_forget1' AND '$date_forget2'
                        UNION ALL
                        SELECT count(*) FROM `new_score` WHERE score1 = 1 AND date(date_created) BETWEEN '$date_forget1' AND '$date_forget2'";
                        $query = mysqli_query($conn, $sql);
                        while ($result = $query->fetch_assoc()) { ?>
                            <th class="text-center"><?php echo $result["result"]; ?></th>
                        <?php
                        }
                        ?>
                    </tr>
                    <tr>
                        <th scope="row" class="text-center" rowspan="2">2</th>
                        <th rowspan="2"><a href="#">เหตุผลที่เลือกใช้บริการ</a></th>
                        <th class="text-center" style="width: 18%">เคยมารับบริการ/ผู้ป่วยเก่า</th>
                        <th class="text-center" style="width: 18%">ถูกส่งต่อจากโรงพยาบาลอื่น</th>
                        <th class="text-center" style="width: 18%">เดินทางสะดวก</th>
                    </tr>
                    <tr>
                        <?php
                        $sql = "SELECT count(*) as result FROM `new_score` WHERE score2 = 3 AND date(date_created) BETWEEN '$date_forget1' AND '$date_forget2'
                        UNION ALL
                        SELECT count(*) FROM `new_score` WHERE score2 = 2 AND date(date_created) BETWEEN '$date_forget1' AND '$date_forget2'
                        UNION ALL
                        SELECT count(*) FROM `new_score` WHERE score2 = 1 AND date(date_created) BETWEEN '$date_forget1' AND '$date_forget2'";
                        $query = mysqli_query($conn, $sql);
                        while ($result = $query->fetch_assoc()) { ?>
                            <th class="text-center"><?php echo $result["result"]; ?></th>
                        <?php
                        }
                        ?>
                    </tr>
                    <tr>
                        <th scope="row" class="text-center">3</th>
                        <th><a href="info.php?id=11">คะแนนความพึงพอใจโดยรวม</a></th>
                        <th class="text-center" colspan="3"><?php echo $sum . " คะแนน (" . $per . "%)"; ?></th>
                    </tr>
                    <tr>
                        <th scope="row" class="text-center">4</th>
                        <th><a href="info.php?id=10">ข้อเสนอแนะ</a></th>
                        <th class="text-center" colspan="3"></th>
                    </tr>

                </tbody>
            </table>
            <br>
            <div class="row">
                <div class="col">
                    <a href="select_date2.php" class="btn btn-danger float-start">ย้อนกลับ</a>
                </div>
            </div>
        </div>
    </header>
</body>

<?php include "../footer.php"; ?>