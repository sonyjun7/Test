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
    <title>중등 시나리오 관람</title>
</head>
<body>

    <?php
        include "../common/header.php"
    ?>

    <div id="hNotice">
        <h2>중등 시나리오 게시판</h2>
        <img src="../../img/main_pic_02.png">
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
                $sql = mq("select * from scenario_post_mid");

                $row_num = mysqli_num_rows($sql);                
                $list = 10;                                  
                $block_ct = 5;                                     
                
                $block_num = ceil($page/$block_ct);                
               
                $block_start = (($block_num -1)* $block_ct) + 1;   
                $block_end = $block_start + $block_ct - 1;          
                $total_page = ceil($row_num/$list);   

                if($block_end > $total_page){                       
                    $block_end = $total_page;                       
                }                                                  
                $total_block = ceil($total_page/$block_ct);      
                $start_num = ($page -1) * $list;                    
 
                $sql2 = mq("select * from scenario_post_mid order by post_idx desc limit $start_num, $list");                                         


                while($sceboard = $sql2 -> fetch_array()){             
                    $title = $sceboard['post_title'];
                    
                    if(strlen($title) > 30){
                        $title = str_replace($sceboard['post_title'], mb_substr($sceboard['post_title'], 0, 30, "utf-8")."...", $sceboard['post_title']);   
                    }

                    if($sceboard['date'] != ""){
            ?>
            <tbody>
                <tr>
                    <td width="10%"><?php echo $sceboard['post_idx'] ?></td>
                    <td width="20%"><?php echo $sceboard['id'] ?></td>
                    <form action="./mid_scenarioRead.php" method="post">
                        <td width="30%"><button class="btn btn-link"><?php echo $title ?></button></td>
                        <input type="hidden" name="id" value="<?php echo $sceboard['id'] ?>">
                        <input type="hidden" name="post_idx" value="<?php echo $sceboard['post_idx'] ?>">
                    </form>
                  
                    <td width="30%"><?php echo $sceboard['date'] ?></td>
                    <td width="10%"><?php echo $sceboard['hit'] ?></td>
                </tr>

            </tbody>
        <?php
                    }
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
                         //만약 페이지가 1보다 작거나 1일 경우, '이전(< 기호)' 버튼이 필요 없으므로 빈 값을 줌
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
                        //만약 현재 페이지의 블록이 블록의 총 개수보다 많거나 같다면 빈 값, '다음(> 기호)' 버튼이 필요 없으므로 빈 값을 줌
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

        <div id="search_box">
            <form action="./mid_scenario_search_result.php" method="get">
                    <select name="catgo" id="select_search" class="form-control">
                        <option value="id">작성자</option>
                        <option value="post_title">제목</option>
                    </select>

                    <input type="text" class="form-control" name="search" required="required"/>
                    <button class="btn btn-primary">검색</button>
            </form>
        </div> 
    <?php
        //삭제 시 idx값이 정렬되지 않으므로, AUTO_INCREMENT 재 정렬
        $sql2 = mq("alter table scenario_post_mid AUTO_INCREMENT = 1");
        $sql2 = mq("set @COUNT = 0");
        $sql2 = mq("update scenario_post_mid set post_idx = @COUNT:=@COUNT + 1");
    ?>

    </div>

    <?php
        include "../common/footer.php"
    ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
</body>
</html>