<?php
    include "../common/db.php";

    $data = json_decode(stripslashes($_POST['data']));
    // $data = json_decode($_POST['data']);

    foreach($data as $d){
        echo $d;

        $sql1 = mq("update member set submit_flag='Y' where id='".$d."'");

        // ---------- 아래 해당 두 쿼리는 교육자 가입 시 승인절차가 Y가 될경우( sbumit_flag == Y )인 경우에 쿼리들을 실행할 수 있도록 하기(가입대기목록 페이지->승인시 사용하게)----

        $mq1 = mq("select * from member where id='".$d."'");

        $uarr = $mq1 -> fetch_array();

        if($uarr['group'] == "teacher"){
            // 교육자 가입 승인후 교육자에 해당하는 반의 response_teacher(담임ID)를 모두 업데이트
            $sql1 = mq("update member set response_teacher='".$d."' where edu_course='".$uarr['edu_course']."' and school='".$uarr['school']."'");

            // 교육자 가입 후 학생명부테이블에서 담당학급/학년 반의 컬럼을 찾아서 update
            $sql2 = mq("update student set teacher_id='".$d."', teacher_attach='".$uarr['attach']."' where edu_course='".$uarr['edu_course']."' and stu_school='".$uarr['school']."'");
        }
        
    }
?>