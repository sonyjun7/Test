<?php
    include "../common/db.php";

    $session = $_SESSION['userid'];
    $date = date('y-m-d');

    $mq1 = mq("select * from scenario_post where id='".$session."'");
    $chkpost = $mq1 -> fetch_array();

    if($chkpost['post_title'] != ""){
        $mq2 = mq("update scenario_post set date='".$date."' where id='".$session."'");

        echo "<script>alert('시나리오가 등록되었습니다.');</script>";
        echo "<script>location.href='./user_select.php';</script>";
    }
    else{
        echo "<script>alert('제목을 작성해주세요');</script>";
        echo "<script>history.back();</script>";
    }

?>