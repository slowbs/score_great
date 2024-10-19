<?php
// header('Content-Type: application/json, charset=utf-8');
session_start();
if (!isset($_SESSION['user_login'])) { // ถ้าไม่ได้เข้าระบบอยู่
    header("location: login.php"); // redirect ไปยังหน้า login.php
    exit;
}
header("Cache-Control: no cache");

$date_forget1 = $_SESSION['date_forget1'];
$date_forget2 = $_SESSION['date_forget2'];
$info_id = $_GET['id'];

$beyear = date('Y', strtotime($date_forget1)) + 543;

include '../connect.php';


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>โรงพยาบาลองค์การบริหารส่วนจังหวัดภูเก็ต</title>
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" type="text/css" />
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300&display=swap" rel="stylesheet">
    <!-- Bootstrap core CSS -->
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="../css/all.css" rel="stylesheet" />
    <link href="../css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
</head>

<body>
    <nav class="navbar navbar-light static-top" style="background-color :navy">
        <div class="container">
            <a class="navbar-brand" href="#!" style="color:white; font-weight:bold">โรงพยาบาลองค์การบริหารส่วนจังหวัดภูเก็ต</a>
            <!-- <img src="assets/img/PPAOH_Hospital.jpeg" alt="Girl in a jacket" width="50" height="60"> -->
        </div>
    </nav>
    <header class="masthead" style="padding-bottom: 0">
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
            <?php if ($info_id == 1) {
                $sql = "SELECT count(*) as result FROM `new_score` WHERE score1 = 1 AND date(date_created) BETWEEN '$date_forget1' AND '$date_forget2'
                UNION ALL
                SELECT count(*) FROM `new_score` WHERE score1 = 2 AND date(date_created) BETWEEN '$date_forget1' AND '$date_forget2'
                UNION ALL
                SELECT count(*) FROM `new_score` WHERE score1 = 3 AND date(date_created) BETWEEN '$date_forget1' AND '$date_forget2'";

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
                // $result = mysqli_fetch_all($query, MYSQLI_ASSOC);
                // echo json_encode([
                //     'message' => 'test ทดสอบ',
                //     'result' => $result
                // ], JSON_UNESCAPED_UNICODE);
            ?>
                <table class="table table-bordered border-success">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center" style="width: 7%">ลำดับ</th>
                            <th scope="col" class="text-center">รายการ</th>
                            <th scope="col" class="text-center" style="width: 15%">ครั้งแรก</th>
                            <th scope="col" class="text-center" style="width: 15%">มากกว่า 2 ครั้ง</th>
                            <th scope="col" class="text-center" style="width: 15%">มากกว่า 5 ครั้ง</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row" class="text-center">1</th>
                            <th>จำนวนครั้งที่เข้าใช้บริการ</th>
                            <?php
                            while ($result = $query->fetch_assoc()) { ?>
                                <th class="text-center"><?php echo $result["result"]; ?></th>
                            <?php
                            }
                            ?>
                        </tr>

                    </tbody>
                </table>
            <?php } else if ($info_id == 2) {
                $sql = "SELECT count(*) as result FROM `new_score` WHERE score2 = 1 AND date(date_created) BETWEEN '$date_forget1' AND '$date_forget2'
                UNION ALL
                SELECT count(*) FROM `new_score` WHERE score2 = 2 AND date(date_created) BETWEEN '$date_forget1' AND '$date_forget2'
                UNION ALL
                SELECT count(*) FROM `new_score` WHERE score2 = 3 AND date(date_created) BETWEEN '$date_forget1' AND '$date_forget2'";
                $query = mysqli_query($conn, $sql);
            ?>
                <table class="table table-bordered border-success">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center" style="width: 7%">ลำดับ</th>
                            <th scope="col" class="text-center">รายการ</th>
                            <th scope="col" class="text-center" style="width: 18%">เคยมารับบริการ/ผู้ป่วยเก่า</th>
                            <th scope="col" class="text-center" style="width: 18%">ถูกส่งต่อจากโรงพยาบาลอื่น</th>
                            <th scope="col" class="text-center" style="width: 18%">เดินทางสะดวก</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row" class="text-center">1</th>
                            <th>เหตุผลที่เลือกใช้บริการ</th>
                            <?php
                            while ($result = $query->fetch_assoc()) { ?>
                                <th class="text-center"><?php echo $result["result"]; ?></th>
                            <?php
                            }
                            ?>
                        </tr>

                    </tbody>
                </table>
            <?php
            } else if ($info_id == 3) {
                $sql = "SELECT count(*) as result FROM `new_score` WHERE score3 = 1 AND date(date_created) BETWEEN '$date_forget1' AND '$date_forget2'
                UNION ALL
                SELECT count(*) FROM `new_score` WHERE score3 = 2 AND date(date_created) BETWEEN '$date_forget1' AND '$date_forget2'
                UNION ALL
                SELECT count(*) FROM `new_score` WHERE score3 = 3 AND date(date_created) BETWEEN '$date_forget1' AND '$date_forget2'
                UNION ALL
                SELECT count(*) FROM `new_score` WHERE score3 = 4 AND date(date_created) BETWEEN '$date_forget1' AND '$date_forget2'
                UNION ALL
                SELECT count(*) FROM `new_score` WHERE score3 = 5 AND date(date_created) BETWEEN '$date_forget1' AND '$date_forget2'";
                $query = mysqli_query($conn, $sql);
            ?>
                <table class="table table-bordered border-success">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center" style="width: 7%">ลำดับ</th>
                            <th scope="col" class="text-center">รายการ</th>
                            <th scope="col" class="text-center" style="width: 10%">น้อยมาก</th>
                            <th scope="col" class="text-center" style="width: 10%">น้อย</th>
                            <th scope="col" class="text-center" style="width: 10%">ปานกลาง</th>
                            <th scope="col" class="text-center" style="width: 10%">มาก</th>
                            <th scope="col" class="text-center" style="width: 10%">มากที่สุด</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row" class="text-center">1</th>
                            <th>ระยะเวลาในการรอคิวเพื่อเข้ารับบริการมีความเหมาะสม</th>
                            <?php
                            while ($result = $query->fetch_assoc()) { ?>
                                <th class="text-center"><?php echo $result["result"]; ?></th>
                            <?php
                            }
                            ?>
                        </tr>

                    </tbody>
                </table>

            <?php
            } else if ($info_id == 4) {
                $sql = "SELECT count(*) as result FROM `new_score` WHERE score4 = 1 AND date(date_created) BETWEEN '$date_forget1' AND '$date_forget2'
                UNION ALL
                SELECT count(*) FROM `new_score` WHERE score4 = 2 AND date(date_created) BETWEEN '$date_forget1' AND '$date_forget2'
                UNION ALL
                SELECT count(*) FROM `new_score` WHERE score4 = 3 AND date(date_created) BETWEEN '$date_forget1' AND '$date_forget2'
                UNION ALL
                SELECT count(*) FROM `new_score` WHERE score4 = 4 AND date(date_created) BETWEEN '$date_forget1' AND '$date_forget2'
                UNION ALL
                SELECT count(*) FROM `new_score` WHERE score4 = 5 AND date(date_created) BETWEEN '$date_forget1' AND '$date_forget2'";
                $query = mysqli_query($conn, $sql);
            ?>
                <table class="table table-bordered border-success">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center" style="width: 7%">ลำดับ</th>
                            <th scope="col" class="text-center">รายการ</th>
                            <th scope="col" class="text-center" style="width: 10%">น้อยมาก</th>
                            <th scope="col" class="text-center" style="width: 10%">น้อย</th>
                            <th scope="col" class="text-center" style="width: 10%">ปานกลาง</th>
                            <th scope="col" class="text-center" style="width: 10%">มาก</th>
                            <th scope="col" class="text-center" style="width: 10%">มากที่สุด</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row" class="text-center">1</th>
                            <th>ระยะเวลาการให้บริการมีความเหมาะสม</th>
                            <?php
                            while ($result = $query->fetch_assoc()) { ?>
                                <th class="text-center"><?php echo $result["result"]; ?></th>
                            <?php
                            }
                            ?>
                        </tr>

                    </tbody>
                </table>

            <?php
            } else if ($info_id == 5) {
                $sql = "SELECT count(*) as result FROM `new_score` WHERE score5 = 1 AND date(date_created) BETWEEN '$date_forget1' AND '$date_forget2'
                UNION ALL
                SELECT count(*) FROM `new_score` WHERE score5 = 2 AND date(date_created) BETWEEN '$date_forget1' AND '$date_forget2'
                UNION ALL
                SELECT count(*) FROM `new_score` WHERE score5 = 3 AND date(date_created) BETWEEN '$date_forget1' AND '$date_forget2'
                UNION ALL
                SELECT count(*) FROM `new_score` WHERE score5 = 4 AND date(date_created) BETWEEN '$date_forget1' AND '$date_forget2'
                UNION ALL
                SELECT count(*) FROM `new_score` WHERE score5 = 5 AND date(date_created) BETWEEN '$date_forget1' AND '$date_forget2'";
                $query = mysqli_query($conn, $sql);
            ?>
                <table class="table table-bordered border-success">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center" style="width: 7%">ลำดับ</th>
                            <th scope="col" class="text-center">รายการ</th>
                            <th scope="col" class="text-center" style="width: 10%">น้อยมาก</th>
                            <th scope="col" class="text-center" style="width: 10%">น้อย</th>
                            <th scope="col" class="text-center" style="width: 10%">ปานกลาง</th>
                            <th scope="col" class="text-center" style="width: 10%">มาก</th>
                            <th scope="col" class="text-center" style="width: 10%">มากที่สุด</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row" class="text-center">1</th>
                            <th>ขั้นตอนการเข้ารับบริการไม่ยุ่งยาก และมีความเหมาะสม</th>
                            <?php
                            while ($result = $query->fetch_assoc()) { ?>
                                <th class="text-center"><?php echo $result["result"]; ?></th>
                            <?php
                            }
                            ?>
                        </tr>

                    </tbody>
                </table>

            <?php
            } else if ($info_id == 6) {
                $sql = "SELECT count(*) as result FROM `new_score` WHERE score6 = 1 AND date(date_created) BETWEEN '$date_forget1' AND '$date_forget2'
                UNION ALL
                SELECT count(*) FROM `new_score` WHERE score6 = 2 AND date(date_created) BETWEEN '$date_forget1' AND '$date_forget2'
                UNION ALL
                SELECT count(*) FROM `new_score` WHERE score6 = 3 AND date(date_created) BETWEEN '$date_forget1' AND '$date_forget2'
                UNION ALL
                SELECT count(*) FROM `new_score` WHERE score6 = 4 AND date(date_created) BETWEEN '$date_forget1' AND '$date_forget2'
                UNION ALL
                SELECT count(*) FROM `new_score` WHERE score6 = 5 AND date(date_created) BETWEEN '$date_forget1' AND '$date_forget2'";
                $query = mysqli_query($conn, $sql);
            ?>
                <table class="table table-bordered border-success">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center" style="width: 7%">ลำดับ</th>
                            <th scope="col" class="text-center">รายการ</th>
                            <th scope="col" class="text-center" style="width: 10%">น้อยมาก</th>
                            <th scope="col" class="text-center" style="width: 10%">น้อย</th>
                            <th scope="col" class="text-center" style="width: 10%">ปานกลาง</th>
                            <th scope="col" class="text-center" style="width: 10%">มาก</th>
                            <th scope="col" class="text-center" style="width: 10%">มากที่สุด</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row" class="text-center">1</th>
                            <th>เจ้าหน้าที่ผู้ให้บริการมีความรู้ ความสามารถในการให้บริการ</th>
                            <?php
                            while ($result = $query->fetch_assoc()) { ?>
                                <th class="text-center"><?php echo $result["result"]; ?></th>
                            <?php
                            }
                            ?>
                        </tr>

                    </tbody>
                </table>

            <?php
            } else if ($info_id == 7) {
                $sql = "SELECT count(*) as result FROM `new_score` WHERE score7 = 1 AND date(date_created) BETWEEN '$date_forget1' AND '$date_forget2'
                UNION ALL
                SELECT count(*) FROM `new_score` WHERE score7 = 2 AND date(date_created) BETWEEN '$date_forget1' AND '$date_forget2'
                UNION ALL
                SELECT count(*) FROM `new_score` WHERE score7 = 3 AND date(date_created) BETWEEN '$date_forget1' AND '$date_forget2'
                UNION ALL
                SELECT count(*) FROM `new_score` WHERE score7 = 4 AND date(date_created) BETWEEN '$date_forget1' AND '$date_forget2'
                UNION ALL
                SELECT count(*) FROM `new_score` WHERE score7 = 5 AND date(date_created) BETWEEN '$date_forget1' AND '$date_forget2'";
                $query = mysqli_query($conn, $sql);
            ?>
                <table class="table table-bordered border-success">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center" style="width: 7%">ลำดับ</th>
                            <th scope="col" class="text-center">รายการ</th>
                            <th scope="col" class="text-center" style="width: 10%">น้อยมาก</th>
                            <th scope="col" class="text-center" style="width: 10%">น้อย</th>
                            <th scope="col" class="text-center" style="width: 10%">ปานกลาง</th>
                            <th scope="col" class="text-center" style="width: 10%">มาก</th>
                            <th scope="col" class="text-center" style="width: 10%">มากที่สุด</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row" class="text-center">1</th>
                            <th>เจ้าหน้าที่ให้บริการด้วยความสุภาพ อ่อนน้อม ยิ้มแย้มแจ่มใส</th>
                            <?php
                            while ($result = $query->fetch_assoc()) { ?>
                                <th class="text-center"><?php echo $result["result"]; ?></th>
                            <?php
                            }
                            ?>
                        </tr>

                    </tbody>
                </table>

            <?php
            } else if ($info_id == 8) {
                $sql = "SELECT count(*) as result FROM `new_score` WHERE score8 = 1 AND date(date_created) BETWEEN '$date_forget1' AND '$date_forget2'
                UNION ALL
                SELECT count(*) FROM `new_score` WHERE score8 = 2 AND date(date_created) BETWEEN '$date_forget1' AND '$date_forget2'
                UNION ALL
                SELECT count(*) FROM `new_score` WHERE score8 = 3 AND date(date_created) BETWEEN '$date_forget1' AND '$date_forget2'
                UNION ALL
                SELECT count(*) FROM `new_score` WHERE score8 = 4 AND date(date_created) BETWEEN '$date_forget1' AND '$date_forget2'
                UNION ALL
                SELECT count(*) FROM `new_score` WHERE score8 = 5 AND date(date_created) BETWEEN '$date_forget1' AND '$date_forget2'";
                $query = mysqli_query($conn, $sql);
            ?>
                <table class="table table-bordered border-success">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center" style="width: 7%">ลำดับ</th>
                            <th scope="col" class="text-center">รายการ</th>
                            <th scope="col" class="text-center" style="width: 10%">น้อยมาก</th>
                            <th scope="col" class="text-center" style="width: 10%">น้อย</th>
                            <th scope="col" class="text-center" style="width: 10%">ปานกลาง</th>
                            <th scope="col" class="text-center" style="width: 10%">มาก</th>
                            <th scope="col" class="text-center" style="width: 10%">มากที่สุด</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row" class="text-center">1</th>
                            <th>อุปกรณ์และเครื่องมือมีคุณภาพและทันสมัย</th>
                            <?php
                            while ($result = $query->fetch_assoc()) { ?>
                                <th class="text-center"><?php echo $result["result"]; ?></th>
                            <?php
                            }
                            ?>
                        </tr>

                    </tbody>
                </table>

            <?php
            } else if ($info_id == 9) {
                $sql = "SELECT count(*) as result FROM `new_score` WHERE score9 = 1 AND date(date_created) BETWEEN '$date_forget1' AND '$date_forget2'
                UNION ALL
                SELECT count(*) FROM `new_score` WHERE score9 = 2 AND date(date_created) BETWEEN '$date_forget1' AND '$date_forget2'
                UNION ALL
                SELECT count(*) FROM `new_score` WHERE score9 = 3 AND date(date_created) BETWEEN '$date_forget1' AND '$date_forget2'
                UNION ALL
                SELECT count(*) FROM `new_score` WHERE score9 = 4 AND date(date_created) BETWEEN '$date_forget1' AND '$date_forget2'
                UNION ALL
                SELECT count(*) FROM `new_score` WHERE score9 = 5 AND date(date_created) BETWEEN '$date_forget1' AND '$date_forget2'";
                $query = mysqli_query($conn, $sql);
            ?>
                <table class="table table-bordered border-success">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center" style="width: 7%">ลำดับ</th>
                            <th scope="col" class="text-center">รายการ</th>
                            <th scope="col" class="text-center" style="width: 10%">น้อยมาก</th>
                            <th scope="col" class="text-center" style="width: 10%">น้อย</th>
                            <th scope="col" class="text-center" style="width: 10%">ปานกลาง</th>
                            <th scope="col" class="text-center" style="width: 10%">มาก</th>
                            <th scope="col" class="text-center" style="width: 10%">มากที่สุด</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row" class="text-center">1</th>
                            <th>สถานที่สะอาดและมีความเหมาะสม</th>
                            <?php
                            while ($result = $query->fetch_assoc()) { ?>
                                <th class="text-center"><?php echo $result["result"]; ?></th>
                            <?php
                            }
                            ?>
                        </tr>

                    </tbody>
                </table>

            <?php
            } else if ($info_id == 10) {
                $sql = "SELECT complain FROM new_score WHERE date(date_created) BETWEEN '$date_forget1' AND '$date_forget2' AND complain <>''";
                $query = mysqli_query($conn, $sql);
                $no = 0;
            ?>
                <table class="table table-bordered border-success">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center" style="width: 7%">ลำดับ</th>
                            <th scope="col" class="text-center">รายการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($result = $query->fetch_assoc()) {
                            $no += 1;
                        ?>
                            <tr>
                                <th scope="row" class="text-center"><?php echo $no; ?></th>
                                <th scope="row"><?php echo $result["complain"]; ?></th>
                            <?php } ?>
                            </tr>
                    </tbody>
                </table>

            <?php
            } else if ($info_id == 11) {
                $sql = "SELECT TRUNCATE(sum(score3)/count(*),2) as sum3,
                        TRUNCATE(sum(score4)/count(*),2) as sum4, TRUNCATE(sum(score5)/count(*),2) as sum5,
                        TRUNCATE(sum(score6)/count(*),2) as sum6, TRUNCATE(sum(score7)/count(*),2) as sum7,
                        TRUNCATE(sum(score8)/count(*),2) as sum8, TRUNCATE(sum(score9)/count(*),2) as sum9,
                        TRUNCATE((sum(score3)/count(*))/5*100,2) as per3, TRUNCATE((sum(score4)/count(*))/5*100,2) as per4,
                        TRUNCATE((sum(score5)/count(*))/5*100,2) as per5, TRUNCATE((sum(score6)/count(*))/5*100,2) as per6,
                        TRUNCATE((sum(score7)/count(*))/5*100,2) as per7, TRUNCATE((sum(score8)/count(*))/5*100,2) as per8,
                        TRUNCATE((sum(score9)/count(*))/5*100,2) as per9, COUNT(*) as total_no
                        FROM `new_score` WHERE date(date_created) BETWEEN '$date_forget1' AND '$date_forget2'";
                $query = mysqli_query($conn, $sql);
                $result = mysqli_fetch_all($query, MYSQLI_ASSOC);
            ?>
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
                            <th scope="row" class="text-center">1</th>
                            <th><a href="info.php?id=3">ระยะเวลาในการรอคิวเพื่อเข้ารับบริการมีความเหมาะสม</a></th>
                            <th id="score3" class="text-center"><?php echo $result[0]['sum3'] . " คะแนน (" . $result[0]['per3'] . "%)"; ?></th>
                        </tr>
                        <tr>
                            <th scope="row" class="text-center">2</th>
                            <th><a href="info.php?id=4">ระยะเวลาการให้บริการมีความเหมาะสม</a></th>
                            <th id="score4" class="text-center"><?php echo $result[0]['sum4'] . " คะแนน (" . $result[0]['per4'] . "%)"; ?></th>
                        </tr>
                        <tr>
                            <th scope="row" class="text-center">3</th>
                            <th><a href="info.php?id=5">ขั้นตอนการเข้ารับบริการไม่ยุ่งยาก และมีความเหมาะสม</a></th>
                            <th id="score5" class="text-center"><?php echo $result[0]['sum5'] . " คะแนน (" . $result[0]['per5'] . "%)"; ?></th>
                        </tr>
                        <tr>
                            <th scope="row" class="text-center">4</th>
                            <th><a href="info.php?id=6">เจ้าหน้าที่ผู้ให้บริการมีความรู้ ความสามารถในการให้บริการ</a></th>
                            <th id="score6" class="text-center"><?php echo $result[0]['sum6'] . " คะแนน (" . $result[0]['per6'] . "%)"; ?></th>
                        </tr>
                        <tr>
                            <th scope="row" class="text-center">5</th>
                            <th><a href="info.php?id=7">เจ้าหน้าที่ให้บริการด้วยความสุภาพ อ่อนน้อม ยิ้มแย้มแจ่มใส</a></th>
                            <th id="score7" class="text-center"><?php echo $result[0]['sum7'] . " คะแนน (" . $result[0]['per7'] . "%)"; ?></th>
                        </tr>
                        <tr>
                            <th scope="row" class="text-center">6</th>
                            <th><a href="info.php?id=8">อุปกรณ์และเครื่องมือมีคุณภาพและทันสมัย</a></th>
                            <th id="score8" class="text-center"><?php echo $result[0]['sum8'] . " คะแนน (" . $result[0]['per8'] . "%)"; ?></th>
                        </tr>
                        <tr>
                            <th scope="row" class="text-center">7</th>
                            <th><a href="info.php?id=9">สถานที่สะอาดและมีความเหมาะสม</a></th>
                            <th id="score9" class="text-center"><?php echo $result[0]['sum9'] . " คะแนน (" . $result[0]['per9'] . "%)"; ?></th>
                        </tr>
                    </tbody>
                </table>
            <?php
            }
            ?>

            <br>
            <div class="row">
                <div class="col">
                    <!-- <a href="new_score10.php" class="btn btn-danger float-start">ย้อนกลับ</a> -->
                    <button class="btn btn-danger" onclick="history.back()">ย้อนกลับ</button>
                </div>
            </div>
        </div>
    </header>
</body>

</html>