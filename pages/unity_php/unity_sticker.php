<?php 

    include "../common/db.php";

    $appID = $_POST['appID'];
    $userID = $_POST['userID'];
    $kind = $_POST['userBadgeType'];
    $get_flag = $_POST['userBadgeFlag'];
    $edu_type = $_POST['userEduType'];
    $game_type = $_POST['userGameType'];
    $date = date('y-m-d');
    $time_report = $_POST['timeReport'];

    // echo $appID, ", ";
    // echo $userID, ", ";
    // echo $kind, ", ";
    // echo $get_flag, ", ";
    // echo $edu_type, ", ";
    // echo $game_type, ", ";
    // echo $time_report, ",";

    $mq0 = mq("select * from member where id='".$userID."'");
    $memmem = $mq0 -> fetch_array();

    $mq1 = mq("select * from sticker where userID='".$userID."' and appID='".$appID."' and edu_type='".$edu_type."' and kind='".$kind."' and school='".$memmem['school']."'");

    $ifsticker = $mq1 -> fetch_array();

    // echo $ifsticker['kind'];
    // echo $ifsticker['get_flag'];

    if($ifsticker['kind'] != "" && $ifsticker['get_flag'] != "" && $ifsticker['kind'] != "timeAttack"){
        $mq2 = mq("update sticker set get_flag='".$get_flag."', date='".$date."' where userID='".$userID."' and appID='".$appID."' and edu_type='".$edu_type."' and kind='".$kind."' and school='".$memmem['school']."'");
        echo "획득여부 업데이트 완료";
    }
    // else if($ifsticker['kind'] == "timeAttack"){
    //     $mq2 = mq("insert into sticker (appID, userID, kind, edu_type, school, game_type, date, time_report) values('".$appID."', '".$userID."', '".$kind."', '".$edu_type."', '".$memmem['school']."', '".$game_type."', '".$date."', '".$time_report."')");

    //     echo $time_report, ",";
    //     echo "타임어택 업데이트 완료";
    // }
    else {
        $mq2 = mq("insert into sticker (appID, userID, kind, get_flag, edu_type, school, game_type, date, time_report) values('".$appID."', '".$userID."', '".$kind."', '".$get_flag."', '".$edu_type."', '".$memmem['school']."', '".$game_type."', '".$date."', '".$time_report."')");

        echo $kind, " insert 완료";
    }

    $sql = mq("alter table sticker AUTO_INCREMENT = 1");
    $sql = mq("set @COUNT = 0;");
    $sql = mq("update sticker set idx = @COUNT := @COUNT + 1");
?>