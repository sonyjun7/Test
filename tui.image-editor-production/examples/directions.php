<?php
    include "../../pages/common/db.php";

    $idx = $_GET['idx'];
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
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <style>
    #banner{
        margin-top: 30px;
        border-top: solid #d6d6d6 1.5px;
        border-bottom: solid #d6d6d6 1.5px;
    }

    #banner img{
        margin-top: 5px;
        margin-bottom: 5px;
        /* width: 700px; */
        max-width: 100%;
        height: auto;
        vertical-align: bottom;
    }

    #goto_btn{
        margin-top: 20px;
        text-align: center;
    }
    </style>
    <title>이미지 편집 사용법</title>
</head>
<body>

    <h4 style="color:blue;">이미지 편집 라이브러리 사용법</h4>

    <div id="goto_btn">
        <a href="./example.php?idx=<?php echo $idx ?>"><button class="btn btn-primary btn-lg">이미지 편집 시작하기</button></a>
    </div>
<!-- 배너 이미지 슬라이드(bootstrap) -->
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
    <!-- 지시자 -->
        <!-- <ol id="car_indi" class="carousel-indicators">
            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
            <li data-target="#carousel-example-generic" data-slide-to="2"></li>
        </ol> -->

        <!-- 슬라이드할 이미지 -->

        <div id="banner" class="carousel-inner" role="listbox">

                <div class="item active">
                    <img src="../../img/image_edit_1.jpg">
                </div>

                <div class="item">
                    <img src="../../img/image_edit_2.jpg">
                </div>

                <div class="item">
                    <img src="../../img/image_edit_3.jpg">
                </div>

                <div class="item">
                    <img src="../../img/image_edit_4.jpg">
                </div>

                <div class="item">
                    <img src="../../img/image_edit_5.jpg">
                </div>

                <div class="item">
                    <img src="../../img/image_edit_6.jpg">
                </div>

                <div class="item">
                    <img src="../../img/image_edit_7.jpg">
                </div>

                <div class="item">
                    <img src="../../img/image_edit_8.JPG">
                </div>

                <div class="item">
                    <img src="../../img/image_edit_9.jpg">
                </div>

                <div class="item">
                    <img src="../../img/image_edit_11.jpg">
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

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="../../bootstrap/js/bootstrap.min.js"></script>
        <script>
            // 자동 슬라이드 false
            $(".carousel").carousel({interval: false });

            // 처음과 마지막 슬라이드의 화살표를 제거해주기(첫페이지 는 마지막페이지로 가는 화살표 제거, 마지막페이지는 첫페이지로 가는 화살표를 제거)

            $("#carousel-example-generic").on('slid', '', checkitem); //on carousel move

            $('#carousel-example-generic').on('slid.bs.carousel', '', checkitem);

            $(document).ready(function(){
                checkitem();
            });

            function checkitem(){
                var $this = $('#carousel-example-generic');
                console.log($this);

                if($('.carousel-inner .item:first').hasClass('active')){
                    $this.children('.left.carousel-control').hide();
                    $this.children('.right.carousel-control').show();
                }
                else if($('.carousel-inner .item:last').hasClass('active')){
                    $this.children('.left.carousel-control').show();
                    $this.children('.right.carousel-control').hide();
                }
                else{
                    $this.children('.carousel-control').show();
                }
            }


        </script>
</body>
</html>