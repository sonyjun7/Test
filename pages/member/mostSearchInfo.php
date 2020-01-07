<?php
    include "../common/db.php";
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
    <link rel="stylesheet" href="../../css/member_css/myPage.css">

    <title>초등 검색 기록 확인</title>
</head>
<body>

    <?php
        // include "../common/header.php";
    ?>

    <!-- <div id="hNotice">
        <h2>MY PAGE</h2>
        <img src="../../img/main_pic_02.png">
    </div>

    <div id="profile">
        <img src="../../img/blank_profile.png">
    </div> -->

    <div class="panel panel-primary m_table">
        <div class="panel-heading">초등관광지 모든유저의 지역총합 검색수 확인</div>
        <div class="panel-body p_table_body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>검색한 지역</th>
                        <th>검색한 횟수</th>
                    </tr>
                </thead>
        <?php
            $session = $_SESSION['userid'];

            // 장소 검색 횟수 확인(날짜별로 구본)
            $sql1 = mq("select state,COUNT(state) from most_state group by state");
            while($msearch = $sql1 -> fetch_array()){
        ?>
                <tbody>
                    <tr>
                        <td><?php echo $msearch['state']; ?></td>
                        <td><?php echo $msearch['COUNT(state)']; ?></td>
                    </tr>
                </tbody>
        <?php
            }
        ?>
            </table>
        </div>
    </div>

    <div class="panel panel-default m_table">
        <div class="panel-heading">초등관광지 모든유저의 장소총합 검색수 확인</div>
        <div class="panel-body p_table_body">
            <form id="all_str_form" method="get">
                <select name="all_structure_param" id="all_structure_param" class="form-control">
                    <?php
                        $sql0 = mq("select * from state_table order by state_t asc");

                        while($allstructure = $sql0 -> fetch_array()){
                    ?>
                            <option value="<?php echo $allstructure['state_t']; ?>"><?php echo $allstructure['state_t']; ?></option>
                    <?php
                        }
                    ?>
                </select>
            </form>

            <button id="all_structure_ok" class="btn btn-default">장소 확인</button>

            <div id="all_str_area"></div>
        </div>
    </div>

    <h4 style="text-align:center;">본인의 검색기록 확인</h4>
    <div class="panel panel-info m_table">
        <div class="panel-heading">초등 -- 날짜별 검색 지역 확인</div>
        <div class="panel-body p_table_body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>검색한 지역</th>
                        <th>날짜</th>
                        <th>검색한 횟수</th>
                    </tr>
                </thead>
        <?php
            $session = $_SESSION['userid'];

            // 장소 검색 횟수 확인(날짜별로 구본)
            $sql1 = mq("SELECT *,COUNT(state) FROM most_state WHERE id='".$session."' GROUP BY id, state, date ORDER BY date desc");
            while($msearch = $sql1 -> fetch_array()){
        ?>
                <tbody>
                    <tr>
                        <td><?php echo $msearch['state']; ?></td>
                        <td><?php echo $msearch['date']; ?></td>
                        <td><?php echo $msearch['COUNT(state)']; ?></td>
                    </tr>
                </tbody>
        <?php
            }
        ?>
            </table>
        </div>
    </div>

    <div class="panel panel-default m_table">
        <div class="panel-heading">초등 -- 최다 검색 지역 확인</div>
        <div class="panel-body p_table_body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>검색한 지역</th>
                        <th>총 검색 횟수</th>
                    </tr>
                </thead>
        <?php

            // 최다 검색 횟수 확인(날짜별 구분 x)
            $sql2 = mq("SELECT *,COUNT(state) FROM most_state WHERE id='".$session."' GROUP BY id, state ORDER BY COUNT(state) desc");
            while($allsearch = $sql2 -> fetch_array()){
        ?>
                <tbody>
                    <tr>
                        <td><?php echo $allsearch['state']; ?></td>
                        <td><?php echo $allsearch['COUNT(state)']; ?></td>
                    </tr>
                </tbody>
        <?php
            }
        ?>
            </table>
        </div>
    </div>

    <div class="panel panel-primary m_table">
        <div class="panel-heading">초등 -- 지역별 최다 검색 장소 확인<br>(최다 검색 순)</div>
        <div class="panel-body p_table_body">
            <form id="str_form" method="get">
                <select name="structure_param" id="structure_param" class="form-control">
                    <?php
                        $sql3 = mq("select state_t, COUNT(*) from state_table left join (select * from most_state where id='".$session."') ms on state_table.state_t = ms.state group by id, state_t order by COUNT(*) desc, state desc, state_t asc");

                        while($mstructure = $sql3 -> fetch_array()){
                    ?>
                            <option value="<?php echo $mstructure['state_t']; ?>"><?php echo $mstructure['state_t']; ?></option>
                    <?php
                        }
                    ?>
                </select>
            </form>

            <button id="structure_ok" class="btn btn-info">장소 확인</button>

            <div id="str_area"></div>
        </div>
    </div>

  


    <?php
        // include "../common/footer.php";
    ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
    <script>
        $("#structure_ok").click(function(){
            console.log("장소 확인 버튼 클릭");
            var str_serial = $("#str_form").serialize();
            
            $.ajax({
                type: "get",
                url: "./strMostSearch.php",
                data: str_serial,
                dataType: "html",
                success: function(result){
                    $("#str_area").html(result);
                    console.log(result);
                },
                error: function(err){
                    console.log(err);
                }
            });
        });

        $("#all_structure_ok").click(function(){
            console.log("모든 유저 지역별 검색수 클릭");
            var all_str_serial = $("#all_str_form").serialize();
            
            $.ajax({
                type: "get",
                url: "./el_all_strMostSearch.php",
                data: all_str_serial,
                dataType: "html",
                success: function(result){
                    $("#all_str_area").html(result);
                    console.log(result);
                },
                error: function(err){
                    console.log(err);
                }
            });
        });

    </script>

</body>
</html>