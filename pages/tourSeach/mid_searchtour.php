<?php
    include "../common/db.php";

    $state = $_GET['state_param'];
    $subject = $_GET['subject_param'];
    $year = $_GET['year_param'];
    $session = $_SESSION['userid'];


    if($session != ""){ //세션이 있을 경우 최다 검색 장소별로 맨위로 출력하기 위한 쿼리
        $searchInfo = mq("select b.structure_nm, b.city, b.spot_idx, mc.structure ,COUNT(b.structure_nm) from (select distinct a.structure_nm, a.city, a.spot_idx from (select TBS.tb_idx, SP.spot_idx, SP.structure_nm, SP.city from ARVR_MID.SPOT SP LEFT join ARVR_MID.TB_SPOT TBS on SP.spot_idx = TBS.spot_idx and SP.state='".$state."') a inner join ARVR_MID.TEXTBOOK TB on TB.tb_idx = a.tb_idx and TB.subject like concat('".$subject."', '%') and TB.year like concat('%', '".$year."', '%')) b left join (select * from most_city_mid where id='".$session."') mc on b.structure_nm = mc.structure group by mc.structure, b.structure_nm, mc.id order by COUNT(b.structure_nm) desc, mc.state desc;
        ");
    }
    else{   //세션이 없을 경우 평범한 출력
        $searchInfo = mq("select distinct a.structure_nm, a.city, a.spot_idx from (select TBS.tb_idx, SP.spot_idx, SP.structure_nm, SP.city from ARVR_MID.SPOT SP LEFT join ARVR_MID.TB_SPOT TBS on SP.spot_idx = TBS.spot_idx and SP.state='".$state."') a inner join ARVR_MID.TEXTBOOK TB on TB.tb_idx = a.tb_idx and TB.subject like concat('".$subject."','%') and TB.year like concat('%', '".$year."', '%') order by spot_idx");
    }

    $idx_cnt = 0;


    $date = date('y-m-d');

    if($session != "" && $state != ""){
        $insertsearch = mq("insert into most_state_mid(id, state, date) values('".$session."', '".$state."', '".$date."')");
    }


?>

<link href="https://fonts.googleapis.com/css?family=Do+Hyeon|Jua|Nanum+Gothic+Coding" rel="stylesheet">
<link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="../../css/common_css/common.css">
<link rel="stylesheet" href="../../css/userEnter_css/user_enter.css">
<link rel="stylesheet" href="../../css/tourSearch_css/tour_search2.css">

<div id="search_area">

    <table class="table table-hover">
        <thead>
            <tr>
                <th>번호</th>
                <th>교과서 내 문화관광지</th>
                <th>지역(시,군,구)</th>
            </tr>
        </thead>
        <?php
            while($search = $searchInfo -> fetch_array()){
                    
        ?>
        <tbody>
            <tr>
                <td><?php echo $idx_cnt+1; ?></td>
                <?php
                    if($session == ""){
                ?>
                        <td><a href="./mid_searchtour_detail.php?state=<?php echo $state; ?>&subject=<?php echo $subject; ?>&year=<?php echo $year; ?>&spotidx=<?php echo $search['spot_idx']; ?>"><?php echo $search['structure_nm']; ?></a></td>
                <?php
                    } else{
                ?>
                        <td><a href="./mid_insertCity.php?state=<?php echo $state; ?>&subject=<?php echo $subject; ?>&year=<?php echo $year; ?>&spotidx=<?php echo $search['spot_idx']; ?>&structure=<?php echo $search['structure_nm']; ?>"><?php echo $search['structure_nm']; ?></a></td>
                <?php
                    }
                ?>

                <td><?php echo $search['city']; ?></td>
            </tr>
        </tbody>
        <?php
                $idx_cnt++;
            }
        ?>

    </table>



</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="../../bootstrap/js/bootstrap.min.js"></script>

