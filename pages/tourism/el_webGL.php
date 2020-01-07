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
</head>
<body>

    <?php
        include "../common/header.php";
        $subj = $_GET['subject'];
    ?>

    <div id="hNotice">
        <h2>초등 <?php echo $subj ?> 웹 체험</h2>
        <img src="../../img/main_pic_02.png">
    </div>

    <div id="left_navi">
        <i class="fas fa-angle-double-down fa-2x"></i>
        <div><a href="./eduSelect.php"><button class="btn btn-primary">초등/중등<br>선택 페이지</button></a></div>
        <div><a href="./el_index.php"><button class="btn btn-primary">초등 과목<br>선택 게시판</button></a></div>
        <div><a href="./el_webGL_select.php"><button class="btn btn-primary">초등 교육<br>웹 체험하기</button></a></div>
        <div><a href="./mid_webGL_select.php"><button class="btn btn-primary">중등 교육<br>웹 체험하기</button></a></div>
    </div>

    <!-- <div id="webgl_area">
        <img src="../../img/Play_map_지리과2.png">
    </div> -->

    <div id="carousel-example-generic2" class="carousel slide" data-ride="carousel">

        <div id="banner" class="carousel-inner" role="listbox"> 

        <div id="webgl_area2" class="item active">

            <!-- <img src="../../img/mid_webgl/<?php echo $subj ?>/snap_shot_3.PNG">
            <textarea id="webgl_text" name="webgl_text" class="form-control webgl_class" readonly="readonly">안녕? 나는 베트남 사람, 비엣이라고 해. 처음 보는 얼굴인데 혹시 여기가 처음이니?</textarea> -->

            <!-- <img src="../../img/Play_map_지리과2.png"> -->

            <?php
                if($subj == "geo"){
            ?>
                    <img src="../../img/el_webgl/<?php echo $subj ?>/초등지리2.PNG">
                    <textarea id="webgl_text" name="webgl_text" class="form-control webgl_class" readonly="readonly">참 아름다운 경관이야. 이곳에서 멸종위기동물 수비대를 함께 할 동료를 찾아볼까? 어, 그런데 아까부터 웬 물새 한 마리가 나를 따라오고 있어.</textarea>
            <?php
                }
                if($subj == "lang"){
            ?>
                    <img src="../../img/el_webgl/<?php echo $subj ?>/초등국어2.PNG">
                    <textarea id="webgl_text" name="webgl_text" class="form-control webgl_class" readonly="readonly">충청북도 충주시를 어디서부터 둘러보면 좋을까? 충주시에서 가장 유명한 문화재가 있는 '중앙탑사적공원'에서 출발해 보자.</textarea>
            <?php
                }
                if($subj == "society"){
            ?>
                    <img src="../../img/el_webgl/<?php echo $subj ?>/초등사회13.PNG">
                    <textarea id="webgl_text" name="webgl_text" class="form-control webgl_class" readonly="readonly">서울시 종로구를 어디서부터 둘러보면 좋을까? 
서울의 중심거리 세종대로에 위치한 광화문광장에서 출발해보자.</textarea>        
            <?php
                }
                if($subj == "sci"){
            ?>
                    <img src="../../img/el_webgl/<?php echo $subj ?>/초등과학1.PNG">
                    <textarea id="webgl_text" name="webgl_text" class="form-control webgl_class" readonly="readonly">경상남도 고성군은 중생대 퇴적층이 넓게 이루어져 중생대에 살았던 공룡의 발자국화석을 쉽게 발견할 수 있는 곳입니다. 또한 해안가에 위치하여 오랜 기간 해수의 침식을 받은 지층을 관찰할 수 있습니다. 
이곳에서 공룡과 지층에 대해 이해하고 과학적으로 탐구해봅시다.</textarea>   
            <?php
                }
                if($subj == "art"){
            ?>
                    <img src="../../img/el_webgl/<?php echo $subj ?>/초등미술1.PNG">
                    <textarea id="webgl_text" name="webgl_text" class="form-control webgl_class" readonly="readonly">제주특별자치도 서귀포시를 둘러볼 것입니다.
제주특별자치도 서귀포시는 6.25전쟁 시기 화가 이중섭이 피난을 가서 정착한 곳입니다. 화가 이중섭이 이곳에서 어떤 삶을 살았는지, 무엇에 영감을 받아 가족, 아이들 시리즈 등의 작품을 그리게 되었는지 직접 느껴봅시다.</textarea>                
            <?php
                }
            ?>


        </div>

            <?php
                $mq1 = mq("select * from el_webgl where subject='".$subj."'");

                // 과목별로 해당 시나리오 이미지 슬라이드
                while($webgl = $mq1 -> fetch_array()){
            ?>
                    <div id="webgl_area" class="item">
                        <img src="../../img/el_webgl/<?php echo $subj ?>/<?php echo $webgl['img'] ?>">
                        <textarea id="webgl_text" name="webgl_text" class="form-control webgl_class" readonly="readonly"><?php echo $webgl['text'] ?></textarea>
                    </div>
            <?php
                }
            ?>

        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#carousel-example-generic2" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>

        <a class="right carousel-control" href="#carousel-example-generic2" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>

    </div>

    <?php
        include "../common/footer.php";
    ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
    <script>
        var i = 0;
        var speed = 50;
        // 자동 슬라이드 false
        $(".carousel").carousel({interval: false });

        // 처음과 마지막 슬라이드의 화살표를 제거해주기(첫페이지 는 마지막페이지로 가는 화살표 제거, 마지막페이지는 첫페이지로 가는 화살표를 제거)

        $("#carousel-example-generic2").on('slid', '', checkitem); //on carousel move

        $('#carousel-example-generic2').on('slid.bs.carousel', '', checkitem);

        $(document).ready(function(){
            checkitem();

        });

        function checkitem(){
            var $this = $('#carousel-example-generic2');
            // console.log($this);

            // console.log($this);

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