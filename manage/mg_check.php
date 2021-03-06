
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://fonts.googleapis.com/css?family=Do+Hyeon|Jua|Nanum+Gothic+Coding" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Noto+Sans+KR:500&display=swap" rel="stylesheet">
    
<link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="../css/common_css/common.css">

<body style="margin:0;">
    <?php
        include "../pages/common/db.php";
        $uid = $_GET['userid'];
        $sql = mq("select * from member where id='".$uid."'");
        $member = $sql->fetch_array();

        if($member == 0){
        ?>
            <h3><?php echo $uid ?>는 사용가능한 아이디입니다.</h3>  
            <button class="btn btn-primary btn-lg" value="닫기" style="width:250px; margin-left:30px;" onclick="window.close()">닫기</button>
        <?php
            // opener: 자기 자신을 연 기존 창의 window객체를 참조
            // 사용가능할 경우 hidden속성의 값을 1로 변경
            echo "<script> window.opener.document.adform.chs.value='1';</script>";

        }else{ 
        ?>
            <h3><?php echo $uid?>는 중복된 아이디입니다.</h3>    
            <button class="btn btn-primary btn-lg" value="닫기" style="width:250px; margin-left:30px;" onclick="window.close()">닫기</button>
        <?php
            // 사용가능하지 않는 경우 hidden속성의 값을 -1로 변경
            echo "<script> window.opener.document.adform.chs.value='-1';</script>";
        } 
        ?>

    <!-- <button class="btn btn-primary btn-lg" value="닫기" style="width:250px; margin-left:30px;" onclick="window.close()">닫기</button> --> 
</body>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="../../bootstrap/js/bootstrap.min.js"></script>