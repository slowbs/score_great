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
                <a href="score4.php" class="btn btn-danger">ย้อนกลับ</a>
            </div>
            <div class="col text-center">
                <h2 class="mb-1">ข้อเสนอแนะ</h2>
            </div>
            <div class="col-3" style="text-align: right">
                <button class="btn btn-success float-end" onclick="submit_online(comment)">ถัดไป</button>
            </div>
        </div>
        <br>
        <textarea class="form-control" id="comment" rows="4" style="margin-bottom:221px"></textarea>
    </div>
</body>
<script>
    function submit_online(comment) {
        window.localStorage.setItem('comment', comment.value)
        window.location.href = "confirm.php";
    }

    $(function() {
        if (window.localStorage.getItem('comment') !== "") {
            document.getElementById("comment").innerHTML = localStorage.getItem("comment");
        }
    });
</script>

<?php include 'footer.php'; ?>