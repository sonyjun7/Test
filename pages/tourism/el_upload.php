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
    <link rel="stylesheet" href="../../css/tourism_css/el_mid_tourism.css">

    <title>초등 관광지 업로드</title>
</head>
<body>

    <?php
        include "../common/header.php";
        $subject = $_GET['subject'];
    ?>

    <div id="hNotice">
        <h2>초등 관광지 업로드</h2>
        <img src="../../img/main_pic_02.png">
    </div>

    <div id="write_area">
        <form action="./el_upload_ok.php?subject=<?php echo $subject ?>" method="post" enctype="multipart/form-data">
            <div id="write_title">
                <div id="title1">
                   * 제목
                </div>
                <div id="title2">
                    <textarea name="title" class="form-control" placeholder="제목을 입력해주세요" required></textarea>
                </div>
                
            </div>

            <div id="write_content">
                <div id="title_cont1">
                    선형 / 비선형
                </div>
                 <div id="title_cont2">
                    <textarea name="linetype" class="form-control" placeholder="선형 / 비선형 선택" required></textarea>
                 </div>
            </div>

            <div id="write_content_sub">
                <div id="title_cont1_sub">
                    내용
                </div>
                 <div id="title_cont2_sub">
                    <textarea name="content" id="idcont" class="form-control" placeholder="내용을 입력해주세요" required></textarea>
                 </div>
            </div>

            <div id="write_content">
                <div id="img_cont1">
                    썸네일 업로드
                </div>
                 <div id="img_cont2">
                    <div id="in_file">
                        <input type="file" value="1" name="thumb" id="upload_button1" accept="image/*" onchange="chk_file_type(this)">

                        <div id="img_wrap"> <!--파일 업로드한 경우 이미지 띄우기 -->
                            <img id="img1">
                        </div>
                    </div>
                 </div>
            </div>
            
            <div id="write_content">
                <div id="img_cont1">
                    360 이미지
                </div>
                 <div id="img_cont2">
                    <div id="in_file">
                        <input type="file" value="1" name="img360" id="upload_button2" accept="image/*" onchange="chk_file_type(this)">
                    
                        <div id="img_wrap"> <!--파일 업로드한 경우 이미지 띄우기 -->
                            <img id="img2">
                        </div>
                    </div>
                 </div>
            </div>



            <div id="btn_set">
                <button class="btn btn-primary btn-lg">게시하기</button>
            </div>
        </form>
    </div>

    <?php
        include "../common/footer.php"
    ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        function chk_file_type(obj){
            var file_kind = obj.value.lastIndexOf('.');
            var file_name = obj.value.substring(file_kind+1, obj.length);
            var file_type = file_name.toLowerCase();

            var check_file_type = new Array();
            check_file_type = ['jpg', 'png', 'jpeg', 'bmp'];

            if(check_file_type.indexOf(file_type)== -1){
                alert("이미지 파일만 선택할 수 있습니다. 다시 업로드 해주세요");
                var parent_obj = obj.parentNode;
                var node = parent_obj.replaceChild(obj.cloneNode(true), obj);
                // location.reload();
                // return false;
            }

        }


        $(function(){   //업로드한 이미지 띄우기
            $("#upload_button1").on('change', function(){
                readURL1(this);
            });
        });

        function readURL1(input){
            if(input.files && input.files[0]){
                var reader = new FileReader();  //FileReader() : 비동기적으로 데이터를 읽기 위하여 읽을 파일을 가리키는 File의 내용을 읽고 사용자의 컴퓨터에 저장을 해줌

                reader.onload = function(e){    //이미지를 업로드하였을 경우 사용자의 컴퓨터에 저장이 되며 , 읽기 동작이 완료되었을 경우 함수 실행(load이벤트 핸들러를 통해)
                    $('#img1').attr('src', e.target.result);    //attr() : 요소의 속성의 값을 가져오거나 속성을 추가
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $(function(){
            $("#upload_button2").on('change', function(){
                readURL2(this);
            });
        });

        function readURL2(input){
            if(input.files && input.files[0]){
                var reader = new FileReader();

                reader.onload = function(e){
                    $("#img2").attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

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
        echo "<script>alert('잘못된 접근입니다.'); history.back(); </script>";
    }
?>
