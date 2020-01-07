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
    <title>비밀번호 찾기</title>
</head>
<body style="margin:0;">

    <div id="pwCheck_area">
        <form action="./pwCheck_find.php" method="post" id="login_box">
            <div id="login_box_1"><a href="../../index.php"><img src="../../img/webicon_big.png"></a></div>

            <h3 id="chk_head">가입했던 아이디, Mail주소와 전화번호를 입력해주세요</h3>

            <h4>ID 입력</h4>
            <input type="text" class="form-control" name="userid" required="required">

            <h4>Mail 입력</h4>
            <div id="find_mail">
                <input type="text" class="form-control" name="mail" placeholder="ex)sqwm123" required="required">
                <select name="mailadd" class="form-control">
                    <option value="naver.com">@naver.com</option>
                    <option value="daum.net">@daum.net</option>
                    <option value="gmail.com">@gmail.com</option>
                </select>
            </div>


            <h4>핸드폰 번호 입력</h4>
            <input type="text" class="form-control" name="phone" placeholder="ex)010-XXXX-XXXX" required="required">

            <div id="find_btn">
                <a href="./pwCheck_find.php"><button class="btn btn-primary" value="비밀번호 찾기">비밀번호 변경</button></a>
            </div>
        </form>

        <div id="back_btn2">
            <a href="./loginMain.php"><button class="btn btn-primary">로그인 페이지</button></a>
            <a href="./admission.php"><button class="btn btn-primary">회원가입 페이지</button></a>
        </div>
    </div>


    <div id="login_footer_copyright">
        <p>개인정보처리방침 | 저작권정책 | 업무별전화번호안내 | 이용안내</p>
        <a href="../../index.php"><img src="../../img/main_icon.png"></a>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
</body>
</html>