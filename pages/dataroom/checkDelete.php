<?php
    include "../common/db.php";

    $data = json_decode(stripslashes($_POST['data']));

    foreach($data as $d){
        echo $d;

        // 게시글 삭제 시 업로드 한 파일도 같이 삭제
        $sql1 = mq("select * from appboard where idx='".$d."'");
        $delfile = $sql1 -> fetch_array();

        unlink("../../download/mobile_ver/".$delfile['file2']); //mobile_ver폴더안에 선택한 idx게시글의 파일 삭제

        $sql1 = mq("delete from appboard where idx='".$d."'");  //파일 삭제 후 게시글 까지 삭제


        }

        $sql1 = mq("alter table appboard AUTO_INCREMENT=1");
        $sql1 = mq("set @COUNT=0");
        $sql1 = mq("update appboard set idx=@COUNT:=@COUNT+1");
    

    // echo $_POST['data'];

    // echo $data;
?>