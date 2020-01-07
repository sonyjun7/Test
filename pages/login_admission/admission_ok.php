<?php
    include "../common/db.php";

    $userid = $_POST['userid'];
    $userpw = password_hash($_POST['userpw'], PASSWORD_DEFAULT);
    $attach = $_POST['attach'];
    $group = $_POST['seltype'];
    $mail = $_POST['mail'].'@'.$_POST['mailadd'];
    $phonenum = $_POST['phonenum'];
    $school = $_POST['school_name'];

    if($_POST['school'] == "element"){
        $edu_course = $_POST['school'].','.$_POST['el_class'].','.$_POST['s_class'];
    }
    if($_POST['school'] == "midlle"){
        $edu_course = $_POST['school'].','.$_POST['mid_class'].','.$_POST['s_class'];
    }

    $gender = $_POST['gender'];

    // echo $userid ,"<br/>";
    // echo $userpw,"<br/>";
    // echo $attach,"<br/>";
    // echo $group,"<br/>";
    // echo $mail,"<br/>";
    // echo $phonenum,"<br/>";
    // echo $edu_course,"<br/>";
    // echo $gender,"<br/>";
    // echo $_POST['school'], "<br/>";
    // echo $_POST['mid_class'], "<br/>";
    // echo $_POST['s_class'];

    // if($group == "teacher"){
    //     // 기존에 가입되어 있는 교육자 중에 선택한 edu_course와 edu_course가 있는지 확인
    //     $mq1 = mq("select edu_course from member where `group`='".$group."' and edu_course='".$edu_course."'");

    //     $chk_group = $mq1 -> fetch_array();

    //     // 만약 group이 교육자인 사람이 기존에 가입되어 있는 교육자의 edu_course(학급/학년)와 같은 것을 선택 후 가입할 경우
    //     if($chk_group['edu_course'] != ""){
    //         echo "<script type='text/javascript'>alert('현재 학급에 교육자가 존재합니다. 다른 학급으로 변경해주세요.')</script>";
    //         echo "<script> history.back(); </script>";
    //     }
    //     else{
    //         // 그룹이 교육자일 경우 해당 방식으로 insert, reponse_teacher는 교육자 본인 이므로 본인의 ID를 insert
    //         // 주의)) 해당 member  내의 컬럼명 type을 group으로 변경하였는데
    //         // 기존 insert into member(id,pw,group....)식으로 하니깐 저장이 안되며 문법 오류가 난다.
    //         // 변경할때 ALTER TABLE member CHANGE `type` `group` VARCHAR(100) 으로 해줬는데
    //         // ` 기호로 변경해줬기 때문인지 insert into member(id, pw , `group` ...) 으로 해줘야 정상적으로 저장이 되는 것을 확인했다.
    //         $sql = mq("insert into member (id, pw, `group`, mail, p_num, gender, edu_course, attach, response_teacher) values('".$userid."', '".$userpw."', '".$group."', '".$mail."', '".$phonenum."', '".$gender."', '".$edu_course."', '".$attach."', '".$userid."')");

    //         // 교육자 가입 후 교육자에 해당하는 반의 response_teacher(담임ID)를 모두 업데이트
    //         $sql1 = mq("update member set response_teacher='".$userid."' where edu_course='".$edu_course."'");

    //         // 교육자 가입 후 학생명부테이블에서 담당학급/학년 반의 컬럼을 찾아서 update
    //         $sql2 = mq("update student set teacher_id='".$userid."', teacher_attach='".$attach."' where edu_course='".$edu_course."'");


    //         echo "<script> alert('회원가입이 완료되었습니다.');
    //         location.href = './loginMain.php';</script>";
    //     }
    // }

    if($group == "student"){
        // 그룹이 학생일 경우 해당 방식으로 insert, response_teacher는 담임 선생님의 ID가 필요하므로 학급/학년이 같은 교육자의 ID를 찾아서 insert해준다.
        // attach는 교육자의 소속(명칭)을 찾아서 같은학생명부 테이블에 insert
        $sel1 = mq("select * from member where edu_course='".$edu_course."' and `group`='teacher' and school='".$school."'");
        $selteach = $sel1 -> fetch_array();

        if($selteach['submit_flag'] == "Y"){    //승인요청 처리된 선생이 있을 경우
            $sql = mq("insert into member (id, pw, attach, `group`, mail, p_num, gender, edu_course, response_teacher, school) values('".$userid."', '".$userpw."', '".$attach."', '".$group."', '".$mail."', '".$phonenum."', '".$gender."', '".$edu_course."', '".$selteach['response_teacher']."', '".$school."')");

            // 학생명부 테이블 insert
            $stutsu = mq("insert into student (student_id, stu_attach, edu_course, teacher_id, teacher_attach, stu_school) values('".$userid."', '".$attach."', '".$edu_course."', '".$selteach['response_teacher']."', '".$selteach['attach']."', '".$school."')");
        
        }
        else{   //해당 학급의 선생이 가입신청을 하였지만 승인요청이 되지 않은 경우, 교육자의 id와 attach가 insert해줘야 하지만 승인이 되지 않은 교육자id이므로 해당 컬럼들은 제외하고 insert
            $sql = mq("insert into member (id, pw, attach, `group`, mail, p_num, gender, edu_course, school) values('".$userid."', '".$userpw."', '".$attach."', '".$group."', '".$mail."', '".$phonenum."', '".$gender."', '".$edu_course."', '".$school."')");

            // 학생명부 테이블 insert
            $stutsu = mq("insert into student (student_id, stu_attach, edu_course, stu_school) values('".$userid."', '".$attach."', '".$edu_course."', '".$school."')");

        }

        //AUTO_INCREMENT 재 정렬
        $sql = mq("alter table member AUTO_INCREMENT = 1");
        $sql = mq("set @COUNT = 0;");
        $sql = mq("update member set idx = @COUNT := @COUNT + 1");

        echo "<script> alert('회원가입이 완료되었습니다.');
        location.href = './loginMain.php';</script>";

    }


?>

<!-- <meta charset="utf-8"> -->
<!-- <script type="text/javascript">
    alert("회원가입이 완료되었습니다.");
    location.href = "./loginMain.php";
</script> -->