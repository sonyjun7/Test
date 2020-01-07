<?php

// include "../../pages/common/db.php";

$postfile = $_POST['hiddentag'];
$postname = $_POST['hiddenName'];
$postidx = $_POST['idx'];
$postid = $_POST['id'];


$db = new mysqli("192.168.1.183", "test", "kssikssi", "arvr_web2");
// $db = new mysqli("175.198.74.238", "test", "kssikssi", "arvr_web2");


// $mq1 = $db -> query("insert into scenario_info(file) values('".$postname."') where id='".$postid."' and idx='".$postidx."'");

// $fmq = $db -> query("select * from scenario_info where id='".$postid."' and idx='".$postidx."'");

// $filecheck = $fmq -> fetch_array();



$mq1 = $db -> query("update scenario_info set file='".$postname."' where id='".$postid."' and idx='".$postidx."'");





// 테스트용 movietest에 저장
// $mq = $db -> query("insert into movietest(movfile) values('".$postname."')");
// 이미지 파일명 저장됨

// move_uploaded_file($_POST['hiddentag'], './'.$postname);

// $mq2 = $db -> query("select * from movietest where movfile='".$postname."'");
// $check = $mq2 -> fetch_array();
// $check_num = $check['idx'];

// $db -> query("alter table scenario_info AUTO_INCREMENT=1;");
// $db -> query("set @COUNT=0;");
// $db -> query("update scenario_info set seq = @COUNT:=@COUNT + 1;");



?>







