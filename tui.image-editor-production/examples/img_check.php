<?php
    include "../../pages/common/db.php";

    $idx = $_GET['idx'];
    $session = $_SESSION['userid'];

    $mq1 = mq("select * from scenario_info where id='".$session."' and idx='".$idx."'");
    $imgchk = $mq1 -> fetch_array();
    // $chk = $_POST['chk'];
    // echo $chk;
    // echo $_GET['movfile'];
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Do+Hyeon|Jua|Nanum+Gothic+Coding" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+KR:500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="../../css/common_css/common.css"> -->
    <title>Document</title>
    <style>
        div.polaroid{
            /* width: 80%; */
            width: 100%;
            max-width: 900px;
            background-color: white;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            margin-bottom: 25px;
            text-align: center;
        }
        div.container {
            text-align: center;
            padding: 10px 20px;
        }
        #imgimg{
            max-width: 100%;
        } 
    </style>
</head>
<body>
<?php
        if($imgchk['file'] != ""){
    ?>
    <div class="polaroid">
        <img alt="none" id="imgimg" />

        <div class="container">
            <p><?php  echo $imgchk['file'] ?></p>

            <div>
                <button class="btn btn-primary btn-lg" value="닫기" style="width:250px; margin-left:30px;" onclick="window.close()">닫기</button>
            </div>
        </div>
    </div>

    <?php
        } else{
    ?>
            <h3>업로드된 이미지 없음</h3>

            <div>
                <button class="btn btn-primary btn-lg" value="닫기" style="width:250px;" onclick="window.close()">닫기</button>
            </div>
    <?php
        }
    ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
    <script>
        var imgfileName = "<?= $imgchk['file']; ?>";
    </script>
    <script src="../dist/image_watch.js"></script>
</body>
</html>

