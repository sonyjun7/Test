<?php
    include "../common/db.php";

    $rno = $_GET['rno'];
    $sql = mq("select * from reply where idx='".$rno."'");
    $reply = $sql -> fetch_array();

    $fno = $_GET['fno'];
    $sql2 = mq("select * from freeboard where idx='".$fno."'");
    $free = $sql2 -> fetch_array();

    $sql3 = mq("update reply set content='".$_GET['mod_cont']."' where idx='".$rno."'");
?>

<script type="text/javascript">
    alert('댓글이 수정되었습니다.');
    location.replace("freeRead.php?idx=<?php echo $fno ?>");
</script>