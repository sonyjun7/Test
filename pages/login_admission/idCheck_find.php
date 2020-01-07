<?php
    include "../common/db.php";

    $email = $_POST['mail'].'@'.$_POST['mailadd'];
    $phone = $_POST['phone'];

    $sql = mq("select * from member where mail='".$email."' && p_num='".$phone."'");
    $result = $sql->fetch_array();

    if($result['p_num'] == $phone){
        echo "<script> alert('회원님의 ID는".$result['id']."입니다'); location.href='./loginMain.php'; </script>";
    }
    else{
        echo "<script> alert('알 수 없는 계정입니다.'); history.back(); </script>";
    }
?>
