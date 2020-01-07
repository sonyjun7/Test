<?php
    include "../common/db.php";

    $data = json_decode(stripslashes($_POST['data']));
    $seq = 1;

    foreach($data as $d){
        echo $d;

        setcookie('freenotice_'.$d, "" , time() - 86400, "/");

        $mq1 = mq("delete from freeboard where idx='".$d."'");
        $mq2 = mq("delete from reply where con_num='".$d."'");

        $sql2 = mq("alter table reply AUTO_INCREMENT=1");
        $sql2 = mq("set @COUNT=0");
        $sql2 = mq("update reply set idx=@COUNT:=@COUNT+1");
    }

    $mq3 = mq("select * from freeboard");

    // 삭제할때 마다 총게시글의 수를 받아와서 보여줄 index를 갱신시켜서 DB에 업데이트
    while($freeseq = $mq3 -> fetch_array()){

        $mq4 = mq("update freeboard set seq='".$seq."' where idx='".$freeseq['idx']."'");

        $seq++;
    }
?>