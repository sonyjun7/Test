<?php
    include "../../pages/common/db.php";
    $idx = $_GET['idx'];
    $session = $_SESSION['userid'];

    if(!isset($_SESSION['userid'])){
        echo "<script> alert('회원만 접근할 수 있습니다.'); window.close(); </script>";
    }
    else{
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>0. Design</title>
        <link type="text/css" href="https://uicdn.toast.com/tui-color-picker/v2.2.0/tui-color-picker.css" rel="stylesheet">
        <link type="text/css" href="../dist/tui-image-editor.css" rel="stylesheet">
        <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
        <style>
            @import url(http://fonts.googleapis.com/css?family=Noto+Sans);
            html, body {
                height: 97%;
                margin: 0;
            }
            #check_btn{
                display:block;
            }
        </style>
    </head>
    <body>

    <?php
            $chfile = mq("select * from scenario_info where id='".$session."' and idx='".$idx."'");

            $chk = $chfile -> fetch_array();
            // echo $chk['file'];
    ?>

        <!-- <a href='../../pages/userEnter/user_select.php'><button>참여공간 페이지로</button></a> -->
        <a id="check_a"><button class="btn btn-primary">업로드 이미지 확인</button></a>
        <button id="refresh_btn" class="btn btn-primary">새로고침(이미지 변경시 새로고침 해주세요)</button>
        <button class="btn btn-danger" onClick='window.close()'>닫기</button>
        
        <div style="float: right;">
            <p>업로드 상태</p>
            <input type="hidden" id="hiddentag" name="hiddentag">
            <input type="hidden" id="hiddenName" name="hiddenName">
            <progress value="0" max="100" id="uploader">0%</progress>
        </div>


        <div id="tui-image-editor-container">
        </div>



        <script>
            // 전역적으로 변수를 사용하기 위해 선언
            var filefile;
            var fileName;
            var typetype;
            var idx = "<?= $idx ?>";
            var id = "<?= $session ?>";
            var prevfile = "<?= $chk['file'] ?>";
            console.log(idx);
        </script>
        <script src="http://code.jquery.com/jquery.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/1.6.7/fabric.js"></script>
        <script type="text/javascript" src="https://uicdn.toast.com/tui.code-snippet/v1.5.0/tui-code-snippet.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/1.3.3/FileSaver.min.js"></script>
        <script type="text/javascript" src="https://uicdn.toast.com/tui-color-picker/v2.2.0/tui-color-picker.js"></script>
        <script type="text/javascript" src="../dist/tui-image-editor.js"></script>
        <script type="text/javascript" src="./js/theme/white-theme.js"></script>
        <script type="text/javascript" src="./js/theme/black-theme.js"></script>
        <script src="../../bootstrap/js/bootstrap.min.js"></script>
        <script>
        
         // Image editor
         var imageEditor = new tui.ImageEditor('#tui-image-editor-container', {
             includeUI: {
                 loadImage: {
                     path: './img/sampleImage2.png',
                     name: 'SampleImage'
                 },
                 theme: blackTheme, // or whiteTheme ,blackTheme
                 initMenu: 'filter',
                 menuBarPosition: 'bottom'
             },
             cssMaxWidth: 700,
             cssMaxHeight: 500
         });

         window.onresize = function() {
             imageEditor.ui.resizeEditor();
         }

         $(document).ready(function(){
            $("#refresh_btn").click(function(){
                location.reload();
            });

         });
        </script>
        <!-- 업로드할 때 기존 이미지 파일이 존재한다면 삭제 하는 js파일 -->
        <script src='../dist/prev_image_delete.js'></script>
        <!-- 이미지 파일을 업로드하는 js 파일 -->
        <script src='../dist/image_firebase.js'></script>
    </body>
</html>
<?php
    }
?>
