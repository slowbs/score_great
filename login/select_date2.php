<?php
session_start();
if (!isset($_SESSION['user_login'])) { // ถ้าไม่ได้เข้าระบบอยู่
    header("location: login.php"); // redirect ไปยังหน้า login.php
    exit;
}

$user = $_SESSION['user_login'];
?>
<?php include '../header.php'; ?>
<script type="text/javascript">
    $(function() {
        var d = new Date();
        var toDay = d.getDate() + '/' +
            (d.getMonth() + 1) + '/' +
            (d.getFullYear());

        // Datepicker
        $("#datepicker-th").datepicker({
            dateFormat: 'dd/mm/yy',
            isBuddhist: true,
            defaultDate: toDay,
            dayNames: ['อาทิตย์', 'จันทร์', 'อังคาร', 'พุธ', 'พฤหัสบดี', 'ศุกร์', 'เสาร์'],
            dayNamesMin: ['อา.', 'จ.', 'อ.', 'พ.', 'พฤ.', 'ศ.', 'ส.'],
            monthNames: ['มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'],
            monthNamesShort: ['ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.', 'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.']
        });
        $("#datepicker-th-2").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'dd/mm/yy',
            isBuddhist: true,
            defaultDate: toDay,
            dayNames: ['อาทิตย์', 'จันทร์', 'อังคาร', 'พุธ', 'พฤหัสบดี', 'ศุกร์', 'เสาร์'],
            dayNamesMin: ['อา.', 'จ.', 'อ.', 'พ.', 'พฤ.', 'ศ.', 'ส.'],
            monthNames: ['มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'],
            monthNamesShort: ['ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.', 'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.']
        });
        $("#datepicker-th-3").datepicker({
            dateFormat: 'dd/mm/yy',
            isBuddhist: true,
            defaultDate: toDay,
            dayNames: ['อาทิตย์', 'จันทร์', 'อังคาร', 'พุธ', 'พฤหัสบดี', 'ศุกร์', 'เสาร์'],
            dayNamesMin: ['อา.', 'จ.', 'อ.', 'พ.', 'พฤ.', 'ศ.', 'ส.'],
            monthNames: ['มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'],
            monthNamesShort: ['ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.', 'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.']
        });
        $("#datepicker-en").datepicker({
            dateFormat: 'dd/mm/yy'
        });
        $("#inline").datepicker({
            dateFormat: 'dd/mm/yy',
            inline: true
        });
    });
</script>

<body>
    <nav class="navbar navbar-light static-top" style="background-color :navy">
        <div class="container">
            <a class="navbar-brand" href="#!" style="color:white; font-weight:bold">โรงพยาบาลองค์การบริหารส่วนจังหวัดภูเก็ต</a>
            <!-- <img src="assets/img/PPAOH_Hospital.jpeg" alt="Girl in a jacket" width="50" height="60"> -->
        </div>
    </nav>
    <header class="masthead">
        <div class="container position-relative">
            <div class="row justify-content-center">
                <div class="col-xl-6">
                    <div class="text-center">
                        <!-- Page heading-->
                        <h2 class="mb-3">รายงานสรุปคะแนน</h2>
                        <h2 class="mb-3">ประจำวัน</h2>
                        <form method="post" action="action_select_date2.php">
                            <!-- Email address input-->
                            <div class="row">
                                <div class="col">
                                    <!-- <input class="form-control" type="text" placeholder="โปรดป้อนคะแนน" aria-label="default input example" id="fname" onkeyup="myFunction()" autocomplete="off"> -->
                                    <input type="text" class="form-control" placeholder="ตั้งแต่วันที่" id="datepicker-th" name="selected_date1" autocomplete="off" data-date-format='yyyy-mm-dd'>

                                </div>
                                <div class="col">
                                    <!-- <input class="form-control" type="text" placeholder="โปรดป้อนคะแนน" aria-label="default input example" id="fname" onkeyup="myFunction()" autocomplete="off"> -->
                                    <input type="text" class="form-control" placeholder="จนถึงวันที่" id="datepicker-th-3" name="selected_date2" autocomplete="off" data-date-format='yyyy-mm-dd'>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col">
                                    <button type="submit" class="btn btn-primary col-3 me-3">ตกลง</button>
                                    <a href="index.php" class="btn btn-danger col-3">ยกเลิก</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <br>
        </div>
    </header>
</body>

<?php include '../footer.php'; ?>