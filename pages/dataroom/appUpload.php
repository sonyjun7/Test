<?php
    include "../common/db.php";
    $session = $_SESSION['userid'];

    $mmchk = mq("select * from member where id='".$session."'");
    $mgchk = $mmchk -> fetch_array();

    if($mgchk['group'] == "manager" || $mgchk['group'] == "root"){
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
    <title>앱 업로드</title>
</head>
<body>

    <?php
        include "../common/header.php";
    ?>

    <div id="hNotice">
        <h2>자료실 - 앱 업로드</h2>
        <img src="../../img/main_pic_02.png">
    </div>

    <div id="upload_area">
        <form action="./appUpload_ok.php" method="post" enctype="multipart/form-data">
            <div id="title_div">
                <input type="text" class="form-control" placeholder="업로드할 파일의 제목/버전 입력" name="title" required="required"> 
            </div>

            <div id="file_div">
                <h4>첨부파일을 업로드 해주세요</h4>

                <div id="appdiv"> 
                    <!-- <label for="ex_filename1">PC 업로드</label> 
                    <input class="upload-name1" value="파일선택" disabled="disabled"> 
                    <input type="file" id="ex_filename1" class="upload-hidden" name="file1">  -->
                    <input type="text" class="form-control" name="applink" placeholder="앱 링크 주소를 적어주세요">
                </div>

                <div class="filebox2"> 
                    <label for="ex_filename2">APP 업로드</label> 
                    <input class="upload-name2" value="파일선택" disabled="disabled"> 
                    <input type="file" id="ex_filename2" class="upload-hidden" name="file2"> 
                </div>

                <!-- <input type="file" id="inp1" name="file1">
                <input type="file" id="inp2" name="file2"> -->

            </div>

            <div id="set_button1">
                <button class="btn btn-primary">파일 게시</button>
            </div>
        </form>
            <div id="set_button2">
                <a href="./appDownload.php"><button class="btn btn-primary">목록</button></a> 
            </div>
    </div>


    <?php
        include "../common/footer.php";
    ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
    <script>
        // $(document).ready(function(){ 
        //     var fileTarget1 = $('.filebox1 .upload-hidden'); 
        //     fileTarget1.on('change', function(){ // 값이 변경되면 
        //     if(window.FileReader){ // modern browser 
        //         var filename1 = $(this)[0].files[0].name; 
        //         } 
        //     else { // old IE 
        //         var filename1 = $(this).val().split('/').pop().split('\\').pop(); // 파일명만 추출 
        //         } // 추출한 파일명 삽입
        //          $(this).siblings('.upload-name1').val(filename1); 
        //     }); 
        // }); 

        $(document).ready(function(){ 
            var fileTarget2 = $('.filebox2 .upload-hidden'); 
            fileTarget2.on('change', function(){ // 값이 변경되면 
            if(window.FileReader){ // modern browser 
                var filename2 = $(this)[0].files[0].name; 
                } 
            else { // old IE 
                var filename2 = $(this).val().split('/').pop().split('\\').pop(); // 파일명만 추출 
                } // 추출한 파일명 삽입
                 $(this).siblings('.upload-name2').val(filename2); 
            }); 
        }); 
    </script>
</body>
</html>
<?php
    } else{
        echo "<script>alert('잘못된 접근입니다.'); history.back();</script>";
    }
?>  