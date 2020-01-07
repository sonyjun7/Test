<?php
    include "../common/db.php";

    $data = json_decode(stripslashes($_POST['data']));
    $seq = 1;

    foreach($data as $d){
        // echo $d;
        setcookie('vote_'.$d, "" , time() - 86400, "/");

        $sql1 = mq("delete from vote_board where idx='".$d."'");
        $sql2 = mq("delete from tbl_poll where vboard_num='".$d."'");
        // $mq3 = mq("update tbl_poll set vboard_num = vboard_num - 1 where vboard_num >'".$d."'");

        // $sql3 = mq("alter table vote_board AUTO_INCREMENT = 1");
        // $sql3 = mq("set @COUNT = 0");
        // $sql3 = mq("update vote_board set idx = @COUNT:=@COUNT + 1");

        $sql4 = mq("alter table tbl_poll AUTO_INCREMENT = 1");
        $sql4 = mq("set @COUNT = 0");
        $sql4 = mq("update tbl_poll set poll_id = @COUNT:=@COUNT + 1");

    }

    $mq1 = mq("select * from vote_board");

        // 삭제할때 마다 총게시글의 수를 받아와서 보여줄 index를 갱신시켜서 DB에 업데이트
    while($voteseq = $mq1 -> fetch_array()){
        $mq2 = mq("update vote_board set seq='".$seq."' where idx='".$voteseq['idx']."'");

        $seq++;
    }


?>