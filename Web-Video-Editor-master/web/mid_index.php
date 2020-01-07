<?php
	include "../../pages/common/db.php";
	$idx = $_GET['idx'];
	$session = $_SESSION['userid'];

	if(!isset($_SESSION['userid'])){
		echo "<script> alert('회원만 접근할 수 있습니다.'); window.close(); </script>";
	}
	else{
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Editor</title>
	<script
		src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
		integrity="sha256-3edrmyuQ0w65f8gfBsqowzjJe2iM6n0nKciPUp8y+7E="
		crossorigin="anonymous">
	</script>
	<script src="http://code.jquery.com/jquery-1.11.1.min.js" type="text/javascript"></script> 
	
	<script src="./nouislider.min.js"></script>
	<link rel="stylesheet" href="./style.css">
	<link rel="stylesheet" href="https://ajax.aspnetcdn.com/ajax/jquery.ui/1.8.9/themes/dot-luv/jquery-ui.css">
	<link rel="stylesheet" href="./nouislider.min.css">
	<link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
</head>
<body>

<?php
    $mq1 = mq("select * from scenario_info_mid where id='".$session."' and idx='".$idx."'");
	$chk = $mq1 -> fetch_array();
	// echo $chk['mov_file'];
?>

<div style="float: right;">
	<p>업로드 상태</p>	
	<progress value="0" max="100" id="uploader">0%</progress>
</div>


	<a id="check_b"><button class="btn btn-success">업로드 영상 확인</button></a>
	<button id="refresh_btn" class="btn btn-success">새로고침(동영상 변경시 새로고침 해주세요)</button>
	<button class="btn btn-danger" onClick='window.close()'>닫기</button>


	<input type="hidden" id="videoName" name="videoName">
	<input type="hidden" id="videotype" name="videotype">

<div id="resizable" class="ui-widget-content">
	<video class="video" loop muted></video>
	<canvas id="canv"></canvas>
</div>

<input type="file" id="video_selector" accept="video/*"/>
<div class="hide_until_load hidden">
	<span class="current_time"></span>
	<div class="slider_wrapper">
		<div id="slider"></div>
		<div class="slider_time_pos"></div>
	</div>
	Start: <input type="number" class="slider_control" data-pos="0" value="0" title="Start" />
	End: <input type="number" class="slider_control" data-pos="1" value="1" title="End" />
	<button class='play_toggle'>&#10074;&#10074;</button>
	<label for="mute_toggle">Mute:</label><input type="checkbox" id="mute_toggle" checked />

	<div class="ffmpeg">
		ffmpeg -i in.mp4 -filter:v "crop=80:60:200:100" -c:a copy out.mp4
	</div>

	<input type="button" id="run_ffmpeg" value="영상 편집하기"/>

	<div class="ffmpeg_log">
		<!-- Running FFmpeg in-browser is unstable, and may crash. It will not work on large files.
		It may also take a while to get started, as it must download a large (26Mb) library to run. -->
		브라우저에서 FFmpeg를 실행하는 것은 불안정할 수 있습니다. 또한 용량이 클 경우 편집이 불안정할 수 있습니다.
	</div>

	<div class="download_links">

	</div>
</div>

<script src="../../bootstrap/js/bootstrap.min.js"></script>
<script>
	var filefile;
	var fileVarName;
	var typetype;
	var idx = "<?= $idx ?>";
	var id = "<?= $session ?>";
	var prevfile = "<?= $chk['mov_file'] ?>";

	$(document).ready(function(){
		$("#refresh_btn").click(function(){
			location.reload();
		});

		// input file 변경시
		$("#video_selector").on("change keyup paste", function(){

			console.log("changed");

			// video파일의 height와 width값
			$(".video").bind("loadedmetadata", function(){
				var vdwidth = this.videoWidth;
				var vdheight = this.videoHeight;
				
				console.log(vdwidth);
				console.log(vdheight);
				
				// 화면 비율
				var w_rate = vdwidth/vdheight;
				var h_rate = vdheight/vdwidth;

				// 특정 픽셀이상 증가시 가로세로 비율 맞추기
				if(vdwidth>= 800){
					vdwidth = 800;
					vdheight = vdwidth * h_rate;
				}
				if(vdheight >= 650){
					vdheight = 650;
					vdwidth = vdheight * w_rate;
				}

				$("#resizable").height(vdheight);	//해당 div영역의 높이를 비디오 파일의 높이로 변경
				$("#resizable").width(vdwidth);

				});
			});

	});
</script>

<script src="./mid_control.js"></script>
<script src="./ffmpeg/ffmpeg_runner.js"></script>
<!-- <script src="./moviefire.js"></script> -->
<script src="./mid_prev_movie_delete.js"></script>
</body>
</html>
<?php
	}
?>