<?php
    include "../common/db.php";
    // echo "<script> alert('".$_SESSION['userid']." : 세션아이디2'); </script>";
    if(!isset($_SESSION['userid'])){
        echo "<script>alert('잘못된 접근입니다.'); history.back();</script>";
      }else{
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
    <title>비밀번호 변경</title>
</head>
<body>

    <div id="pwCheck_area">
        <form action="./member_pw_update_ok.php" method="post" id="login_box">
            <div id="login_box_1"><a href="../../index.php"><img src="../../img/webicon_big.png"></a></div>
            <div id="login_box_2">
                <h3>변경할 비밀번호 입력</h3>
                <input type="password" class="form-control" name="userpw1" placeholder="비밀번호" required="required">
                <h3>다시 입력</h3>
                <input type="password" class="form-control" name="userpw2" placeholder="비밀번호" required="required">

            </div>
            <div id="login_box_3">
                <a href="./member_pw_update_ok.php"><button class="btn btn-primary">비밀번호 변경</button></a>
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
      <?php } ?>