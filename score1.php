<?php include 'header.php'; ?>

<body>
    <nav class="navbar navbar-expand-lg bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">แบบประเมินความพึงพอใจ</a>
        </div>
    </nav>
    <div class="container">
        <!-- Content here -->
        <h1 align="center" class="question">คำถามที่ 1</h1>
        <h1 align="center">คำถามที่ 1 บรรทัด 2</h1>
        <!-- <div class="position-relative" style="margin-top: 70px; padding: 20px;">
            <button type="button" class="position-absolute top-0 start-10 translate-middle btn btn-sm btn-danger back_button">ย้อนกลับ</button>
            <a href="score1.php" class="position-absolute top-0 start-10 translate-middle btn btn-danger back_button">ย้อนกลับ</a>
            <a href="#" onclick="submit_online('1')"><img src="assets/images/pic2.png" class="img-fluid position-absolute top-0 start-50 translate-middle" alt="..."></a>
            <button type="button" class="position-absolute top-0 translate-middle btn btn-sm btn-success next_button">ถัดไป</button>
            <a href="score2.php" class="position-absolute top-0 translate-middle btn btn-success next_button">ถัดไป</a>
        </div> -->
        <div class="row">
            <div class="col">
                <!-- <a href="score1.php" class="btn btn-danger back_button">ย้อนกลับ</a> -->
            </div>
            <div class="col text-center">
                <a href="#" onclick="submit_online('2')"> <img src="assets/images/pic2.png"> </a>
            </div>
            <div class="col" style="text-align: right";>
                <a href="score2.php" class="btn btn-success next_button">ถัดไป</a>
            </div>
        </div>
        <!-- <div class="text-center choice">
            <img src="assets/images/pic2.png" class="img-fluid" alt="...">
        </div> -->
        <div class="text-center choice">
            <a href="#" onclick="submit_online('2')"> <img src="assets/images/pic2.png"> </a>
        </div>
        <div class="text-center choice">
            <a href="#" onclick="submit_online('3')"> <img src="assets/images/pic2.png"> </a>
        </div>
        <div class="text-center choice">
            <a href="#" onclick="submit_online('4')"> <img src="assets/images/pic2.png"> </a>
        </div>
        <div class="text-center choice">
            <a href="#" onclick="submit_online('5')"> <img src="assets/images/pic2.png"> </a>
        </div>


    </div>
</body>
<script>
    function submit_online(score) {
        window.localStorage.setItem('score1', score)
        window.location.href = "score2.php";
        // alert(score)
    }
</script>

<?php include 'footer.php'; ?>