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

    if($group == "teacher"){
        // 기존에 가입되어 있는 교육자 중에 선택한 edu_course와 edu_course가 있는지 확인
        $mq1 = mq("select * from member where `group`='".$group."' and edu_course='".$edu_course."' and school='".$school."'");

        $chk_group = $mq1 -> fetch_array();

        // 만약 group이 교육자인 사람이 기존에 가입되어 있는 교육자의 edu_course(학급/학년)와 같은 것을 선택 후 가입할 경우
        if($chk_group['edu_course'] != "" && $chk_group['school'] != ""){
            echo "<script type='text/javascript'>alert('현재 학급에 교육자가 존재합니다. 다른 학급으로 변경해주세요.')</script>";
            echo "<script> history.back(); </script>";
        }
        else{
            // 그룹이 교육자일 경우 해당 방식으로 insert, reponse_teacher는 교육자 본인 이므로 본인의 ID를 insert
            //  교육자가 가입을 할 경우 승인절차를 거치기 위해 submit_flag를 N으로 insert 시켜서

            // 주의)) 해당 member  내의 컬럼명 type을 group으로 변경하였는데
            // 기존 insert into member(id,pw,group....)식으로 하니깐 저장이 안되며 문법 오류가 난다.
            // 변경할때 ALTER TABLE member CHANGE `type` `group` VARCHAR(100) 으로 해줬는데
            // ` 기호로 변경해줬기 때문인지 insert into member(id, pw , `group` ...) 으로 해줘야 정상적으로 저장이 되는 것을 확인했다.
            $sql = mq("insert into member (id, pw, `group`, mail, p_num, gender, edu_course, attach, response_teacher, submit_flag, school) values('".$userid."', '".$userpw."', '".$group."', '".$mail."', '".$phonenum."', '".$gender."', '".$edu_course."', '".$attach."', '".$userid."', 'N', '".$school."')");

            //
            //
            // // ---------- 아래 해당 두 쿼리는 교육자 가입 시 승인절차가 Y가 될경우( sbumit_flag == Y )인 경우에 쿼리들을 실행할 수 있도록 하기(가입대기목록 페이지->승인시 사용하게)----
            //
            // // 교육자 가입 후 교육자에 해당하는 반의 response_teacher(담임ID)를 모두 업데이트
            // $sql1 = mq("update member set response_teacher='".$userid."' where edu_course='".$edu_course."'");

            // // 교육자 가입 후 학생명부테이블에서 담당학급/학년 반의 컬럼을 찾아서 update
            // $sql2 = mq("update student set teacher_id='".$userid."', teacher_attach='".$attach."' where edu_course='".$edu_course."'");

            $sql = mq("alter table member AUTO_INCREMENT = 1");
            $sql = mq("set @COUNT = 0;");
            $sql = mq("update member set idx = @COUNT := @COUNT + 1");

            echo "<script> alert('가입신청이 완료되었습니다.');
            location.href = './loginMain.php';</script>";
        }
    }

?>