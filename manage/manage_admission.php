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
    
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/common_css/common.css">
    <link rel="stylesheet" href="./mg_style.css">
    <title>관리자 회원가입</title>

    <script>
        function checkid(){
            var userid = document.getElementById("uid").value;
            if(userid){
                url ="./mg_check.php?userid="+userid;
                window.open(url, "chkid", "width=450, height=150");
            }
            else{
                alert("아이디를 입력하세요");
            }
        }

        // function checkmanage(){
        //     var mgcode = document.getElementById("managecode").value;
        //     if(mgcode){
        //         url2 = "./mgcode_check.php?mgcode="+mgcode;
        //         window.open(url2, "chkmg", "width=450, height=150");
        //     }
        //     else{
        //         alert("관리자 코드를 입력해주세요");
        //     }
        // }
    </script>
</head>
<body style="margin:0;">

    <div id="admission_area">
        <form method="post" id="login_box" name="adform">
            <div id="login_box_1"><a href="./index.php"><img src="../../img/webicon_big.png"></a></div>

            <div id="admission_box_1">
                <h3>* 관리자 회원가입 *</h3>

                <div id="idbox">
                    <input type="text" id="uid" class="form-control" name="userid" placeholder="ID를 입력해주세요" required="required">
                    <input type="hidden" value="0" name="chs" id="hidden_chs">
                    <button class="btn btn-primary" value="중복검사" onclick="checkid();">중복검사</button>
                </div>
   
                <input type="password" class="form-control" name="userpw" placeholder="PW를 입력해주세요" required="required">

                <h5>관리자 소속</h5>
                <input type="text" class="form-control" name="attach" placeholder="자신을 구분하고자 할 소속을 입력해주세요">

                <!-- <div id="idbox">
                <h5>관리자 코드</h5>
                    <input type="text" id="managecode" class="form-control" name="attach" placeholder="관리자 승인 코드 입력">
                    <input type="hidden" value="0" name="mgs" id="hidden_mgs">
                    <button class="btn btn-primary" value="관리자코드검사" onclick="checkmanage();">관리자코드검사</button>
                </div> -->
              

                <div id="group_div">
                    <h5 id="grh5">Group</h5>
                    <select name="seltype" id="sel_type" class="form-control">
                        <option value="manager">관리자</option>
                    </select>
                </div>


                <div id="in_mail">
                    <input type="text" class="form-control" name="mail" placeholder="메일주소" required="required"> 
                    <select name="mailadd" class="form-control">
                        <option value="naver.com">@naver.com</option>
                        <option value="daum.net">@daum.net</option>
                        <option value="gmail.com">@gmail.com</option>
                    </select>
                </div>

                <input type="text" class="form-control" name="phonenum" placeholder="전화번호 입력 : ex) 010-XXXX-XXXX" required="required">


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

        // $("#admission_btn_2").click(function(){
        //     document.getElementsByName("chs")[0].attributes[1].value;
        // });

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
            else{
                if($("select[name=seltype]").val() == "manager"){
                    // 매니저인 경우 승인을 하는 페이지로 전송
                    // #login_box -> form요소id
                    $("#login_box").attr("action", "./mg_admission_ok.php");
                }
            }

            // if(document.getElementsByName("mgs")[0].attributes[1].value == "-1"){
            //     $("#admission_btn").attr('disabled', 'disabled');
            //     alert("관리자 코드가 맞지 않습니다. RESET 버튼을 클릭해주세요");
            // }
            // else if(document.getElementsByName("mgs")[0].attributes[1].value == "0"){
            //     $("#admission_btn").attr('disabled', 'disabled');
            //     alert("관리자 코드를 검사 하지 않았습니다. RESET 버튼을 클릭해주세요");
            // }
        });

        $("#reset_btn").click(function(){
            $("#admission_btn").removeAttr('disabled');
            location.reload();
        });

        // console.log($("select[name=school]").val());
    </script>
</body>
</html>