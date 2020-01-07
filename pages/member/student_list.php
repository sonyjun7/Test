<?php
    include "../common/db.php";
    $session = $_SESSION['userid'];
    $seq = 1;
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
    <title>학생 명부 확인</title>
</head>
<body>

    <?php
        include "../common/header.php";
    ?>

    <div id="hNotice">
        <h2>학생 명단</h2>
        <img src="../../img/main_pic_02.png">
    </div>

    <?php
        $mq1 = mq("select * from member where id='".$session."'");
        $tcher = $mq1 -> fetch_array();

        $split = explode(",", $tcher['edu_course']); 

        if($split[0] == "element"){
            $f_class = "초등";
        }
        else if($split[0] == "midlle"){
            $f_class = "중등";
        }
    ?>

    <div id="stu_tit_div">

        <div id="stu_title">
            <span>담당자 : &nbsp;&nbsp;&nbsp;&nbsp;</span>
            <span><?php echo $tcher['id'] ?></span>
        </div>
        <div id="stu_title">
            <span>학교 : &nbsp;&nbsp;&nbsp;&nbsp;</span>
            <span><?php echo $tcher['school'] ?></span>
        </div>
        <div id="stu_sub_title">
            <span>담당학급 : &nbsp;&nbsp;&nbsp;</span>
            <span><?php echo $f_class ?>, &nbsp;&nbsp;</span>
            <span><?php echo $split[1] ?>학년, &nbsp;&nbsp;</span>
            <span><?php echo $split[2] ?>반</span>
        </div>

        <div id="list_area">
            <div id="list_back"></div>

            <table id="list_table" class="table table-hover">
                <thead>
                    <tr>
                        <th width="20%">순 번</th>
                        <th width="20%">학생 소속(명칭)</th>
                        <th width="20%">학교명</th>
                        <th width="40%">학급/학년/반</th>
                    </tr>
                </thead>
                
                <?php
                    if(isset($_GET['page'])){
                        $page = $_GET['page'];
                    }
                    else{
                        $page = 1;
                    }
                    $mq2 = mq("select * from student where edu_course='".$tcher['edu_course']."' and stu_school='".$tcher['school']."'");

                    $row_num = mysqli_num_rows($mq2);

                    $list = 10;
                    $block_ct = 5;

                    $block_num = ceil($page/$block_ct);
                    $block_start = (($block_num -1)*$block_ct) + 1;
                    $block_end = $block_start + $block_ct - 1;
                    $total_page = ceil($row_num/$list);

                    if($block_end > $total_page){
                        $block_end = $total_page;
                    }
                    $start_num = ($page -1)*$list;

                    $mq3 = mq("select * from student where edu_course='".$tcher['edu_course']."' and stu_school='".$tcher['school']."' order by student_id limit $start_num,$list");

                    while($board = $mq3 -> fetch_array()){

                        $bd_split = explode(",", $board['edu_course']); 

                        if($bd_split[0] == "element"){
                            $s_class = "초등";
                        }
                        else if($bd_split[0] == "midlle"){
                            $s_class = "중등";
                        }

                ?>
                <tbody>
                    <tr>
                        <td width="20%"><?php echo $seq ?></td>
                        <td width="20%"><?php echo $board['student_id'] ?></td>
                        <td width="20%"><?php echo $board['stu_school'] ?></td>
                        <td width="40%"><?php echo $s_class ?> / <?php echo $bd_split[1] ?> 학년 / <?php echo $bd_split[2] ?> 반</td>
                    </tr>
                </tbody>


                <?php
                        $seq++;
                    }
                ?>

            </table>

            <div id="page_num">
                <ul class="pagination">
                    <?php
                        if($page <= 1){
                            echo "<li><a> << </a></li>";
                        }
                        else{
                            echo "<li><a href='?page=1'> << </a></li>";
                        }
                        if($page <= 1){

                        }
                        else{
                            $pre = $page -1;
                            echo "<li><a href='?page=$pre'> < </a></li>";
                        }
                        for($i=$block_start; $i<=$block_end; $i++){
                            if($page == $i){
                                echo "<li><a id='now_page'>$i</a></li>";
                            }
                            else{
                                echo "<li><a href='?page=$i'>$i</a></li>";
                            }
                        }
                        if($block_num >= $total_page){

                        }
                        else{
                            $next = $page + 1;
                            echo "<li><a href='?page=$next'> > </a></li>";
                        }
                        if($page >= $total_page){
                            echo "<li><a> >> </a></li>";
                        }
                        else{
                            echo "<li><a href='?page=$total_page'> >> </a></li>";
                        }
                    ?>
                </ul>
            </div>
        </div>
        
        <div id="my_btn">
            <a href="./myPage.php"><button class="btn btn-primary">My Page</button></a>
        </div>

    </div>

    <?php
        include "../common/footer.php";
    ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
<?php
    if(!isset($_SESSION['userid'])){
        echo "<script> alert('잘못된접근입니다.');  location.href='../../index.php'; </script>";
    }
?>