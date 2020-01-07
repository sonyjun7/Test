<?php
    include "../common/db.php";
    if(isset($_SESSION['userid'])){
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
    <link rel="stylesheet" href="../../css/userEnter_css/freeboard.css">

    <title>자유게시판 글수정</title>
</head>
<body>

    <?php
        include "../common/header.php"
    ?>

    <div id="hNotice">
        <h2>자유게시판 글 수정</h2>
        <img src="../../img/main_pic_02.png">
    </div>

    <?php
        $fno = $_GET['idx'];
        $sql = mq("select * from freeboard where idx='".$fno."'");
        $modi = $sql -> fetch_array();
    ?>

    <div id="write_area">
        <form action="./freeModify_ok.php?idx=<?php echo $fno ?>" method="post">
            <div id="write_title">
                <div id="title1">
                   * 제목
                </div>
                <div id="title2">
                    <textarea name="title" id="idcont" class="form-control" placeholder="제목을 입력해주세요" required><?php echo $modi['title'] ?></textarea>
                </div>
                
            </div>

            <div id="write_content">
                <div id="title_cont1">
                    내용
                </div>
                 <div id="title_cont2">
                    <textarea name="content" class="form-control" placeholder="내용을 입력해주세요" required><?php echo $modi['content'] ?></textarea>
                 </div>
            </div>
            
            <div id="btn_set">
                <button class="btn btn-primary btn-lg">수정하기</button>
            </div>
        </form>
    </div>

    <?php
        include "../common/footer.php"
    ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
    <script>
        $('#idcont').on('keyup', function(){
            if($(this).val().length > 500){
                alert("글자수 제한 500자를 넘었습니다.");
                $(this).val($(this).val().substring(0, 500));
            }
        });
    </script>
</body>
</html>
<?php
    } else{
        echo "<script> alert('회원만 이용 가능합니다.'); history.back(); </script>";
    }
?>
