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
    <link rel="stylesheet" href="../../css/userEnter_css/user_enter.css">
    <link rel="stylesheet" href="../../css/tourSearch_css/tour_search2.css">
    <title>관광지 검색</title>
</head>
<body>

    <p id="gubun_elmid">중등</p>
    <!-- 검색할 파라미터 장소,과목,학년 -->
    <div class="panel panel-success p_head">
        <div class="panel-heading">원하는 교육 관광 정보를 선택해 주세요<br>(검색을 자주한 지역일수록 상단에 나옵니다.)</div>

        <div id="paramdiv" class="panel panel-body">
            <form method="get" id="param_form">
                <select name="state_param" id="state_param" class="form-control">

                    <?php
                        if($session != ""){ //세션이 있을 경우 최다 검색 지역 부터 출력되도록

                        $sql1 = mq("select state_t, COUNT(*) from state_table left join (select * from most_state_mid where id='".$session."') ms on state_table.state_t = ms.state group by id, state_t order by COUNT(*) desc, state desc, state_t asc");
        
                        while($morder = $sql1 -> fetch_array()){
                    ?>
                                <option value="<?php echo $morder['state_t']; ?>"><?php echo $morder['state_t']; ?></option>
                    <?php
                            }
                        } else{
                    ?>
                        <option value="">지역(시,도) 선택</option>
                        <option value="강원도">강원도</option>
                        <option value="경기도">경기도</option>
                        <option value="경상남도">경상남도</option>
                        <option value="경상도">경상도</option>
                        <option value="경상북도">경상북도</option>
                        <option value="광주광역시">광주광역시</option>
                        <option value="대구광역시">대구광역시</option>
                        <option value="대전광역시">대전광역시</option>
                        <option value="부산광역시">부산광역시</option>
                        <option value="서울특별시">서울특별시</option>
                        <option value="세종특별자치시">세종특별자치시</option>
                        <option value="울산광역시">울산광역시</option>
                        <option value="인천광역시">인천광역시</option>
                        <option value="전라남도">전라남도</option>
                        <option value="전라도">전라도</option>
                        <option value="전라북도">전라북도</option>
                        <option value="제주특별자치도">제주특별자치도</option>
                        <option value="충청남도">충청남도</option>
                        <option value="충청북도">충청북도</option>
                    <?php 
                        }
                    ?>
                </select>
                
                <select name="subject_param" id="subject_param" class="form-control">
                    <option value="">과목 선택</option>
                    <option value="국어">국어</option>
                    <option value="과학">과학</option>
                    <option value="미술">미술</option>
                    <option value="사회">사회</option>
                </select>

                <select name="year_param" id="year_param" class="form-control">
                    <option value="">학년 선택</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <!-- <option value="3">3</option> -->
                </select>


            </form>

            <button id="param_select" class="btn btn-success">검색</button>
        </div>
    </div>

    <div class="panel panel-default p_body">
        <div class="panel-heading">검색 결과<br>(검색을 자주한 장소일수록 상단에 나옵니다.)</div>
        <div class="panel-body">

        <!-- form submit막기 : 기존에 form으로 둘러싸여진 input text박스에서 포커스가 있을 때 Enter를 누르게 되면 자동적으로 submit가 된며 페이지가 리로드된다. 이것은 form 내부에 input박스가 하나만 존재해서 그런 경우이다.이 기능을 막고자할 경우 onsubmit="return false"로 제어가 가능하다 -->
            <form id="search_form" method="get" onsubmit="return false">
                <input type="text" class="form-control" name="searchstr" id="searchstr" required="required"/>
                <button id="searchbtn" class="btn btn-success">장소 검색</button>
            </form>

            <!-- 지역 선택 후 검색시 search_area영역에 ajax로 검색된 결과 테이블이 출력 -->
            <div id="search_area"></div>
        </div>
    </div>

    <?php
        // include "../common/footer.php";
    ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function(){

                $("#param_select").click(function(){
                    console.log("눌림");
                    var params = $("#param_form").serialize();
                    console.log(params);

                    $.ajax({
                        type: 'get',
                        url: './mid_searchtour.php',
                        data: params,
                        dataType: 'html',
                        success: function(result){
                            $("#search_area").html(result);
                            // alert(result);
                            console.log(result);
                            // location.reload();
                        },
                        error: function(err){
                            console.log(err);
                        }
                    });
                });

                $("#searchbtn").click(function(){
                    console.log("장소검색버튼");
                    var searchel = $("#search_form").serialize();

                    console.log($("#search_form")[0].attributes[0].ownerElement[0].value); 
                     // 버튼클릭시 form요소 내부의 input value값 확인

                    // input값에 내용이 있을때 실행
                    if($("#search_form")[0].attributes[0].ownerElement[0].value != ""){
                            $.ajax({
                                type: "get",
                                url: "./mid_searchstr_result.php",
                                data: searchel,
                                dataType: "html",
                                success: function(result2){
                                    $("#search_area").html(result2);
                                    console.log(result2);
                     
                                },
                                error: function(err){
                                    console.log(err);
                                }
                            });
                        }
                    });
                });

    </script>

</body>
</html>