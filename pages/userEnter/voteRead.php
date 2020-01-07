<?php
    include "../common/db.php";

    $session = $_SESSION['userid'];

    if(!isset($_SESSION['userid'])){
        echo "<script> alert('회원만 접근할 수 있습니다.'); location.href='../../index.php'; </script>";
    }
    else{
        // echo $_GET['idx'];
        $idx = $_GET['idx'];

        if(!empty($idx) && empty($_COOKIE['vote_' . $idx])){

            $cook = 'update vote_board set hit = hit + 1 where idx=' . $idx;
            $votehit = $db -> query($cook);

            if(empty($votehit)){
                echo "<script>alert('오류가 발생했습니다.'); history.back(); </script>";
            }
            else{
                setcookie('vote_' . $idx, TRUE, time() + (60 * 60 * 24), '/');
            }
        }

    $mq1 = mq("select * from member where id='".$_SESSION['userid']."'");
    $mmchk = $mq1 -> fetch_array(); 

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
    <link rel="stylesheet" href="../../css/userEnter_css/scenario.css">
    <link rel="stylesheet" href="../../css/userEnter_css/vote.css">
    <title>투표 게시글</title>
</head>
<body>

    <?php
        include "../common/header.php"
    ?>

    <div id="hNotice">
        <h2>투표 게시글</h2>
        <img src="../../img/main_pic_02.png">
    </div>

    <?php
        // $hit = mysqli_fetch_array(mq("select * from vote_board where idx='".$_GET['idx']."'"));
        // $hit = $hit['hit'] + 1;
        // $fet = mq("update vote_board set hit='".$hit."' where idx='".$_GET['idx']."'");

        $mq1 = mq("select * from vote_board where idx='".$_GET['idx']."'");
        $vboard = $mq1 -> fetch_array();

        $split = explode(",", $vboard['edu_course']);


        if($split[0] == "element"){
            $f_class = "초등";
        }
        else if($split[0] == "midlle"){
            $f_class = "중등";
        }

    ?>

    <div id="voteRead_area">

        <div id="vtit1_area">
            <div id="vtit1">
                <h4>제목</h4>
            </div>

            <div id="vtit2">
                <textarea name="vtit_tarea" id="vtit_tarea" class="form-control" readonly="readonly"><?php echo $vboard['title'] ?></textarea>
            </div>
        </div>

        <div id="vtit1_area">
            <div id="vtit1">
                <h4>학교 구분</h4>
            </div>

            <div id="vtit2">
                <textarea name="vtit_tarea" id="vtit_tarea" class="form-control" readonly="readonly"><?php echo $vboard['school'], ", ", $f_class, ", ", $split[1], "학년 ,", $split[2], "반" ?></textarea>
            </div>
        </div>

        <div>
            <div id="vote_ticket">
                <form method="post" id="poll_form">
                    <div class="radio">
                        <input type="radio" name="poll_option" class="poll_option" value="<?php echo $vboard['vote1'] ?>">
                        <span class="vote_ticket_head"><?php echo $vboard['vote1'] ?></span>
                    </div>

                    <?php 
                        if($vboard['vote2'] != ""){
                    ?>
                    <div class="radio">
                        <input type="radio" name="poll_option" class="poll_option" value="<?php echo $vboard['vote2'] ?>">
                        <span class="vote_ticket_head"><?php echo $vboard['vote2'] ?></span>
                    </div>
                    <?php
                        }
                        if($vboard['vote3'] != ""){
                    ?>
                    <div class="radio">
                        <input type="radio" name="poll_option" class="poll_option" value="<?php echo $vboard['vote3'] ?>">
                        <span class="vote_ticket_head"><?php echo $vboard['vote3'] ?></span>
                    </div>
                    <?php
                        }
                        if($vboard['vote4'] != ""){
                    ?>
                    <div class="radio">
                        <input type="radio" name="poll_option" class="poll_option" value="<?php echo $vboard['vote4'] ?>">
                        <span class="vote_ticket_head"><?php echo $vboard['vote4'] ?></span>
                    </div>
                    <?php
                        }
                        if($vboard['vote5'] != ""){
                    ?>
                    <div class="radio">
                        <input type="radio" name="poll_option" class="poll_option" value="<?php echo $vboard['vote5'] ?>">
                        <span class="vote_ticket_head"><?php echo $vboard['vote5'] ?></span>
                    </div>
                    <?php
                        }
                    ?>
                    <input type="hidden" name="edu_course" value="<?php echo $vboard['edu_course'] ?>">
                    <input type="hidden" name="idx" value="<?php echo $vboard['idx'] ?>">
                    <br />
                    <input type="hidden" name="school" value="<?php echo $vboard['school'] ?>">

                    <?php 
                        $idchk = 0;

                        $mq2 = mq("select * from tbl_poll where vboard_num='".$_GET['idx']."'");
                        while($chkvote = $mq2 -> fetch_array()){
                            if($chkvote['userID'] == $session){
                                $idchk++; 
                            }
                        }
                    ?>

                    <?php 
                        if($idchk == 0){
                    ?>
                        <input type="submit" name="poll_button" id="poll_button" class="btn btn-primary" />
                    <?php
                        }
                        else if($idchk != 0){
                    ?>
                        <!-- <input type="submit" name="poll_button" id="poll_button" class="btn btn-primary" disabled/>이미투표하셨습니다 -->
                        <button class="btn btn-primary" disabled>이미 투표하셨습니다.</button>
                    <?php
                        }
                    ?>

                </form>
            </div>

            <div id="vote_result_div">
                <h4>투표 결과</h4>
                <button class="btn btn-primary" id="re_btn">결과 확인</button>
                <div id="poll_result"></div>
            </div>
        </div>


            <div id="vboard_del_div">
                <!-- <a href="./vote_board_del.php?idx=<?php //echo $_GET['idx'] ?>"><button class="btn btn-danger" id="del_btn">투표글 삭제</button></a> -->
                <a href="./vote_notice.php"><button class="btn btn-primary">목록으로</button></a>
                <?php
                    if($vboard['id'] == $session || $mmchk['group'] == 'root' || $mmchk['group'] == 'manager'){
                ?>
                    <button class="btn btn-danger" id="del_btn">투표글 삭제</button>

                <?php
                    }
                ?>
            </div>


    </div>

    <?php
        $sql1 = mq("alter table tbl_poll AUTO_INCREMENT = 1");
        $sql1 = mq("set @COUNT = 0");
        $sql1 = mq("update tbl_poll set poll_id = @COUNT:=@COUNT + 1");

        include "../common/footer.php";
    ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
    <script>
        var idx = "<?= $vboard['idx'] ?>";

        $(document).ready(function(){
            $("#del_btn").click(function(){
                if(confirm("삭제 하시겠습니까? 투표내용이 모두 삭제됩니다")){
                    location.href='./vote_board_del.php?idx=' + idx;
                }else{
                    return false;
                }
            });

            $("#re_btn").click(function(){
                if($("#poll_result").css("display") == "none"){
                    $("#poll_result").css("display", "block");
                }
                else if($("#poll_result").css("display") == "block"){
                    $("#poll_result").css("display", "none");
                }
            });

            fetch_poll_data();

            function fetch_poll_data(){
                $.ajax({
                    url: "./vote_fetch_poll_data.php?idx="+ idx,
                    method: "POST",
                    success: function(data){
                        $("#poll_result").html(data);
                        // console.log(data);
                    }
                });
            }

            $("#poll_form").on('submit', function(event){
                event.preventDefault();
                var poll_option = '';

                $('.poll_option').each(function(){
                    if($(this).prop("checked")){
                        poll_option = $(this).val();
                    }
                });

                if(poll_option != ''){
                    $("#poll_button").attr('disabled', 'disabled');
                    var form_data = $(this).serialize();

                    $.ajax({
                        url:"./vote_poll.php",
                        method:"POST",
                        data: form_data,
                        success: function(e)
                        {        
                            $('#poll_form')[0].reset();
                            $("#poll_button").attr('disabled', true);
                            fetch_poll_data();
                            console.log(e);
                            alert("투표 되었습니다.");
                        }
                    });
                }
                else{
                    alert("투표해주세요");
                }
            });
        });
    </script>
</body>
</html>
<?php
    }

?>