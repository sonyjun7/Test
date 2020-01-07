<?php
    include "../common/db.php";

    $session = $_SESSION['userid'];

    if(!isset($_SESSION['userid'])){
        echo "<script> alert('회원만 접근할 수 있습니다.'); location.href='../../index.php'; </script>";
    }
    else{
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Do+Hyeon|Jua|Nanum+Gothic+Coding" rel="stylesheet">
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/common_css/common.css">
    <link rel="stylesheet" href="../../css/userEnter_css/scenario.css">
    <link rel="stylesheet" href="../../css/userEnter_css/vote.css">
    <title>투표 생성</title>
</head>
<body>

    <?php
        include "../common/header.php"
    ?>

    <div id="hNotice">
        <h2>투표 생성</h2>
        <img src="../../img/main_pic_02.png">
    </div>

    <div id="voteWrite_area">
        <form method="post" id="vform_box" name="vform_name">
            <div id="vtit1_area">
                <div id="vtit1">
                    <h4>제목</h4>
                </div>

                <div id="vtit2">
                    <textarea name="vtit_tarea" id="vtit_tarea" class="form-control" placeholder="투표 제목을 입력해주세요"></textarea>
                </div>
            </div>

            <div id="vtit1_area">
                <div id="vtit1">
                    <h4>투표 학교명</h4>
                </div>

                <div id="vtit2">
                    <textarea name="vote_school" id="vtit_tarea" class="form-control" placeholder="투표할 학교명을 입력해주세요"></textarea>
                </div>
            </div>
        
            <div id="vote_gubun">
                <div id="vtit1">
                    <h4>투표학급</h4>
                </div>

                    <div id="edu_course">
                        <select name="school" id="sc_btn" class="form-control">
                            <option value="element">초등학교</option>
                            <option value="midlle">중학교</option>
                        </select>

                        <select name="el_class" id="el_cls_btn" class="form-control">
                            <option value="1">1학년</option>
                            <option value="2">2학년</option>
                            <option value="3">3학년</option>
                            <option value="4">4학년</option>
                            <option value="5">5학년</option>
                            <option value="6">6학년</option>
                        </select>

                        <select name="mid_class" id="mid_cls_btn" class="form-control">
                            <option value="1">1학년</option>
                            <option value="2">2학년</option>
                            <option value="3">3학년</option>  
                        </select>

                        <select name="s_class" class="form-control">
                            <option value="A">A반</option>
                            <option value="B">B반</option>
                            <option value="C">C반</option>
                            <option value="D">D반</option>
                        </select>
                    </div>
            </div>

        <div id="votevotediv">
            <div id="votevote">
                <div id="vtit1">
                    <h4>관광지 투표 1.</h4>
                </div>

                <div id="vtit2">
                    <textarea name="vote_input1" id="vot1" class="form-control vote_input" placeholder="투표할 관광지를 입력해주세요"></textarea>
                </div>
            </div>
        </div>
        <div id="votevotediv2"></div>
        <div id="votevotediv3"></div>
        <div id="votevotediv4"></div>
        <div id="votevotediv5"></div>
        </form>

        <div id="vote_submit">
            <button class="btn btn-primary" id="vote_regist">투표 등록</button>
        </div>

        <div id="vote_navi">
            <i class="fas fa-angle-double-down fa-2x"></i>
            <p>* 투표추가/삭제 버튼 최대 5개까지 가능</p>
            <p>* 투표생성 시 순서대로 생성해 주세요</p>
            <div>
                <button class="btn btn-primary" id="vote_add2">장소 2번 추가</button>
                <button class="btn btn-info" id="del2" >삭제</button>
            </div>

            <div>
                <button class="btn btn-primary" id="vote_add3">장소 3번 추가</button>
                <button class="btn btn-info" id="del3" >삭제</button>
            </div>

            <div>
                <button class="btn btn-primary" id="vote_add4">장소 4번 추가</button>
                <button class="btn btn-info" id="del4" >삭제</button>
            </div>

            <div>
                <button class="btn btn-primary" id="vote_add5">장소 5번 추가</button>
                <button class="btn btn-info" id="del5" >삭제</button>
            </div>
        </div>


    </div>

    <?php
        include "../common/footer.php"
    ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
    <script>
    $(document).ready(function(){
        // var votecnt = 2;
        var vote2 = 0;
        var vote3 = 0;
        var vote4 = 0;
        var vote5 = 0;

        $("#sc_btn").click(function(){
            // 초등학교 선택 시 6학년까지만 보이게
            // select 박스 name=school의 option값이(val()) element인 경우 초등학생 아닐 경우 중학생
            if($("select[name=school]").val() == "element"){
                console.log("초딩");
                $("#el_cls_btn").css("display","block");
                $('#mid_cls_btn').css("display","none");
            }
            // 중학교 선택 시 3학년까지만 보이게
            else {
                console.log("중딩");
                $('#mid_cls_btn').css("display","block");
                $("#el_cls_btn").css("display","none");
            }
         });


         $("#vote_add2").click(function(){
            if(vote2 == 0){
                $("#votevotediv2").append(createEl2());
                // console.log($("#votevotediv2")[0]);
                vote2 = 1;
            }
            else{
                alert("이미 생성되어 있거나 투표 순서가 맞지 않습니다.");
                console.log("이미 생성되어 있음");
            }

         });

         $("#vote_add3").click(function(){
             if(vote3 == 0 && vote2 == 1){
                $("#votevotediv3").append(createEl3());
                vote3 = 1;
             }
             else{
                alert("이미 생성되어 있거나 투표 순서가 맞지 않습니다.");
                console.log("장소3가 이미 생성되어 있음");
             }
         });

         $("#vote_add4").click(function(){
             if(vote4 == 0 && vote3 == 1){
                $("#votevotediv4").append(createEl4());
                vote4 = 1;
             }
             else{
                alert("이미 생성되어 있거나 투표 순서가 맞지 않습니다.");
                 console.log("장소4가 이미 생성되어 있음");
             }

         });
         
         $("#vote_add5").click(function(){
             if(vote5 == 0 && vote4 == 1){
                $("#votevotediv5").append(createEl5());
                vote5 = 1;
             }
             else{
                alert("이미 생성되어 있거나 투표 순서가 맞지 않습니다.");
                 console.log("장소5가 이미 생성되어 있음");
             }

         });


         function createEl2(){
            var el_result2;

            el_result2 = "<div id='votevote' class='voteclass2'><div id='vtit1'><h4>관광지 투표 2.</h4></div><div id='vtit2'><textarea name='vote_input2' id='vot2' class='form-control vote_input' placeholder='투표할 관광지를 입력해주세요'></textarea></div></div>";

            return el_result2; 
         }

         function createEl3(){
            var el_result3;

            el_result3 = "<div id='votevote' class='voteclass3'><div id='vtit1'><h4>관광지 투표 3.</h4></div><div id='vtit2'><textarea name='vote_input3' class='form-control vote_input' placeholder='투표할 관광지를 입력해주세요'></textarea></div></div>";
           
            return el_result3; 
        }

        function createEl4(){
            var el_result4;

            el_result4 = "<div id='votevote' class='voteclass4'><div id='vtit1'><h4>관광지 투표 4.</h4></div><div id='vtit2'><textarea name='vote_input4' class='form-control vote_input' placeholder='투표할 관광지를 입력해주세요'></textarea></div></div>";

            return el_result4; 
        }

        function createEl5(){
            var el_result5;

            el_result5 = "<div id='votevote' class='voteclass5'><div id='vtit1'><h4>관광지 투표 5.</h4></div><div id='vtit2'><textarea name='vote_input5' class='form-control vote_input' placeholder='투표할 관광지를 입력해주세요'></textarea></div></div>";

            return el_result5; 
        }

         $("#vote_regist").click(function(){
             if($("#vtit_tarea")[0].value == ""){
                 alert("제목을 입력해주세요");
             }
             else if($("#vot1")[0].value == ""){
                alert("투표장소를 하나이상 입력해주세요");
             }
             else if($("#vot2")[0].value == ""){
                 alert("투표장소를 하나이상 입력해주세요");
             }
             else if($("#vtit_tarea")[0].value != "" && $("#vot1")[0].value != ""){
                $("#vform_box").attr("action", "./voteWrite_ok.php");
                $("#vform_box").submit();
             }

         });

         $("#del2").click(function(){   
            $("#votevotediv2").empty();
            vote2 = 0;

            if(vote3 == 1){
                $("#votevotediv3").empty();
                alert("2번 삭제시 하위 투표도 같이 삭제 됩니다.");
                vote3 = 0;
            }
            if(vote4 == 1){
                $("#votevotediv4").empty();
                alert("2번 삭제시 하위 투표도 같이 삭제 됩니다.");
                vote4 = 0;
            }
            if(vote5 == 1){
                $("#votevotediv5").empty();
                alert("2번 삭제시 하위 투표도 같이 삭제 됩니다.");
                vote5 = 0;
            }
         });

         $("#del3").click(function(){   
            $("#votevotediv3").empty();
            vote3 = 0;

            if(vote4 == 1){
                $("#votevotediv4").empty();
                alert("3번 삭제시 하위 투표도 같이 삭제 됩니다.");
                vote4 = 0;
            }
            if(vote5 == 1){
                $("#votevotediv5").empty();
                alert("3번 삭제시 하위 투표도 같이 삭제 됩니다.");
                vote5 = 0;
            }
         });

         $("#del4").click(function(){   
            $("#votevotediv4").empty();
            vote4 = 0;

            if(vote5 == 1){
                $("#votevotediv5").empty();
                alert("4번 삭제시 하위 투표도 같이 삭제 됩니다.");
                vote5 = 0;
            }
         });

         $("#del5").click(function(){   
            $("#votevotediv5").empty();
            vote5 = 0;
         });

    });

    </script>
</body>
</html>
<?php

    }

?>