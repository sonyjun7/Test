<?php
    include "../common/db.php";
    $state = $_GET['structure_param'];
    $session = $_SESSION['userid'];
?>

<link href="https://fonts.googleapis.com/css?family=Do+Hyeon|Jua|Nanum+Gothic+Coding" rel="stylesheet">
<link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="../../css/common_css/common.css">
<link rel="stylesheet" href="../../css/member_css/myPage.css">

<table class="table table-hover">
    <thead>
        <tr>
            <th>지역</th>
            <th>문화관광지</th>
            <th>구</th>
            <th>검색한 횟수</th>
        </tr>
    </thead>
    <?php
        $sql1 = mq("select b.structure_nm, b.city, most_city.state, COUNT(b.structure_nm) from (select distinct a.structure_nm, a.city, a.spot_idx from (select TBS.tb_idx, SP.spot_idx, SP.structure_nm, SP.city from ARVR.SPOT SP LEFT join ARVR.TB_SPOT TBS on SP.spot_idx = TBS.spot_idx and SP.state='".$state."') a inner join ARVR.TEXTBOOK TB on TB.tb_idx = a.tb_idx) b left join most_city on b.structure_nm = most_city.structure where most_city.id = '".$session."' group by most_city.structure, b.structure_nm order by COUNT(b.structure_nm) desc, most_city.state desc;");

        while($strquery = $sql1 -> fetch_array()){
    ?>
    <tbody>
        <tr>
            <td><?php echo $strquery['state']; ?></td>
            <td><?php echo $strquery['structure_nm'];?></td>
            <td><?php echo $strquery['city']; ?></td>
            <td><?php echo $strquery['COUNT(b.structure_nm)']; ?></td>
        </tr>
    </tbody>
    <?php
        }
    ?>
</table>




<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="../../bootstrap/js/bootstrap.min.js"></script>