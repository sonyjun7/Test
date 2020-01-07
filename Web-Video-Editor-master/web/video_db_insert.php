<?php
    $videopost = $_POST['videoName'];
    $typepost = $_POST['videotype'];
    $v_name_type = $videopost.'.'.$typepost;
    $idx = $_POST['idx'];
    $id = $_POST['id'];

    $db = new mysqli("192.168.1.183", "test", "kssikssi", "arvr_web2");
    // $db = new mysqli("175.198.74.238", "test", "kssikssi", "arvr_web2");

    // $mq = $db -> query("insert into movietest(videofile) values('".$v_name_type."')");
    $mq1 = $db -> query("update scenario_info set mov_file='".$v_name_type."' where id='".$id."' and idx='".$idx."'");


    // $db -> query("alter table scenario_info AUTO_INCREMENT=1;");
    // $db -> query("set @COUNT=0;");
    // $db -> query("update scenario_info set seq=@COUNT:=@COUNT+1;");

    echo $v_name_type;
?>