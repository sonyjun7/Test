<?php
    include "../common/db.php";

    $state = $_GET['state'];
    $subject = $_GET['subject'];
    $year = $_GET['year'];
    $spotidx = $_GET['spotidx'];
    $structure = $_GET['structure'];
    $date = date('y-m-d');
    $session = $_SESSION['userid'];

    $inmost = mq("insert into most_city_mid(id, structure, date, spot_idx, state) values('".$session."', '".$structure."', '".$date."', '".$spotidx."', '".$state."')");

    $inmost = mq("alter table scenario_info_mid AUTO_INCREMENT = 1");
    $inmost = mq("set @COUNT = 0");
    $inmost = mq("update scenario_info_mid set seq = @COUNT := @COUNT + 1");
?>

<script>
    var state = "<?= $state ?>";
    var subject = "<?= $subject ?>";
    var year = "<?= $year ?>";
    var spotidx = "<?= $spotidx ?>";

    location.href= "./mid_searchtour_detail.php?state=" + state + "&subject=" + subject + "&year=" + year + "&spotidx=" + spotidx; 
</script>