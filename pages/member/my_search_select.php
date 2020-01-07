<?php
    include "../common/db.php";
    $session = $_SESSION['userid'];

    $gcount1 = 1;
    $garr = array();
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
    <title>회원정보확인</title>
</head>
<body>

    <?php
        include "../common/header.php";
    ?>

    <div id="hNotice">
        <a href="./myPage.php"><h2>MY PAGE</h2></a>
        <img src="../../img/main_pic_02.png">
    </div>

    <div id="profile">
        <img src="../../img/blank_profile.png">
    </div>

    <div id="board_area">
        <button id="el_info_btn" class="btn btn-primary">초등관광지<br/> 검색 기록 확인</button>
        <button id="mid_info_btn" class="btn btn-success">중등관광지<br/> 검색 기록 확인</button>
    </div>

    <div id="board_area">
        <a href="./search_graph.php"><button id="el_graph" class="btn btn-primary">초등관광지<br/> 그래프 확인</button></a>
        <a href="./mid_search_graph.php"><button id="mid_graph" class="btn btn-success">중등관광지<br/> 그래프 확인</button></a>
    </div>

    <div id="search_info_area"></div>

    <?php
        include "../common/footer.php";
    ?>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#el_info_btn").click(function(){
                    console.log("초등 검색기록 눌림");

                    $.ajax({
                        type: 'get',
                        url: './mostSearchInfo.php',
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

                $("#mid_info_btn").click(function(){
                    console.log("중등 검색기록 눌림");

                    $.ajax({
                        type: 'get',
                        url: './mid_mostSearchInfo.php',
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

                // $("#el_graph").click(function(){
                //     // console.log("초등 검색기록 눌림");

                //     $.ajax({
                //         type: 'get',
                //         url: './search_graph.php',
                //         dataType: 'html',
                //         success: function(result){
                //             $("#search_info_area").html(result);
                //             // alert(result);
                //             // console.log(result);
                //             // location.reload();
                //         },
                //         error: function(err){
                //             console.log(err);
                //         }
                //     });
                // });
        });

    </script>
</body>
</html>
<?php
    if(!isset($_SESSION['userid'])){
        echo "<script> alert('잘못된접근입니다.');  location.href='../../index.php'; </script>";
    }
?>