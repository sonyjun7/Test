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
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/common_css/common.css">
    <link rel="stylesheet" href="../../css/userEnter_css/user_enter.css">

    <title>참여 공간</title>
</head>
<body>

    <?php
        include "../common/header.php"
    ?>

    <div id="hNotice">
        <h2>참여 공간</h2>
        <img src="../../img/main_pic_02.png">
    </div>

    <div id="select_user">
        <h3>회원들이 참여할 수 있는 공간입니다.</h3>
        <button class="btn btn-primary" id="free">회원 참여게시판</button>
        <button class="btn btn-info" id="sce">시나리오</button>
    </div>

    <div id="free_field1"></div>
    <div id="sce_field1"></div>
   
    <div id="free_field2"></div>
    <div id="sce_field2"></div>
    <div id="sce_field3"></div>
    <div id="sce_field4"></div>

    <div id="space"></div>


    <?php
        include "../common/footer.php"
    ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript">
             var el_count = 1;      //초기에 버튼생성을 구분하기 위해 1로 설정  
        var mid_count = 1;

        $('#free').click(function(){
            // document.getElementById('el').innerHTML = el_count;      // id값 el에 el_count 넣어서 확인, id값이지만 #를 붙이면 안됨
            if(el_count == 1){
                $('#free_field1').append(createEl1());      //append() : 컨텐츠를 선택된 요소 내부의 끝 부분에서 삽입
                $('#free_field2').append(createEl2());   
                $('#sce_field1').empty();
                $('#sce_field2').empty();    
                $('#sce_field3').empty();  
                $('#sce_field4').empty();  
            }
            else if(el_count == 0){
                el_count = 1;
                $('#free_field1').empty(); 
                $('#free_field2').empty();
            }
        });

        $('#sce').click(function(){
            // document.getElementById('mid').innerHTML = mid_count;
            if(mid_count == 1){
                $('#sce_field1').append(createMid1());
                $('#sce_field2').append(createMid2());
                $('#sce_field3').append(createMid3());
                $('#sce_field4').append(createMid4());
                $('#free_field1').empty();     //remove 사용시 이벤트까지 제거 되므로 empty()로 대체
                $('#free_field2').empty();     
            }
            else if(mid_count == 0){
                mid_count = 1;
                $('#sce_field1').empty();
                $('#sce_field2').empty();
                $('#sce_field3').empty();  
                $('#sce_field4').empty();  
            }
        });
        
        function createEl1(){
            var el_result1;
            el_result1 = "<a href='./freeNotice.php'><button class='btn btn-primary'>자유게시판</button></a>";
            el_count = 0;
            mid_count = 1;
            return el_result1; 
        }

        function createEl2(){
            var el_result2;
            el_result2 = "<a href='./vote_notice.php'><button class='btn btn-primary'>투표게시판</button></a>";
            el_count = 0;
            mid_count = 1;
            return el_result2; 
        }

        function createMid1(){
            var mid_result1;
            mid_result1 = "<a href='./scenarioWrite.php'><button class='btn btn-info'>초등코스<br>시나리오<br>생성 및 편집</button></a>";
            mid_count = 0;
            el_count = 1;
            return mid_result1;
        }

        function createMid2(){
            var mid_result2;
            mid_result2 = "<a href='./mid_scenarioWrite.php'><button class='btn btn-success'>중등코스<br>시나리오<br>생성 및 편집</button></a>";
            mid_count = 0;
            el_count = 1;
            return mid_result2;
        }

        function createMid3(){
            var mid_result2;
            mid_result2 = "<a href='./scenario_view_notice.php'><button class='btn btn-info'>초등 시나리오<br>관람</button></a>";
            mid_count = 0;
            el_count = 1;
            return mid_result2;
        }

        function createMid4(){
            var mid_result2;
            mid_result2 = "<a href='./mid_scenario_view_notice.php'><button class='btn btn-success'>중등 시나리오<br>관람</button></a>";
            mid_count = 0;
            el_count = 1;
            return mid_result2;
        }



    </script>
</body>
</html>