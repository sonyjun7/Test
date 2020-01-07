<?php
    include "../common/db.php";
    $session = $_SESSION['userid'];
    $bno = $_GET['idx'];    //read.php?idx=게시글번호를 받음, $_GET으로 현재 주소창에 있는 게시글번호 얻기

    $mmchk = mq("select * from member where id='".$session."'");
    $mgchk = $mmchk -> fetch_array();

    // 게시글 번호가있고 쿠키가 비어있다면(최초 게시글 클릭)
    if(!empty($bno) && empty($_COOKIE['notice_' . $bno])){
        // $hit = mysqli_fetch_array(mq("select * from board1 where idx='".$bno."'")); //mysqli_fetch_array()로 레코드를 1개 리턴
        // $hit = $hit['hit'] + 1;    //$hit에서 hit항목을 가져오고 +1 (조회수 +1)
        // $fet = mq("update board1 set hit='".$hit."' where idx='".$bno."'");

        // 조회수 증가
        $cook = 'update board1 set hit = hit + 1 where idx=' . $bno;
        $cookre = $db -> query($cook);
        // 조회수 증가 쿼리가 정상적으로 작동하면 setcookie로 쿠키 할당
        // setcookie('쿠키명', '쿠키 값', '쿠키 유지시간', '경로');
        // 조회수 증가 쿼리가 비정상적일 경우 $cookre가 빔
        if(empty($cookre)){
            echo "<script>alert('오류가 발생했습니다.'); history.back(); </script>";
        }
        else{
                setcookie('notice_' . $bno, TRUE, time() + (60 * 60 * 24), '/');
                // 쿠키가 하루동안 유지
            }
    }
    

    $sql = mq("select * from board1 where idx='".$bno."'");     //받아온 idx값을 선택
    $board = $sql -> fetch_array();

    $dbfile = $board['file'];

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
    <link rel="stylesheet" href="../../css/notice_css/main_notice.css">

    <title>공지사항 글읽기</title>
</head>
<body>

    <?php
        include "../common/header.php"
    ?>


    <div id="hNotice">
        <h2>공지사항 내용</h2>
        <img src="../../img/main_pic_02.png">
    </div>

    <div id="content1">
        <div id="read_box1">제목<span><?php echo $board['title'] ?></span></div>

        <div id="read_box4">조회수  <span><?php echo $board['hit'] ?></span> </div>
        <div id="read_box3">작성일   <span><?php echo $board['date'] ?></span></div>
        <div id="read_box2">작성자 <span><?php 
                if($board['id'] == "arvrroot"){
                    echo "총괄관리자";
                }
                else{
                    echo $board['id'];
                }
                ?></span></div>   
    </div>


    <div id="content2">
        <?php echo $board['content'] ?>
    </div>

    <div id="upload_div">
        첨부파일 : <a id="filedown" download><?php echo $board['file']; ?></a>
    </div>

    <div id="prev_next">
    
    </div>

    <div id="button_box">
        <?php
            // 추후에 교육자id를 찾아서 해당 글을 작성한 id가 수정 삭제 버튼이 보이도록
            // root나 manager는 관련없이 삭제 가능하게 
            if($mgchk['group'] == "manager" || $mgchk['group'] == "root" || $board['id'] == $session){
        ?>
            <a href="./modify.php?idx=<?php echo $board['idx'] ?>"><button class="btn btn-primary btn-lg">수정</button></a>
        <?php
            }
        ?>
        <a href="./arvr_notice.php"><button class="btn btn-primary btn-lg">목록</button></a>
        <?php 
            if($mgchk['group'] == "manager" || $mgchk['group'] == "root" || $board['id'] == $session){
        ?>
            <!-- <a href="./delete.php?idx=<?php //echo $board['idx'] ?>"><button id="notice_del_btn" class="btn btn-primary btn-lg">삭제</button></a> -->
            <button id="notice_del_btn" class="btn btn-primary btn-lg">삭제</button>
        <?php
            }
        ?>
    </div>

    <!-- firebase 영상 테스트 -->
    <!-- <video width="320" height="240" id="vvv" controls>
        <source type="video/mp4">
     
        Your browser does not support the video tag.
    </video> -->

    <?php
        include "../common/footer.php"
    ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
    <script>
        var dbfile;
        dbfile = "<?= $dbfile ?>";
        console.log(dbfile);

        var delidx = "<?= $board['idx'] ?>";

        $("#notice_del_btn").click(function(){
             if(confirm("삭제 하시겠습니까?")){
                location.href="./delete.php?idx="+delidx;
             }   
             else{
                 return false;
             }
        });
    </script>
    <script src="./read_ok_bundle.js"></script>
</body>
</html>
