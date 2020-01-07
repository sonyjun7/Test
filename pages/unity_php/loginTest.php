<?php
	
	$userId = $_POST['userID'];
	$password = $_POST['userPW'];
		
	$db = new mysqli("192.168.1.183", "test", "kssikssi", "arvr_web2");     
	// $db = new mysqli("175.198.74.238", "test", "kssikssi", "arvr_web2");

	$board = $db -> query("select * from member where id='".$userId."'");
	$member = $board -> fetch_array();
	$hash_pw = $member['pw'];

	if(password_verify($password, $hash_pw)){
		echo $member['id'];
	}
	else{
		echo "ID or Password ERROR";
	}

?>

