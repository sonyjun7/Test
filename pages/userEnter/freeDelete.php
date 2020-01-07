<?php
    include "../common/db.php";

    $fno = $_GET['idx'];
    echo $fno;
    $seq = 1;

    //쿠키를 삭제
    setcookie('freenotice_'.$fno, "", time() - 86400, "/");

    $rno = $_GET['rno'];
    echo $rno;
    $sql = mq("delete from freeboard where idx='".$fno."'");
    $sql = mq("delete from reply where con_num='".$fno."'");

    $mq1 = mq("select * from freeboard");

    // 삭제할때 마다 총게시글의 수를 받아와서 보여줄 index를 갱신시켜서 DB에 업데이트
    while($freeseq = $mq1 -> fetch_array()){

        $mq3 = mq("update freeboard set seq='".$seq."' where idx='".$freeseq['idx']."'");

        $seq++;
    }

    $sql = mq("alter table reply AUTO_INCREMENT=1");
    $sql = mq("set @COUNT=0");
    $sql = mq("update reply set idx=@COUNT:=@COUNT+1");
?>

<script type="text/javascript">
    alert('게시글이 삭제 되었습니다.');
    location.href= "./freeNotice.php";
</script>