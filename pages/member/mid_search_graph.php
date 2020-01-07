<?php
    include "../common/db.php";
    $session = $_SESSION['userid'];

    $gcount1 = 1;
    $dcount = 1;
    $garr = array();
    $darr = array();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Do+Hyeon|Jua|Nanum+Gothic+Coding" rel="stylesheet">
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/common_css/common.css">
    <link rel="stylesheet" href="../../css/member_css/myPage.css">
    <title>중등검색기록 그래프확인</title>
</head>
<body>

    <?php
        include "../common/header.php";
    ?>

<div id="all_graph_div">
    <div id="hNotice">
        <a href="./myPage.php"><h2>MY PAGE</h2></a>
        <img src="../../img/main_pic_02.png">
    </div>

    <div id="profile2">
        <img src="../../img/blank_profile.png">
        <h3>중등관광지 검색 그래프</h3>
    </div>

    <?php
        $mq1 = mq("SELECT *,COUNT(state) FROM most_state_mid WHERE id='".$session."' GROUP BY id, state ORDER BY COUNT(state) desc limit 5");

        // 첫번째 header타입에 줄 명칭 넣기
        $garr[0] = array("장소", "검색수");

        while($mmm = $mq1 -> fetch_array()){
            //$gcount1 이 1부터 시작해서 1번째 배열부터
            $garr[$gcount1] = array($mmm['state'], (int)$mmm['COUNT(state)']);
            $gcount1++;
        }
        // json_encode(.. ,JSON_UNESCAPED_UNICODE) 에서 JSON_UNESCAPED_UNICODE는 한글이 깨질 경우 깨짐을 방지하기 위함
        // echo json_encode($garr, JSON_UNESCAPED_UNICODE);

        // 장소 검색 횟수 확인(날짜별로 구본)
        $sql1 = mq("SELECT *,COUNT(date) FROM most_state_mid WHERE id='".$session."' GROUP BY id, date ORDER BY date desc limit 5");

        $darr[0] = array("날짜", "날짜별 검색수");
        while($msearch = $sql1 -> fetch_array()){
            $darr[$dcount] = array($msearch['date'], (int)$msearch['COUNT(date)']);
            $dcount++;
        }
    ?>

    <!-- 차트가 보이는 div -->
    <?php
        $rowchk = mysqli_num_rows($sql1);
        // echo $rowchk;
        if($rowchk != 0){
    ?>
        <div id="chart_div" ></div>
        <div id="curve_chart" ></div>
    <?php
        }
        else{
            echo "<div id='nograph'><h3 style='color:red;'>---검색한 기록이 없습니다---</h3></div>";
        }
    ?>

</div>


    <?php
        include "../common/footer.php";
    ?>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
    <script src="//www.google.com/jsapi"></script>
    <!-- <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script> -->
    <script>
        // json_encode(.. ,JSON_UNESCAPED_UNICODE) 에서 JSON_UNESCAPED_UNICODE는 한글이 깨질 경우 깨짐을 방지하기 위함

        google.load('visualization', '1.0', {'packages':['corechart']});
        google.setOnLoadCallback(phpchar1);
       
        function phpchar1(){
            var data1 = google.visualization.arrayToDataTable(<?= json_encode($garr, JSON_UNESCAPED_UNICODE) ?>);
            console.log(data1);

            var options1 = {
                title: '지역별 최다 검색 횟수',
                // // width: 400, 
                height: 500,
                colors: ['rgb(75, 184, 90)']
            };

            var chart1 = new google.visualization.ColumnChart(document.querySelector('#chart_div'));
            chart1.draw(data1, options1);

        }
    </script>
        <!-- <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script> -->
     <script type="text/javascript">
        google.load('visualization', '1.0', {'packages':['corechart']});
        google.setOnLoadCallback(phpchar2);

            function phpchar2(){
            var data2 = google.visualization.arrayToDataTable(<?= json_encode($darr, JSON_UNESCAPED_UNICODE) ?>);
                console.log(data2);
            
                var options2 = {
                    title: '최근 날짜별 검색 횟수',
                    // width: 400, 
                    height: 500,
                    colors: ['rgb(75, 184, 90)']
                };

                var chart2 = new google.visualization.LineChart(document.querySelector('#curve_chart'));
                chart2.draw(data2, options2);     
            }

        $(window).resize(function(){
            phpchar1();
            phpchar2();
        });
    </script>
</body>
</html>
<?php
    if(!isset($_SESSION['userid'])){
        echo "<script> alert('잘못된접근입니다.');  location.href='../../index.php'; </script>";
    }
?>