<?php
    include "../common/db.php";
    $session = $_SESSION['userid'];
    $seq = 0;

    $mmchk = mq("select * from member where id='".$session."'");
    $mgchk = $mmchk -> fetch_array();

    if($mgchk['group'] == "root"){
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
    <title>가입대기목록</title>
</head>
<body>

    <?php
        include "../common/header.php";
    ?>

    <div id="hNotice">
        <h2>승인대기자목록</h2>
        <img src="../../img/main_pic_02.png">
    </div>

    <div id="stu_tit_div">

        <div id="stu_title">
            <p>* 관리자/교육자 회원 승인을 해주세요</p>
            <p>* 해당 유저의 아이디를 클릭시 상세정보가 나옵니다</p>
            <p>* 해당 유저를 체크하고 승인 버튼을 누르면 해당 유저가 승인됩니다.</p>
            <p>* 해당 유저를 체크하고 승인거부 버튼을 누르면 해당 유저가 거부되며 삭제됩니다.</p>

            <div id="submitdiv">
                <button id="click_deny" class="btn btn-danger">승인거부</button>
                <button id="click_submit" class="btn btn-success">승인</button>
            </div>
        </div>

        <div id="list_area2">
            <div id="list_back"></div>

            <table id="list_table2" class="table table-hover">
                <thead>
                    <tr>
                        <th>순 번</th>
                        <th>아이디</th>
                        <th>그룹</th>
                        <th>사용자메일</th>
                        <!-- <th>전화번호</th> -->
                        <th>가입상태</th>
                        <th><input type="checkbox" name="all" class="check_all"></th>
                    </tr>
                </thead>

                <?php
                    if(isset($_GET['page'])){
                        $page = $_GET['page'];
                    }
                    else{
                        $page = 1;
                    }
                    $mq1 = mq("select * from member where submit_flag='N'");

                    $row_num = mysqli_num_rows($mq1);

                    $list = 10;
                    $block_ct = 5;

                    $block_num = ceil($page/$block_ct);
                    $block_start = (($block_num -1)*$block_ct) + 1;
                    $block_end = $block_start + $block_ct - 1;
                    $total_page = ceil($row_num/$list);

                    if($block_end > $total_page){
                        $block_end = $total_page;
                    }
                    $start_num = ($page -1)*$list;

                    $mq2 = mq("select * from member where submit_flag = 'N' order by id desc limit $start_num,$list");

                    // 순번에 해당 승인대기자목록의 수를 넣어주고  $seq--로 감소
                    $seq = $row_num;
                    while($memlist = $mq2 -> fetch_array()){
                        
                ?>
                <tbody>
                    <tr>
                        <td><?php echo $seq ?></td>
                        <!-- data-id에 모달창에 넘길 데이터를 담아준다. 아이디,그룹,사용자메일...등 쉼표(,)로 구분해서 넣어줌-->
                        <td><button data-toggle="modal" data-id="<?php echo $memlist['id'] ?>,<?php echo $memlist['group'] ?>,<?php echo $memlist['mail'] ?>,<?php echo $memlist['p_num'] ?>,<?php echo $memlist['gender'] ?>,<?php echo $memlist['edu_course'] ?>,<?php echo $memlist['attach'] ?>,<?php echo $memlist['submit_flag'] ?>,<?php echo $memlist['school']?>" data-target="#layerpop" class="btn btn-link modalbtn"><?php echo $memlist['id'] ?>
    
                        </button></td>
                        <td><?php echo $memlist['group'] ?></td>
                        <td><?php echo $memlist['mail'] ?></td>
                        <!-- <td><?php //echo $memlist['p_num'] ?></td> -->
                        <td><button class="btn btn-link"><?php 
                        if($memlist['submit_flag'] == "N"){
                            echo "승인 요청중..";
                        }  ?></button></td>
                        <td><input type="checkbox" name="chk[]" value="<?php echo $memlist['id']?>" class="checkSelect"></td>
                    </tr>
                </tbody>


                <?php
                        $seq--;
                    }
                ?>

            </table>

            <!-- 모달 출력 영역 -->
            <div class="modal fade" id="layerpop" >
                <div class="modal-dialog">
                    <div class="modal-content">
                    <!-- header -->
                    <div class="modal-header">
                        <!-- 닫기(x) 버튼 -->
                        <button type="button" class="close" data-dismiss="modal">×</button>
                        <!-- header title -->
                        <h4 class="modal-title">유저 상세정보확인</h4>
                    </div>
                    <!-- body -->
                    <div class="modal-body">
                        <h4 class="md_c_b">아이디 : </h4>
                        <h4 id="md_p"></h4>
                        <br>
                        <h4 class="md_c_b">그룹 : </h4>
                        <h4 id="md_p2"></h4>
                        <br>
                        <h4 class="md_c_b">메일 : </h4>
                        <h4 id="md_p3"></h4>
                        <br>
                        <h4 class="md_c_b">전화번호 : </h4>
                        <h4 id="md_p4"></h4>
                        <br>
                        <h4 class="md_c_b">성별 : </h4>
                        <h4 id="md_p5"></h4>
                        <br>
                        <h4 class="md_c_b">학급코스(학급/학년/반) : </h4>
                        <h4 id="md_p6"></h4>
                        <br>
                        <h4 class="md_c_b">소속(명칭) : </h4>
                        <h4 id="md_p7"></h4>
                        <br>
                        <h4 class="md_c_b">승인상태 : </h4>
                        <h4 id="md_p8"></h4>
                        <br>
                        <h4 class="md_c_b">학교명 : </h4>
                        <h4 id="md_p9"></h4>
                    </div>
                    <!-- Footer -->
                        <div class="modal-footer">
                    
                            <button type="button" class="btn btn-default" data-dismiss="modal">닫기</button>
                        </div>
                    </div>
                </div>
            </div>
            <!--  -->


            <div id="page_num">
                <ul class="pagination">
                    <?php
                        if($page <= 1){
                            echo "<li><a> << </a></li>";
                        }
                        else{
                            echo "<li><a href='?page=1'> << </a></li>";
                        }
                        if($page <= 1){

                        }
                        else{
                            $pre = $page -1;
                            echo "<li><a href='?page=$pre'> < </a></li>";
                        }
                        for($i=$block_start; $i<=$block_end; $i++){
                            if($page == $i){
                                echo "<li><a id='now_page'>$i</a></li>";
                            }
                            else{
                                echo "<li><a href='?page=$i'>$i</a></li>";
                            }
                        }
                        if($block_num >= $total_page){

                        }
                        else{
                            $next = $page + 1;
                            echo "<li><a href='?page=$next'> > </a></li>";
                        }
                        if($page >= $total_page){
                            echo "<li><a> >> </a></li>";
                        }
                        else{
                            echo "<li><a href='?page=$total_page'> >> </a></li>";
                        }
                    ?>
                </ul>
            </div>
        </div>
        
        <div id="my_btn">
            <a href="./masterPage.php"><button class="btn btn-primary">관리자 페이지로</button></a>
        </div>

    </div>

    <?php
        include "../common/footer.php";
    ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
    <script>
        // 승인 대기중인 유저의 id를 클릭시
        $(document).on("click", ".modalbtn", function(){
            var modalId = Array();
            modalId = $(this).data("id").split(',');
            // for문으로 modalId배열에 split으로 구분된 문자열들이 하나씩 들어감
            for(var i in modalId){
                // console.log(modalId[i]);
            }
            document.getElementById("md_p").innerHTML = modalId[0];
            document.getElementById("md_p2").innerHTML = modalId[1];
            document.getElementById("md_p3").innerHTML = modalId[2];
            document.getElementById("md_p4").innerHTML = modalId[3];
            document.getElementById("md_p5").innerHTML = modalId[4];
            if(modalId[1] == "teacher"){
                document.getElementById("md_p6").innerHTML = modalId[5] +"/"+ modalId[6] +"/"+ modalId[7];
            }
            else{
                document.getElementById("md_p6").innerHTML = "NULL"
            }
            if(modalId[1] == "teacher"){
                document.getElementById("md_p7").innerHTML = modalId[8];
            }
            else{
                document.getElementById("md_p7").innerHTML = modalId[6];
            }
            if(modalId[1] == "teacher"){
                document.getElementById("md_p8").innerHTML = modalId[9];
            }
            else{
                document.getElementById("md_p8").innerHTML = modalId[7];
            }
            if(modalId[1] == "teacher"){
                document.getElementById("md_p9").innerHTML = modalId[10];
            }
            else{
                document.getElementById("md_p9").innerHTML = modalId[8];
            }

            // var modalId = $(this).data("id");
            // console.log($(this).data("id"));
        
            // console.log($("#hgrup")[0].value);
            // console.log($(".modal-body #md_p").val(modalId)[0].value);
            // $(".modal-body #md_p").val(modalId);
            // document.getElementById("md_p").innerHTML = modalId;
        });


        // 체크박스 전체 선택
        $(".check_all").click(function(){
            $(".checkSelect").prop('checked', this.checked);
        });
        //승인버튼 클릭시
        $("#click_submit").click(function(){
            var send_array = Array();
            var send_cnt = 0;
            var chkbox = $(".checkSelect");

            console.log("클릭");
                for(i=0; i<chkbox.length; i++){
                    if(chkbox[i].checked == true){
                        send_array[send_cnt] = chkbox[i].value;
                        send_cnt++;
                    }
                }
                console.log(send_array);

                if(send_array == ""){   
                    console.log("check none");
                }
                else{   
                    if(confirm("승인처리 하시겠습니까?")){
                        var jsonString = JSON.stringify(send_array); 
                        //JSON.stringify : javascript 값이나 객체를 JSON 문자열로 변환
                        console.log(jsonString);

                        $.ajax({
                            type: "POST",
                            url: "./submit_ok.php",
                            data: {data : jsonString},
                            cache: false,
                            success: function(e){
                                // alert(JSON.stringify(e));
                                console.log(JSON.stringify(e));
                                alert("승인 처리 되었습니다.");
                                location.reload();
                            }
                        });
                    }
                    else{
                        return false;
                    }
                }
        });
        // 승인거부 버튼 클릭시
        $("#click_deny").click(function(){
            var send_array = Array();
            var send_cnt = 0;
            var chkbox = $(".checkSelect");

                for(i=0; i<chkbox.length; i++){
                    if(chkbox[i].checked == true){
                        send_array[send_cnt] = chkbox[i].value;
                        send_cnt++;
                    }
                }
                console.log(send_array);

                if(send_array == ""){   
                    console.log("check none");
                }
                else{   
                    if(confirm("승인거부 하시겠습니까?")){
                        var denyString = JSON.stringify(send_array); 
                        //JSON.stringify : javascript 값이나 객체를 JSON 문자열로 변환
                        console.log(denyString);

                        $.ajax({
                            type: "POST",
                            url: "./deny_ok.php",
                            data: {data : denyString},
                            cache: false,
                            success: function(e){
                                // alert(JSON.stringify(e));
                                console.log(JSON.stringify(e));
                                alert("승인거부 되었습니다.");
                                location.reload();
                            }
                        });
                    }
                    else{
                        return false;
                    }
                }
        });

    </script>
</body>
</html>
<?php
    }else{
        echo "<script> alert('잘못된접근입니다.');  location.href='../../index.php'; </script>";
    }
?>