<?php
    include "../common/db.php";

    $session = $_SESSION['userid'];
    $title = $_GET['tit_tarea'];

    // 기존에 작성된 내용이 있는지 select
    $sti1 = mq("select post_title from scenario_post_mid where id='".$session."'");

    $iftitle = $sti1 -> fetch_array();

    // 기존에 작성된 내용이 있으면 update
    if($iftitle['post_title'] != ""){
        $sti2 = mq("update scenario_post_mid set post_title='".$title."' where id='".$session."'");

    } else{ // 처음 작성하면 insert
        $sti3 = mq("insert into scenario_post_mid(id, post_title) values('".$session."','".$title."')");

        $sql = mq("alter table scenario_post_mid AUTO_INCREMENT = 1");
        $sql = mq("set @COUNT = 0;");
        $sql = mq("update scenario_post_mid set post_idx = @COUNT := @COUNT + 1");
    }

    
?>

