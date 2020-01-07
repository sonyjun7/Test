<?php
    include "../common/db.php";

    $softver =  $_POST['appVersion'];
    $resver = $_POST['resVersion'];
    $appID = $_POST['appID'];

    $mq1 = mq("select * from assetBundle where appID='".$appID."'");
    $version = $mq1 -> fetch_array();

    if($version['now_software_v'] != $softver){
        echo "software:", $version['now_software_v'], "," , $version['SDK'];
    }   
    if($version['now_resource_v'] != $resver){
        echo "res:", $version['now_resource_v'], "," , $version['SDK'];
    }
    if($version['now_software_v'] == $softver && $version['now_resource_v'] == $resver){
        echo "None";
    }
?>