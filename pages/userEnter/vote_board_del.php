<?php
    include "../common/db.php";

    $session = $_SESSION['userid'];
    $idx = $_GET['idx'];
    $seq = 1;

    setcookie('vote_' . $idx, "" , time() - 86400, '/');

    $mq1 = mq("delete from vote_board where idx='".$idx."'");
    $mq2 = mq("delete from tbl_poll where vboard_num='".$idx."'");
    // $sql = mq("update tbl_poll set vboard_num= vboard_num -1 where vboard_num>'".$idx."'");

    $mq3 = mq("select * from vote_board");

    // 삭제할때 마다 총게시글의 수를 받아와서 보여줄 index를 갱신시켜서 DB에 업데이트
    while($voteseq = $mq3 -> fetch_array()){
        $mq4 = mq("update vote_board set seq='".$seq."' where idx='".$voteseq['idx']."'");

        $seq++;
    }

    $sql1 = mq("alter table tbl_poll AUTO_INCREMENT = 1");
    $sql1 = mq("set @COUNT = 0");
    $sql1 = mq("update tbl_poll set poll_id = @COUNT:=@COUNT + 1");

?>
<script>
    alert("투표 게시글이 삭제 되었습니다.");
    location.href='./vote_notice.php';
</script>