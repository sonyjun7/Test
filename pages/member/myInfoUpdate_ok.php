<?php
    include "../common/db.php";

    $session = $_SESSION['userid'];
    $id = $_POST['userid'];
    $attach = $_POST['attach'];
    $group = $_POST['seltype'];
    $mail = $_POST['mail'];
    $phone = $_POST['phonenum'];
    $school = $_POST['school_name'];
    $gender = $_POST['gender'];

    if($_POST['school'] == "element"){
        $edu_course = $_POST['school'].','.$_POST['el_class'].','.$_POST['s_class'];
    }
    if($_POST['school'] == "midlle"){
        $edu_course = $_POST['school'].','.$_POST['mid_class'].','.$_POST['s_class'];
    }

    // echo $id, "<br>";
    // echo $attach, "<br>";
    // echo $group, "<br>";
    // echo $mail, "<br>";
    // echo $phone, "<br>";
    // echo $gender, "<br>";
    // echo $edu_course, "<br>";
    // echo $school, "<br>";

    $mq0 = mq("select * from member where id='".$id."'");
    $idcheck = $mq0 -> fetch_array();

    // 변경하려는 아이디가 이미 존재하는 경우 
    if($idcheck['id'] != ""){
        if($idcheck['id'] == $session){
            // 아이디를 변경하지 않았을 경우 세션과 동일하므로 아래 else문을 작동하지 않도록함
            
        }else{
            echo "<script> alert('해당아이디가 존재합니다.'); location.href='./myPage.php'; </script>";
        }

    }
        $mq1 = mq("select * from member where `group`='".$group."' and edu_course='".$edu_course."' and school='".$school."'");

        $chk_edu = $mq1 -> fetch_array();

        if($group == "teacher"){
            // 해당학급과 학교명이 같지만 아이디가 다른 경우 다른 교육자가 존재하는 것이므로 history.back();
            if($chk_edu['edu_course'] == $edu_course && $chk_edu['school'] == $school && $chk_edu['id'] != $session){
                echo "<script type='text/javascript'>alert('현재 학급에 교육자가 존재합니다. 다른 학급으로 변경해주세요.')</script>";
                echo "<script> location.href='./myPage.php'; </script>";
            }else{
            //     // 현재 정보수정을 하기 전의 담임 edu_course확인
            //     $sql0 = mq("select * from member where id='".$session."'");
            //     // $sql0 = mq("select * from student where teacher_id='".$id."'");

            //     $tidchk = $sql0 -> fetch_array();

            //     if($tidchk['school'] != "" && $tidchk['edu_course']){
            //         echo "<script> alert('.'); location.href='./myPage.php'; </script>";
            //     }

            // // 기존의 edu_course에 담임의 iD와 소속이 있다면, edu_course가 바뀌기 때문에 비워준다.
            //     if($tidchk['edu_course'] != "" && $tidchk['school'] != ""){
            //         $sql2 = mq("update student set teacher_id='NULL', teacher_attach='NULL' where edu_course='".$tidchk['edu_course']."' and stu_school='".$tidchk['school']."'");
            //     }
            //     else{
            //         // 학생명부 테이블의 edu_course(학급)이 같은 학생명단의 담임ID, 담임 소속 을 수정
            //         $mq2 = mq("update student set teacher_id='".$id."' , teacher_attach='".$attach."' where edu_course='".$edu_course."' and stu_school='".$school."'");
            //     }
   
                // 교육자의 id와 attach가 바뀌었을 경우 
                $sql0 = mq("select * from student where edu_course='".$edu_course."' and stu_school='".$school."'");

                // 해당 학교와 학급/학년이 일치하는 학생의 정보도 같이 수정해준다.
                while($stuchk = $sql0 -> fetch_array()){
                    if($stuchk['edu_course'] != "" && $stuchk['stu_school'] != ""){
                        $sql1 = mq("update student set teacher_id='".$id."', teacher_attach='".$attach."' where edu_course='".$stuchk['edu_course']."' and stu_school='".$stuchk['stu_school']."'");
                    }
                }
                
                // 회원정보 수정
                $sql = mq("update member set id='".$id."', attach='".$attach."' , `group`='".$group."', mail='".$mail."', p_num='".$phone."', gender='".$gender."', edu_course='".$edu_course."', school='".$school."', response_teacher='".$id."' where id='".$_SESSION['userid']."'");

                // 학생 회원의 담임선생ID 수정
                // 바꾼 학교명과 학급이 있는 학생을 select
                $mq2 = mq("select * from member where school='".$school."' and edu_course='".$edu_course."'");
                $memcheck = $mq2 -> fetch_array();
                // 학생의 학교명 == 바꾼 선생의 학교명 이고 학생의 학급 == 바꾼 선생의 학급
                // 일 경우 해당 학교와 학급의 학생의 담당 선생 아이디를 변경
                if($memcheck['school'] == $school && $memcheck['edu_course'] == $edu_course){
                        $mq3 = mq("update member set response_teacher='".$id."' where edu_course='".$edu_course."' and school='".$school."' and `group`='student'");
                    }
                

                echo "<script> alert('회원정보가 수정되었습니다.'); location.href='./myPage.php'; </script>";
            }
        }
        else{
            $sql = mq("update member set id='".$id."', attach='".$attach."' , `group`='".$group."', mail='".$mail."', p_num='".$phone."', gender='".$gender."', edu_course='".$edu_course."', school='".$school."' where id='".$_SESSION['userid']."'");

            echo "<script> alert('회원정보가 수정되었습니다.'); location.href='./myPage.php'; </script>";
        }

        // 회원정보 수정후 해당 아이디로 세션을 변경
        $_SESSION['userid'] = $id;
        
        // echo "<script> alert('회원정보가 수정되었습니다.'); location.href='./myPage.php'; </script>";
    
?>
