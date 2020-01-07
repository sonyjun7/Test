<?php  
     include "../common/db.php";
     $session = $_SESSION['userid'];
     
     $mmchk = mq("select * from member where id='".$session."'");
     $mgchk = $mmchk -> fetch_array();
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
    <title>투표게시판</title>
</head>
<body>

    <?php
        include "../common/header.php"
    ?>

    <div id="hNotice">
        <h2>투표 게시판</h2>
        <img src="../../img/main_pic_02.png">
    </div>

    <div id="board_area">
        <?php
            if($mgchk['group'] == "manager" || $mgchk['group'] == "root"){
        ?>
            <div id="trashdiv">
                <!-- <a id="clicktrash" href="./arvr_notice.php"><i class="fas fa-trash-alt fa-2x"></i></a> -->
                <a id="clicktrash"><i class="fas fa-trash-alt fa-2x"></i></a>
            </div>
        <?php
            }
        ?>  
        <div id="notice_back"></div>
        
        <table id="list_table" class="table table-hover">
            <thead>
                <tr>
                    <th width="10%">번호</th>
                    <th width="20%">작성자</th>
                    <th width="30%">제목</th>
                    <th width="30%">등록일</th>
                    <th width="10%">조회수</th>
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
                }
                else{
                    $page = 1;                               
                }
                $sql = mq("select * from vote_board");

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
 
                $sql2 = mq("select * from vote_board order by idx desc limit $start_num, $list");                                         

                while($voteboard = $sql2 -> fetch_array()){             
                    $title = $voteboard['title'];
                    
                    if(strlen($title) > 30){
                        $title = str_replace($voteboard['title'], mb_substr($voteboard['title'], 0, 30, "utf-8")."...", $voteboard['title']);   
                    }

            ?>
            <tbody>
                <tr>
                    <td width="10%"><?php echo $voteboard['seq'] ?></td>
                    <td width="20%"><?php echo $voteboard['id'] ?></td>
                    <td><a width="30%" href="./voteRead.php?idx=<?php echo $voteboard['idx'] ?>"><?php echo $title ?></a></td>
                    <td width="30%"><?php echo $voteboard['date'] ?></td>
                    <td width="10%"><?php echo $voteboard['hit'] ?></td>
                    <?php
                        if($mgchk['group'] == "root" || $mgchk['group'] == "manager"){
                    ?>
                            <td width="5%"><input type="checkbox" name="chk[]" value="<?php echo $voteboard['idx'] ?>" class="checkSelect"></td>
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
    <script>
        var vboardarr = Array();
        var send_cnt = 0;
        var chkbox = $(".checkSelect");

        $(".check_all").click(function(){
            $(".checkSelect").prop('checked', this.checked);
        });

        $("#clicktrash").click(function(){
            if(confirm("삭제 하시겠습니까?")){

                for(var i=0; i<chkbox.length; i++){
                    if(chkbox[i].checked == true){
                        vboardarr[send_cnt] = chkbox[i].value;
                        send_cnt++;
                    }
                }

                if(vboardarr == ""){
                    console.log("체크 none");
                }
                else{
                    var jsonchk = JSON.stringify(vboardarr);
                    console.log(jsonchk);
                    console.log(vboardarr);

                    $.ajax({
                        type: "POST",
                        url: "./vote_trashbtn.php",
                        data: {data : jsonchk},
                        cache: false,
                        success: function(e){
                            // console.log(e);
                            alert("삭제 되었습니다.");
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