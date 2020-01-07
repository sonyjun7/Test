<?php
    include "../common/db.php";

    $pw1 = $_POST['userpw1'];
    $pw2 = $_POST['userpw2'];

    if($pw1 != $pw2){
        echo "<script> alert('두 비밀번호가 일치 하지 않습니다.'); history.back(); </script>";
    }
    else{
        $userpw = password_hash($pw2, PASSWORD_DEFAULT);
        $sql = mq("update member set pw='".$userpw."' where id='".$_SESSION['userid']."'");
        session_destroy();
        echo "<script> alert('비밀번호를 변경하였습니다.'); location.href='./loginMain.php'; </script>";
    }
?>