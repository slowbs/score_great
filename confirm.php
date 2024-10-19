<?php include 'header.php'; ?>

<body>
    <nav class="navbar navbar-expand-lg bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">แบบประเมินความพึงพอใจ</a>
        </div>
    </nav>
    <div class="container">
        <div class="row pt-3">
            <div class="col">
                <a href="comment.php" class="btn btn-danger back_button">กลับ</a>
            </div>
            <div class="col text-center">
                <h2 class="mb-1">สรุปผลการประเมิน</h2>
            </div>
            <div class="col" style="text-align: right">
                <button class="btn btn-success next_button" onclick="submit_online()">ส่ง</button>
            </div>
        </div>
        <table class="table table-bordered border-success">
            <thead>
                <tr>
                    <th scope="col" class="text-center">ลำดับ</th>
                    <th scope="col" class="text-center">รายการ</th>
                    <th scope="col" class="text-center">ผลการตอบ</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row" class="text-center">1</th>
                    <th>จำนวนครั้งที่เข้าใช้บริการ</th>
                    <th id="score1" class="text-center"></th>
                </tr>
                <tr>
                    <th scope="row" class="text-center">2</th>
                    <th>เหตุผลที่เลือกใช้บริการ</th>
                    <th id="score2" class="text-center"></th>
                </tr>
                <tr>
                    <th scope="row" class="text-center">3</th>
                    <th>ระยะเวลาในการรอคิวเพื่อเข้ารับบริการมีความเหมาะสม</th>
                    <th id="score3" class="text-center"></th>
                </tr>
                <tr>
                    <th scope="row" class="text-center">4</th>
                    <th>ระยะเวลาการให้บริการมีความเหมาะสม</th>
                    <th id="score4" class="text-center"></th>
                </tr>
                <tr>
                    <th scope="row" class="text-center">5</th>
                    <th>ขั้นตอนการเข้ารับบริการไม่ยุ่งยาก และมีความเหมาะสม</th>
                    <th id="score5" class="text-center"></th>
                </tr>
                <tr>
                    <th scope="row" class="text-center">6</th>
                    <th>เจ้าหน้าที่ผู้ให้บริการมีความรู้ ความสามารถในการให้บริการ</th>
                    <th id="score6" class="text-center"></th>
                </tr>
                <tr>
                    <th scope="row" class="text-center">7</th>
                    <th>เจ้าหน้าที่ให้บริการด้วยความสุภาพ อ่อนน้อม ยิ้มแย้มแจ่มใส</th>
                    <th id="score7" class="text-center"></th>
                </tr>
                <tr>
                    <th scope="row" class="text-center">8</th>
                    <th>อุปกรณ์และเครื่องมือมีคุณภาพและทันสมัย</th>
                    <th id="score8" class="text-center"></th>
                </tr>
                <tr>
                    <th scope="row" class="text-center">9</th>
                    <th>สถานที่สะอาดและมีความเหมาะสม</th>
                    <th id="score9" class="text-center"></th>
                </tr>

            </tbody>
        </table>
        <textarea class="form-control" id="comment" rows="3" disabled></textarea>
        <br>


    </div>
</body>

<script>
    function submit_online(score) {
        window.localStorage.setItem('score3', score)
        window.location.href = "score4.php";
    }
</script>

