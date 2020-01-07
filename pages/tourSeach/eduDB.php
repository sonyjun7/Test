<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Do+Hyeon|Jua|Nanum+Gothic+Coding" rel="stylesheet">
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/common_css/common.css">
    <link rel="stylesheet" href="../../css/userEnter_css/user_enter.css">
    <link rel="stylesheet" href="../../css/tourSearch_css/tour_search.css">
    <link rel="stylesheet" href="../../css/tourSearch_css/tour_search2.css">
    <title>관광지 검색</title>
</head>
<body>

    <?php
        include "../common/header.php"
    ?>

    <div id="hNotice">
        <h2>관광지 검색</h2>
        <img src="../../img/main_pic_02.png">
    </div>

    <a href="./phpsearch.php"><button>php</button></a>

    <div id="iframe_div">
        <iframe src="http://192.168.1.183:8080/eduDB2/index.html" frameborder="0">검색 오류</iframe>
    </div>

    <?php
        include "../common/footer.php"
    ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../../bootstrap/js/bootstrap.min.js"></script>

</body>
</html>