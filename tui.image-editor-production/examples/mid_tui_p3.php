<?php

    // include "../../pages/common/db.php";

    $postfile = $_POST['hiddentag'];
    $postname = $_POST['hiddenName'];
    $postidx = $_POST['idx'];
    $postid = $_POST['id'];

    $db = new mysqli("192.168.1.183", "test", "kssikssi", "arvr_web2");

    $mq1 = $db -> query("update scenario_info_mid set file='".$postname."' where id='".$postid."' and idx='".$postidx."'");

?>







