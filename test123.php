<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
  <input type="checkbox" name="box[]" value="a" class="checkSelect">


  <input type="checkbox" name="box[]" value="b" class="checkSelect">


  <input type="checkbox" name="box[]" value="c" class="checkSelect">


  <input type="checkbox" name="box[]" value="d" class="checkSelect">


  <input type="checkbox" name="box[]" value="e" class="checkSelect">

  <button id="ccc">akff</button>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script>
    var send_array = Array();
    var send_cnt = 0;
    var chkbox = $(".checkSelect");

  $("#ccc").click(function(){
    for(i=0;i<chkbox.length;i++) {
        if (chkbox[i].checked == true){
            send_array[send_cnt] = chkbox[i].value;
            
            send_cnt++;
        }
    }
    console.log(send_array);  //체크한 value값들 나옴
    // console.log(send_array[0]);

    for(var j=0; j<send_array.length; j++){
      console.log(send_array[j]);
      // 여기서 체크한 input값의 idx번호를 받아서 location.href의 GET방식을 써서 ?idx=값으로 넘기도록 해보기
    }


    console.log(send_cnt);
    console.log(chkbox);
    $("#array").val(send_array);
    console.log($("#array").val(send_array));
  });

  </script>
</body>
</html>