<?php
    include "../common/db.php";
    $session = $_SESSION['userid'];

    $mmchk = mq("select * from member where id='".$session."'");
    $mgchk = $mmchk -> fetch_array();

    $writetime = date("y-m-d H:i:s");

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

    <title>공지사항 글쓰기</title>
</head>
<body>

    <?php
        include "../common/header.php"
    ?>

    <div id="hNotice">
        <h2>공지사항 글 쓰기</h2>
        <img src="../../img/main_pic_02.png">
    </div>

    <div id="write_area">
        <!-- <form action="" method="post" enctype="multipart/form-data" id="myFormId" name="write_form"> -->
            <div id="write_title">
                <div id="title1">
                   * 제목
                </div>
                <div id="title2">
                    <textarea name="title" id="idtitle" class="form-control" placeholder="제목을 입력해주세요" required></textarea>
                </div>
                
            </div>

            <div id="write_content">
                <div id="title_cont1">
                    내용
                </div>
                 <div id="title_cont2">
                    <textarea name="content" id="idcont" class="form-control" placeholder="내용을 입력해주세요" required></textarea>
                 </div>
            </div>

            <div id="write_content">
                <div id="title1">
                    업로드 상태
                </div>
                <div id="title2">
                    <progress value="0" max="100" id="uploader">0%</progress>
                </div>
            </div>
            
            <div id="in_file">
                    <!-- <input type="file" value="1" name="b_file" id="upload_button"> -->
                    <input type="file" name="file" id="file">
                    
            </div>

            <div id="btn_set">
                <button class="btn btn-primary btn-lg" id="write_bb">게시하기</button>
            </div>
        <!-- </form> -->
    </div>
       
    <!-- <input type="file" id="fileButton" onchange="handleFileSelect()"> -->


    <?php
        include "../common/footer.php"
    ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
    <script>
        var session = "<?= $session ?>";
        var attach = "<?= $mgchk['attach'] ?>";
        var writetime = "<?= $writetime ?>";
        var fileflag = 0;
        console.log(writetime);
        // console.log(session);

    </script>
    <script src='./write_ok_bundle.js'></script>
    <script>
        //textarea 글자수 제한 두기
        $('#idcont').on('keyup', function(){
            if($(this).val().length > 500){
                alert("글자수 제한 500자를 넘었습니다.");
                $(this).val($(this).val().substring(0, 500));
            }
        })

    </script>
</body>
</html>
<?php
    } else{
        echo "<script> alert('잘못된접근입니다.');  location.href='../../index.php'; </script>";
    }

?>