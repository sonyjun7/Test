<?php
    include "../common/db.php";

        // echo "<script> alert('".$_SESSION['userid']."'); </script>";
        // echo "<script> alert('".$_GET['session']."'); </script>";
        $freeno = $_GET['idx'];
        $datetime = date('y-m-d H:i:s');
        $re_sql = mq("insert into reply(con_num, name, content, date) values('".$freeno."', '".$_GET['session']."', '".$_GET['content']."', '".$datetime."')");
?>

    <div id="reply_area">
        <h3>댓글 목록</h3>
        <?php
            $sql4 = mq("select * from reply where con_num='".$freeno."' order by idx desc");
            while($reply = $sql4 -> fetch_array()){
        ?>
        <div id="reply_read">
            <div id="reply1">
                <i class="fas fa-user"></i>
                <h5><?php echo $reply['name'] ?></h5>
                <h5><?php echo $reply['date'] ?></h5>
                <?php 
                    if($reply['name'] == $_SESSION['userid']){
                ?>
                    <!-- <a id="re_modify" href="#">수정</a>
                    <a id="re_delete" href="#">삭제</a> -->
                <?php
                    }
                ?>
            </div>
            <div id="reply2">
                <h4><?php echo $reply['content'] ?></h4>
            </div>
        </div>
        <?php
            }
        ?>

        <div id="reply_write">
            <form method="get" id="reply_form">
                <input type="hidden" name="freeno" value="<?php echo $freeno ?>">
                <input type="hidden" name="session" vlaue="<?php echo $_SESSION['userid']?>">
                <textarea name="content" id="cont_area" required="required"></textarea>
                <button class="btn btn-primary" id="re_bt">댓글</button>
            </form>
        </div>
    </div>

    <?php
        include "../common/footer.php"
    ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript">
    
            $(document).ready(function(){
                $('#re_bt').click(function(){
                    if($('#cont_area').val() != ""){
                        var params = $('#reply_form').serialize();  //serialize(): html form요소를 통해 입력된 데이터를 쿼리 문자열로 변환
                            $.ajax({
                                type: 'get',
                                url: 'reply_ok.php?=<?php echo $freeboard['idx'] ?>',
                                data: params,
                                dataType: 'html',
                                success: function(data){
                                    $('#reply_area').html(data);
                                    $('#cont_area').val('');
                                    location.reload();
                                }
                            });
                        }
                    });
                });

    </script>

    <?php
        $re_sql = mq("alter table reply AUTO_INCREMENT=1");
        $re_sql = mq("set @COUNT=0");
        $re_sql = mq("update reply set idx=@COUNT:=@COUNT+1");
    ?>
