<?php
    include "../../pages/common/db.php";
    $idx = $_GET['idx'];
    $session = $_SESSION['userid'];

    $mq1 = mq("select * from scenario_info_mid where id='".$session."' and idx='".$idx."'");
    $videochk = $mq1 -> fetch_array();
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
        #imgimg{
            width: 400px; 
            max-width: 100%;
        }

        #v_watch{
            width: 400px; 
            max-width: 100%;
        }

        div.polaroid{
            width: 100%;
            max-width: 900px;
            background-color: white;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            margin-bottom: 25px;
            text-align: center;
        }
    </style>
</head>
<body>
    <?php echo $_GET['videofile']; ?>
    <?php
        if($videochk['mov_file'] != ""){
    ?>
        <!-- <video width="320" height="240" id="v_watch" controls>
            <source type="video/mp4">
        
            Your browser does not support the video tag.
        </video> -->

        <div class="polaroid">
            <div class="watch_div">
                <p>영상 확인</p>
            </div>

            <video width="320" height="240" id="v_watch" controls>
                <source type="video/mp4">
            
                Your browser does not support the video tag.
            </video>

            <div>
                <button class="btn btn-primary btn-lg" value="닫기" style="width:250px;" onclick="window.close()">닫기</button>
            </div>
        </div>

    <?php
        } else {
    ?>
        <h3>업로드된 영상없음</h3>
       
        <div>
            <button class="btn btn-success btn-lg" value="닫기" style="width:250px;" onclick="window.close()">닫기</button>
        </div>
    <?php
        }
    ?>
    


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
    <script>
        var videoNameGet = "<?= $videochk['mov_file'];?>";
    </script>
    <script src="./mid_video_watch_firebase.js"></script>
</body>
</html>