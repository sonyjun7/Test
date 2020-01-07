<?php
    include "../common/db.php";

    $session = $_SESSION['userid'];
    $idx = $_GET['idx'];

    $count1 = 0;
    $count2 = 0;
    $filearr = array();
    $movfilearr = array();

    setcookie("mid_sce_". $idx, "" , time() - 86400, "/");

    $sql1 = mq("select * from scenario_info_mid where id='".$session."' order by idx");
    while($file = $sql1 -> fetch_array()){

        if($file['file'] != ""){
            $filearr[$count1] = $file['file'];
            // echo "file의", $count1, "번째 배열", $filearr[$count1], "<br>";
            $count1++;
        }
        if($file['mov_file'] != ""){
            $movfilearr[$count2] = $file['mov_file'];
            // echo "movfile의", $count2, "번째 배열",  $movfilearr[$count2], "<br>";
            $count2++;
        }
        // $count1++;
    }
    // echo $filearr[0] , "<br>";
    // echo $movfilearr, "<br>";

    $mq1 = mq("delete from scenario_info_mid where id='".$session."'");
    $mq2 = mq("delete from scenario_post_mid where id='".$session."'");

?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script>
    var filearr = Array();
    var movfilearr = Array();
    var id = "<?= $session ?>";

    $(document).ready(function(){
        //php 배열을 자바스크립트 배열로 넣는 과정
        filearr = <?= json_encode($filearr) ?>;
        movfilearr = <?= json_encode($movfilearr) ?>;

        // console.log(filearr);
        // console.log(movfilearr);

    });
</script>
<script src="./mid_all_drop_cose_firebase.js"></script>
<!-- <script>
    alert("모든 코스와 시나리오가 삭제되었습니다.");
    location.href="./user_select.php";
</script> -->