<script>
    // function submit_online() {
    //     var userdata = {
    //         'score1': window.localStorage.getItem('score1'),
    //         'score2': window.localStorage.getItem('score2'),
    //         'score3': window.localStorage.getItem('score3'),
    //         'score4': window.localStorage.getItem('score4'),
    //         'score5': window.localStorage.getItem('score5'),
    //         'score6': window.localStorage.getItem('score6'),
    //         'score7': window.localStorage.getItem('score7'),
    //         'score8': window.localStorage.getItem('score8'),
    //         'score9': window.localStorage.getItem('score9'),
    //         'complain': window.localStorage.getItem('complain'),
    //     };
    //     $.ajax({
    //         type: "POST",
    //         url: "insert2.php",
    //         data: userdata,
    //         success: function(data) {
    //             console.log(data);
    //             window.location.href = "finish2.php";
    //             localStorage.clear();
    //         },
    //         error: function(xhr, status, error) {
    //             // alert(xhr.responseText);
    //             // console.log(xhr.responseJSON.value)
    //             console.log(xhr.responseText)
    //             alert("กรุณากรอกข้อมูลให้ครบถ้วน");
    //         }
    //     });
    //     // console.log(userdata);
    //     // window.location.href = "new_score7.php";
    // }
    function submit_online() {
        alert("ส่งแล้ว")
    }
    $(function() {
        // document.getElementById("score1").innerHTML = localStorage.getItem("score1");
        if (window.localStorage.getItem('score1') == 3) {
            document.getElementById("score1").innerHTML = "ครั้งแรก";
        } else if (window.localStorage.getItem('score1') == 2) {
            document.getElementById("score1").innerHTML = "มากกว่า 2 ครั้ง";
        } else if (window.localStorage.getItem('score1') == 1) {
            document.getElementById("score1").innerHTML = "มากกว่า 5 ครั้ง";
        }
        if (window.localStorage.getItem('score2') == 3) {
            document.getElementById("score2").innerHTML = "เคยมารับบริการ/ผู้ป่วยเก่า";
        } else if (window.localStorage.getItem('score2') == 2) {
            document.getElementById("score2").innerHTML = "ถูกส่งต่อจากโรงพยาบาลอื่น";
        } else if (window.localStorage.getItem('score2') == 1) {
            document.getElementById("score2").innerHTML = "เดินทางสะดวก";
        }
        if (window.localStorage.getItem('score3') == 1) {
            document.getElementById("score3").innerHTML = "น้อยมาก";
        } else if (window.localStorage.getItem('score3') == 2) {
            document.getElementById("score3").innerHTML = "น้อย";
        } else if (window.localStorage.getItem('score3') == 3) {
            document.getElementById("score3").innerHTML = "ปานกลาง";
        } else if (window.localStorage.getItem('score3') == 4) {
            document.getElementById("score3").innerHTML = "มาก";
        } else if (window.localStorage.getItem('score3') == 5) {
            document.getElementById("score3").innerHTML = "มากที่สุด";
        }
        if (window.localStorage.getItem('score4') == 1) {
            document.getElementById("score4").innerHTML = "น้อยมาก";
        } else if (window.localStorage.getItem('score4') == 2) {
            document.getElementById("score4").innerHTML = "น้อย";
        } else if (window.localStorage.getItem('score4') == 3) {
            document.getElementById("score4").innerHTML = "ปานกลาง";
        } else if (window.localStorage.getItem('score4') == 4) {
            document.getElementById("score4").innerHTML = "มาก";
        } else if (window.localStorage.getItem('score4') == 5) {
            document.getElementById("score4").innerHTML = "มากที่สุด";
        }
        if (window.localStorage.getItem('score5') == 1) {
            document.getElementById("score5").innerHTML = "น้อยมาก";
        } else if (window.localStorage.getItem('score5') == 2) {
            document.getElementById("score5").innerHTML = "น้อย";
        } else if (window.localStorage.getItem('score5') == 3) {
            document.getElementById("score5").innerHTML = "ปานกลาง";
        } else if (window.localStorage.getItem('score5') == 4) {
            document.getElementById("score5").innerHTML = "มาก";
        } else if (window.localStorage.getItem('score5') == 5) {
            document.getElementById("score5").innerHTML = "มากที่สุด";
        }
        if (window.localStorage.getItem('score6') == 1) {
            document.getElementById("score6").innerHTML = "น้อยมาก";
        } else if (window.localStorage.getItem('score6') == 2) {
            document.getElementById("score6").innerHTML = "น้อย";
        } else if (window.localStorage.getItem('score6') == 3) {
            document.getElementById("score6").innerHTML = "ปานกลาง";
        } else if (window.localStorage.getItem('score6') == 4) {
            document.getElementById("score6").innerHTML = "มาก";
        } else if (window.localStorage.getItem('score6') == 5) {
            document.getElementById("score6").innerHTML = "มากที่สุด";
        }
        if (window.localStorage.getItem('score7') == 1) {
            document.getElementById("score7").innerHTML = "น้อยมาก";
        } else if (window.localStorage.getItem('score7') == 2) {
            document.getElementById("score7").innerHTML = "น้อย";
        } else if (window.localStorage.getItem('score7') == 3) {
            document.getElementById("score7").innerHTML = "ปานกลาง";
        } else if (window.localStorage.getItem('score7') == 4) {
            document.getElementById("score7").innerHTML = "มาก";
        } else if (window.localStorage.getItem('score7') == 5) {
            document.getElementById("score7").innerHTML = "มากที่สุด";
        }
        if (window.localStorage.getItem('score8') == 1) {
            document.getElementById("score8").innerHTML = "น้อยมาก";
        } else if (window.localStorage.getItem('score8') == 2) {
            document.getElementById("score8").innerHTML = "น้อย";
        } else if (window.localStorage.getItem('score8') == 3) {
            document.getElementById("score8").innerHTML = "ปานกลาง";
        } else if (window.localStorage.getItem('score8') == 4) {
            document.getElementById("score8").innerHTML = "มาก";
        } else if (window.localStorage.getItem('score8') == 5) {
            document.getElementById("score8").innerHTML = "มากที่สุด";
        }
        if (window.localStorage.getItem('score9') == 1) {
            document.getElementById("score9").innerHTML = "น้อยมาก";
        } else if (window.localStorage.getItem('score9') == 2) {
            document.getElementById("score9").innerHTML = "น้อย";
        } else if (window.localStorage.getItem('score9') == 3) {
            document.getElementById("score9").innerHTML = "ปานกลาง";
        } else if (window.localStorage.getItem('score9') == 4) {
            document.getElementById("score9").innerHTML = "มาก";
        } else if (window.localStorage.getItem('score9') == 5) {
            document.getElementById("score9").innerHTML = "มากที่สุด";
        }
        document.getElementById("comment").innerHTML = localStorage.getItem("comment");
    });
</script>

<?php include 'footer.php'; ?>