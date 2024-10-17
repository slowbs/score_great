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
        <div class="row">
            <div class="col">
                <a href="score1.php" class="btn btn-danger back_button">ย้อนกลับ</a>
            </div>
            <div class="col text-center">
                <a href="#" onclick="submit_online('2')"> <img src="assets/images/pic2.png"> </a>
            </div>
            <div class="col" style="text-align: right";>
                <a href="score3.php" class="btn btn-success next_button">ถัดไป</a>
            </div>
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
        window.localStorage.setItem('score2', score)
        window.location.href = "score3.php";
    }
</script>

<?php include 'footer.php'; ?>