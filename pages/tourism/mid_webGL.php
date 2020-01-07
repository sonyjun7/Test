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
    <title>중등 웹 체험 과목 선택</title>
</head>
<body>

    <?php
        include "../common/header.php";
        $subj = $_GET['subject'];
        $linetype = $_GET['linetype'];
    ?>

    <div id="hNotice">
        <h2>중등 <?php echo $subj ?> 웹 체험</h2>
        <img src="../../img/main_pic_02.png">
        <p>* 초기 웹체험시 음성을 불러오는데 시간이 다소 걸립니다. 참고바랍니다.</p>
    </div>

    <div id="left_navi">
        <i class="fas fa-angle-double-down fa-2x"></i>
        <div><a href="./eduSelect.php"><button class="btn btn-primary">초등/중등<br>선택 페이지</button></a></div>
        <div><a href="./mid_index.php"><button class="btn btn-primary">중등 과목<br>선택 게시판</button></a></div>
        <div><a href="./el_webGL_select.php"><button class="btn btn-primary">초등 교육<br>웹 체험하기</button></a></div>
        <div><a href="./mid_webGL_select.php"><button class="btn btn-primary">중등 교육<br>웹 체험하기</button></a></div>
    </div>

    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">

        
        <div id="banner" class="carousel-inner" role="listbox"> 
        
        <div id="webgl_area" class="item active">
        <?php
            // 과목별 첫 장면
            if($subj == "society" && $linetype == "혼합형"){
        ?>
            <img src="../../img/mid_webgl/<?php echo $subj ?>/<?php echo $linetype ?>/snap_shot_3.PNG">
            <textarea id="webgl_text" name="webgl_text" class="form-control webgl_class" readonly="readonly">안녕? 나는 베트남 사람, 비엣이라고 해. 처음 보는 얼굴인데 혹시 여기가 처음이니?</textarea>
            <input type="hidden" value="<?php echo '사회혼합형1.wav' ?>">

            <audio id="audioclass" controls>
                <source src="../../sound/<?php echo $subj ?>/<?php echo $linetype ?>/사회혼합형1.wav" type="audio/wav"> 
            </audio>
        <?php
            }
            if($subj == "society" && $linetype == "체험형"){
        ?>
            <img src="../../img/mid_webgl/<?php echo $subj ?>/<?php echo $linetype ?>/연수구1.PNG">
            <textarea id="webgl_text" name="webgl_text" class="form-control webgl_class" readonly="readonly">인천광역시 연수구를 둘러볼 것입니다.
인천광역시에는 현재 경제자유구역 3곳과 인천국제공항, G타워가 위치하여 
'세계로 뻗어가는 교류의 전진기지'로서 역할을 맡고 있습니다. 
인천광역시의 역사를 살펴보면, 이곳이 근대 제물포 개항 이전부터 국제교류의 기지로
존재했음을 확인할 수 있습니다. 능허대는 삼국시대부터 대외교류의 거점으로 역할을 
수행했습니다. 인천광역시의 능허대와 G타워에서 국제 거래의 필요성과 
환율에 대해서 배워 퀘스트를 완수해 봅시다. </textarea>
            <input type="hidden" value="<?php echo '사회체험형1.wav' ?>">

            <audio id="audioclass" controls>
                <source src="../../sound/<?php echo $subj ?>/<?php echo $linetype ?>/사회체험형1.wav" type="audio/wav">
            </audio>
        <?php
            }
            if($subj == "geo" && $linetype == "체험형"){
        ?>
            <img src="../../img/mid_webgl/<?php echo $subj ?>/<?php echo $linetype ?>/태안10.PNG">
            <textarea id="webgl_text" name="webgl_text" class="form-control webgl_class" readonly="readonly">안녕! 난 태안에 살고 있는 꽃게야. 이제부터 내가 살고 있는 이곳에 대한 설명하도록 하지. 나의 배지를 받으려면 내 말을 아주 집중해서 들어야 할 거다!</textarea>
        <?php
            }
            if($subj == "geo" && $linetype == "혼합형"){
        ?>
            <img src="../../img/mid_webgl/<?php echo $subj ?>/<?php echo $linetype ?>/평창1.PNG">
            <textarea id="webgl_text" name="webgl_text" class="form-control webgl_class" readonly="readonly">안녕! 나는 대관령 삼양목장에서 살고 있는 양이라고 해.</textarea>  
        <?php
            }
            if($subj == "art" && $linetype == "혼합형"){
        ?>
            <img src="../../img/mid_webgl/<?php echo $subj ?>/<?php echo $linetype ?>/부여3.PNG">
            <textarea id="webgl_text" name="webgl_text" class="form-control webgl_class" readonly="readonly">안녕? 나는 정림사지에서 살고 있는 정림이라고 해. 넌 처음 보는데.. 누구인지 알려주겠니?</textarea>
        <?php
            }
            if($subj == "art" && $linetype == "체험형"){
        ?>
            <img src="../../img/mid_webgl/<?php echo $subj ?>/<?php echo $linetype ?>/파주4.PNG">
            <textarea id="webgl_text" name="webgl_text" class="form-control webgl_class" readonly="readonly">경기도 파주시는 우리나라 분단의 아픔을 가장 가까이에서 볼 수 있는 지역입니다. 임진각 평화누리공원은 한국 전쟁의 비통한 역사를 기록한 임진각 부근에 위치하고 있습니다.</textarea>
        <?php
            }
            if($subj == "sci" && $linetype == "혼합형"){
        ?>
            <img src="../../img/mid_webgl/<?php echo $subj ?>/<?php echo $linetype ?>/창녕1.PNG">
            <textarea id="webgl_text" name="webgl_text" class="form-control webgl_class" readonly="readonly">안녕! 나는 지킴이라고 해. 우포늪을 다니다 보면 물에서 사는 식물들을 볼 수 있을꺼야! 다 비슷비슷해 보이지? 하지만 모두 다른 식물이야! 우포늪에는 다양한 수생식물들이 살아가고 있어.</textarea>
        <?php
            }
            if($subj == "lang" && $linetype == "혼합형"){
        ?>
            <img src="../../img/mid_webgl/<?php echo $subj ?>/<?php echo $linetype ?>/춘천5.PNG">
            <textarea id="webgl_text" name="webgl_text" class="form-control webgl_class" readonly="readonly">안녕? 나는 점순이라고 해. 나는 김유정이 창조한 매력적인 인물 중 한 명이지. 나와 함께 김유정 문학촌을 둘러볼래?</textarea>

            <audio id="audioclass" controls>
                <source src="../../sound/<?php echo $subj ?>/<?php echo $linetype ?>/국어혼합형1.wav" type="audio/wav">
            </audio>
        <?php
            }
            if($subj == "lang" && $linetype == "체험형"){
        ?>
            <img src="../../img/mid_webgl/<?php echo $subj ?>/<?php echo $linetype ?>/강진3.PNG">
            <textarea id="webgl_text" name="webgl_text" class="form-control webgl_class" readonly="readonly">거기! 시방 뭐던다요?</textarea>
        <?php
            }
            if($subj == "sci" && $linetype == "체험형"){
        ?>
            <img src="../../img/mid_webgl/<?php echo $subj ?>/<?php echo $linetype ?>/전주2.PNG">
            <textarea id="webgl_text" name="webgl_text" class="form-control webgl_class" readonly="readonly">안녕? 만나서 반가워! 나는 미래에서 온 건축가야. 미래의 도시는 수많은 건물에서 에너지를 사용하여 자원이 점차 고갈되고, 환경을 위협하는 폐기물도 넘쳐나고 있어. 
한옥에 자연으로부터 얻은 에너지를 활용하여 생활할 수 있는 비밀이 숨어 있다고 해서 타임머신을 타고 이곳에 와 보게 되었어. 한옥의 비밀을 함께 찾아보지 않을래? 우리가 함께 비밀을 찾게 된다면, 미래의 사람들이 환경을 고려한 건축물을 짓는 데 도움이 될 거야!</textarea>
        <?php
            }
        ?>

        </div>

                    <!-- <div id="webgl_area" class="item">
                        
                        <audio controls autoplay>
                            <source src="../../sound/여_player_02.wav" type="audio/wav"> 
                        </audio>
                    </div> -->

            <?php
                $mq1 = mq("select * from mid_webgl where subject='".$subj."' and linetype='".$linetype."'");

                // 과목별로 해당 시나리오 이미지 슬라이드
                // $webgl = $mq1 -> fetch_array();
                while($webgl = $mq1 -> fetch_array()){
            ?>
                    <div id="webgl_area" class="item">
                        <img src="../../img/mid_webgl/<?php echo $subj ?>/<?php echo $linetype ?>/<?php echo $webgl['img'] ?>">
                        <textarea id="webgl_text" name="webgl_text" class="form-control webgl_class" readonly="readonly"><?php echo $webgl['text'] ?></textarea>
                        <input type="hidden" value="<?php echo $webgl['sound'] ?>">

                        <audio id="audioclass" controls>
                            <source src="../../sound/<?php echo $subj ?>/<?php echo $linetype ?>/<?php echo $webgl['sound'] ?>" type="audio/wav"> 
                        </audio>
                    </div>
            <?php
                }
            ?>

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


    <!-- <div id="webgl_area">
        <img src="../../img/mid_img/snap_shot_3.PNG">
        <textarea id="webgl_text" name="webgl_text" class="form-control"></textarea>
    </div> -->

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

        $("#carousel-example-generic").on('slid', '', checkitem); //on carousel move

        $('#carousel-example-generic').on('slid.bs.carousel', '', checkitem);

        $(document).ready(function(){
            checkitem();

        });

        function checkitem(){
            var $this = $('#carousel-example-generic');
            // console.log($this);

            console.log($('div.item.active')[0].children[2].value);

            // 현재 이미지 슬라이드중에서 사운드 파일이 있을 경우 if문 실행
            if($('div.item.active')[0].children[2].value){
  
                // 현재 과목의 이미지 슬라이드의 총길이만큼 반복해서 모두 정지
                for(var i=0; i<$('div.item').length; i++){
                    // console.log($('div.item')[i].children[3]);
                    $('div.item')[i].children[3].pause();
                }

                // 현재 이미지 슬라이드인 음성만 재생
                $('div.item.active')[0].children[3].play(); 
                
                // console.log($('div.item'));
            }

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