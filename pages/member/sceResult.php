<?php 
    include "../common/db.php";

    $idxck = $_REQUEST['idxck'];
    $spotck = $_REQUEST['spotck'];
    $session = $_SESSION['userid'];
    

    //변경된 순번 받아오기
    for($i=0; $i<count($idxck); $i++){
        // echo $idxck[$i]. "<br>\n";
        // echo "<br>\n";
        $idxarr[$i] = $idxck[$i];
    }

    //해당하는 순번의 spot_idx번호 받아오기
    for($j=0; $j<count($spotck); $j++){
        echo $idxarr[$j]. "<br>\n";
        echo "<br>\n";
        
        echo $spotck[$j]."<br>\n";
        echo "<br>\n";

        // $sql1 = mq("select * from scenario_info where id='".$session."' and idx='".$idxarr[$j+1]."'");

        $sql2 = mq("update scenario_info set idx='".$idxarr[$j]."' where spot_idx='".$spotck[$j]."'");
        
    }

?>

<script>
    alert("시나리오 순번이 수정되었습니다.");
    location.href='./mysce_info_select.php';
</script>