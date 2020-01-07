<?php

    include "../common/db.php";

    $structure = $_POST['structure'];
    // echo $structure;

    $mq1 = mq("select * from GPS_state where structure='".$structure."'");

    $gps = $mq1 -> fetch_array();

    // echo $_POST['structure'];

    if($structure != ""){
        echo $gps['GPS'];
        // echo $gps['structure'];
    }
    else{
        echo "응답없음";
    }


?>