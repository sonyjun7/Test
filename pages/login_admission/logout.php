<?php
    include "../common/db.php";
    session_destroy();
?>

<script type="text/javascript">
    alert('로그아웃 되었습니다.');
    location.href='../../index.php';
</script>