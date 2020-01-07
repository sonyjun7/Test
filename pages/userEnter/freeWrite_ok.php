<?php
    include "../common/db.php";

    $title = $_POST['title']; 
    $name = $_SESSION['userid']; 
    $content = addslashes($_POST['content']);
    $date = date('y-m-d');

    $mq1 = mq("select * from freeboard");

    // 총 레코드 수의 + 1을 index insert
    $record_num = mysqli_num_rows($mq1) + 1;

    $sql = mq("insert into freeboard(seq, title, name, content, date) values('".$record_num."', '".$title."', '".$name."', '".$content."', '".$date."')");
?>

<script type="text/javascript">
    alert('글쓰기가 완료되었습니다.');
    location.href='./freeNotice.php';
</script>