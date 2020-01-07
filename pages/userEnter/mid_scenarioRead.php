<?php
    include "../common/db.php";

    header("Cache-Control: no cache");
    session_cache_limiter("private_no_expire");

    $sceid = $_POST['id'];
    $idx = $_POST['post_idx'];

    // if($_POST['id'] != ""){
    //     $sl1 = mysqli_fetch_array(mq("select * from scenario_post where id='".$_POST['id']."'"));
    //     $hit = $sl1['hit'] + 1;

    //     $up1 = mq("update scenario_post set hit='".$hit."' where id='".$_POST['id']."'");

    //     // echo $hit;

    // }
    if(!empty($idx) && empty($_COOKIE['mid_sce_' . $idx])){
        $cook = 'update scenario_post_mid set hit= hit + 1 where post_idx=' . $idx;
        $elscehit = $db -> query($cook);

        if(empty($elscehit)){
            echo "<script>alert('오류가 발생했습니다.'); history.back(); </script>";
        }
        else{
            setcookie('mid_sce_' . $idx, TRUE, time() + (60 * 60 * 24), '/');
        }
    }




    if(!isset($_SESSION['userid'])){
        echo "<script> alert('회원만 접근할 수 있습니다.'); location.href='../../index.php'; </script>";
    }
    else{
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Do+Hyeon|Jua|Nanum+Gothic+Coding" rel="stylesheet">
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/common_css/common.css">
    <link rel="stylesheet" href="../../css/userEnter_css/scenario.css">
    <title>중등시나리오 관람</title>
</head>
<body>

<?php
        include "../common/header.php";

        $ttt = mq("select post_title from scenario_post_mid where id='".$sceid."'");

        $titarr = $ttt -> fetch_array();
    ?>


    <div id="hNotice">
        <h2>중등 시나리오 관람</h2>
        <img src="../../img/main_pic_02.png">
    </div>

    <div id="sce_area">
        <div id="title_area">
            <div id="tit1">
                <h4>시나리오 제목</h4>
            </div>

            <!-- form 태그로 textarea로 작성된 제목 내용을 get방식으로 전달(ajax사용) -->
            <form id="tit_form" method="get">
                <div id="tit2">
                    <textarea name="tit_tarea" id="tit_tarea" class="form-control" readonly="readonly"><?php echo $titarr['post_title'] ?></textarea>
                </div>
            </form>

        </div>

        <?php
            $scemq = mq("select * from scenario_info_mid where id='".$sceid."' order by idx asc");

            if(!$scemq){
                echo "<h3 style='text-align:center;'>< 등록되어 있는 시나리오가 없음 ></h3>";
            }

            while($scebtn = $scemq -> fetch_array()){
        ?>

                <div id="sce_one_div1">
                    <button class="btn btn-default btn_indx"><?php echo $scebtn['idx'] ?></button>
                    <h4><?php echo $scebtn['state'] ?></h4>
                    <div><h4>장소 : &nbsp;&nbsp;<?php echo $scebtn['structure'] ?></h4></div>
                                 
                <?php
                    // 해당 코스 순번을 찾아서 제목과 내용의 유무를 확인하기 위한 쿼리
                    $ifmq = mq("select * from scenario_info_mid where id='".$sceid."' and idx='".$scebtn['idx']."'");

                    $ifbtn = $ifmq -> fetch_array();

                    // 제목이나 내용 둘 중 하나만이라도 해당 순번에 있을 경우 코스 보기 버튼으로 변경
                    if($ifbtn['title'] != "" || $ifbtn['content'] != ""){
                ?>
            <form action="./mid_courseRead.php" method="post">
                <button class="btn btn-info btn_wa"><?php echo $scebtn['idx'] ?>번 코스 관람</button>
                <input type="hidden" name="sceid" value="<?php echo $sceid ?>">
                <input type="hidden" name="idx" value="<?php echo $scebtn['idx'] ?>">
            </form>

                <?php
                    } else{
                ?>
                 <button class="btn btn-warning btn_wa"><?php echo $scebtn['idx'] ?>번 코스가 작성되어있지 않습니다</button>
                <?php
                    }   
                ?>
                </div>
        <?php
            }
        ?>

       
    </div>

    <div id="cosebtn_area">
        <a href="./mid_scenario_view_notice.php"><button class="btn btn-primary">시나리오 목록</button></a>
    </div>

    <?php
        include "../common/footer.php"
    ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
    <script>
    </script>
</body>
</html>
<?php

    }

?>