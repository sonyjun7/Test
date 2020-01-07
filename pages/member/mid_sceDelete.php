<?php
    include "../common/db.php";
    $session = $_SESSION['userid'];

    $data = json_decode(stripslashes($_POST['data']));

    foreach($data as $d){

        $sql1 = mq("select * from scenario_info_mid where id='".$session."'");

        $scedel = $sql1 -> fetch_array();

        $sql2 = mq("delete from scenario_info_mid where spot_idx='".$d."' and id='".$session."'");

    }

?>
