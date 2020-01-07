
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://fonts.googleapis.com/css?family=Do+Hyeon|Jua|Nanum+Gothic+Coding" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Noto+Sans+KR:500&display=swap" rel="stylesheet">
    
<link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="../css/common_css/common.css">


<?php
    include "../pages/common/db.php";
    $mgcode = $_GET['mgcode'];

    // echo $mgcode;

    $sql = mq("select * from manage_submit where submit_code='".$mgcode."'");

    $mgchk = $sql->fetch_array();

    if($mgchk == 0){
?>
        <h3>관리자 승인 코드가 맞지않습니다.</h3>
        <button class="btn btn-primary btn-lg" value="닫기" style="width:250px; margin-left:30px;" onclick="window.close()">닫기</button>
<?php
         echo "<script> window.opener.document.adform.mgs.value='-1';</script>";
    }
    else{
?>
        <h3>관리자 승인 코드가 일치합니다.</h3>
        <button class="btn btn-primary btn-lg" value="닫기" style="width:250px; margin-left:30px;" onclick="window.close()">닫기</button>
<?php
        echo "<script> window.opener.document.adform.mgs.value='1';</script>";
    }

    ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="../../bootstrap/js/bootstrap.min.js"></script>