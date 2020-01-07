<?php

    include "../common/db.php";

    $appID = $_POST['appID'];
    $userID = $_POST['userID'];
    $kind = $_POST['userBadgeType'];
    $edu_type = $_POST['userEduType'];

    $mq1 = mq("select * from sticker where userID='".$userID."' and appID='".$appID."' and kind='".$kind."' and edu_type='".$edu_type."'");

    $check = $mq1 -> fetch_array();

    echo $check['get_flag'];

?>