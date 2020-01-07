<?php
    include "../common/db.php";

    $bno = $_POST['idx'];
    $session = $_SESSION['userid'];

    $mq1 = mq("select * from member where id='".$session."'");
    $user = $mq1 -> fetch_array();
    
    if($user['group'] == "root"){
        $sql = mq("update board1 set title='".$_POST['title']."',content='".$_POST['content']."', id='".$session."' where idx='".$bno."'");
    }
    else if($user['group'] == "manager"){
        $sql = mq("update board1 set title='".$_POST['title']."',content='".$_POST['content']."', id='".$session."' where idx='".$bno."'");
    }
    else{
        $sql = mq("update board1 set title='".$_POST['title']."',content='".$_POST['content']."' where idx='".$bno."' and id='".$session."'");
    }

?>

<script type="text/javascript">
    alert("수정되었습니다.");
    // location.href='./arvr_notice.php';
</script>

<meta http-equiv="refresh" content="0 url=../arvr_notice.php">





