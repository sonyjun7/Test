<?php  
     include "../common/db.php";
     $session = $_SESSION['userid'];
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Do+Hyeon|Jua|Nanum+Gothic+Coding" rel="stylesheet">
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/common_css/common.css">
    <link rel="stylesheet" href="../../css/userEnter_css/scenario.css">
    <link rel="stylesheet" href="../../css/userEnter_css/vote.css">
    <title>투표 게시판</title>
</head>
<body>

    <?php
        include "../common/header.php"
    ?>

    <div id="hNotice">
        <h2>투표 게시판</h2>
        <img src="../../img/main_pic_02.png">
    </div>

    <?php
        $category = $_GET['catgo'];
        $search = $_GET['search'];

        // echo $category;
        // echo $search;
    ?>

    <div id="hNotice2">
        <?php 
            if($category == 'id'){
                echo "<h2>'작성자'에서 '$search' 의 검색결과</h2>";
            }
            else if($category == 'title'){
                echo "<h2>'제목'에서 '$search'의 검색결과</h2>";
            }
        ?>
        <h4><a href='./vote_notice.php'>투표 게시판으로 돌아가기</a></h4>
    </div>

    <div id="board_area">
        <div id="notice_back"></div>
        
        <table id="list_table" class="table table-hover">
            <thead>
                <tr>
                    <th width="10%">번호</th>
                    <th width="20%">작성자</th>
                    <th width="30%">제목</th>
                    <th width="30%">등록일</th>
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
                $sql1 = mq("select * from vote_board where $category like '%$search%' order by idx desc");

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

                $sql2 = mq("select * from vote_board where $category like '%$search%' order by idx desc limit $start_num, $list");                                         

                while($voteboard = $sql2 -> fetch_array()){             
                    $title = $voteboard['title'];
                    
                    if(strlen($title) > 30){
                        $title = str_replace($voteboard['title'], mb_substr($voteboard['title'], 0, 30, "utf-8")."...", $voteboard['title']);   
                    }
            ?>
            <tbody>
                <tr>
                    <td width="10%"><?php echo $voteboard['idx'] ?></td>
                    <td width="20%"><?php echo $voteboard['id'] ?></td>
                    <td><a width="30%" href="./voteRead.php?idx=<?php echo $voteboard['idx'] ?>"><?php echo $title ?></a></td>
                    <td width="30%"><?php echo $voteboard['date'] ?></td>
                    <td width="10%"><?php echo $voteboard['hit'] ?></td>
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
                <a href="./voteWrite.php"><button class="btn btn-primary">글 쓰기</button></a>
            </div>
        <?php
            }
        ?>

        <div id="search_box">
            <form action="./vote_search_result.php" method="get">
                    <select name="catgo" id="select_search" class="form-control">
                        <option value="id">작성자</option>
                        <option value="title">제목</option>
                    </select>

                    <input type="text" class="form-control" name="search" required="required"/>
                    <button class="btn btn-primary">검색</button>
            </form>
        </div> 

    </div>


    <?php
        include "../common/footer.php"
    ?>

    <?php
        $sql2 = mq("alter table vote_board AUTO_INCREMENT=1");
        $sql2 = mq("set @COUNT=0");
        $sql2 = mq("update vote_board set idx=@COUNT:=@COUNT+1");
    ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
</body>
</html>