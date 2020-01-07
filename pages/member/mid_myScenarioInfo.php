<?php
    include "../common/db.php";
    $session = $_SESSION['userid'];

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
    <title>중등시나리오정보확인</title>
</head>
<body>

    <?php
        include "../common/header.php";
    ?>

    <div id="hNotice">
        <h2><?php echo $session ?>님의 중등시나리오 정보 확인</h2>
        <img src="../../img/main_pic_02.png">
    </div>

    <div id="profile">
        <img src="../../img/blank_profile.png">
    </div>



    <div id="sce_div">
        <div id="p_div">
            <p>* 순번을 입력해서 시나리오 순서를 수정을 할 수 있습니다.</p>
            <p>* 휴지통을 클릭하여 전체 삭제 및 선택 삭제를 할 수 있습니다.</p>
        </div>


        <div id="trashdiv">
            <a id="clicktrash"><i class="fas fa-trash-alt fa-2x"></i></a>
        </div>

        <table class="table table-hover sce_table">
            <thead>
                <tr>
                    <th>순번</th>
                    <th>도시</th>
                    <th>지역(시,군,구)</th>
                    <th>관광지</th>
                    <th><input type="checkbox" name="all" class="check_all"></th>
                </tr>
            </thead>

        <form  id="form_el" action="mid_sceResult.php" method="post">
        <?php
            $sql1 = mq("select * from scenario_info_mid where id='".$session."' order by idx");

            while($sce_arr = $sql1 -> fetch_array()){

        ?>

            <tbody>
                <tr>
                    <td><textarea name="idxck[]" class="idxSelect"><?php echo $sce_arr['idx']; ?></textarea></td>
                    <td><?php echo $sce_arr['state']; ?></td>
                    <td><?php echo $sce_arr['city']; ?></td>
                    <td><?php echo $sce_arr['structure']; ?></td>
                    <input type="hidden" name="spotck[]" value="<?php echo $sce_arr['spot_idx']; ?>"> 
                    <!-- 해당장소의 고유번호를 넘기기 -->
                    <input type="hidden" name="fileck[]" value="<?php echo $sce_arr['file'] ?>">
                    <!-- 해당장소의 이미지 파일값 hidden속성으로 넘기기 -->
                    <input type="hidden" name="movfileck[]" value="<?php echo $sce_arr['mov_file']?>">
                    <!-- 해당장소의 영상 파일값 hidden속성으로 넘기기 -->
                    <td><input type="checkbox" name="chk[]" value="<?php echo $sce_arr['spot_idx'] ?>" class="checkSelect"></td>
                    <!-- checkbox value에 파일명과 스팟번호가 있어서 전달됨 -->
                </tr>
            </tbody>

        <?php

            }
        ?>
        </form>
        </table>

        <div id="sce_btn_div">
            <button id="sce_mod_btn" class="btn btn-success">시나리오 순서 수정하기</button>
        </div>

    </div>



    <?php
        include "../common/footer.php";
    ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
    <script>
        var idxarr = Array();
        var file_array = Array();
        var movfile_array = Array();
        var idcnt = 0;
        var overlap = 0;
        

        $(document).ready(function(){
            $("#sce_mod_btn").click(function(){
                console.log("순서 수정 버튼");

                for(var i=0; i<$(".idxSelect").length; i++){
                    idxarr[idcnt] = $(".idxSelect")[i].value;
                    console.log("i번째 확인 : ", i);
                    idcnt++;

                    // 시나리오 순번을 수정할 때 1~5를 넘을 경우 
                    if($(".idxSelect")[i].value < 1 || $(".idxSelect")[i].value > 5){
                        alert("시나리오 순번을 1~5 사이로 입력해주세요.");
                        location.reload();
                        return false;   // return false;로 해당 form이 수행하지 못하게 하기
                    }

                    //중복 검사 for문
                    for(var j=0; j<i; j++){
                        // i번째 순번을 반복해서 j가 i번째 까지 검사
                        // ex) i가 3까지 도달한 경우 중복검사 for문은 0~3까지 4번 반복하며,
                        // idxarr[3] 값을 $(".idxSelect")[0].value ~ $(".idxSelect")[3].value까지 4번 검사 하고 같을 경우 overlap변수에 중복된 순서를 넣는다.
                        if(idxarr[i] == $(".idxSelect")[j].value){
                             overlap = $(".idxSelect")[j].value;
                        }
                    }
                }

                // 중복될 경우 
                if(overlap != ""){
                    console.log("중복된 번호 확인 : ", overlap);
                        overlap = 0;   
                        alert("시나리오 순서가 중복되었습니다.");
                        location.reload();
                }

                else{   //중복이 아닐 경우 form태그를 submit해주기
                    document.getElementById("form_el").submit();

                }
            
            });

            var send_array = Array();
            var send_cnt = 0;
            var chkbox = $(".checkSelect");
         

            // 체크박스 전체 선택
            $(".check_all").click(function(){
                $(".checkSelect").prop('checked', this.checked);
            });

            //선택되어 있는 체크박스를 삭제하기
            $("#clicktrash").click(function(){
                for(i=0; i<chkbox.length; i++){
                    if(chkbox[i].checked == true){
                        send_array[send_cnt] = chkbox[i].value;
                        console.log(document.getElementsByName("fileck[]")[i].value);
                        console.log(document.getElementsByName("movfileck[]")[i].value);
                        file_array[send_cnt] = document.getElementsByName("fileck[]")[i].value;
                        movfile_array[send_cnt] =document.getElementsByName("movfileck[]")[i].value;
                         // hidden속성인 파일의 value값의 순번을 받기
                        send_cnt++;
                    }
                }

                if(send_array == ""){
                    console.log("check none");
                }
                else{
                    console.log(file_array);
                    console.log(send_array);
                    var chkjson = JSON.stringify(send_array);
                    
                    $.ajax({
                        type: "POST",
                        url: "./mid_sceDelete.php",
                        data: {data : chkjson},
                        cache: false,
                        success: function(e){
                            alert("삭제 되었습니다.");
                        }
                    });
                }
            });
        });
    </script>
    <!-- 삭제 시 현 시나리오에 담긴 파일도 삭제(firebase) -->
    <script src="./mid_delete_firebase_file.js"></script>
</body>
</html>
<?php
    if(!isset($_SESSION['userid'])){
        echo "<script> alert('잘못된접근입니다.');  location.href='../../index.php'; </script>";
    }
?>