<?php
    include "../common/db.php";

    $session = $_SESSION['userid'];
    $title = $_GET['title'];
    $idx = $_GET['idx'];

    if(!isset($_SESSION['userid'])){
        echo "<script> alert('회원만 접근할 수 있습니다.'); location.href='../../index.php'; </script>";
    }
    else{
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Do+Hyeon|Jua|Nanum+Gothic+Coding" rel="stylesheet">
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/common_css/common.css">
    <link rel="stylesheet" href="../../css/userEnter_css/scenario.css">
    <!-- <link rel="stylesheet" href="../../style.css"> -->
    <title>초등 코스 글쓰기</title>
</head>
<body>

<?php
        include "../common/header.php";

        $coseq = mq("select * from scenario_info where id='".$session."' and idx='".$idx."'");
        $cose = $coseq -> fetch_array();


   
    ?>

    <div id="hNotice">
        <h2><?php echo $idx ?> 번 코스 생성</h2>
        <img src="../../img/main_pic_02.png">
    </div>

    <div id="sce_area">
        <div class="panel panel-primary area_panel">
            <div class="panel-heading">AREA</div>
            <div class="panel-body a_p_body">
                <p>현재 교육 과정 : 초등</p>
                <p>현재 지역 : <?php echo $cose['state'] ?></p>
                <p>현재 구 : <?php echo $cose['city'] ?></p>
                <p>현재 장소 : <?php echo $cose['structure'] ?></p>
            </div>
        </div>
  
        <form action="./scenario_course_ok.php?idx=<?php echo $idx ?>" method="post" id="cose_form">
            <div id="title_area">
                <div id="tit1_cose">
                    <h4>제목</h4>
                </div>

                <div id="tit2">
                    <textarea name="cose_tit_tarea" id="cose_tit_tarea" class="form-control" placeholder="코스 제목을 입력해주세요" required><?php echo $cose['title']; ?></textarea>
                </div>
            </div>

            <div id="title_area">
                <div id="tit1_cose">
                    <h4>내용</h4>
                </div>
                
                <div id="tit2">
                    <textarea name="cont_tarea" id="cont_tarea" class="form-control" placeholder="코스 내용을 입력해주세요" required><?php echo $cose['content']; ?></textarea>
                </div>
            </div>
        </form>



            
        <div id="upload_div">
            <p id="p_div">* 이미지/영상 둘 다 업로드 가능하며 둘 중 하나만 업로드 해도 됩니다.</p>
            <p id="p_div">* 동영상 업로드 및 편집 라이브러리는 웹 버전에서만 사용가능합니다.</p>
            <div id="edit_div">
                <a href="../../tui.image-editor-production/examples/directions.php?idx=<?php echo $idx ?>" onClick="window.open(this.href, '', 'width=900, height=900'); return false;" target="_blank"><button id="edit_btn" class="btn btn-primary">이미지 편집 후 업로드</button></a>
                
                <a href="../../Web-Video-Editor-master/web/instructions.php?idx=<?php echo $idx ?>" onClick="window.open(this.href, '', 'width=900, height=900'); return false;" target="_blank"><button id="edit_vid" class="btn btn-primary">영상 편집 후 업로드</button></a>
            </div>

            <div id="edit_div">
                <a href="../../tui.image-editor-production/examples/img_check.php?idx=<?php echo $idx ?>" onClick="window.open(this.href, '', 'width=900, height=900'); return false;" target="_blank"><button id="edit_btn" class="btn btn-primary">이미지 확인</button></a>

                <a href="../../Web-Video-Editor-master/web/video_check.php?idx=<?php echo $idx ?>" onClick="window.open(this.href, '', 'width=900, height=900'); return false;" target="_blank"><button class="btn btn-primary">영상 확인</button></a>
            </div>

            <!-- <div id="watch_div">
                <img id="img_thum">

                 <video width="320" height="240" id="vid_thum" controls>
                    <source type="video/mp4">
                        Your browser does not support the video tag.
                </video>
            </div> -->
        </div>


       
    </div>

    <div id="cosebtn_area">
        <!-- <button href="./sceTesttest.php"><button id="back_sce" class="btn btn-primary"><?php //echo $idx ?> 번 코스 등록</button></a> -->
        <a href="./scenarioWrite.php"><button class="btn btn-info">코스 확인</button></a>
        <button id="back_sce" class="btn btn-info"><?php echo $idx ?> 번 코스 등록</button>
        <button class="btn btn-danger" id="cose_drop" >시나리오 삭제</button>
    </div>

    <?php
        include "../common/footer.php"
    ?>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
    <script>
        //textarea 글자수 제한 두기
        $('#cont_tarea').on('keyup', function(){
            if($(this).val().length > 400){
                alert("글자수 제한 400자를 넘었습니다.");
                $(this).val($(this).val().substring(0, 400));
            }
        });

        $("#back_sce").click(function(){
            if($("#cose_tit_tarea")[0].value == "" || $("#cont_tarea")[0].value == ""){
                alert("내용을 모두 입력해주세요");
            }
            else{
                $("#cose_form").submit();
            }
        });


        $("#cose_drop").click(function(){
            if(confirm("현재 코스의 내용 및 파일들을 지우시겠습니까?")){
                location.href="./course_delete.php?idx=<?php echo $idx ?>";
            }
            else{
                return false;
            }
        });
    
 
    </script>
</body>
</html>
<?php

    }

?>