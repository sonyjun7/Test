<?php

    include "../common/db.php";

    if(isset($_SESSION['userid'])){
        $mq1 = mq("select * from member where id='".$_SESSION['userid']."'");
        $seltcher = $mq1 -> fetch_array();

        // 선생인 경우 회원 탈퇴 시 연관된 학생의 컬럼을 NULL로 변경
        if($seltcher['group'] == "teacher"){
            $mq2 = mq("update student set teacher_id='NULL', teacher_attach='NULL' where edu_course='".$seltcher['edu_course']."'");

            $mq3 = mq("update member set response_teacher='NULL' where response_teacher='".$_SESSION['userid']."'");
        }
        
        // 공지사항에 파일을 올린경우 해당 파이어베이스에 올린 파일도 같이 삭제
        $boardcount = 0;
        $boardfile = array();

        $mq1 = mq("select * from board1 where id='".$_SESSION['userid']."'");
        while($board = $mq1 -> fetch_array()){
            if($board['file'] != ""){
                $boardfile[$boardcount] = $board['file'];
                $boardcount++;
            }
        }

        // 시나리오 코스에서 파일을 올린경우 해당 파이어베이스에 올린 파일도 같이 삭제
        $scecount1 = 0;
        $scecount2 = 0;
        $scemidcount1 = 0;
        $scemidcount2 = 0;
        $sceimg = array();
        $scevid = array();
        $sceimg_mid = array();
        $scevid_mid = array();

        $mq2 = mq("select * from scenario_info where id='".$_SESSION['userid']."' order by idx");
        while($sce = $mq2 -> fetch_array()){
            if($sce['file'] != ""){
                $sceimg[$scecount1] = $sce['file'];
                $scecount1++;
            }
            if($sce['mov_file'] != ""){
                $scevid[$scecount2] = $sce['mov_file'];
                $scecount2++;
            }
        }

        $qq1 = mq("select * from scenario_info_mid where id='".$_SESSION['userid']."' order by idx");
        while($scemid = $qq1 -> fetch_array()){
            if($scemid['file'] != ""){
                $sceimg_mid[$scemidcount1] = $scemid['file'];
                $scemidcount1++;
            }
            if($scemid['mov_file'] != ""){
                $scevid_mid[$scemidcount2] = $scemid['mov_file'];
                $scemidcount2++;
            }
        }


        // 탈퇴시 작성했던 자유게시글 밑의 모든 댓글들 삭제
        $mq3 = mq("select * from freeboard where name='".$_SESSION['userid']."'");
        while($freeidx = $mq3 -> fetch_array()){
            $mq4 = mq("delete from reply where con_num='".$freeidx['idx']."'");
        }

        $sql = mq("delete from member where id='".$_SESSION['userid']."'");
        $sql2 = mq("delete from student where student_id='".$_SESSION['userid']."'");
        $sql3 = mq("delete from scenario_info where id='".$_SESSION['userid']."'");
        $sql4 = mq("delete from scenario_post where id='".$_SESSION['userid']."'");
        $sql5 = mq("delete from freeboard where name='".$_SESSION['userid']."'");
        $sql6 = mq("delete from reply where name='".$_SESSION['userid']."'");
        $sql7 = mq("delete from most_city where id='".$_SESSION['userid']."'");
        $sql8 = mq("delete from most_state where id='".$_SESSION['userid']."'");
        $sql9 = mq("delete from sticker where userID='".$_SESSION['userid']."'");
        $sql10 = mq("delete from GPS_log where id='".$_SESSION['userid']."'");
        $sql11 = mq("delete from board1 where id='".$_SESSION['userid']."'");
        $sql12 = mq("delete from tbl_poll where userID='".$_SESSION['userid']."'");
        $sql13 = mq("delete from vote_board where id='".$_SESSION['userid']."'");


        //삭제 후 ,AUTO_INCREMENT 재 정렬
        $sql = mq("alter table member AUTO_INCREMENT = 1");
        $sql = mq("set @COUNT = 0");
        $sql = mq("update member set idx = @COUNT := @COUNT + 1");

        $sql3 = mq("alter table scenario_info AUTO_INCREMENT = 1");
        $sql3 = mq("set @COUNT = 0");
        $sql3 = mq("update scenario_info set seq = @COUNT := @COUNT + 1");

        $sql4 = mq("alter table scenario_post AUTO_INCREMENT = 1");
        $sql4 = mq("set @COUNT = 0");
        $sql4 = mq("update scenario_post set post_idx = @COUNT := @COUNT + 1");

        $sql6 = mq("alter table reply AUTO_INCREMENT = 1");
        $sql6 = mq("set @COUNT = 0");
        $sql6 = mq("update reply set idx = @COUNT := @COUNT + 1");

        $sql9 = mq("alter table sticker AUTO_INCREMENT = 1");
        $sql9 = mq("set @COUNT = 0");
        $sql9 = mq("update sticker set idx = @COUNT := @COUNT + 1");

        $sql10 = mq("alter table GPS_log AUTO_INCREMENT = 1");
        $sql10 = mq("set @COUNT = 0");
        $sql10 = mq("update GPS_log set idx = @COUNT := @COUNT + 1");

        $sql11 = mq("alter table board1 AUTO_INCREMENT = 1");
        $sql11 = mq("set @COUNT = 0");
        $sql11 = mq("update board1 set idx = @COUNT := @COUNT + 1");

        $sql12 = mq("alter table tbl_poll AUTO_INCREMENT = 1");
        $sql12 = mq("set @COUNT = 0");
        $sql12 = mq("update tbl_poll set poll_id = @COUNT := @COUNT + 1");

        // echo "<script> alert('탈퇴되었습니다.'); location.href='../home/index.php'; </script>";
        session_destroy();
    }
    else{
        echo "<script> alert('접근할 수 없습니다.'); history.back(); </script>";
    }
    
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script>
    // $(document).ready(function(){
        var boardfile = Array();
        var sceimg = Array();
        var scevid = Array();
        var sceimg_mid = Array();
        var scevid_mid = Array();

        boardfile = <?= json_encode($boardfile) ?>;
        sceimg = <?= json_encode($sceimg) ?>;
        scevid = <?= json_encode($scevid) ?>;
        sceimg_mid = <?= json_encode($sceimg_mid) ?>;
        scevid_mid = <?= json_encode($scevid_mid) ?>;

        // console.log(boardfile);
        // console.log(sceimg);
        // console.log(scevid);
    // });

</script>
<script src="./member_delete_file.js"></script>