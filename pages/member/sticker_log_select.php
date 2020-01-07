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
    <title>획득정보및 GPS로그확인</title>
</head>
<body>

    <?php
        include "../common/header.php";
    ?>

    <div id="hNotice">
        <h2>획득정보 및 GPS로그확인</h2>
        <img src="../../img/main_pic_02.png">
    </div>

    <div id="profile">
        <img src="../../img/blank_profile.png">
    </div>

    <div id="board_area">
        <!-- <button id="el_stick_info" class="btn btn-primary">초등획득 정보확인</button> -->
        <button id="mid_stick_info" class="btn btn-success">중등획득 정보확인</button>
        <button id="gps_log_info" class="btn btn-warning">GPS 로그확인</button>
    </div>

    <div id="search_info_area"></div>

    <?php
        include "../common/footer.php";
    ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#el_stick_info").click(function(){
                    console.log("초등획득 정보확인");

                });

            $("#mid_stick_info").click(function(){
                console.log("중등획득 정보확인");

                $.ajax({
                    type: 'get',
                    url: './my_midSticker.php',
                    dataType: 'html',
                    success: function(result){
                        $("#search_info_area").html(result);
                        // alert(result);
                        console.log(result);
                        // location.reload();
                    },
                    error: function(err){
                        console.log(err);
                    }
                });   
            });

            $("#gps_log_info").click(function(){
                console.log("GPS로그 확인");

                $.ajax({
                    type: 'get',
                    url: './gps_logInfo.php',
                    dataType: 'html',
                    success: function(e){
                        $("#search_info_area").html(e);
                        console.log(e);
                    },
                    error: function(err){
                        console.log(err);
                    }
                });
            });
        });


    </script>
</body>
</html>
<?php
    if(!isset($_SESSION['userid'])){
        echo "<script> alert('잘못된접근입니다.');  location.href='../../index.php'; </script>";
    }
?>