<?php
    include "../common/db.php";

    $searchstr = $_GET['searchstr'];    //phpsearch.php에서 input값 받기
    $session = $_SESSION['userid'];

?>

<link href="https://fonts.googleapis.com/css?family=Do+Hyeon|Jua|Nanum+Gothic+Coding" rel="stylesheet">
<link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="../../css/common_css/common.css">
<link rel="stylesheet" href="../../css/userEnter_css/user_enter.css">
<link rel="stylesheet" href="../../css/tourSearch_css/tour_search2.css">

<div>

    <table class="table table-hover">
        <thead>
            <tr>
                <th>도시</th>
                <th>교과서 내 문화관광지</th>
                <th>지역(시,군,구)</th>
            </tr>
        </thead>
        <?php
            // SPOT테이블에서 
            // $sql1 = mq("SELECT state, structure_nm, city, spot_idx FROM ARVR.SPOT WHERE structure_nm LIKE '%$searchstr%' ORDER BY spot_idx asc");

            // SPOT과 TB_SPOT의 spot_idx가 같은 부분을 조인하고 state가 나올 수 있도록 셀렉트 하고 전체적으로 출력할 수 있도록 한다. 마지막으로 where로 검색한 부분을 최종적으로 검색
            // distinct a.structure_nm, a.city, a.spot_idx, a.state 에서 지역을 추가로 셀렉트(a.state) 여기서 distinct ...(출력할 컬럼명...) 을 해줘야지 한 장소에 모든 내용들이 모아져서 나옴
            // ex) select * 로 할경우 국립중앙박물관 이 여러개가 나오게 된다(내용들이 분할됨). 위에 내용대로 할 경우는 국립중앙박물관이 한번 출력되고 정보들이 한번출력된 내용안에 모두 들어가있다. 고로 한번만 출력되도록 함
            $sql1 = mq("select distinct a.structure_nm, a.city, a.spot_idx, a.state from (select TBS.tb_idx, SP.spot_idx, SP.structure_nm, SP.city, SP.state from ARVR.SPOT SP LEFT join ARVR.TB_SPOT TBS on SP.spot_idx = TBS.spot_idx) a inner join ARVR.TEXTBOOK TB on TB.tb_idx = a.tb_idx where structure_nm like '%$searchstr%'");

            while($strarr = $sql1 -> fetch_array()){
                    
        ?>
        <tbody>
            <tr>
                <td><?php echo $strarr['state']; ?></td>   
            <?php 
                if($session == ""){
            ?>
                <td><a href="./searchtour_detail.php?state=<?php echo $strarr['state']; ?>&spotidx=<?php echo $strarr['spot_idx']; ?>&subject=<?php echo $strarr['subject']; ?>&year=<?php echo $strarr['year']; ?>&structure=<?php echo $strarr['structure_nm']; ?>"><?php echo $strarr['structure_nm']; ?></a></td>
            <?php
                }else{
            ?>
                <td><a href="./insertCity.php?state=<?php echo $strarr['state']; ?>&spotidx=<?php echo $strarr['spot_idx']; ?>&subject=<?php echo $strarr['subject']; ?>&year=<?php echo $strarr['year']; ?>&structure=<?php echo $strarr['structure_nm']; ?>"><?php echo $strarr['structure_nm']; ?></a></td>
            <?php
                }
            ?>

                <td><?php echo $strarr['city']; ?></td>
            </tr>
        </tbody>
        <?php

            }
        ?>

    </table>



</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="../../bootstrap/js/bootstrap.min.js"></script>

