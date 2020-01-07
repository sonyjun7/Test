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
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Do+Hyeon|Jua|Nanum+Gothic+Coding" rel="stylesheet">
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/common_css/common.css">
    <link rel="stylesheet" href="../../css/notice_css/main_notice.css">

    <title>공지사항</title>
</head>
<body>

    <?php
        include "../common/header.php"
    ?>

    <div id="hNotice">
        <h2>공지사항</h2>
        <img src="../../img/main_pic_02.png">
    </div>

    <?php
        // 검색한 변수를 get으로 받아오기
        $category = $_GET['catgo'];
        $search = $_GET['search'];
    ?>

    <div id="hNotice2">
        <?php if($category == 'title'){ ?>  <!-- 제목 검색 시 -->
            <h2>'제목'에서 '<?php echo $search; ?>'의 검색결과</h2>
        <?php } ?>
        
        <?php if($category == 'content'){ ?>  <!-- 내용 검색 시 -->
            <h2>'내용'에서 '<?php echo $search; ?>'의 검색결과</h2>
        <?php } ?>

        <h4><a href="./arvr_notice.php">메인 게시판으로 돌아가기</a></h4>
    </div>

    <div id="board_area">
        <div id="notice_back"></div>
        
        <table id="list_table" class="table table-striped">
            <thead>
                <tr>
                    <th width="10%">번호</th>
                    <th width="50%">제목</th>
                    <th width="20%">등록일</th>
                    <th width="10%">조회수</th>
                </tr>
            </thead>

            <?php
                if(isset($_GET['page'])){
                    $page = $_GET['page'];        
                }
                else{
                    $page = 1;                               
                }
                $sql1 = mq("select * from board1 where $category like '%$search%' order by idx desc");

                $row_num = mysqli_num_rows($sql1);

                $list = 10;
                $block_ct = 5;

                $block_num = ceil($page/$block_ct);

                $block_start = (($block_num - 1)*$block_ct) + 1;
                $block_end = $block_start + $block_ct - 1;

                $total_page = ceil($row_num/$list);

                if($block_end > $total_page){
                    $block_end = $total_page;
                }
                
                $total_block = ceil($total_page/$block_ct);
                $start_num = ($page -1) * $list;

                $sql2 = mq("select * from board1 where $category like '%$search%' order by idx desc limit $start_num, $list"); 

                while($board = $sql2 -> fetch_array()){
                    
                    $title = $board['title'];
                    if(strlen($title) > 30){
                        $title = str_replace($board['title'], mb_substr($board['title'],0,30,"utf-8")."...", $board['title']);
                    }
            ?>
            <tbody>
                <tr>
                    <td width="10%"><?php echo $board['idx'] ?></td>
                    <td width="50%"><a href="./read.php?idx=<?php echo $board['idx'] ?>"><?php echo $title?></a></td>
                    <td width="20%"><?php echo $board['date'] ?></td>
                    <td width="10%"><?php echo $board['hit'] ?></td>
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
                        echo "<li><a href='?catgo=$category&search=$search&page=1'> << </a></li>";
                    }
                    if($page <= 1){

                    }
                    else{
                        $pre = $page - 1;
                        echo "<li><a href='?catgo=$category&search=$search&page=$pre'> < </a></li>";
                    }
                    for($i=$block_start; $i<=$block_end; $i++){
                        if($page == $i){
                            echo "<li><a id='now_page'>$i</a></li>";
                        }
                        else{
                            echo "<li><a href='?catgo=$category&search=$search&page=$i'>$i</a></li>";
                        }
                    }
                    if($block_num >= $total_block){

                    }
                    else{
                        $next = $page  + 1;
                        echo "<li><a href='?catgo=$category&search=$search&page=$next'> > </a></li>";
                    }
                    if($page >= $total_page){
                        echo "<li><a> >> </a></li>";
                    }
                    else{
                        echo "<li><a href='?catgo=$category&search=$search&page=$total_page'> >> </a></li>";
                    }
                ?>
            </ul>
        </div>

        <?php
            $sql3 = mq("select * from member where id='".$session."'");

            $mgchk = $sql3 -> fetch_array();

            if($mgchk['group'] == "manager" || $mgchk['group'] == "teacher" || $mgchk['group'] == "root"){
        ?>

        <div id="write_btn">
            <a href="./write.php"><button class="btn btn-primary btn-lg">글 쓰기</button></a>
        </div>
        <?php
            }
        ?>

        <div id="search_box">
            <form action="./search_result.php" method="get">
                <select name="catgo" id="select_search" class="form-control">
                    <option value="title">제목</option>
                    <option value="content">내용</option>
                </select>

                <input type="text" class="form-control" name="search" required="required"/>
                <button class="btn btn-primary">검색</button>
            </form>
        </div>

    </div>

    <?php
        include "../common/footer.php"
    ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
</body>
</html>