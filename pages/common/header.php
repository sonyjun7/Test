<?php
    // include "./db.php";
    session_start();
    
    // $id = "commonUser";
    // $_SESSION['userid'] = $id;
    // session_destroy();      //세션 새로고침을 확인하기 위해서 설정, 로그인 유지를 위해서는 이 부분을 제거
    $head1 = mq("select * from member where id='".$_SESSION['userid']."'");
    $mem = $head1 -> fetch_array();
?>
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+KR:500&display=swap" rel="stylesheet">
<script src="https://use.fontawesome.com/releases/v5.2.0/js/all.js"></script>
<script src="https://use.fontawesome.com/releases/v5.2.0/js/all.js"></script>

<div class="header_menu">
        <div class="header_icon">
            <a href="../../index.php"><img src="../../img/main_icon.png"></a>
        </div>

                <label for="toggle"><i class="fas fa-bars fa-2x"></i></label>
                <input type="checkbox" id="toggle">

                    <ul id="nav">
                        <li><a href="../notice/arvr_notice.php">공지사항</a></li>
                        <li><a href="../tourism/eduSelect.php">교육관광</a></li>
                        <!-- <li><a href="../tourSeach/phpsearch.php">관광DB</a></li> -->
                        <li><a href="../tourSeach/toursearch_select.php">관광DB</a></li>
                        <li><a href="../dataroom/appDownload.php">자료실</a></li>
                        <li><a href="../userEnter/user_select.php">참여공간</a></li>

                        <?php
                            if(!isset($_SESSION['userid'])){
                        ?>
                            <button class="btn btn-primary clsbtn" onclick="location.href='../login_admission/loginMain.php'">로그인/회원가입</button>

                        <?php
                          } 
                        else{
                        ?>
                        <?php
                            if($mem['group'] == "root"){    //관리자ID일 경우
                        ?>
                                <li><a href="../member/masterPage.php">관리자페이지</a></li>
                                <button class="btn btn-primary clsbtn" onclick="location.href='../login_admission/logout.php'">로그아웃</button> 
                        <?php   
                            }  else{  //일반 사용자일 경우 
                        ?>   
                            <li><a href="../member/myPage.php">MyPage</a></li>
                            <button class="btn btn-primary clsbtn" onclick="location.href='../login_admission/logout.php'">로그아웃</button>          
                        <?php    
                            }           
                        }
                        ?>

                    </ul>
                  
            <div id="site_map_div">
                <a id="ppolicy_css" href="../common/personal_policy.php"><button class="btn btn-link" style="color:black;">| 개인정보 방침 |</button></a>
                <a href="../common/sitemap.php"><button class="btn btn-link" style="color:black;">| 사이트 맵 |</button></a>
            </div>

 </div>

    <div id="commonBanner">
        <img src="../../img/Art_bar.png" width="100%">
    </div>