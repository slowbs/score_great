<?php include 'header.php'; ?>

<body>
    <nav class="navbar navbar-expand-lg bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">แบบประเมินความพึงพอใจ</a>
        </div>
    </nav>
    <div class="container">
        <div class="row pt-3">
            <div class="col-3">
                <a href="score2.php" class="btn btn-danger">ย้อนกลับ</a>
            </div>
            <div class="col text-center">
                <h2 class="mb-1">คำถามบรรทัดที่ 1</h2>
            </div>
            <div class="col-3" style="text-align: right">
                <a href="score4.php" class="btn btn-success">ถัดไป</a>
            </div>
        </div>
        <div class="row">
            <div class="col text-center">
                <h2>คำถามบรรทัดที่ 2</h2>
            </div>
        </div>
        <div class="text-center choice">
            <a href="#" onclick="submit_online('1')"> <img src="assets/images/pic2.png"> </a>
        </div>
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
        window.localStorage.setItem('score3', score)
        window.location.href = "score4.php";
    }
</script>

<?php include 'footer.php'; ?>