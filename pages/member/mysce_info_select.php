<?php
    include "../common/db.php";
    $session = $_SESSION['userid'];
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Do+Hyeon|Jua|Nanum+Gothic+Coding" rel="stylesheet">
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/common_css/common.css">
    <link rel="stylesheet" href="../../css/member_css/myPage.css">
    <title>회원정보확인</title>
</head>
<body>

    <?php
        include "../common/header.php";
    ?>

    <div id="hNotice">
        <a href="./myPage.php"><h2>MY PAGE</h2></a>
        <img src="../../img/main_pic_02.png">
    </div>

    <div id="profile">
        <img src="../../img/blank_profile.png">
    </div>

    <div id="board_area">
        <a href="./myScenarioInfo.php"><button id="el_sce_btn" class="btn btn-primary">초등 시나리오 확인</button></a>
        <a href="./mid_myScenarioInfo.php"><button id="mid_sce_btn" class="btn btn-success">중등 시나리오 확인</button></a>
    </div>

    <div id="sce_info_area"></div>

    <?php
        include "../common/footer.php";
    ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
<?php
    if(!isset($_SESSION['userid'])){
        echo "<script> alert('잘못된접근입니다.');  location.href='../../index.php'; </script>";
    }
?>