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
    <title>회원가입</title>

    <script>
        function checkid(){
            var userid = document.getElementById("uid").value;
            if(userid){
                url ="check.php?userid="+userid;
                window.open(url, "chkid", "width=450, height=150");
            }
            else{
                alert("아이디를 입력하세요");
            }
        }
    </script>
</head>
<body style="margin:0;">

    <div id="admission_area">
        <form method="post" id="login_box" name="adform">
            <div id="login_box_1"><a href="../../index.php"><img src="../../img/webicon_big.png"></a></div>

            <div id="admission_box_1">
                <h3>회원가입</h3>

                <div id="idbox">
                    <input type="text" id="uid" class="form-control" name="userid" placeholder="ID를 입력해주세요" required="required">
                    <input type="hidden" value="0" name="chs" id="hidden_chs">
                    <button class="btn btn-primary" value="중복검사" onclick="checkid();">중복검사</button>
                </div>
   
                <input type="password" class="form-control" name="userpw" placeholder="PW를 입력해주세요" required="required">

                <input type="password" class="form-control" name="checkpw" placeholder="패스워드 재확인" required="required">

                <h5>소속(명칭)</h5>
                <input type="text" class="form-control" name="attach" placeholder="자신을 구분하고자 할 소속을 입력해주세요">

                <h5>Group</h5>
                <select name="seltype" id="sel_type" class="form-control">
                    <option value="student">학생</option>
                    <option value="teacher">교육자</option>
                    <!-- <option value="manager">관리자</option> -->
                </select>

                <div id="in_mail">
                    <input type="text" class="form-control" name="mail" placeholder="메일주소" required="required"> 
                    <select name="mailadd" class="form-control">
                        <option value="naver.com">@naver.com</option>
                        <option value="daum.net">@daum.net</option>
                        <option value="gmail.com">@gmail.com</option>
                    </select>
                </div>

                <input type="text" class="form-control" name="phonenum" placeholder="전화번호 입력 : ex) 010-XXXX-XXXX" required="required">

                <h5>학교 명</h5>
                <input type="text" class="form-control" name="school_name" placeholder="학교명을 입력해주세요 ex)OO중학교/OO초등학교" required="required">

                <h5>학급/학년</h5>
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

                <h5>Gender</h5>
                <div id="radio_area">
                    <input type="radio"  name="gender" value="woman" checked="checked"><span> 여</span>
                    <input type="radio"  name="gender" value="man"><span> 남</span>
                </div>
                
            </div>
            <div id="login_box_3">
                <button id="admission_btn" class="btn btn-primary">회원가입</button>
            </div>

            <div id="login_box_3">
                <button type="reset"  id="reset_btn" class="btn btn-primary">RESET</button>
            </div>
        </form>
            <!-- <div id="login_box_3">
                <a href="./loginMain.php"><button type="reset" class="btn btn-primary">돌아가기</button></a>
            </div> -->
            <!-- <button id="admission_btn_2">확인</button> -->

    </div>


    <div id="login_footer_copyright">
        <p>개인정보처리방침 | 저작권정책 | 업무별전화번호안내 | 이용안내</p>
        <a href="../../index.php"><img src="../../img/main_icon.png"></a>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
    <script>

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

        $("#el_cls_btn").click(function(){
            console.log($("select[name=el_class]").val());
        });

        $("#mid_cls_btn").click(function(){
            console.log($("select[name=mid_class]").val());
        });

        $("#admission_btn_2").click(function(){
            console.log(document.getElementsByName("chs")[0].attributes[1].value);
        });

        $("#admission_btn").click(function(){
            console.log(document.getElementsByName("chs")[0].attributes[1].value);
            if(document.getElementsByName("chs")[0].attributes[1].value == "-1"){
                $("#admission_btn").attr('disabled', 'disabled');
                alert("ID가 중복 되었습니다. RESET 버튼을 클릭해주세요.");
            }
            else if(document.getElementsByName("chs")[0].attributes[1].value == "0"){
                $("#admission_btn").attr('disabled', 'disabled');
                alert("ID를 검사를 하지 않았습니다. RESET 버튼을 클릭해주세요");
            }
            else{   //ID체크가 완료된 경우

                if(document.getElementsByName("userpw")[0].value == document.getElementsByName("checkpw")[0].value){
                    if($("select[name=seltype]").val() == "teacher"){
                        // 선생일 경우 승인을 하는 페이지로 전송
                        // #login_box -> form요소id
                        $("#login_box").attr("action", "./admin_chk.php");
                    }
                    else if($("select[name=seltype]").val() == "student"){
                        // 학생일 경우 승인절차 없이 form 요소를 회원가입하는 페이지로 전송
                        $("#login_box").attr("action", "./admission_ok.php");
                    }
                }
                else{
                    alert("비밀번호가 다릅니다. 다시 입력해주세요");
                }


            }

        });

        $("#reset_btn").click(function(){
            $("#admission_btn").removeAttr('disabled');
            location.reload();
        });

        // console.log($("select[name=school]").val());
    </script>
</body>
</html>