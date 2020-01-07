<?php
    include "../common/db.php";
    $session = $_SESSION['userid'];

    // header("Cache-Control: no cache");
    // session_cache_limiter("private_no_expire");
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
    <link rel="stylesheet" href="../../css/member_css/myPage.css">
    <title>회원정보확인</title>
</head>
<body>

    <?php
        include "../common/header.php";
    ?>

    <div id="hNotice">
        <h2>MY PAGE</h2>
        <img src="../../img/main_pic_02.png">
    </div>

    <div id="profile">
        <img src="../../img/blank_profile.png">
    </div>
    <div id="board_area">
        <a href="./my_search_select.php"><button class="btn btn-primary">관광지 검색 기록 확인</button></a>
        <a href="./myInfoUpdate.php"><button class="btn btn-primary">회원정보수정</button></a>
        <a href="./sticker_log_select.php"><button class="btn btn-primary">획득정보 및<br>GPS로그 확인</button></a>
    </div>

    <div id="board_area">

            <button class="btn btn-danger" id="confirm_drop">탈퇴하기</button>


        <?php
            // if(isset($_POST['drop'])){
                // echo "<script>
                // if(confirm('탈퇴 하시겠습니까?')){
                //     if(confirm('<경고!!!!!> 정말로 탈퇴하시겠습니까? 모든 정보들이 삭제됩니다.'){
                //         location.href='../index.php';
                //     }
                // }
                // else{
                //     return false;
                // }
                // </script>";
            // }
        ?>

            <a href="./mysce_info_select.php"><button class="btn btn-primary">시나리오 확인</button></a>
            <?php
                $mq1 = mq("select * from member where id='".$session."'");
                
                $memarr = $mq1 -> fetch_array();

                if($memarr['group'] == "teacher"){
            ?>
                    <a href="./student_list.php"><button class="btn btn-primary">학생 명부</button></a>

            <?php
                }
            ?>
    </div>

    <?php
        include "../common/footer.php";
    ?>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        var session = "<?= $session ?>";

        $(function drop(){
            $("#confirm_drop").click(function(){
                if(confirm("탈퇴 하시겠습니까?")){
                    if(confirm("<경고!!!!!> 정말로 탈퇴하시겠습니까? 모든 정보들이 삭제됩니다.")){
                    
                        var result = prompt("탈퇴 확인 : 자신의 ID를 입력해주세요");

                         if(result == session){
                             alert("ID를 확인했습니다. 탈퇴되었습니다");
                            location.href="./dropMember.php";
                         }
                         else{
                             alert("ID가 일치하지 않습니다");
                             location.href='./myPage.php';
                         }
                    }
                    else{
                        return false;
                    }          
                }
                else{
                    return false;
                }
            });
        });

    </script>
</body>
</html>
<?php
    if(!isset($_SESSION['userid'])){
        echo "<script> alert('잘못된접근입니다.');  location.href='../../index.php'; </script>";
    }
?>