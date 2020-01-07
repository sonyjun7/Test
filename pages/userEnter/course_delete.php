<?php

    include "../common/db.php";

    $idx = $_GET['idx'];
    $session = $_SESSION['userid'];

    $mq1 = mq("select * from scenario_info where id='".$session."' and idx='".$idx."'");
    $nowcose = $mq1 -> fetch_array();

    $mq2 = mq("delete from scenario_info where id='".$session."' and idx='".$idx."'");

?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script>
    var file = "<?= $nowcose['file'] ?>";
    var mov_file = "<?= $nowcose['mov_file'] ?>";
    var id = "<?= $session ?>";

</script>
<!-- 삭제시 파이어베이스 파일도 같이 삭제 -->
<script src="./cose_firebase_delete.js"></script>
