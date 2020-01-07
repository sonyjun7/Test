<?php
    include "../common/db.php";
    $session = $_SESSION['userid'];

    $mmchk = mq("select * from member where id='".$session."'");
    $mgchk = $mmchk -> fetch_array();

    if(!isset($_SESSION['userid'])){
        echo "<script> alert('회원만 접근할 수 있습니다.'); history.back(); </script>";
    }
    else{
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
    <link rel="stylesheet" href="../../css/dataroom_css/dataroom.css">
    <title>앱 다운로드</title>
</head>
<body>

    <?php
        include "../common/header.php"
    ?>

    <div id="hNotice">
        <h2>자료실</h2>
        <img src="../../img/main_pic_02.png">
    </div>

    <?php
        $category = $_GET['catgo'];
        $search = $_GET['search'];
    ?>

    <div id="hNotice2">
        <?php
            if($category = 'title'){
                echo "<h2>'$search' 의 검색결과</h2>";
            }
        ?>
        <a href="./appDownload.php"><h4>메인 자료실로 돌아가기</h4></a>
    </div>

    <div id="board_area">
        <div id="notice_back"></div>

        <table class="table table-bordered" id="app_list">
            <thead>
                <tr>
                    <th width="10%">번호</th>
                    <th width="30%">앱 버전</th>
                    <th width="30%">다운로드</th>
                    <th width="20%">날짜</th>
                </tr>
            </thead>
        <?php
            if(isset($_GET['page'])){   
                $page = $_GET['page'];                          
            }
            else{
                $page = 1;                                    
            }
            $sql = mq("select * from appboard where $category like '%$search%' order by idx desc");

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

            $sql2 = mq("select * from appboard where $category like '%$search%' order by idx desc limit $start_num, $list ");

            while($appboard = $sql2 -> fetch_array()){
            $title = $appboard['title'];

            if(strlen($title) > 0 && strlen($title) < 50){

                $first = mb_substr($title, 0, strlen($title)/2, "utf-8");
                $second = mb_substr($title, strlen($title)/2, strlen($title), "utf-8");

                $ad = $first.'<br>'.$second;    
            }
            else if(strlen($title) >= 50){

                $first = mb_substr($title, 0, strlen($title)/2, "utf-8");
                $second = mb_substr($title, strlen($title)/2, strlen($title), "utf-8");

                $ad = $first.'<br>'.$second;    

                $title = str_replace($ad, mb_substr($ad, 0, 50, "utf-8")."...", $ad);
            }
        ?>
            <tbody>
                <tr>
                    <td width="10%"><?php echo $appboard['idx'] ?></td>
                    <td width="20%"><?php 
                        if(strlen($title) > 0 && strlen($title) < 50){
                            echo $ad;
                        }
                        else if(strlen($title) >= 50){
                            echo $title;
                        }
                        else{
                            echo $title;
                        }
                     
                     ?></td>

                    <td width="20%">
                        <?php
                            if($appboard['link']){     
                        ?>
                                <a href="<?php echo $appboard['link'] ?>" target="_blank"><button class="btn btn-primary">playstore 링크</button></a> 
                        <?php
                            }if($appboard['link'] == ""){  
                        ?>
                                 <a href=""><button class="btn btn-success">앱 링크 X</button></a>
                        <?php        
                            }
                            if($appboard['file2']){
                         ?>
                                <a href="../../download/mobile_ver/<?php echo $appboard['file2'] ?>"><button class="btn btn-primary">모바일용</button></a>
                        <?php     
                            }if($appboard['file2'] == ""){
                        ?>
                                <a href=""><button class="btn btn-success">모바일파일 없음</button></a>
                        <?php
                            }
                        ?>
                    </td>
                    
                    <td width="5%"><?php echo $appboard['date'] ?></td>

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
           if($mgchk['group'] == "manager" || $mgchk['group'] == "root"){
        ?>
        <div id="write_btn">
            <a href="./appUpload.php"><button class="btn btn-primary">앱 업로드</button></a>
        </div>
        <?php
           }
        ?>

        <div id="search_box">
            <form action="./appsearch.php" method="get">
                <select name="catgo" id="select_search" class="form-control">
                    <option value="title">버전 제목</option>
                </select>

                <input type="text" name="search" class="form-control" required="required">
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

<?php } ?>