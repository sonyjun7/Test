<?php
    include "../common/db.php";

    header("Cache-Control: no cache");
    session_cache_limiter("private_no_expire");

    $sceid = $_POST['sceid'];
    $idx = $_POST['idx'];

    if(!isset($_SESSION['userid'])){
        echo "<script> alert('회원만 접근할 수 있습니다.'); location.href='../../index.php'; </script>";
    }
    else{
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Do+Hyeon|Jua|Nanum+Gothic+Coding" rel="stylesheet">
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/common_css/common.css">
    <link rel="stylesheet" href="../../css/userEnter_css/scenario.css">
    <title>코스 관람</title>
</head>
<body>

<?php
        include "../common/header.php";

        $coseq = mq("select * from scenario_info_mid where id='".$sceid."' and idx='".$idx."'");
        $cose = $coseq -> fetch_array();

    ?>

    <div id="hNotice">
        <h2><?php echo $sceid ?>님의 <?php echo $idx ?> 번 코스보기</h2>
        <img src="../../img/main_pic_02.png">
    </div>

    <div id="sce_area">
        <div class="panel panel-success area_panel">
            <div class="panel-heading">AREA</div>
            <div class="panel-body a_p_body">
                <p>현재 교육 과정 : 중등</p>
                <p>현재 지역 : <?php echo $cose['state'] ?></p>
                <p>현재 구 : <?php echo $cose['city'] ?></p>
                <p>현재 장소 : <?php echo $cose['structure'] ?></p>
            </div>
        </div>
  

            <div id="title_area">
                <div id="tit1_cose">
                    <h4>제목</h4>
                </div>

                <div id="tit2">
                    <textarea name="cose_tit_tarea" id="cose_tit_tarea" class="form-control" readonly="readonly"><?php echo $cose['title']; ?></textarea>
                </div>
            </div>

            <div id="title_area">
                <div id="tit1_cose">
                    <h4>내용</h4>
                </div>
                
                <div id="tit2">
                    <textarea name="cont_tarea" id="cont_tarea" class="form-control" readonly="readonly"><?php echo $cose['content']; ?></textarea>
                </div>
            </div>

            <?php
                if($cose['file'] != ""){
            ?>
                <div class="polaroid">
                    <div class="watch_div">
                        <p>이미지 확인</p>
                    </div>

                    <img alt="none" id="imgimg" />

                </div>
            <?php
                }
            ?>

            <?php
                if($cose['mov_file'] != ""){
            ?>
                <div class="polaroid">
                    <div class="watch_div">
                        <p>영상 확인</p>
                    </div>

                    <video width="320" height="240" id="v_watch" controls>
                        <source type="video/mp4">
                    
                        Your browser does not support the video tag.
                    </video>
                </div>
            <?php
                }
            ?>

    </div>

    <div id="cosebtn_area">

        <a href="./mid_scenario_view_notice.php"><button class="btn btn-success">시나리오 게시판</button></a>
        <button id="back_cose" class="btn btn-success">코스 목록</button>
    </div>

    <?php
        include "../common/footer.php"
    ?>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
    <script>
        var imgfileName = "<?= $cose['file']; ?>";
        var videoNameGet = "<?= $cose['mov_file'];?>";

        $("#back_cose").click(function(){
            history.back();
        });
    
 
    </script>
    <script src="../../tui.image-editor-production/dist/mid_image_watch.js"></script>
    <script src="../../Web-Video-Editor-master/web/mid_video_watch_firebase.js"></script>
</body>
</html>
<?php

    }

?>
