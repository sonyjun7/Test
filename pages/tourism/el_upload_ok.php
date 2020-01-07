<?php
    include "../common/db.php";

    $sub = $_GET['subject'];
    $title = $_POST['title'];
    $line = $_POST['linetype'];
    $content = addslashes($_POST['content']);

    $thumb_tmp = $_FILES['thumb']['tmp_name'];
    $thumb_origin = $_FILES['thumb']['name'];
    $thumb_name = iconv("UTF-8", "UTF-8", $_FILES['thumb']['name']);
    $thumb_folder = "../../img/el_img/".$thumb_name;

    move_uploaded_file($thumb_tmp, $thumb_folder);

    $img360_tmp = $_FILES['img360']['tmp_name'];
    $img360_origin = $_FILES['img360']['name'];
    $img360_name = iconv("UTF-8", "UTF-8", $_FILES['img360']['name']);
    $img360_folder = "../../img/el_img/".$img360_name;

    move_uploaded_file($img360_tmp, $img360_folder);

    // echo "<p> $sub : 과목</p>";
    // echo "<p> $title : 제목</p>";
    // echo "<p> $line : 선형/비선형</p>";
    // echo "<p> $content : 내용</p>";
    // echo "<p> $thumb_origin : 섬네일파일</p>";
    // echo "<p> $img360_origin : 360이미지파일</p>";

    $sql = mq("insert into eltable(subject, title, content, linetype, thumbnail, 360img) values('".$sub."', '".$title."', '".$content."', '".$line."', '".$thumb_origin."', '".$img360_origin."');");

    echo "<script> alert('$sub 의 값 확인?'); </script>";
?>

<script type="text/javascript">
    alert('관광지가 등록되었습니다.');
    location.href= "./el_index.php";
</script>
