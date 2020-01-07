<?php
    include "../common/db.php";
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
    <title>초등 웹 체험 과목 선택</title>
</head>
<body>

    <?php
        include "../common/header.php";
    ?>

    <div id="hNotice">
        <h2>초등 웹 체험관 선택</h2>
        <img src="../../img/main_pic_02.png">
    </div>

    <div id="left_navi">
        <i class="fas fa-angle-double-down fa-2x"></i>
        <div><a href="./eduSelect.php"><button class="btn btn-primary">초등/중등<br>선택 페이지</button></a></div>
        <div><a href="./el_index.php"><button class="btn btn-primary">초등 과목<br>선택 게시판</button></a></div>
        <div><a href="./el_webGL_select.php"><button class="btn btn-primary">초등 교육<br>웹 체험하기</button></a></div>
        <div><a href="./mid_webGL_select.php"><button class="btn btn-primary">중등 교육<br>웹 체험하기</button></a></div>
    </div>

    <div id="line">
        <div></div>
        <div></div>
    </div>

    <div id="el_sel1">
        <a href="./el_webGL.php?subject=society"><button class="btn btn-info">사회과<br>웹 체험</button></a>
        <a href="./el_webGL.php?subject=lang"><button class="btn btn-info">국어과<br>웹 체험</button></a>
        <a href="./el_webGL.php?subject=geo"><button class="btn btn-info">지리과<br>웹 체험</button></a>
    </div>

    <div id="el_sel2">
        <a href="./el_webGL.php?subject=sci"><button class="btn btn-info">과학과<br>웹 체험</button></a>
        <a href="./el_webGL.php?subject=art"><button class="btn btn-info">미술과<br>웹 체험</button></a>
    </div>

    <div id="line">
        <div></div>
        <div></div>
    </div>
    <?php
        include "../common/footer.php";
    ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
</body>
</html>