<html>
<head>
<title></title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
$("#selectall").click(selectAll);
$("#save").click(save);
$("#del").click(del);
});
function selectAll()
{
var checked = $("#selectall").attr("checked");
$(".red input:checkbox").each(function(){
var subChecked = $(this).attr("checked");
if (subChecked != checked)
$(this).click();
});
} 
function del()
{
$(".wrap input:checked").each(function(){
var checked = $(this).attr("checked"); // 체크된 값만을 불러 들인다.
if(checked==true){
$(this).next().remove(); //span내용지우기
$(this).remove(); //checkbox 지우기
}
});
} 
function save()
{
var result = "";
$(".box:checked").each(function() {
$("#"+$(this).val()).remove(); 
// result += ','+$(this).val(); //후에 값을 배열로 사용 할시에는 콤바로 나눈다. 첫콤마는 짜르고 만든다 
result += ','+$(this).val();
//AJAX로 넘겨줄때는 
//.get('XXX.php',{SelType:$(this).val()});
});
$("#aa").empty();//초기화
$("#aa").append(result);//데이터 입력
}
</script>
</head>
<body>
<table>
<tr><td><input type="button" value="저장" id="save"></td></tr>
<tr><td><input type="button" value="삭제" id="del"></td></tr>
</table>
<div class="red"><input type="checkbox" id=selectall>전체선택</div>
<div id ="wrap" class="wrap">
<div class="red"><input type="checkbox" name="chkbox" value="하나" class="box" /><span>하나</span></div>
<div class="red"><input type="checkbox" name="chkbox" value="둘" class="box" /><span>둘</span></div>
<div class="red"><input type="checkbox" name="chkbox" value="셋" class="box" /><span>셋</span></div>
</div>
<div id="aa"></div>
</body>
</html>



