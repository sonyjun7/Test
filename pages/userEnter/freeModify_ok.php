<?php
    include "../common/db.php";

    $fno = $_GET['idx'];
    $title = $_POST['title'];
    $content = $_POST['content'];

    $sql = mq("update freeboard set title='".$title."', content='".$content."' where idx='".$fno."'");
?>

<script type="text/javascript">
    alert('수정되었습니다.');
    location.href= "./freeRead.php?idx=<?php echo $fno ?>";
</script>