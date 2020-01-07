<?php
    include "../common/db.php";

    $appID = $_POST['appID'];
    $userID = $_POST['userID'];
    $kind = $_POST['userBadgeType'];
    $edu_type = $_POST['userEduType'];

    $mq1 = mq("select * from sticker where appID='".$appID."' and userID='".$userID."' and kind='".$kind."' order by time_report asc");

    $timechk = $mq1 -> fetch_array();

    if($timechk['time_report']){
        echo $timechk['time_report'];
    }
    else{
        echo "타임어택 기록이 존재하지 않습니다";
    }

?>