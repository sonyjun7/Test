<?php

//poll.php

// include('database_connection.php');
$connect = new PDO('mysql:host=192.168.1.183;dbname=arvr_web2', 'test', 'kssikssi');

include "../common/db.php";
$session = $_SESSION['userid'];

echo $_POST['idx'], ",";
echo $_POST['edu_course'], ",";
echo $_POST['poll_option'];
echo $_POST['school'];

if(isset($_POST["poll_option"]))
{
	$query = "
	INSERT INTO tbl_poll 
	(vote_place, vboard_num, edu_course, userID, school) VALUES (:vote_place, '".$_POST['idx']."', '".$_POST['edu_course']."', '".$session."' , '".$_POST['school']."')
	";
	$data = array(
		':vote_place'		=>	$_POST["poll_option"]
	);
	$statement = $connect->prepare($query);
	$statement->execute($data);
}

?>