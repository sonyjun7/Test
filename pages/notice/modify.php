<?php
    include "../common/db.php";

    $bno = $_GET['idx'];
    $session = $_SESSION['userid'];

    $sql = mq("select * from board1 where idx='$bno';");
    $board = $sql -> fetch_array();

    $mmchk = mq("select * from member where id='".$session."'");
    $mgchk = $mmchk -> fetch_array();

    if($mgchk['group'] == "manager" || $mgchk['group'] == "teacher" || $mgchk['group'] == "root"){
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

    <title>공지사항 글수정</title>
</head>
<body>

    <?php
        include "../common/header.php"
    ?>

    <div id="hNotice">
        <h2>공지사항 글 수정</h2>
        <img src="../../img/main_pic_02.png">
    </div>

    <div id="write_area">
        <form action="modify_ok.php/<?php echo $board['idx']; ?>" method="post">  <!--modify_ok.php/(생략) echo $board['idx'] :modify_ok.php로 전송하면서 수정한 데이터를 현재 선택된 게시글번호에 전송하게 됨-->
            <input type="hidden" name="idx" value="<?=$bno?>"/>    <!--hidden속성으로 화면상에 보여지지는 않지만 게시글 번호를 불러와서 input태그에 입력-->
            <div id="write_title">
                <div id="title1">
                   * 수정할 제목
                </div>
                <div id="title2">
                    <textarea name="title" class="form-control" required><?php  echo $board['title']; ?></textarea>
                </div>
            </div>

            <div id="write_content">
                <div id="title_cont1">
                    수정할 내용
                </div>
                 <div id="title_cont2">
                    <textarea name="content" class="form-control" required><?php echo $board['content']; ?></textarea>
                 </div>
            </div>
            <!-- <div id="in_file">
                    <input type="file" value="1" name="b_file" id="upload_button">
            </div> -->

            <!-- <h4>Input Groups</h4>
            <div class="input-group">
                <label class="input-group-btn">
                    <span class="btn btn-primary">
                        첨부파일 <input type="file" style="display: none;" multiple>
                    </span>
                </label>
                <input type="text" class="form-control" readonly>
            </div> -->

            <div id="btn_set">
                <button type="submit" class="btn btn-primary btn-lg">수정하기</button>
            </div>
        </form>
    </div>

    <?php
        include "../common/footer.php"
    ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
<?php
    }
?>