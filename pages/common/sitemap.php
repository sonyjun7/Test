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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+KR:500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Do+Hyeon|Jua|Nanum+Gothic+Coding" rel="stylesheet">
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/common_css/common.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery.min.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>

    <title>사이트 맵</title>
</head>
<body>

    <?php
        include "../common/header.php"
    ?>

    <div id="hNotice">
        <h2>사이트 맵</h2>
        <img src="../../img/main_pic_02.png">
    </div>

    <div id="site_area">
        <div id="sit_div1">
            <h3>교육관광</h3>
            <br>
            <h5><a href="../tourism/el_index.php">- 초등교육관광</a></h5>
            <h5><a href="../tourism/el_webGL_select.php">- 초등웹체험관</a></h5>
            <h5><a href="../tourism/mid_index.php">- 중등교육관광</a></h5>
            <h5><a href="../tourism/mid_webGL_select.php">- 중등웹체험관</a></h5>
        </div>

        <!-- <a href="./vote/index.php">votetest</a> -->

        <div id="sit_div2">
            <div id="sit_div2_1">
                <div id="div2_1_1">
                    <h3>공지사항</h3>
                    <br>
                    <h5><a href="../notice/arvr_notice.php">- 게시글 보기</a></h5>
                </div>

                <div id="div2_1_2">
                    <h3>My Page</h3>
                    <br>
                <?php
                    if($session){
                ?>
                    <h5><a href="../member/myPage.php">- mypage 보기</a></h5>
                <?php
                    } else{
                ?>
                    <h5>- mypage 보기<br>(로그인 후 사용가능)</h5>
                <?php
                    }
                ?>
                </div>

                <div id="div2_1_3">
                    <h3>회원</h3>
                    <br>
                    <h5><a href="../login_admission/loginMain.php">- 로그인</a></h5>
                    <h5><a href="../login_admission/admission.php">- 회원가입</a></h5>
                    <h5><a href="../login_admission/idCheck.php">- 아이디 찾기</a></h5>
                    <h5><a href="../login_admission/pwCheck.php">- 비밀번호 변경</a></h5>
                </div>
            </div>

            <div id="sit_div2_2">
                <div id="div2_2_1">
                    <h3>관광DB</h3>
                    <br>
                    <h5><a href="../tourSeach/toursearch_select.php">- 관광지 검색하기</a></h5>
                </div>

                <div id="div2_2_2">
                    <h3>자료실</h3>
                    <br>
                    <h5><a href="../dataroom/appDownload.php">- 자료받기</a></h5>
                </div>

                <div id="div2_2_3">
                    <h3>참여 공간</h3>
                    <br>
                    <h5><a href="../userEnter/freeNotice.php">- 자유게시판</a></h5>
                    <h5><a href="../userEnter/vote_notice.php">- 투표게시판</a></h5>
                    <h5><a href="../userEnter/scenarioWrite.php">- 초등코스 시나리오<br>생성및 편집</a></h5>
                    <h5><a href="../userEnter/scenarioWrite_mid.php">- 중등코스 시나리오<br>생성및편집</a></h5>
                    <h5><a href="../userEnter/scenario_view_notice.php">- 초등 시나리오 관람<br>게시판</a></h5>
                    <h5><a href="../userEnter/scenario_view_mid_notice.php">- 중등 시나리오 관람<br>게시판</a></h5>
                </div>
            </div>
        </div>
    </div>


    <?php
        include "../common/footer.php";


    ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../../jquery-ui.js"></script>
</body>
</html>

