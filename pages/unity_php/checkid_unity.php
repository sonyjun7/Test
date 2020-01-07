<?php
    $userid = $_POST['userID'];

    $db = new mysqli("192.168.1.183", "test", "kssikssi", "arvr_web2");
    // $db = new mysqli("175.198.74.238", "test", "kssikssi", "arvr_web2");

    $mq = $db -> query("select * from member where id='".$userid."'");

    $check = $mq -> fetch_array();

    if($check){
        echo "exist";
    }
    else{
        echo "사용가능한 아이디입니다.";
    }
?>