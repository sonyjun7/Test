<?php  
     include "../common/db.php";
     $session = $_SESSION['userid'];

     $mmchk = mq("select * from member where id='".$session."'");
     $mgchk = $mmchk -> fetch_array();
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Do+Hyeon|Jua|Nanum+Gothic+Coding" rel="stylesheet">
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/common_css/common.css">
    <link rel="stylesheet" href="../../css/userEnter_css/freeboard.css">

    <title>자유 게시판</title>
</head>
<body>

    <?php
        include "../common/header.php"
    ?>

    <div id="hNotice">
        <h2>자유 게시판</h2>
        <img src="../../img/main_pic_02.png">
    </div>

    <div id="freeboard_area">
        <?php
            if($mgchk['group'] == "manager" || $mgchk['group'] == "root"){
        ?>
            <div id="trashdiv">
                <a id="clicktrash"><i class="fas fa-trash-alt fa-2x"></i></a>
            </div>
        <?php
           }
        ?>  
        <div id="notice_back"></div>

        <table id="free_list" class="table table-hover">
            <thead>
                <tr>
                    <th width="10%">번호</th>
                    <th width="30%">제목</th>
                    <th width="20%">작성자</th>
                    <th width="20%">작성일</th>
                    <!-- <th width="10%">조회수</th> -->
                    <?php
                        if($mgchk['group'] == "root" || $mgchk['group'] == "manager"){
                    ?>
                            <th width="5%"><input type="checkbox" name="all" class="check_all"></th>
                    <?php
                        }
                    ?>
                </tr>
            </thead>

        <?php
            if(isset($_GET['page'])){
                $page = $_GET['page'];
            } else{
                $page = 1;
            }
            $sql = mq("select * from freeboard");

            $row_num = mysqli_num_rows($sql);   //총 레코드 갯수
            $list = 10;     //한 페이지에 보여줄 레코드 수
            $block_ct  = 5;     //블록당 보여줄 페이징 개수

            $block_num = ceil($page/$block_ct);     //현재 블록의 번호(현재 속해있는 블록 번호)
            $block_start = (($block_num -1)*$block_ct) + 1;     //블록의 시작번호
            $block_end = $block_start + $block_ct - 1;          //블록의 마지막번호

            $total_page = ceil($row_num/$list);                 //총 페이지의 개수

            if($block_end > $total_page){
                $block_end = $total_page;
            }
            $total_block = ceil($total_page/$block_ct);      //총 블록의 개수
            $start_num =  ($page -1)*$list; //아래 쿼리 셀렉을 해주기 위한 시작번호 변수

            $sql2 = mq("select * from freeboard order by idx desc limit $start_num, $list");


      
       
            while($freeboard = $sql2 -> fetch_array()){
                $title = $freeboard['title'];

                if(strlen($title) > 30){
                    $title = str_replace($freeboard['title'], mb_substr($freeboard['title'], 0, 30, "utf-8")."...", $freeboard['title']);
                }
            
            $re_sql = mq("select * from reply where con_num='".$freeboard['idx']."'");
            $re_count = mysqli_num_rows($re_sql);
        ?>
            <tbody>
                <tr>
                    <td width="10%"><?php echo $freeboard['seq'] ?></td>
                    <td width="30%"><a href="./freeRead.php?idx=<?php echo $freeboard['idx'] ?>"><?php echo $title ?><span>[<?php echo $re_count ?>]</span></a></td>
                    <td width="20%"><?php echo $freeboard['name'] ?></td>
                    <td width="20%"><?php echo $freeboard['date'] ?></td>
                    <!-- <td width="10%"><?php //echo $freeboard['hit'] ?></td> -->
                    <?php
                        if($mgchk['group'] == "root" || $mgchk['group'] == "manager"){
                    ?>
                            <td width="5%"><input type="checkbox" name="chk[]" value="<?php echo $freeboard['idx'] ?>" class="checkSelect"></td>
                    <?php
                        }
                    ?>
                </tr>
            </tbody>
        <?php
                
            }
        ?>
        </table>

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
                        $pre = $page - 1;
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
                    if($block_num >= $total_block){

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

        <div id="write_btn">
            <a href="./freeWrite.php"><button class="btn btn-primary">글 쓰기</button></a>
        </div>

        <div id="search_box">
            <form action="./free_search_result.php" method="get">
                <select name="catgo" id="select_search" class="form-control">
                    <option value="title">제목</option>
                    <option value="content">내용</option>
                </select>

                <input type="text" class="form-control" name="search" required="required">
                <button class="btn btn-primary">검색</button>
            </form>
        </div>

    </div>

    <?php
        include "../common/footer.php"
    ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
    <script>
        var send_array = Array();
        var send_cnt = 0;
        var chkbox = $('.checkSelect');

        $('.check_all').click(function(){
            $('.checkSelect').prop('checked', this.checked);
        });

        $('#clicktrash').click(function(){
            if(confirm("삭제 하시겠습니까?")){

                for(i=0; i<chkbox.length; i++){
                    if(chkbox[i].checked == true){
                        send_array[send_cnt] = chkbox[i].value;
                        send_cnt++;
                    }
                }
                console.log(send_array);

                if(send_array == ""){
                    console.log("체크되어 있지 않음");
                }
                else{
                    var jsonString = JSON.stringify(send_array);
                    console.log(jsonString);

                    $.ajax({
                        type: "POST",
                        url: "./freeboard_trash_del.php",
                        data : {data : jsonString},
                        cache : false,
                        success: function(e){
                            // console.log(e);
                            alert("삭제되었습니다");
                            location.reload();
                        }
                    });
                }
            }
            else{
                location.reload();
                return false;
            }

        });
    </script>
</body>
</html>