<?php
    include "../common/db.php";
    if(isset($_SESSION['userid'])){
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
    <link rel="stylesheet" href="../../css/member_css/myPage.css">
    <title>회원정보수정</title>
</head>
<body>

    <?php
        include "../common/header.php"
    ?>

    <div id="hNotice">
        <h2>정보수정하기</h2>
        <img src="../../img/main_pic_02.png">
    </div>

    <div id="profile2">
        <img src="../../img/blank_profile.png">
    </div>

    <div id="admission_area">
        <form action="./myInfoUpdate_ok.php" method="post" id="login_box">
            <?php
                $sql = mq("select * from member where id='".$_SESSION['userid']."'");
                $member = $sql -> fetch_array();
            ?>
            <div id="admission_box_1">
                <h5>ID확인</h5>
                <div id="idbox">
                    <input type="text" id="uid" class="form-control" name="userid" required="required" value="<?php echo $_SESSION['userid'] ?>">
                </div>

                <h5>소속(명칭)</h5>
                <div id="idbox">
                    <input type="text" id="uid" class="form-control" name="attach" required="required" value="<?php echo $member['attach'] ?>">
                </div>
                
                <h5>Type</h5>
                <select name="seltype" id="sel_type" class="form-control">
              
                    <?php 
                        if($member['group'] == "student"){
                    ?>
                        <option value="student">학생</option>
                  
                    <?php
                        } else if($member['group']  == "teacher"){
                    ?>
                        <option value="teacher">교육자</option>
        
                    <?php
                        } else if($member['group']  == "manager"){
                    ?>
                        <option value="manager">관리자</option>
                    <?php
                        }
                    ?>
                </select>

                <h5>Mail확인</h5>
                <div id="in_mail">
                    <input type="text" class="form-control" name="mail" required="required" value="<?php echo $member['mail'] ?>"> 
                </div>

                <h5 id="ph">Phone</h5>
                <input type="text" class="form-control" name="phonenum" required="required" value="<?php echo $member['p_num'] ?>">

                <h5>학교 명</h5>
                <input type="text" class="form-control" name="school_name" required="required" value="<?php echo $member['school'] ?>">

                <h5>학급/학년</h5>
                <div id="edu_course">
                    <select name="school" id="sc_btn" class="form-control">
                    <?php
                            // explode() : split과 같은 기능을 하는 함수로 특정 문자열을 구분하여 배열에 담을 수 있다.
                            $split = explode(",", $member['edu_course']);
                            // echo $split[0];
                            if($split[0] == "element"){
                    ?>
                                <option value="element">초등학교</option>
                                <option value="midlle">중학교</option>
                        <?php
                            } else if($split[0] == "midlle"){
                        ?>
                                <option value="midlle">중학교</option>
                                <option value="element">초등학교</option>
                        <?php
                            } else {
                        ?>
                                <option value="">NULL</option>
                        <?php
                            }
                        ?>
                    </select>

     
                        <?php
                            if($split[0] == "element"){ // 현재 회원의 학년이 최상단
                        ?>
                        <select name="el_class" id="el_cls_btn" class="form-control">
                                <option value="<?php echo $split[1] ?>"><?php echo $split[1] ?>학년</option>
                        <?php
                            for($i=1; $i<=6; $i++){
                                if($i == $split[1]){    //for문 반복시 $i번과 현재 회원의 학년이 같을 경우 넘어가기
                                    continue;
                                }else{  // 현재 회원과 같은 학년빼고 나머지 생성
                        ?>
                                <option value="<?php echo $i ?>"><?php echo $i?>학년</option>
                        <?php
                                }
                            }
                        ?>
                        </select>
                            <!-- 정보수정에서 다른학급(중학교) 선택 시 그에 해당하는 학년 선택을 위해 diplay:none인 상태였다가 중학교 선택 시 활성화 -->
                            <select name="mid_class" id="mid_cls_btn" class="form-control" style="display:none;"> 
                                <option value="1">1학년</option>
                                <option value="2">2학년</option>
                                <option value="3">3학년</option>  
                            </select>
                        <?php
                            }
                        ?>

                    <?php
                              if($split[0] == "midlle"){ // 현재 회원의 학년이 최상단
                        ?>
                        <select name="mid_class" id="mid_cls_btn" class="form-control">
                                <option value="<?php echo $split[1] ?>"><?php echo $split[1] ?>학년</option>
                        <?php
                            for($i=1; $i<=3; $i++){
                                if($i == $split[1]){    //for문 반복시 $i번과 현재 회원의 학년이 같을 경우 넘어가기
                                    continue;
                                }else{
                        ?>
                                <option value="<?php echo $i ?>"><?php echo $i?>학년</option>
                        <?php
                                 }
                             }
                        ?>
                        </select>
                             <!-- 정보수정에서 다른학급(초등학교) 선택 시 그에 해당하는 학년 선택을 위해 diplay:none인 상태였다가 초등학교 선택 시 활성화 -->
                            <select name="el_class" id="el_cls_btn" class="form-control" style="display:none;">
                                <option value="1">1학년</option>
                                <option value="2">2학년</option>
                                <option value="3">3학년</option>
                                <option value="4">4학년</option>
                                <option value="5">5학년</option>
                                <option value="6">6학년</option>
                            </select>
                        <?php
                            }
                            if($member['group'] == "manager"){
                        ?>
                            <select class="form-control">
                                <option value="">NULL</option>
                            </select>
                                
                        <?php
                            }
                        ?>

                    <select name="s_class" class="form-control">
                        <option value="<?php echo $split[2] ?>"><?php echo $split[2] ?>반</option>
                        <?php
                            $sub_class = range('A', 'D');   // A~D까지 문자열 배열에 담기

                            for($j=0; $j<count($sub_class); $j++){
                                if($sub_class[$j] == $split[2]){
                                    continue;
                                } else{
                        ?>
                                    <option value="<?php echo $sub_class[$j] ?>"><?php echo $sub_class[$j] ?>반</option>
                        <?php
                                }
                            }
                        ?>
                    </select>
                </div>

                <h5>Gender</h5>
                <div id="radio_area">
                    <?php
                        if($member['gender'] == "woman"){
                    ?>
                            <input type="radio"  name="gender" value="woman" checked="checked"><span> 여</span>
                            <input type="radio"  name="gender" value="man"><span> 남</span>
                    <?php
                        }else{
                    ?>
                            <input type="radio"  name="gender" value="woman"><span> 여</span>
                            <input type="radio"  name="gender" value="man" checked="checked"><span> 남</span>
                    <?php
                        }
                    ?>

                </div>
                
            </div>

            <div id="login_box_3">
                <a><button class="btn btn-primary">회원정보수정</button></a>
            </div>
            <?php } ?>
        </form>
    </div>

    <?php
        include "../common/footer.php"
    ?>

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
    
    </script>
</body>
</html>
    <?php if(!isset($_SESSION['userid'])){
        echo "<script> alert('잘못된접근입니다.');  history.back(); </script>";
    }
    ?>