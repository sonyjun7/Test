<?php
    include "../common/db.php";

    $rno = $_GET['idx'];
    $sql = mq("select * from reply where idx='".$rno."'");
    $reply = $sql -> fetch_array();

    $fno = $_GET['fno'];
    $sql2 = mq("select * from freeboard where idx='".$fno."'");
    $free = $sql2 -> fetch_array();

    $sql3 = mq("delete from reply where idx='".$rno."'");

    $sql3 = mq("alter table reply AUTO_INCREMENT=1");
    $sql3 = mq("set @COUNT=0");
    $sql3 = mq("update reply set idx=@COUNT:=@COUNT+1");
?>

<script type="text/javascript">
    alert('댓글이 삭제되었습니다.');
    location.replace("./freeRead.php?idx=<?php echo $free['idx'] ?>");
</script>