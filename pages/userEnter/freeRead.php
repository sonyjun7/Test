<?php
    include "../common/db.php";
    if(isset($_SESSION['userid'])){
        $freeno = $_GET['idx'];

        if(!empty($freeno) && empty($_COOKIE['freenotice_' . $freeno])){

            $cook = 'update freeboard set hit = hit + 1 where idx=' . $freeno;
            $freehit = $db -> query($cook);

            if(empty($freehit)){
                echo "<script>alert('오류가 발생했습니다.'); history.back(); </script>";
            }
            else{
                setcookie('freenotice_' . $freeno, TRUE, time() + (60 * 60 * 24), '/');
            }
        }

        $mq1 = mq("select * from member where id='".$_SESSION['userid']."'");
        $mmchk = $mq1 -> fetch_array(); 
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Do+Hyeon|Jua|Nanum+Gothic+Coding" rel="stylesheet">
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/common_css/common.css">
    <link rel="stylesheet" href="../../css/userEnter_css/freeboard.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery.min.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>

    <title>자유게시판 글 읽기</title>
</head>
<body>

    <?php
        include "../common/header.php"
    ?>

    <div id="hNotice">
        <h2>자유게시판 글 읽기</h2>
        <img src="../../img/main_pic_02.png">
    </div>

    <?php


        // $hit = mysqli_fetch_array(mq("select hit from freeboard where idx='".$freeno."'"));
        // $hit = $hit['hit'] + 1;
        // $fet = mq("update freeboard set hit='".$hit."' where idx='".$freeno."'");
        $sql = mq("select * from freeboard where idx='".$freeno."'");
        $freeboard = $sql -> fetch_array();

        $re_sql = mq("select * from reply where con_num='".$freeno."'");
        $re_count = mysqli_num_rows($re_sql);

    ?>

    <div id="content1">
        <div id="read_box1">제목<span> <?php echo $freeboard['title'] ?></span></div>
       
        <div id="read_box4">조회수  <span><?php echo $freeboard['hit'] ?></span> </div>
        <div id="read_box3">작성일   <span><?php echo $freeboard['date'] ?></span></div> 
        <div id="read_box2">작성자 <span><?php echo $freeboard['name'] ?></span></div>   
    </div>

    <div id="content2">
        <?php echo $freeboard['content'] ?>
    </div>

    <div id="button_box">

        <?php
            if($freeboard['name'] == $_SESSION['userid']){
        ?>
            <a href="./freeModify.php?idx=<?php echo $freeboard['idx'] ?>"><button class="btn btn-primary btn-lg">수정</button></a>

        <?php 
            }
        ?>

            <a href="./freeNotice.php"><button class="btn btn-primary btn-lg">목록</button></a>
            
        <?php
            if($freeboard['name'] == $_SESSION['userid'] || $mmchk['group'] == 'root' || $mmchk['group'] == 'manager'){
        ?>
            <!-- <a href="./freeDelete.php?idx=<?php //echo $freeboard['idx'] ?>"><button class="btn btn-primary btn-lg">삭제</button></a> -->
            <button id="del_btn" class="btn btn-primary btn-lg">삭제</button>      
        <?php 
            }
        ?>

    </div>

    <button id="re_tag" class="btn btn-default" value="open">댓글 보기&nbsp;&nbsp;&nbsp;&nbsp;<i class="far fa-comment-dots"></i><?php echo $re_count ?></button>
    <!-- <button id="reply_cunt" class="btn btn-default"></button> -->
    <div id="reply_area">
        <?php
        
            $sql4 = mq("select * from reply where con_num='".$freeno."' order by idx desc");
            while($reply = $sql4 -> fetch_array()){
                
        ?>
        <!-- 댓글 보기 -->
        <div id="reply_read">
            <div id="reply1">
                <i class="fas fa-user fa-2x"></i>
               <div><h5><?php echo $reply['name'] ?></h5></div> 
               <div><h5><?php echo $reply['date'] ?></h5></div> 
                
               <div>
                <?php 

                   if($reply['name'] == $_SESSION['userid']){
             
                ?>
                    <button class="btn btn-link re_modify_btn">수정</button>
                    <a href="./reply_delete.php?idx=<?php echo $reply['idx'] ?>&fno=<?php echo $freeno ?>"><button class="btn btn-link re_delete_btn">삭제</button></a>
                <?php
                   }
                ?>  
               </div>     

                <div id="reply2">
                    <h4><?php echo $reply['content'] ?></h4>

                        <!-- 댓글 수정 form -->
                        <div class="reply_modify">
                            <form action="./reply_modify_ok.php" method="get">
                                <input type="hidden" name="rno" value="<?php echo $reply['idx'] ?>">
                                <input type="hidden" name="fno" value="<?php echo $freeno ?>">
                                <textarea name="mod_cont" required="required" class="form-control"><?php echo $reply['content']?></textarea>
                                <button class="btn btn-primary">수정하기</button>
                            </form>

                            <button class="btn btn-primary btn_close">수정 취소</button>
                        </div>                  
     
                </div>

            </div>
        </div>

        <?php
            }
        ?>


        <!-- 댓글 입력 -->
        <div id="reply_write">
            <form method="get" id="reply_form">
                <input type="hidden" name="idx" value="<?php echo $freeno ?>">
                <input type="hidden" name="session" value="<?php echo $_SESSION['userid']?>">
                <textarea name="content" id="cont_area" class="form-control" required="required"></textarea>
                <button class="btn btn-primary" id="re_bt">댓글</button>
            </form>
        </div>
    </div>

    <?php
        include "../common/footer.php"
    ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../../jquery-ui.js"></script>
  
    <script type="text/javascript">
            //댓글 등록
            $(document).ready(function(){
                $('#re_bt').click(function(){
                    if($('#cont_area').val() != ""){    //textarea값이 빈 값이 아닐경우 실행
                        var params = $('#reply_form').serialize();  //serialize(): html form요소를 통해 입력된 데이터를 쿼리 문자열로 변환
                            $.ajax({
                                type: 'get',
                                url: 'reply_ok.php?=<?php echo $freeboard['idx'] ?>',
                                data: params,
                                dataType: 'html',
                                success: function(reply_ok_data){
                                    $('#reply_area').html(reply_ok_data);
                                    // html()은 선택한 요소 안의 내용을 가져오거나 다른 내용으로 바꿈
                                    // 댓글이 추가된 것을 보여주는 원리 : 
                                    // ajax로 params(댓글의 요소)를 reply_ok.php로 넘겨주고 reply_ok.php 에서는 이 요소를 $_GET으로 받아서 댓글을 insert해주는 과정이 있다. 그리고 <div id="reply_area"> 영역 안에서는 추가된 댓글이 보여지며 이 내용을 success :funcion(reply_ok_data)에서 reply_ok_data가 받아온다.
                                    //  즉, reply_ok_data에는 reply_ok.php에서의 댓글들이 담겨져 있다.  이 내용을 html(reply_ok_data)로 인해 댓글의 내용이 바뀌어 지는 것
                                    $('#cont_area').val('');
                                    location.reload();
                                }
                            });
                        }
                    });
                //댓글 수정 창 보이기
                $('.re_modify_btn').click(function(){
                    
                    var obj = $(this).closest('#reply_read').find('.reply_modify');

                    if(obj.css('display', 'none')){
                        obj.css('display', 'block');
                    }

                });
                //댓글 수정 창 닫기
                $('.btn_close').click(function(){
                    var clos = $(this).closest('#reply_read').find('.reply_modify');

                    if(clos.css('display', 'block')){
                        clos.css('display', 'none');
                    }
                });
                //게시글 삭제 확인 및 url 이동
                // $(function deleted(){
                    $('#del_btn').click(function(){
                        if(confirm("삭제하시겠습니까?")){
                            location.href="./freeDelete.php?idx=<?php echo $freeno ?>";
                        }
                        else{
                            return false;
                        }
                    });
                // });
                //댓글 접기 펼치기
                $('#re_tag').click(function(){
                    // alert($('#re_tag').val());
                    // alert(document.getElementById('re_tag').getAttribute('value'));

                    if(document.getElementById('re_tag').getAttribute('value') == 'open'){
                        document.getElementById('reply_area').style.display = 'block';
                        document.getElementById('re_tag').setAttribute('value', 'close');
                        document.getElementById('re_tag').innerHTML = '댓글 접기&nbsp;&nbsp;&nbsp;&nbsp;<i class="far fa-comment-dots"></i><?php echo $re_count ?>';
                    }
                    else{
                        document.getElementById('reply_area').style.display = 'none';
                        document.getElementById('re_tag').setAttribute('value', 'open');
                        document.getElementById('re_tag').innerHTML = '댓글 보기&nbsp;&nbsp;&nbsp;&nbsp;<i class="far fa-comment-dots"></i><?php echo $re_count ?>';
                    }
                });

            });

    </script>
</body>
</html>
<?php
    } else{
        echo "<script> alert('회원만 이용 가능합니다.'); history.back(); </script>";
    }
?>
