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
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+KR:500&display=swap" rel="stylesheet">
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
                    <th width="50%">제목</th>
                    <th width="10%">작성자</th>
                    <th width="20%">등록일</th>
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
                    $page = $_GET['page'];                           //현재 블록페이징에 값이 있으면 받아온 블록페이징의 값을 $page에 넣어줌(ex) 클릭한 블록의 페이지가 3이면 3번째 블록페이징이 $page에 넣어짐)
                }
                else{
                    $page = 1;                                       //처음에는 블록페이징의 페이지에 값이 없으므로 1을 넣어서 초기에 1부터 시작하도록
                }
                $sql = mq("select * from board1");

                $row_num = mysqli_num_rows($sql);                   //게시판 총 레코드 수, mysqli_num_rows()로 해당하는 데이터의 총 개수를 '숫자로 반환'해줌
                $list = 10;                                         //한 페이지에 보여줄 개수
                $block_ct = 5;                                     //블록당 보여줄 페이지 개수(1블록당 5개의 페이지 항목)
                
                $block_num = ceil($page/$block_ct);                 //현재 페이지의 블록 구하기, ceil()함수는 소수점 아래를 올림함수 
                // ex)현재 1페이지($page==1)라면 ceil(1/5)=0.1 -> ceil(올림) -> 1로 현재 블록은 1(1블록은 페이지 수를 5개로 정했으므로(1~5페이지까지가 1블록))
               
                $block_start = (($block_num -1)* $block_ct) + 1;    //블록의 시작번호
                                                                    // ex) 1블록은 1~5까지가 존재, 2블록은 6~10까지 존재, 2블록은 ((2-1)*5)+1 이므로 2블록의 첫 시작페이지는 6
                $block_end = $block_start + $block_ct - 1;          //블록의 마지막번호(1블록 마지막 5, 2블록 마지막 10)
                $total_page = ceil($row_num/$list);                 //페이징한 페이지 수 구하기
                                                                    // ex) 레코드 수가 16개 일 경우 ceil(16/10) = 2이므로 페이지가 2페이지 까지 나옴
                if($block_end > $total_page){                       // 이 if 문이 없을 경우 게시글이 없는데도 블록이 다 표시되어버리는 현상이 나옴
                    $block_end = $total_page;                       // 1블록에 5개의 페이지까지 나오기 때문에  레코드 수를 계산해서 나오는 페이지를 (ex)4) 블록의 마지막에 넣어서 4개의 페이지까지 나오도록 해준다.
                }                                                  
                $total_block = ceil($total_page/$block_ct);         //블록의 총 개수 (ex) 총 페이지가 3개일 경우 ceil(3/5) = 1블록만 존재, 총 페이지가 6개일 경우 ceil(6/5) = 2블록 까지 존재) 
                $start_num = ($page -1) * $list;                    //시작번호를 구하기 위한 변수 ex)1페이지일 경우 $sql2로 인해 0,9까지 출력, 3페이지일 경우 $sql2가 20,29까지 출력
 
                $sql2 = mq("select * from board1 order by idx desc limit $start_num, $list"); 
                // limit 구문의 쉼표앞에는 시작 번호 쉼표뒤에는 출력할 개수
                // ex) "select * from board1 order by idx desc limit 0, 10" 인 경우는 0번째부터 시작해서 10개를 출력(즉, 0~9번째 행을 출력한다)
                // ex) "select * from board1 order by idx desc limit 10, 10" 인 경우는 10번째부터 시작해서 10개를 출력(즉, 10~19번째 행를 출력한다)
                //board1테이블에 있는 idx를 기준으로 내림차순해서 게시글이 10개까지 표시
                //limit 시작점, 표시할 개수                                      

                //fetch_array() : 결과를 배열로 만듬, 번호로된 배열과 필드 이름으로 된 배열 두가지가 생성
                while($board = $sql2 -> fetch_array()){             //쿼리의 행이 끝날때 까지 자동을 반복하고 그 값을 $board에 저장(읽어들인 데이터가 $board에 있음)
                    $title = $board['title'];
                    
                    if(strlen($title) > 30){
                        $title = str_replace($board['title'], mb_substr($board['title'], 0, 30, "utf-8")."...", $board['title']);   //str_replace(변경대상 문자, 변경하려는 문자, 변수(replace가 바꾸고자 하는 문자열))
                        //mb_substr(문자열, 시작위치, 나타낼 길이, 인코딩 방식)
                    }
            ?>
            <tbody>
                <tr>
                    <td width="10%"><?php echo $board['idx'] ?></td>
                    <td width="50%"><a href="./read.php?idx=<?php echo $board['idx'] ?>"><?php echo $title ?></a></td>
                    <td width="10%"><?php 
                        if($board['id'] == "arvrroot"){
                            echo "총괄관리자";
                        }
                        else{
                            echo $board['id'];
                        }
                        ?></td>
                    <td width="20%"><?php echo $board['date'] ?></td>
                    <td width="10%"><?php echo $board['hit'] ?></td>
                    <?php
                        if($mgchk['group'] == "root" || $mgchk['group'] == "manager"){
                    ?>
                            <td width="5%"><input type="checkbox" name="chk[]" value="<?php echo $board['idx'] ?>" class="checkSelect"></td>
                            <input type="hidden" name="fileck[]" value="<?php echo $board['file'] ?>">
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
                        echo "<li><a> << </a></li>";                 //초기에 페이지는 1이므로 '처음(<< 기호)' 글자는 링크 존재 X
                    }
                    else{
                        echo "<li><a href='?page=1'> << </a></li>";      //그 외에의 페이지에는 '처음(<< 기호)' 버튼 클릭 시 ?page=1의 파라미터를 주어서 1번 페에지로 갈 수 있게 링크 
                    }
                    if($page <= 1){
                         //만약 페이지가 1보다 작거나 1일 경우, '이전(< 기호)' 버튼이 필요 없으므로 빈 값을 줌
                    }
                    else{
                        $pre = $page - 1;                               // 페이지가 1보다 큰 경우, $pre변수에 현재 페이지의 한 단계 낮은 페이지로 갈 수 있도록 해주기
                        echo "<li><a href='?page=$pre'> < </a></li>";  //'이전(< 기호)'버튼 클릭 시 ?page=$pre의 파라미터를 주어서 $page -1로 이동할 수 있게 링크
                    }
                    for($i=$block_start; $i<=$block_end; $i++){        //초기값은 블록의 시작번호($block_start), 마지막 블록보다 작거나 같을 때까지 $i(블록의 번호)를 반복

                        if($page == $i){                               //현재페이지($page)와 블록의 번호($i)가 같으면 
                            echo "<li><a id='now_page'>$i</a></li>";          //현재 페이지 및 번호는 링크 존재 X
                        }
                        else{
                            echo "<li><a href='?page=$i'>$i</a></li>";    //현재 페이지가 아닌 번호는 번호별 페이지 파라미터를 주어서(?page=$i) 번호별 페이지로 갈 수 있게 링크
                        }
                    }
                    if($block_num >= $total_block){
                        //만약 현재 페이지의 블록이 블록의 총 개수보다 많거나 같다면 빈 값, '다음(> 기호)' 버튼이 필요 없으므로 빈 값을 줌
                    }
                    else{
                        $next = $page + 1;
                        echo "<li><a href='?page=$next'> > </a></li>";     //'다음(> 기호)' 버튼 클릭 시 ?page=$next 의 파라미터를 주어서 $page + 1로 이동할 수 있게 링크
                    }
                    if($page >= $total_page){                           //마지막 페이징에 해당할 경우 '마지막(>> 기호)' 버튼에 빨간색 표시         
                        echo "<li><a> >> </a></li>";  
                    }
                    else{                                               //마지막 페이징에 해당 하지 않다면 '마지막(>> 기호)' 버튼 클릭 시 페이지의 끝으로 이동
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
            <a href="./write.php"><button class="btn btn-primary">글 쓰기</button></a>
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
    <?php
        //삭제 시 idx값이 정렬되지 않으므로, AUTO_INCREMENT 재 정렬
        $sql2 = mq("alter table board1 AUTO_INCREMENT = 1");
        $sql2 = mq("set @COUNT = 0");
        $sql2 = mq("update board1 set idx = @COUNT:=@COUNT + 1");
    ?>


    </div>

    <?php
        include "../common/footer.php"
    ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
    <script>
        var sendarr = Array();
        var noticearr = Array();
        var noticecnt = 0;
        var chkbox = $('.checkSelect');
        var gubun = 0;  // confirm 삭제 시 gubun을 1로 만들어주어서 파이어베이스 삭제 js파일이 반응할 수 있도록 해준다.
        var session = "<?= $session ?>";

        $(".check_all").click(function(){
            $(".checkSelect").prop('checked', this.checked);
        });

        $("#clicktrash").click(function(){
            if(confirm("삭제 하시겠습니까?")){
                gubun = 1;  //삭제 수락 시 gubun을 1로 만들어주어서 chkdelete_file.js의 if문이 성립이 되어서 firebase파일도 삭제 작업을 해주도록 한다.
                for(var i =0; i<chkbox.length; i++){
                    // console.log(chkbox[i].value);
                    if(chkbox[i].checked == true ){
                        sendarr[i] = chkbox[i].value;
                        console.log(document.getElementsByName("fileck[]")[i].value);

                        if(document.getElementsByName("fileck[]")[i].value != ""){
                            noticearr[noticecnt] = document.getElementsByName("fileck[]")[i].value;
                            noticecnt++;
                        }

                    }
                }

                if(sendarr == ""){
                    console.log("check none");
                }
                else{
                    var chkjson = JSON.stringify(sendarr);
                    console.log(chkjson);
                    console.log(sendarr);
                    console.log(noticearr);

                    $.ajax({
                            type: "POST",
                            url: "./delete_trashbtn.php",
                            data: {data : chkjson},
                            cache: false,
                            success: function(e){
                                // console.log(e);
                                alert("삭제 되었습니다.");
                                location.reload();
                            }
                        });
                }
            } else{
                location.reload();
                return false;
                
            }
        });
    </script>
    <script src="./chkdelete_file.js"></script>
</body>
</html>
