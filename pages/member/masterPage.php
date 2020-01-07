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
    <title>관리자페이지</title>
</head>
<body>

    <?php
        include "../common/header.php";
    ?>

    <div id="hNotice">
        <h2>관리자 페이지</h2>
        <img src="../../img/main_pic_02.png">
    </div>

    <div id="profile">
        <img src="../../img/lock_img.png">
    </div>

    <div id="board_area">
        <!-- <a href="./my_search_select.php"><button class="btn btn-primary">회원정보확인</button></a> -->
        <div id="mas_div">
            <a href="./mem_submit_chk.php"><button class="btn btn-primary">가입대기목록</button></a>
        </div>

    </div>


    <?php
        include "../common/footer.php";
    ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript">

    </script>
</body>
</html>
<?php
    if($mem['group'] != "root"){
        echo "<script> alert('잘못된접근입니다.');  location.href='../../index.php'; </script>";
    }
?>