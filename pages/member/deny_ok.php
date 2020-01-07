<?php
    include "../common/db.php";

    $data = json_decode(stripslashes($_POST['data']));

    foreach($data as $d){
        $mq1 = mq("delete from member where id='".$d."'");
    }
?>