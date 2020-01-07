<?php
    include "../common/db.php";
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Do+Hyeon|Jua|Nanum+Gothic+Coding" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+KR:500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/common_css/common.css">
    <link rel="stylesheet" href="../../css/login_admission_css/login.css">
    <title>로그인</title>
</head>
<body style="margin:0;">

    <div id="login_area">
        <form action="./loginMain_ok.php" method="post" id="login_box">
            <div id="login_box_1"><a href="../../index.php"><img src="../../img/webicon_big.png"></a></div>
            <div id="login_box_2">
                <input type="text" class="form-control" name="userid" placeholder="아이디" required="required">
                <input type="password" class="form-control" name="userpw" placeholder="비밀번호" required="required">
            </div>
            <div id="login_box_3">
                <a href="./loginMain_ok.php"><button class="btn btn-primary">로그인</button></a>
            </div>
            <div id="login_box_4">
                <a href="./admission.php"><h4>회원이 아니신가요? 회원가입 하기</h4></a>
            </div>
            <div id="login_box_5">
                <a href="./idCheck.php"><h4>아이디 찾기</h4></a>
                <a href="./pwCheck.php"><h4>비밀번호 변경</h4></a>
            </div>
        </form>
    </div>


    <div id="login_footer_copyright">
        <p>개인정보처리방침 | 저작권정책 | 업무별전화번호안내 | 이용안내</p>
        <a href="../../index.php"><img src="../../img/main_icon.png"></a>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
</body>
</html>