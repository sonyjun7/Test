<?php
    include "../common/db.php";

    $spot_idx = $_GET['spot_idx'];
    $idx = $_GET['idx'];
    $state = $_GET['state'];
    $structure = $_GET['structure'];
    $city = $_GET['city'];
    $id = $_SESSION['userid'];

    if($idx <= 5){     // 시나리오를 총 5코스 전까지만 등록할 수 있도록   
        $sql1 = mq("insert scenario_info (spot_idx,idx,state,structure,city,id) values('".$spot_idx."', '".$idx."', '".$state."', '".$structure."', '".$city."', '".$id."')");
        echo "<script> alert('시나리오가 담아졌습니다.');location.href='./toursearch_select.php'; </script>";
    }
    else if($idx > 5){
        echo "<script> alert('담을 수 있는 시나리오 개수 초과'); history.back(); </script>";
    }

?>
