<?php

    include "../../pages/common/db.php";

    $prevfile = $_POST['prevfile'];
    $idx = $_POST['idx'];
    $id = $_POST['id'];

    $mq1 = mq("update scenario_info set file= null where id='".$id."' and idx='".$idx."'");

?>