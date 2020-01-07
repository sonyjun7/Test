<?php
    include "../common/db.php";

    $session = $_SESSION['userid'];

    $vtit = $_POST['vtit_tarea'];
    $vote_school = $_POST['vote_school'];

    if($_POST['school'] == "element"){
        $edu_course = $_POST['school'].','.$_POST['el_class'].','.$_POST['s_class'];
    }
    if($_POST['school'] == "midlle"){
        $edu_course = $_POST['school'].','.$_POST['mid_class'].','.$_POST['s_class'];
    }

    $vote1 = $_POST['vote_input1'];
    $vote2 = $_POST['vote_input2'];
    $vote3 = $_POST['vote_input3'];
    $vote4 = $_POST['vote_input4'];
    $vote5 = $_POST['vote_input5'];

    $date = date('y-m-d');

    // echo $_POST['vtit_tarea'] , "<br>";
    // echo $_POST['school'], "<br>";
    // echo $_POST['el_class'], "<br>";
    // echo $_POST['mid_class'], "<br>";
    // echo $_POST['s_class'], "<br>";
    // echo $edu_course, "<br>";
    // echo $_POST['vote_input1'], "<br>";
    // echo $_POST['vote_input2'], "<br>";
    // echo $_POST['vote_input3'], "<br>";
    // echo $_POST['vote_input4'], "<br>";
    // echo $_POST['vote_input5'], "<br>";

    $sql1 = mq("select * from vote_board");

        // 총 레코드 수의 + 1을 index insert
    $record_num = mysqli_num_rows($sql1) + 1;

    $mq1 = mq("insert into vote_board(seq, id, title, edu_course, school, vote1, vote2, vote3, vote4, vote5, date) values('".$record_num."', '".$session."', '".$vtit."', '".$edu_course."', '".$vote_school."', '".$vote1."', '".$vote2."', '".$vote3."', '".$vote4."', '".$vote5."', '".$date."')");

    echo "<script>alert('투표가 등록되었습니다.'); location.href='./vote_notice.php'; </script>"
?>