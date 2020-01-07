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
    <link rel="stylesheet" href="../../css/userEnter_css/user_enter.css">
    <link rel="stylesheet" href="../../css/tourSearch_css/tour_search2.css">
    <title>관광지 검색</title>
</head>
<body>

    <?php
        include "../common/header.php"
    ?>

    <div id="hNotice">
        <h2>관광지 검색</h2>
        <img src="../../img/main_pic_02.png">
    </div>

    <div id="esel_btn">
        <button class="btn btn-primary" id="el_saerch_btn">초등 관광지검색</button>
        <button class="btn btn-success" id="mid_search_btn">중등 관광지검색</button>
    </div>

    <div id="search_div">

    </div>

    <?php
        include "../common/footer.php";
    ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
    <script>

        $(document).ready(function(){

                $("#el_saerch_btn").click(function(){
                    console.log("초등검색 눌림");

                    $.ajax({
                        type: 'get',
                        url: './phpsearch.php',
                        dataType: 'html',
                        success: function(result){
                            $("#search_div").html(result);
                            // alert(result);
                            console.log(result);
                            // location.reload();
                        },
                        error: function(err){
                            console.log(err);
                        }
                    });
                });

                $("#mid_search_btn").click(function(){
                    console.log("초등검색 눌림");

                    $.ajax({
                        type: 'get',
                        url: './mid_phpsearch.php',
                        dataType: 'html',
                        success: function(result){
                            $("#search_div").html(result);
                            // alert(result);
                            console.log(result);
                            // location.reload();
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