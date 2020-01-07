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
        include "../common/header.php";

    ?>

    <div id="hNotice">
        <h2>자료실 - 앱 다운로드</h2>
        <img src="../../img/main_pic_02.png">
    </div>


    <div id="board_area">
        <?php
        if($mgchk['group'] == "manager" || $mgchk['group'] == "root"){
        ?>
        <div id="trashdiv">
            <a id="clicktrash" href="./appDownload.php"><i class="fas fa-trash-alt fa-2x"></i></a>
        </div>
        <?php
            }
        ?>  

        <div id="notice_back"></div>

        <table class="table table-bordered" id="app_list">
            <thead>
                <tr>
                    <th width="10%">번호</th>
                    <th width="20%">앱 버전</th>
                    <th width="20%">다운로드</th>
                    <th width="5%">날짜</th>
                    <?php
                       if($mgchk['group'] == "manager" || $mgchk['group'] == "root"){
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
            $sql = mq("select * from appboard");

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

            $sql2 = mq("select * from appboard order by idx desc limit $start_num, $list ");
            while($appboard = $sql2 -> fetch_array()){
                $title = $appboard['title'];

                if(strlen($title) > 0 && strlen($title) < 50){
                    // $chktit = $title;   //30자를 넘을 경우 chktit 변수에 넣어서 자바스크립트 변수로 넘겨주기 위해
                    // $ooo = substr($chktit, strlen($chktit)/2);


                    // $title = str_replace($appboard['title'], mb_substr($appboard['title'], 0, 30, "utf-8")."...", $appboard['title']);

                    $first = mb_substr($title, 0, strlen($title)/2, "utf-8");
                    $second = mb_substr($title, strlen($title)/2, strlen($title), "utf-8");

                    $ad = $first.'<br>'.$second;   
                }
                else if(strlen($title) >= 50){

                    $first = mb_substr($title, 0, strlen($title)/2, "utf-8");
                    $second = mb_substr($title, strlen($title)/2, strlen($title), "utf-8");

                    $ad = $first.'<br>'.$second;    //50줄이 넘을 경우 <br>태그로 줄바꿈처리

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
                            if($appboard['link']){     // 업로드한 파일이 있을 경우 다운로드
                        ?>
                                <a href="<?php echo $appboard['link'] ?>" target="_blank"><button class="btn btn-primary">playstore 링크</button></a> 
                        <?php
                            }if($appboard['link'] == ""){  //업로드한 파일이 없을 경우 버튼 명이 달라지고 다운로드 경로가 X
                        ?>
                            <a href=""><button class="btn btn-success">앱 링크 X</button></a>
                        <?php        
                            }
                        if($mgchk['group'] == "manager" || $mgchk['group'] == "root"){
                            if($appboard['file2']){
                         ?>
                                <a href="../../download/mobile_ver/<?php echo $appboard['file2'] ?>"><button class="btn btn-primary">모바일용 다운</button></a>
                        <?php     
                            }if($appboard['file2'] == ""){
                        ?>
                                <a href=""><button class="btn btn-success">모바일파일 없음</button></a>
                        <?php
                                }
                            }
                        ?>
                    </td>
                    
                    <td width="5%"><?php echo $appboard['date'] ?></td>
                    <?php    
                    if($mgchk['group'] == "manager" || $mgchk['group'] == "root"){
                    ?>
                        <td width="5%"><input type="checkbox" name="chk[]" value="<?php echo $appboard['idx']?>" class="checkSelect"></td>
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

        <?php
        
                $sql2 = mq("alter table appboard AUTO_INCREMENT = 1");
                $sql2 = mq("set @COUNT = 0");
                $sql2 = mq("update appboard set idx = @COUNT:=@COUNT + 1");

        ?>

    </div>

    <?php
        include "../common/footer.php"
    ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
    <script>

        // $( window ).resize(function(){
        //     var chkwidth = $(window).width();

        //     if(chkwidth < 465){   //465 미만으로 해야지 해상도가 480px이하일 때 해당 if가 나옴(??)
        //         console.log("480이하");
        //     }
        //     else{
        //         console.log("480이상");
        //     }
        // });

        var send_array = Array();
        var send_cnt = 0;
        var chkbox = $(".checkSelect");
    
        // 체크박스 전체 선택
        $(".check_all").click(function(){
            $(".checkSelect").prop('checked', this.checked);
        });

        // 선택된 체크박스 삭제
        $("#clicktrash").click(function(){

                console.log("클릭");
                for(i=0; i<chkbox.length; i++){
                    if(chkbox[i].checked == true){
                        send_array[send_cnt] = chkbox[i].value;
                        send_cnt++;
                    }
                }
                console.log(send_array);

                if(send_array == ""){   //checkbox가 선택되어있지 않다면 빈값, 삭제 하지 않음
                    console.log("check none");
                }
                else{   //checkbox가 선택되어 있다면 삭제
                    var jsonString = JSON.stringify(send_array); 
                    //JSON.stringify : javascript 값이나 객체를 JSON 문자열로 변환
                    console.log(jsonString);

                    $.ajax({
                        type: "POST",
                        url: "./checkDelete.php",
                        data: {data : jsonString},
                        cache: false,
                        success: function(e){
                            // alert(JSON.stringify(e));
                            alert("삭제 되었습니다.");
                            location.reload();
                        }
                    });
                }
        });

    </script>
</body>
</html>

<?php 
    } 
?>