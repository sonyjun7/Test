<?php

    include "../common/db.php";

    $date = date('y-m-d');

    $content = addslashes($_POST['content']);
    $ajaxfile = $_POST['file'];
    $session = $_SESSION['userid'];
    $writetime = $_GET['writetime'];

    // $tmpfile = $_FILES['file']['tmp_name'];   //tmp_name으로 임시파일명으로 바꿈
    // $o_name = $_FILES['file']['name'];        //name에는 원래 파일명을 넣음
    // $filename = iconv("UTF-8", "UTF-8", $_FILES['file']['name']);    // iconv([입력 캐릭터셋], [변환하고자하는 캐릭터셋], [문자열])으로 문자 캐릭터셋(인코딩) 설정을 바꿔줌
    // $folder = "../../upload/".$filename;
    // $error123 = $_FILES['b_file']['error'];
    // move_uploaded_file($tmpfile, $folder);  //move_uploaded_file() : 지정한 위치($folder)에 업로드한 파일이 저장

    $mq1 = mq("select * from member where id='".$session."'");
    $user = $mq1 -> fetch_array();

    if($_POST['file'] != ""){
        if($user['group'] == "root"){
            $sql = mq("insert into board1(title, content, date, file, id) values('".$_POST['title']."', '".$content."', '".$date."', '".$user['attach'].".".$writetime."_".$ajaxfile."', '".$session."')");
        }else{
            $sql = mq("insert into board1(title, content, date, file, id) values('".$_POST['title']."', '".$content."', '".$date."', '".$user['attach'].".".$writetime."_".$ajaxfile."', '".$session."')");
        }
    }
    else{
        if($user['group'] == "root"){
            $sql = mq("insert into board1(title, content, date, id) values('".$_POST['title']."', '".$content."', '".$date."', '".$session."')");
        }else{
            $sql = mq("insert into board1(title, content, date, id) values('".$_POST['title']."', '".$content."', '".$date."', '".$session."')");
        }
    }



    $sql2 = mq("alter table board1 AUTO_INCREMENT = 1");
    $sql2 = mq("set @COUNT = 0");
    $sql2 = mq("update board1 set idx = @COUNT:=@COUNT + 1");
        //upload.php
    // if($_FILES["file"]["name"] != '')
    // {
    // $test = explode('.', $_FILES["file"]["name"]);
    // $ext = end($test);
    // $name = rand(100, 999) . '.' . $ext;

    // }

//    echo "<script>location.href='./arvr_notice.php';</script>";
//    header("Location: ./arvr_notice.php");
    // echo "<meta http-equiv='refresh' url='./arvr_notice,php'>";


    // 세션에 접속한 유저 아이디를 ajax로 넘겨주기(사용안하는 중)
    // $javsession = $_SESSION['userid'];
    // echo $javsession;
?>



