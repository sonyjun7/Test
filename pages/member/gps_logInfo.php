<?php
    include "../common/db.php";
    $session = $_SESSION['userid'];
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
    <title>GPS로그확인</title>
</head>
<body>

    <?php
        // include "../common/header.php";
    ?>

        <div class="panel panel-info m_table">
            <div class="panel-heading">GPS 로그기록</div>
            <div class="panel-body p_table_body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>도착장소</th>
                            <th>도착한 앱ID</th>
                            <th>도착날짜</th>
                        </tr>
                    </thead>
                <?php
                    $mq1 = mq("select * from GPS_log where id='".$session."'");

                    while($gpslog = $mq1 -> fetch_array()){
                        // 과목별 명칭변경
                        if(strpos($gpslog['appID'], "social") !== false){
                            $app = str_replace("social", "사회", $gpslog['appID']);
                        }
                        else if(strpos($gpslog['appID'], "geo") !== false){
                            $app = str_replace("geo", "지리", $gpslog['appID']);
                        }
                        else if(strpos($gpslog['appID'], "sci") !== false){
                            $app = str_replace("sci", "과학", $gpslog['appID']);
                        }
                        else if(strpos($gpslog['appID'], "lang") !== false){
                            $app = str_replace("lang", "국어", $gpslog['appID']);
                        }
                        else if(strpos($gpslog['appID'], "art") !== false){
                            $app = str_replace("art", "미술", $gpslog['appID']);
                        }
                        // AR/VR앱 구분
                        if(strpos($app, "_AR") !== false){
                            $appID = str_replace("_AR", " AR앱", $app);
                        }
                        else if(strpos($app, "_VR") !== false){
                            $appID = str_replace("_VR", " VR앱", $app);
                        }

                ?>
                    <tbody>
                        <tr>
                            <td><?php echo $gpslog['structure'] ?></td>
                            <td><?php echo $appID ?></td>
                            <td><?php echo $gpslog['date'] ?></td>
                        </tr>
                    </tbody>

                <?php
                    }
                ?>
                </table>
            </div>
        </div>

    <?php
        // include "../common/footer.php";
    ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../../bootstrap/js/bootstrap.min.js"></script>

</body>
</html>
<?php
    if(!isset($_SESSION['userid'])){
        echo "<script> alert('잘못된접근입니다.');  location.href='../../index.php'; </script>";
    }
?>