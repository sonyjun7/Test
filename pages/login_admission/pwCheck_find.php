<?php
    include "../common/db.php";
 
    $id = $_POST['userid'];
    $email = $_POST['mail'].'@'.$_POST['mailadd'];
    $phone = $_POST['phone'];

    if($id == "" || $email == "" || $phone == ""){
        echo "<script> alert('모두 입력해주세요'); </script>";
    }

    $sql = mq("select * from member where id='".$id."' && mail='".$email."' && p_num='".$phone."'");
    $result = $sql -> fetch_array();

    if($result['id']  == $id || $result['mail'] == $email || $result['p_num'] == $phone){
        $_SESSION['userid'] = $id;
        echo "<script> alert('비밀번호 변경 페이지로 이동'); location.href='./member_pw_update.php'; </script>";
    }
    else{
        echo "<script> alert('없는 계정입니다.'); history.back(); </script>";
    }

?>