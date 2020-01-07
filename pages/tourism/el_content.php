<?php
    include "../common/db.php";
    $title = $_GET['title'];
    $idx = $_GET['idx'];

    if(!empty($idx) && empty($_COOKIE['eltable_' . $idx])){

        $cook = 'update eltable set hit = hit + 1 where idx=' . $idx;
        $fet = $db -> query($cook);

        if(empty($fet)){
         
            echo "<script>alert('오류가 발생했습니다.'); history.back(); </script>";
        }
        else{
        
            setcookie('eltable_' . $idx, TRUE, time() + (60*60*24), './');
        }
    }

    $sql = mq("select * from eltable where title='".$title."'");
    $elread = $sql -> fetch_array();
    $subj = $elread['subject'];
    $readcont = $elread['content'];
    $linetype = $elread['linetype'];
    $img360 = $elread['360img'];
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Do+Hyeon|Jua|Nanum+Gothic+Coding" rel="stylesheet">
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/common_css/common.css">
    <link rel="stylesheet" href="../../css/tourism_css/el_mid_tourism.css">

    <title>초등관광지 내용</title>
</head>
<body>

    <?php
        include "../common/header.php";
    ?>

    <div id="hNotice">
        <h2>초등<?php echo $title ?> 관광지 정보</h2>
        <img src="../../img/main_pic_02.png">
    </div>

    <div id="left_navi">
        <i class="fas fa-angle-double-down fa-2x"></i>
        <div><a href="./eduSelect.php"><button class="btn btn-primary">초등/중등<br>선택 페이지</button></a></div>
        <div><a href="./el_index.php"><button class="btn btn-primary">초등 과목<br>선택 게시판</button></a></div>
        <div><a href="./el_webGL_select.php"><button class="btn btn-primary">초등 교육<br>웹 체험하기</button></a></div>
        <div><a href="./mid_webGL_select.php"><button class="btn btn-primary">중등 교육<br>웹 체험하기</button></a></div>
    </div>

    <?php

        $position = mq("select title from eltable where subject='".$subj."'");
        
    ?>

    <div id="elread_area">
        <div id="eltitle">
            <h4>제목  <span><?php echo $title ?></span></h4>
        </div>
        <div id="elsubtitle">
            <h4>과정 분류 <span><?php echo $linetype ?></span></h4>
            <h4>과목 <span><?php echo $subj ?></span></h4>
            <h4>조회 <span><?php echo $elread['hit'] ?></span></h4>
        </div>

        <div id="elimg360">
            <iframe src="./el_img360.php?title=<?php echo $title ?>"></iframe> <!--iframe을 사용해서 해당하는 제목의 360이미지를 불러올 php적용-->
            <p style="color:red;">* 모바일 확인 시 '크롬'앱에서만 360이미지를 볼 수 있습니다.</p>
        </div>

        <div id="elcourse">
            <h4>장소 네비게이션</h4>
            <?php 
                while($elpos = $position -> fetch_array()){
                if($elpos['title'] == $title){
            ?>
            <button class="btn btn-danger"><i class="fas fa-arrow-right"></i> 현재 위치 : <?php echo $elpos['title'] ?></button>
            <?php
                } else{
            ?>
            <a href="./el_content.php?title=<?php echo $elpos['title'] ?>"><button class="btn btn-primary"><?php echo $elpos['title'] ?></button></a>
            <?php
                }
            }
            ?>
        </div>
        <div id="elcontent">
            <h4><?php echo $readcont ?></h4>
        </div>
    </div>

    <div id="go_board">
        <a href="./el_board.php?subject=<?php echo $subj ?>"><button class="btn btn-primary">목록으로</button></a>
    </div>

    <?php
        include "../common/footer.php"
    ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdn.bootcss.com/aframe/0.7.1/aframe.min.js"></script>
    <script type="text/javascript">
    </script>
</body>
</html>
