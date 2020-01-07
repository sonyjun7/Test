<?php
    include "../common/db.php";

    $idx = $_GET['idx'];
    $title = $_POST['cose_tit_tarea'];
    $content = $_POST['cont_tarea'];
    $session = $_SESSION['userid'];

    $mq1 = mq("update scenario_info_mid set title='".$title."', content='".$content."' where id='".$session."' and idx='".$idx."'");

?>

<script type="text/javascript">
    alert('코스등록이 완료되었습니다.');
    location.href = "./mid_scenarioWrite.php";
</script>