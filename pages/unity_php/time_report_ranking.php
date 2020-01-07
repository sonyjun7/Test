<?php
    include "../common/db.php";

    $appID = $_POST['appID'];
    $userID = $_POST['userID'];
    $kind = $_POST['userBadgeType'];
    $edu_type = $_POST['userEduType'];
    // $i = 1;

    $mq1 = mq("select * from member where id = '".$userID."'");

    $school = $mq1 -> fetch_array();

    if($school['school'] != ""){
        $mq2 = mq("select * from sticker where kind = '".$kind."' and school='".$school['school']."' order by time_report asc limit 3");

        while($rank = $mq2 -> fetch_array()){
            echo $userID, ",", $rank['school'], "," , $rank['time_report'], ",";
            // $i++;
        }

    }
    else{
        echo "유저가 존재하지 않습니다.";
    }

?>