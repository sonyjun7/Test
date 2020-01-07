<?php
    include "../common/db.php";

    $apptitle = $_POST['title'];

    // $pctmp = $_FILES['file1']['tmp_name'];
    // $pc_origin = $_FILES['file1']['name'];
    // $pcfile = iconv("UTF-8", "UTF-8", $_FILES['file1']['name']);
    // $pcfolder = "../../download/pc_ver/".$pcfile;
    // move_uploaded_file($pctmp, $pcfolder);
    $link = $_POST['applink'];

    $apptmp = $_FILES['file2']['tmp_name'];
    $app_origin = $_FILES['file2']['name'];
    $appfile = iconv("UTF-8", "UTF-8", $_FILES['file2']['name']);
    $appfolder = "../../download/mobile_ver/".$appfile;
    move_uploaded_file($apptmp, $appfolder);

    // $apptmp = $_FILES['file2']['tmp_file'];
    // $app_origin = $_FILES['file2']['name'];
    // $appfile = iconv("UTF-8", "EUC-KR", $_FILES['file2']['name']);
    // $appfolder = "../../download/".$appfile;
    // move_uploaded_file($apptmp, $appfolder);

    $date = date('y-m-d');

    $sql = mq("insert into appboard(title, link, file2, date) values('".$apptitle."', '".$link."', '".$app_origin."', '".$date."')");

?>
<script type="text/javascript">
    alert('업로드 되었습니다.');
    location.href = "./appDownload.php";
</script>