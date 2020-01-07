<?php
    // session_start();
    // include "../common/db.php";

    // $id = real_escape_string($_POST['userid']);
    // $password = real_escape_string($_POST['userpw']);
    // $sql = mq("select * from member where id='".$id."'");

    // $member = $sql->fetch_array();
    // $hash_pw = $member['pw'];

    // if(password_verify($password, $hash_pw)){   //password_verify(비교할문자, $hash값) : password가 hash와 맞는지 확인하는 함수, password_hash()로 생성된 해시값이 맞는지 확인함
    //     $_SESSION['userid'] = $member['id'];
    //     $_SESSION['userpw'] = $member['pw'];

    //     echo "<script> alert('로그인 되었습니다.'); location.href='../../index.php'; </script>";   
    // }
    // else{
    //     echo "<script> alert('아이디 혹은 비밀번호를 확인하세요'); history.back(); </script>";
    // }

    session_start();
    include "../common/db.php";

    $password = $_POST['userpw'];
    $sql = mq("select * from member where id='".$_POST['userid']."'");

    $member = $sql->fetch_array();
    $hash_pw = $member['pw'];

    if(password_verify($password, $hash_pw)){   //password_verify(비교할문자, $hash값) : password가 hash와 맞는지 확인하는 함수, password_hash()로 생성된 해시값이 맞는지 확인함

        if($member['submit_flag'] == "N"){
            echo "<script> alert('회원가입 승인이 되지 않은 아이디입니다.'); history.back(); </script>";
        }
        else{
            $_SESSION['userid'] = $member['id'];
            // $_SESSION['userpw'] = $member['pw'];

            echo "<script> alert('로그인 되었습니다.'); location.href='../../index.php'; </script>";   
        }
    }
    else{
        if($member['group'] == "root" && $hash_pw == $_POST['userpw']){
            $_SESSION['userid'] = $member['id'];
            
            echo "<script> alert('관리자 로그인 되었습니다.'); location.href='../../index.php'; </script>";   

        }else{
            echo "<script> alert('아이디 혹은 비밀번호를 확인하세요'); history.back(); </script>";
        }

    }
    

?>

