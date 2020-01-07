<?php
    include "../common/db.php";

    // get으로부터 검색된 결과의 정보를 받아오기
    $state = $_GET['state'];
    $subject = $_GET['subject'];
    $year = $_GET['year'];
    $spotidx = $_GET['spotidx']; 
    $session = $_SESSION['userid'];
    $sce_btn_cnt = 1;

?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Do+Hyeon|Jua|Nanum+Gothic+Coding" rel="stylesheet">
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/common_css/common.css">
    <link rel="stylesheet" href="../../css/userEnter_css/user_enter.css">
    <link rel="stylesheet" href="../../css/tourSearch_css/tour_search2.css">
    <title>중등 관광지 검색</title>
</head>
<body>

    <?php
        include "../common/header.php"
    ?>

    <div id="hNotice">
        <h2>중등관광지 검색된 결과</h2>
        <img src="../../img/main_pic_02.png">
        <?php
            //SPOT 테이블 출력
            $sql1 = mq("select spot_idx, structure_nm, state, city, town, road_nm_add from ARVR_MID.SPOT where spot_idx='".$spotidx."'");
            $sql_head = $sql1 -> fetch_array();

            // 최다 검색 장소 테이블 삽입
            //세션이 있을 경우에만 생성되도록
            // if($session != ""){ 
            //     $date = date('y-m-d');
            //     $inmost = mq("insert into most_city(id, structure, date, spot_idx, state) values('".$session."', '".$sql_head['structure_nm']."', '".$date."', '".$spotidx."', '".$state."')");
            // }

        ?>
        <div><a href="./toursearch_select.php"><button class="btn btn-success">검색화면으로</button></a></div>
        
        <?php
            if($session != ""){
        ?>
            <div>
                <button class="btn btn-info" id="display_btn">시나리오 버튼 펼치기</button>
                <div id="arrows"><i class="fas fa-angle-double-down fa-3x"></i></div>
            </div>
            
        <?php
            }
        ?>



        <?php
            // 유저별 담아져 있는 시나리오 정보 보기
            $sce_query = mq("SELECT * FROM scenario_info_mid WHERE id='".$session."' ORDER BY idx desc");
            $sce_arr = $sce_query -> fetch_array();

        
                // 세션이 있을 경우에만 실행하도록
                if($session != ""){

                    for($i=1; $i<=5; $i++){

                        $sss = mq("select * from scenario_info_mid where id='".$session."' and idx='".$i."' order by idx");

                        $sce_search = $sss -> fetch_array();

                        
                        // ~번째 시나리오에 시나리오가 없다면 시나리오 담기 버튼
                        if($sce_search['idx']  == ""){

                        ?>

                            <a class="ggg" href="./mid_scenario_input.php?idx=<?php echo $sce_btn_cnt; ?>&spot_idx=<?php echo $sql_head['spot_idx']; ?>&state=<?php echo $sql_head['state']; ?>&structure=<?php echo $sql_head['structure_nm']; ?>&city=<?php echo $sql_head['city']; ?>"><button class="btn btn-success sce_btn_cls"><?php echo $sce_btn_cnt ?>번 째 시나리오 담기</button></a>
        <?php
                                
                        }
                         // 검색한 장소와 담아져 있는 시나리오가 같은 부분
                        else if($sql_head['structure_nm'] == $sce_search['structure']){
        ?>
                            <button id="gubun" class="btn btn-danger sce_btn_cls"><?php echo $sce_btn_cnt?>번 째 시나리오에 현재 장소가 담아져 있습니다.</button>
        <?php
                         
                        }
                    // 시나리오가 담아져 있다면
                        else if($sce_search['idx'] != ""){
                   
        ?>
                            <button class="btn btn-default sce_btn_cls"><?php echo $sce_btn_cnt?>번 째 시나리오<br>[도시] : <?php echo $sce_search['state'];?><br>[장소] : <?php echo $sce_search['structure']; ?></button>
        <?php   
                            }
                        $sce_btn_cnt++;
                    }
        ?>
                    <a href="../member/mid_myScenarioInfo.php"><button class="btn btn-warning sce_btn_cls">담긴 시나리오 보기</button></a>
        <?php
                }

        ?>
 
     
        <h2><?php echo $sql_head['structure_nm']; ?></h2>
        <h4><?php echo $sql_head['road_nm_add']; ?></h4>
    </div>

    <!-- 검색할 파라미터 장소,과목,학년 -->

    <?php
        $sql2 = mq("SELECT tbk.tb_idx, tbs.bpt_idx, bgm.mpb_idx, tbk.tb_nm, tbk.subject, tbk.year, tbk.publ_nm, tbk.course, tbk.revision, tbg.bgst_nm, bgm.midl_nm, tbs.page_no 
        FROM ARVR_MID.TEXTBOOK tbk INNER JOIN ARVR_MID.TB_SPOT tbs ON tbk.tb_idx= tbs.tb_idx 
        AND tbs.spot_idx='".$spotidx."' AND tbk.subject LIKE CONCAT ('".$subject."', '%') AND tbk.year LIKE CONCAT('%', '".$year."' ,'%') INNER JOIN ARVR_MID.TB_BGST tbg ON tbg.bpt_idx = tbs.bpt_idx AND tbg.tb_idx=tbs.tb_idx LEFT JOIN ARVR_MID.BGST_MIDL bgm ON bgm.bpt_idx=tbs.bpt_idx GROUP BY tbk.tb_idx");

        while($sql_body1 = $sql2 -> fetch_array()){

    ?>

<div class="panel panel-success p_body1">

    <div class="panel-heading">교과 기본 정보</div>

    <div id="paramdiv" class="panel panel-body">
        <span class="sp_color">- 교과서 &nbsp;&nbsp;</span><span class="sp1"><?php echo $sql_body1['tb_nm'] ?></span>
        <span class="sp_color">- 과목 &nbsp;&nbsp;</span><span class="sp1"><?php echo $sql_body1['subject']; ?></span>
        <span class="sp_color">- 과정 &nbsp;&nbsp;</span><span class="sp1"><?php echo $sql_body1['course']; ?></span>
        <span class="sp_color">- 학년 &nbsp;&nbsp;</span><span class="sp1"><?php echo $sql_body1['year']; ?></span>
        <span class="sp_color">- 출판사 &nbsp;&nbsp;</span><span class="sp1"><?php echo $sql_body1['publ_nm']; ?></span>
        <span class="sp_color">- 페이지&nbsp;&nbsp;</span><span class="sp1"><?php echo $sql_body1['page_no']; ?></span>
        <span class="sp_color">- 대단원 &nbsp;&nbsp;</span><span class="sp1"><?php echo $sql_body1['bgst_nm']; ?></span>
        <span class="sp_color">- 중단원 &nbsp;&nbsp;</span><span class="sp1"><?php echo $sql_body1['midl_nm']; ?></span>
    </div>
</div>

<div class="panel panel-warning p_body2">
        <div class="panel-heading">학습 목표</div>
    <?php
        $b2_cnt = 0;
        $b3_cnt = 0;

        $sql3 = mq("SELECT DISTINCT tbk.tb_idx, lego.goal_txt FROM ARVR_MID.TEXTBOOK tbk INNER JOIN ARVR_MID.TB_SPOT tbs ON tbk.tb_idx= tbs.tb_idx AND tbs.spot_idx='".$spotidx."' AND tbk.subject LIKE CONCAT ('".$subject."', '%') AND tbk.year LIKE CONCAT('%', '".$year."' ,'%') INNER JOIN ARVR_MID.TB_BGST tbg ON tbg.bpt_idx = tbs.bpt_idx AND tbg.tb_idx=tbs.tb_idx LEFT JOIN ARVR_MID.BGST_MIDL bgm ON bgm.bpt_idx=tbs.bpt_idx INNER JOIN ARVR_MID.LEARNING_GOAL lego ON lego.bpt_idx=tbs.bpt_idx");
   
    ?>
        <div class="panel-body" id="p_goal">
    <?php
      while($sql_body2 = $sql3 -> fetch_array()){
        if($sql_body2['tb_idx'] == $sql_body1['tb_idx']){
    ?>
            <span><?php echo $b2_cnt+1; ?>.&nbsp;&nbsp;<?php echo $sql_body2['goal_txt']; ?></span><br>
    <?php
            $b2_cnt++;
        }
    }
    ?>
        </div>
    </div>
<?php
    }
?>

    <div class="panel panel-default p_body3">
        <div class="panel-heading">지역(시,군,구) 내 문화관광지 --- (해당 관광지를 클릭해서 장소를 확인할 수 있습니다)</div>
        <div class="panel-body p_table_body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>번호</th>
                        <th>주변 문화관광지</th>
                        <th>도로명 주소</th>
                    </tr>
                </thead>
                <?php
                    $sql4 = mq("SELECT ATS.spot, ATS.road_nm_add FROM ARVR_MID.ALL_TRVL_SPOT ATS INNER JOIN ARVR_MID.SPOT_TRVL ST ON ATS.big_cd = ST.big_cd AND ST.spot_idx = '".$spotidx."'");
                    while($sql_body3 = $sql4 -> fetch_array()){
                ?>
                <tbody>
                    <tr>
                        <td><?php echo $b3_cnt+1; ?></td>
                        <td><a href="https://search.naver.com/search.naver?sm=tab_hty.top&where=nexearch&query=<?php echo $sql_body3['spot'] ?>" target="_blank"><?php echo $sql_body3['spot']; ?></a></td>
                        <td><?php echo $sql_body3['road_nm_add']; ?></td>
                    </tr>
                </tbody>
                <?php
                        $b3_cnt++;
                    }
                ?>
            </table>
        </div>
    </div>

    <?php
        include "../common/footer.php";
    ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
    <script>
        $("#display_btn").click(function(){

                if($(".sce_btn_cls").css("display") == "inline-block"){
                    $(".sce_btn_cls").css("display", "none");
                    $("#arrows").css("display", "none");
                    document.getElementById("display_btn").innerHTML = "시나리오 버튼 펼치기";

                }
                else if($(".sce_btn_cls").css("display") == "none"){
                    $(".sce_btn_cls").css("display", "inline-block");
                    $("#arrows").css("display", "block");
                    // console.log($("#display_btn"));
                    document.getElementById("display_btn").innerHTML = "시나리오 버튼 접기";
    
                }
 
        });

        // 시나리오 담기 버튼 a태그 class="ggg" 클릭 시
        // 현재 장소가 담겨져 있는 버튼이 있다면( if($('#gubun').length) { ... })
        // a 태그의 href요소를 #로 변경시켜서 장소가 중복해서 담겨지지 않도록 변경
        $(".ggg").click(function(){
            if($("#gubun").length){
                console.log("장소가 담겨져 있어 버튼 비활성화");
                $(".ggg").attr('href', '#');
            }
        });


    </script>
</body>
</html>