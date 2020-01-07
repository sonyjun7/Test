<?php
    include "./pages/common/db.php";

?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+KR:500&display=swap" rel="stylesheet">
    
    <link href="https://fonts.googleapis.com/css?family=Do+Hyeon|Jua|Nanum+Gothic+Coding" rel="stylesheet">
    <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/common_css/common.css">
    <link rel="stylesheet" href="./css/home_css/home.css">
    <title>교육관광 메인페이지</title>
</head>
<body>

    <?php
        include "./main_header.php";
    ?>

<!-- 배너 이미지 슬라이드(bootstrap) -->
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
    <!-- 지시자 -->
        <ol id="car_indi" class="carousel-indicators">
            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
        </ol>

        <!-- 슬라이드할 이미지 -->

        <div id="banner" class="carousel-inner" role="listbox">

                <div class="item active">
                    <img src="./img/main_pic.jpg">
                </div>

                <div class="item">
                    <img src="./img/360_banner.jpg">
                </div>
        </div>

    <!-- Controls -->
        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>


    <div id="intro">
            <h2>과제소개</h2>
            <img src="./img/main_pic_02.png">
            <h4>교육관광 AR/VR의 연구개발 개요를 설명합니다.</h4>
    </div>

    <div id="intro_content1">
        <p style="color:red;">* 본 사이트는 구글 크롬, 마이크로소프트 엣지, 모질라 파이어폭스에서 호환됩니다.</p>
        <br>
        <p><i class="fa fa-book fa-2x"></i> 초등,중등 교육과정 전교과에 포함되어 있는 지역정보 수집을 통하여 POI를 추출 하고 교육 관광 DB를 구축</p>
        <p>- 국내 지역 관광의 경쟁력을 확보하기 위하여 초등,중등 교육과정의 전교과에 등장하는 지역에 대해 데이터베이스를 구축하고 관광코스를 개발하여 국내관광 활성화에 기여할 수 있습니다.</p>
    </div>
    <div id="intro_content2">
        <p><i class="fa fa-book fa-2x"></i> 교육관광코스와 VR/AR 콘텐츠 개발</p>
        <p>- 초등, 중등교육과정 전교과의 지역 데이터를 수집하고 흥미로운 코스 및 AR 콘텐츠를 개발함으로써 현장체험교육 및 융복합교육의 의의를 달성할 수 있습니다.</p>
        <p>- 개발한 AR 콘텐츠 사례를 바탕으로 각 지자체와 협력하여 지역경제를 활성화할 수 있고, 각급학교 및 연구소 등 교육현장에서 직접적으로 활용할 수 있으며 포털 회사와 연계하여 기술 개선 및 홍보 효과를 가지고 옵니다.</p>
    </div>

    <div id="content_flow">
        <img src="./img/main_pic_03.png">
        <div id="background1"></div>
        <div id="background2"></div>
    </div>


    <?php
        include "./pages/common/footer.php"
    ?>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="./bootstrap/js/bootstrap.min.js"></script>
        <script>
            // // 자동 슬라이드 false
            // $(".carousel").carousel({interval: false });
        </script>
</body>
</html>