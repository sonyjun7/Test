<?php
    include "../common/db.php";
    $state = $_GET['all_structure_param'];
    $session = $_SESSION['userid'];
?>

<link href="https://fonts.googleapis.com/css?family=Do+Hyeon|Jua|Nanum+Gothic+Coding" rel="stylesheet">
<link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="../../css/common_css/common.css">
<link rel="stylesheet" href="../../css/member_css/myPage.css">

<table class="table table-hover">
    <thead>
        <tr>
            <th>문화관광지</th>
            <th>검색한 횟수</th>
        </tr>
    </thead>
    <?php
        $sql1 = mq("select structure,COUNT(structure) from most_city where state='".$state."' group by structure");

        while($strquery = $sql1 -> fetch_array()){
    ?>
    <tbody>
        <tr>
            <td><?php echo $strquery['structure']; ?></td>
            <td><?php echo $strquery['COUNT(structure)']; ?></td>
        </tr>
    </tbody>
    <?php
        }
    ?>
</table>




<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="../../bootstrap/js/bootstrap.min.js"></script>