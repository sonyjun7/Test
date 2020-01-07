<?php
    include "../common/db.php";

?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Do+Hyeon|Jua|Nanum+Gothic+Coding" rel="stylesheet">
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/common_css/common.css">
    <link rel="stylesheet" href="../../css/tourism_css/tourism.css">
    <title>교육관광 메인페이지</title>
</head>
<body>

    <?php
        include "../common/header.php"
    ?>

    <div id="hNotice">
        <h2>교육관광</h2>
        <img src="../../img/main_pic_02.png">
    </div>

    <div id="select_edu">
        <h3>교육과정 학년 선택</h3>
        <button class="btn btn-warning" id="el">초등교육관광</button> 
        <button class="btn btn-success" id="mid">중등교육관광</button>
    </div>

    <div id="el_field1"></div>
    <div id="mid_field1"></div>
   
    <div id="el_field2"></div>
    <div id="mid_field2"></div>
    
    <div id="space"></div>

    <?php
        include "../common/footer.php"
    ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        var el_count = 1;      //초기에 버튼생성을 구분하기 위해 1로 설정  
        var mid_count = 1;

        $('#el').click(function(){
            // document.getElementById('el').innerHTML = el_count;      // id값 el에 el_count 넣어서 확인, id값이지만 #를 붙이면 안됨
            if(el_count == 1){
                $('#el_field1').append(createEl1());      //append() : 컨텐츠를 선택된 요소 내부의 끝 부분에서 삽입
                $('#el_field2').append(createEl2());   
                $('#mid_field1').empty();
                $('#mid_field2').empty();    
            }
            else if(el_count == 0){
                el_count = 1;
                $('#el_field1').empty(); 
                $('#el_field2').empty();
            }
        });

        $('#mid').click(function(){
            // document.getElementById('mid').innerHTML = mid_count;
            if(mid_count == 1){
                $('#mid_field1').append(createMid1());
                $('#mid_field2').append(createMid2());
                $('#el_field1').empty();     //remove 사용시 이벤트까지 제거 되므로 empty()로 대체
                $('#el_field2').empty();     
            }
            else if(mid_count == 0){
                mid_count = 1;
                $('#mid_field1').empty();
                $('#mid_field2').empty();
            }
        });
        
        function createEl1(){
            var el_result1;
            el_result1 = "<a href='./el_index.php'><button class='btn btn-primary'>정보게시판</button></a>";
            el_count = 0;
            mid_count = 1;
            return el_result1; 
        }

        function createEl2(){
            var el_result2;
            el_result2 = "<a href='./el_webGL_select.php'><button class='btn btn-primary'>웹 체험관</button></a>";
            el_count = 0;
            mid_count = 1;
            return el_result2; 
        }

        function createMid1(){
            var mid_result1;
            mid_result1 = "<a href='./mid_index.php'><button class='btn btn-primary'>정보게시판</button></a>";
            mid_count = 0;
            el_count = 1;
            return mid_result1;
        }

        function createMid2(){
            var mid_result2;
            mid_result2 = "<a href='./mid_webGL_select.php'><button class='btn btn-primary'>웹 체험관</button></a>";
            mid_count = 0;
            el_count = 1;
            return mid_result2;
        }

    </script>
</body>
</html>