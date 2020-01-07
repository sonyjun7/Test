<link rel="stylesheet" href="../../css/userEnter_css/vote.css">

<?php

//fetch_poll_data.php

// include('database_connection.php');
$connect = new PDO('mysql:host=192.168.1.183;dbname=arvr_web2', 'test', 'kssikssi');
include "../common/db.php";

$mq1 = mq("select * from vote_board where idx='".$_GET['idx']."'");
$votebaord = $mq1 -> fetch_array();

// $php_framework = array("Laravel", "CodeIgniter", "CakePHP", "Phalcon", "Symfony");

$vote_place = array($votebaord['vote1'], $votebaord['vote2'], $votebaord['vote3'], $votebaord['vote4'], $votebaord['vote5']);

$arr = array();
$cnt = 0;

while(true){
	// 생성된 투표에 맞게 배열에 추가
    if($cnt==0){
        if($votebaord['vote1'] != ""){
            $arr[$cnt] = $votebaord['vote1'];
        }
    }
    if($cnt==1){
        if($votebaord['vote2'] != ""){
            $arr[$cnt] = $votebaord['vote2'];
        }
    }
    if($cnt==2){
        if($votebaord['vote3'] != ""){
            $arr[$cnt] = $votebaord['vote3'];
        }
    }
    if($cnt==3){
        if($votebaord['vote4'] != ""){
            $arr[$cnt] = $votebaord['vote4'];
        }

    }
    if($cnt==4){
        if($votebaord['vote5'] != ""){
            $arr[$cnt] = $votebaord['vote5'];
        }
    }
    if($cnt > 5){
        break;
    }
    $cnt++;
}

// print_r($arr);


$total_poll_row = get_total_rows($connect);
$output = '';
if($total_poll_row > 0)
{
	foreach($arr as $row)
	{
		$mq2 = mq("select vote_place,COUNT(vote_place) from tbl_poll where vboard_num='".$_GET['idx']."' and vote_place='".$row."' group by vote_place");
		$tbl = $mq2 -> fetch_array();

		if($tbl['COUNT(vote_place)'] != ""){
			$tbl_count = $tbl['COUNT(vote_place)'];
		}
		else{
			$tbl_count = 0;
		}


		$query = "SELECT * FROM tbl_poll WHERE vote_place = '".$row."' and vboard_num='".$_GET['idx']."'";
		$statement = $connect->prepare($query);
		$statement->execute();
		$total_row = $statement->rowCount();
		$percentage_vote = round(($total_row/$total_poll_row)*100);
		$progress_bar_class = '';
		if($percentage_vote >= 40)
		{
			$progress_bar_class = 'progress-bar-success';
		}
		else if($percentage_vote >= 25 && $percentage_vote < 40)
		{
			$progress_bar_class = 'progress-bar-info';
		}
		else if($percentage_vote >= 10 && $percentage_vote < 25)
		{
			$progress_bar_class = 'progress-bar-warning';
		}
		else
		{
			$progress_bar_class = 'progress-bar-danger';
		}
		$output .= '
        <div><b id="font_vote">'.$row.' &nbsp;&nbsp;('.$tbl_count.' 명 투표)</b></div>
        
		<div class="row">
            
			<div class="col-md-10">
                <div class="progress" id="progdiv">
              
					<div class="progress-bar '.$progress_bar_class.'" role="progressbar" aria-valuenow="'.$percentage_vote.'" aria-valuemin="0" aria-valuemax="100" style="width:'.$percentage_vote.'%">
						'.$percentage_vote.' %
					</div>
				</div>
			</div>
		</div>
		
		';
	}
}

echo $output;

function get_total_rows($connect)
{
	$query = "SELECT * FROM tbl_poll WHERE vboard_num='".$_GET['idx']."'";
	$statement = $connect->prepare($query);
	$statement->execute();
	return $statement->rowCount();
}


?>