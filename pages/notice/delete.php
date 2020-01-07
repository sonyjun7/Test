<?php
    include "../common/db.php";

    $bno = $_GET['idx'];
    $session = $_SESSION['userid'];

    $sql3 = mq("select * from board1 where idx='".$bno."'");
    $selfile = $sql3 -> fetch_array();

    $mq1 = mq("select * from member where id='".$session."'");
    $user = $mq1 -> fetch_array();

    setcookie('notice_' .$bno, "", time() - 86400, "/");

    if($user['group'] == "root" || $user['group'] == "manager"){
        $sql = mq("delete from board1 where idx='".$bno."'");

        //삭제 후 ,AUTO_INCREMENT 재 정렬
       $sql2 = mq("alter table board1 AUTO_INCREMENT = 1");
       $sql2 = mq("set @COUNT = 0");
       $sql2 = mq("update board1 set idx = @COUNT:=@COUNT + 1");
   
       $dbfile = $selfile['file'];
    }else{
        $sql = mq("delete from board1 where idx='".$bno."' and id='".$session."'");

        //삭제 후 ,AUTO_INCREMENT 재 정렬
       $sql2 = mq("alter table board1 AUTO_INCREMENT = 1");
       $sql2 = mq("set @COUNT = 0");
       $sql2 = mq("update board1 set idx = @COUNT:=@COUNT + 1");
   
       $dbfile = $selfile['file'];
    }

?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script>
    var dbfile;
    dbfile = "<?= $dbfile ?>";
    var session = "<?= $session ?>";
    console.log(dbfile);
</script>
<script src="./delete_ok_bundle.js"></script>

