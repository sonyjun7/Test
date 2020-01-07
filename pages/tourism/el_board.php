<?php
    include "../common/db.php";
    $session = $_SESSION['userid'];

    $mmchk = mq("select * from member where id='".$session."'");
    $mgchk = $mmchk -> fetch_array();

?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Do+Hyeon|Jua|Nanum+Gothic+Coding" rel="stylesheet">
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/common_css/common.css">
    <link rel="stylesheet" href="../../css/tourism_css/el_mid_tourism.css">
    <title>초등 관광지 정보 게시판</title>
</head>
<body>

    <?php
        include "../common/header.php";
    ?>

    <?php
        $subject = $_GET['subject'];
        
    ?>
    <div id="hNotice">
        <h2>초등 <?php echo $subject ?> 관광지 정보 게시판</h2>
        <img src="../../img/main_pic_02.png">
    </div>

    <div id="left_navi">
        <i class="fas fa-angle-double-down fa-2x"></i>
        <div><a href="./eduSelect.php"><button class="btn btn-primary">초등/중등<br>선택 페이지</button></a></div>
        <div><a href="./el_index.php"><button class="btn btn-primary">초등 과목<br>선택 게시판</button></a></div>
        <div><a href="./el_webGL_select.php"><button class="btn btn-primary">초등 교육<br>웹 체험하기</button></a></div>
        <div><a href="./mid_webGL_select.php"><button class="btn btn-primary">중등 교육<br>웹 체험하기</button></a></div>
    </div>

    <div id="elboard_area">
        <div id="notice_back"></div>

        <table class="table table-hover" id="el_table">
            <thead>
                <tr>
                    <th width="30%">이미지</th>
                    <th width="30%">제목</th>
                    <th width="10%">과정 분류</th>
                    <th width="10%">조회 수</th>
                </tr>
            </thead>

            <?php
                $sql = mq("select * from eltable where subject='".$subject."'");
                
                while($elboard = $sql -> fetch_array()){
            ?>

            <tbody>
                <tr>
                    <td width="30%"><img src="../../img/el_img/<?php echo $elboard['thumbnail'] ?>"></td>
                    <td width="30%"><a href="./el_content.php?idx=<?php echo $elboard['idx'] ?>&title=<?php echo $elboard['title'] ?>"><?php echo $elboard['title'] ?></a></td>
                    <td width="10%"><?php echo $elboard['linetype'] ?></td>
                    <td width="10%"><?php echo $elboard['hit'] ?></td>
                </tr>
            </tbody>
    <?php
        }
    ?>
        </table>
    </div>

    <?php
        if($mgchk['group'] == "manager" || $mgchk['group'] == "root"){
    ?>
    <div id="btn_board">
        <a href="./el_upload.php?subject=<?php echo $subject ?>"><button class="btn btn-primary">초등 관광지 업로드</button></a>
    </div>
    <?php
        }
    ?>

    <?php
        $sql = mq("alter table eltable AUTO_INCREMENT = 1");
        $sql = mq("set @COUNT = 0");
        $sql = mq("update eltable set idx=@COUNT:=@COUNT + 1");
    ?>

    <?php
        include "../common/footer.php";
    ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
</body>
</html>