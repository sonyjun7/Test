<?php

    include "../common/db.php";

    $userID = $_POST['userID'];
    $gps_log = $_POST['GPSinfo'];
    $date = date('y-m-d H:i:s');
    $appID = $_POST['appID'];
    $structure = $_POST['structure'];

    $mq1 = mq("select * from GPS_log where id='".$userID."' and appID='".$appID."' and structure='".$structure."'");

    $chkGPS = $mq1 -> fetch_array();

    // 해당장소에 GPS log가 기록되어 있으면 update
    // if($chkGPS['id'] != "" && $chkGPS['structure'] != ""){
    //     $mq1 = mq("update GPS_log set GPS='".$gps_log."' , date='".$date."' where structure='".$structure."' and id='".$userID."' and appID='".$appID."'");

    //     echo "GPS LOG UPDATE";
    // }
    // 해당장소에 GPS log가 없으면 insert
    // else{

        $mq2 = mq("insert into GPS_log(id, GPS, date, appID, structure) values('".$userID."', '".$gps_log."', '".$date."', '".$appID."', '".$structure."')");

        echo "GPS LOG INSERT";
    // }

    $sql = mq("alter table GPS_log AUTO_INCREMENT = 1");
    $sql = mq("set @COUNT = 0;");
    $sql = mq("update GPS_log set idx = @COUNT := @COUNT + 1");


?>