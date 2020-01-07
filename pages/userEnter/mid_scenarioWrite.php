<?php
    include "../common/db.php";

    $session = $_SESSION['userid'];

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
    <title>중등 시나리오 생성</title>
</head>
<body>

<?php
        include "../common/header.php";

        $ttt = mq("select * from scenario_post_mid where id='".$session."'");

        $titarr = $ttt -> fetch_array();
        
    ?>


    <div id="hNotice">
        <h2>중등 시나리오 생성</h2>
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
                    <textarea name="tit_tarea" id="tit_tarea" class="form-control" placeholder="시나리오 제목을 입력 후 저장버튼을 눌러주세요" required><?php echo $titarr['post_title'] ?></textarea>
                </div>
            </form>

                <div id="tit3">
                    <button id="tit_insert" class="btn btn-success">제목 저장</button>
                </div>
        </div>

        <p style="text-align:center;">* 제목 작성/수정 시 반드시 제목 저장 버튼을 눌러주세요</p>

        <?php
            $scemq = mq("select * from scenario_info_mid where id='".$session."' order by idx asc");

            while($scebtn = $scemq -> fetch_array()){
        ?>

                <div id="sce_one_div1">
                    <button class="btn btn-default btn_indx"><?php echo $scebtn['idx'] ?></button>
                    <h4><?php echo $scebtn['state'] ?></h4>
                    <div><h4>장소 : &nbsp;&nbsp;<?php echo $scebtn['structure'] ?></h4></div>
                                 
                <?php
                    // 해당 코스 순번을 찾아서 제목과 내용의 유무를 확인하기 위한 쿼리
                    $ifmq = mq("select * from scenario_info_mid where id='".$session."' and idx='".$scebtn['idx']."'");

                    $ifbtn = $ifmq -> fetch_array();

                    // 제목이나 내용 둘 중 하나만이라도 해당 순번에 있을 경우 코스 보기 버튼으로 변경
                    if($ifbtn['title'] != "" || $ifbtn['content'] != ""){
                ?>
                        <a href="./mid_scenarioCourse.php?title=<?php echo $ifbtn['title'] ?>&idx=<?php echo $ifbtn['idx'] ?>"><button class="btn btn-danger btn_wa"><?php echo $scebtn['idx'] ?>번 코스 보기</button></a>
                <?php
                    } else{
                ?>
                        <a href="./mid_scenarioCourse.php?idx=<?php echo $ifbtn['idx'] ?>"><button class="btn btn-success btn_wa"><?php echo $scebtn['idx'] ?>번 코스 글쓰기</button></a>
                <?php
                    }   
                ?>
                </div>
        <?php
            }
        ?>

       
    </div>

    <div id="cosebtn_area">
        <a href="./user_select.php"><button class="btn btn-primary">참여공간 페이지로</button></a>
        <a href="./mid_main_scenario_post_insert.php"><button class="btn btn-success">시나리오 등록</button></a>
        <button id="all_drop" class="btn btn-danger">전체 삭제</button>
    </div>

    <?php
        include "../common/footer.php"
    ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"></script>
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
    <script>
        var idx = "<?= $titarr['post_idx'] ?>";
        console.log(idx);

        $("#tit_insert").click(function(){

            console.log($("#tit_form")[0].attributes[0].ownerElement[0].value);

            var title_el = $("#tit_form").serialize();

            if($("#tit_form")[0].attributes[0].ownerElement[0].value != ""){
                $.ajax({
                    type: "get",
                    url: "./mid_scenario_title_insert.php",
                    data: title_el,
                    success: function(result){
                        alert("저장되었습니다.");
                        location.reload();
                    },
                    error: function(err){
                        console.log(err);
                    }
                });
            }
        });

        $("#all_drop").click(function(){
            if(confirm("해당 시나리오를 전체 삭제하시겠습니까?")){
                if(confirm("<경고> 중등 시나리오의 모든 코스 및 파일들이 지워집니다.")){
                    if(idx != ""){
                        location.href='./mid_all_drop_scenario.php?idx=' + idx;
                    }
                    else{
                        location.href='./mid_all_drop_scenario.php';
                    }

                }else{
                    return false;
                }
            }
            else{
                return false;
            }

        });
    </script>
</body>
</html>
<?php

    }

?>