<?php
    include "../pages/common/db.php";

    $userid = $_POST['userid'];
    $userpw = password_hash($_POST['userpw'], PASSWORD_DEFAULT);
    $attach = $_POST['attach'];
    $group = $_POST['seltype'];
    $mail = $_POST['mail'].'@'.$_POST['mailadd'];
    $phonenum = $_POST['phonenum'];
    $gender = $_POST['gender'];

    $mq1 = mq("insert into member(id, pw, `group`, mail, p_num, gender, attach, submit_flag) values('".$userid."', '".$userpw."', '".$group."', '".$mail."', '".$phonenum."', '".$gender."', '".$attach."', 'N')");
    
     //AUTO_INCREMENT 재 정렬
    $sql = mq("alter table member AUTO_INCREMENT = 1");
    $sql = mq("set @COUNT = 0;");
    $sql = mq("update member set idx = @COUNT := @COUNT + 1");
?>

<meta charset="utf-8">
<script type="text/javascript">
    alert("가입신청이 완료되었습니다.");
    location.href = "../index.php";
</script>