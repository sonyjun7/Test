<?php
    include "../common/db.php";
    $session = $_SESSION['userid'];

    $data = json_decode(stripslashes($_POST['data']));

    foreach($data as $d){

        echo $d;
        setcookie('notice_' .$d, "", time() - 86400, "/");
        
        $sql1 = mq("delete from board1 where idx='".$d."'");

    }

            //삭제 후 ,AUTO_INCREMENT 재 정렬
            $sql2 = mq("alter table board1 AUTO_INCREMENT = 1");
            $sql2 = mq("set @COUNT = 0");
            $sql2 = mq("update board1 set idx = @COUNT:=@COUNT + 1");
?>