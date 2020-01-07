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
    <title>획득정보확인</title>
</head>
<body>

    <?php
        // include "../common/header.php";
    ?>

    <!-- <div id="hNotice">
        <h2>획득정보확인</h2>
        <img src="../../img/main_pic_02.png">
    </div> -->


        <div id="stick_img_div">
            <img class="st1" src="../../img/sticker1.png" alt="">
            <img class="st1" src="../../img/sticker2.png" alt="">
            <img class="st1" src="../../img/sticker3.png" alt="">
            <img class="st1" src="../../img/sticker4.png" alt="">
        </div>

        <?php
            $mq1 = mq("select * from sticker where userID='".$session."' and edu_type like '%social%' and not kind in('timeAttack')");

            $socialrow = mysqli_num_rows($mq1);

            if($socialrow == 0){
                $social_achieve = 0;
            }
            else {
                // 사회과앱 달성률 (총 스티커수 4개)
                $social_achieve = ($socialrow/4)*100;
            }

        ?>

        <div class="panel panel-primary m_table">
            <p>사회과 달성률 : <?php echo $social_achieve ?>%</p>
            <div class="panel-heading">사회과 획득정보</div>
            <div class="panel-body p_table_body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>타입</th>
                            <th>획득여부</th>
                            <th>앱 종류</th>
                            <th>획득날짜</th>
                        </tr>
                    </thead>
                <?php


                    while($social = $mq1 -> fetch_array()){
                        // social -> 사회
                        if(strpos($social['kind'], "social") !== false || strpos($social['edu_type'], "social") !== false){
                           $tit = str_replace("social", "사회", $social['kind']);
                           $edu = str_replace("social", "사회", $social['edu_type']);
                        }
                        // 종류에따라 글자 변환
                        if(strpos($tit, "_sticker_") !== false){
                            $kindtype = str_replace("_sticker_", " 스티커 ", $tit);
                        }
                        else if(strpos($tit, "_badge_") !== false){
                            $kindtype = str_replace("_badge_", " 배지 ", $tit);
                        }
                        else if(strpos($tit, "_stamp_") !== false){
                            $kindtype = str_replace("_stamp_", " 스탬프 ", $tit);
                        }
                        // 순서에따라 글자 변환
                        if(strpos($kindtype, "first") !== false){
                            $rekind = str_replace("first", "(1)", $kindtype);
                        }
                        else if(strpos($kindtype, "second") !== false){
                            $rekind = str_replace("second", "(2)", $kindtype);
                        }
                        else if(strpos($kindtype, "third") !== false){
                            $rekind = str_replace("third", "(3)", $kindtype);
                        }
                        else if(strpos($kindtype, "fourth") !== false){
                            $rekind = str_replace("fourth", "(4)", $kindtype);
                        }
                        // 교육앱 종류를 변환
                        if(strpos($edu, "_live") !== false){
                            $edutype = str_replace("_live", " 혼합형 앱", $edu);
                        }
                        else if(strpos($edu, "_experience") !== false){
                            $edutype = str_replace("_experience", " 체험형 앱", $edu);
                        }

                ?>
                    <tbody>
                        <tr>
                            <td><?php echo $rekind ?></td>
                            <td><?php echo $social['get_flag'] ?></td>
                            <td><?php echo $edutype ?></td>
                            <td><?php echo $social['date'] ?></td>
                        </tr>
                    </tbody>

                <?php
                    }
                ?>
                </table>
            </div>
        </div>

        <?php 
            $mq1 = mq("select * from sticker where userID='".$session."' and edu_type like '%geo%' and not kind in('timeAttack')");

            $georow = mysqli_num_rows($mq1);

            if($georow == 0){
                $geo_achieve = 0;
            }
            else{
                // 지리과앱 달성률 (총 스티커수 8개)
                $geo_achieve = ($georow/8)*100;
            }
        ?>

        <div class="panel panel-success m_table">
            <p>지리과 달성률 : <?php echo $geo_achieve ?>%</p>
            <div class="panel-heading">지리과 획득정보</div>
            <div class="panel-body p_table_body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>타입</th>
                            <th>획득여부</th>
                            <th>앱 종류</th>
                            <th>획득날짜</th>
                        </tr>
                    </thead>
                <?php


                    while($geo = $mq1 -> fetch_array()){
                        // geo -> 지리
                        if(strpos($geo['kind'], "geo") !== false || strpos($geo['edu_type'], "geo") !== false){
                            $tit = str_replace("geo", "지리", $geo['kind']);
                            $edu = str_replace("geo", "지리", $geo['edu_type']);
                         }
                         // 종류에따라 글자 변환
                         if(strpos($tit, "_sticker_") !== false){
                             $kindtype = str_replace("_sticker_", " 스티커 ", $tit);
                         }
                         else if(strpos($tit, "_badge_") !== false){
                             $kindtype = str_replace("_badge_", " 배지 ", $tit);
                         }
                         else if(strpos($tit, "_stamp_") !== false){
                             $kindtype = str_replace("_stamp_", " 스탬프 ", $tit);
                         }
                         // 순서에따라 글자 변환
                         if(strpos($kindtype, "first") !== false){
                             $rekind = str_replace("first", "(1)", $kindtype);
                         }
                         else if(strpos($kindtype, "second") !== false){
                             $rekind = str_replace("second", "(2)", $kindtype);
                         }
                         else if(strpos($kindtype, "third") !== false){
                             $rekind = str_replace("third", "(3)", $kindtype);
                         }
                         else if(strpos($kindtype, "fourth") !== false){
                             $rekind = str_replace("fourth", "(4)", $kindtype);
                         }
                         // 교육앱 종류를 변환
                         if(strpos($edu, "_live") !== false){
                             $edutype = str_replace("_live", " 혼합형 앱", $edu);
                         }
                         else if(strpos($edu, "_experience") !== false){
                             $edutype = str_replace("_experience", " 체험형 앱", $edu);
                         }
                ?>
                    <tbody>
                        <tr>
                            <td><?php echo $rekind ?></td>
                            <td><?php echo $geo['get_flag'] ?></td>
                            <td><?php echo $edutype ?></td>
                            <td><?php echo $geo['date'] ?></td>
                        </tr>
                    </tbody>

                <?php
                    }
                ?>
                </table>
            </div>
        </div>

        <?php
            $mq1 = mq("select * from sticker where userID='".$session."' and edu_type like '%sci%' and not kind in('timeAttack')");

            $scirow = mysqli_num_rows($mq1);

            if($scirow == 0){
                $sci_achieve = 0;
            }
            else{
                $sci_achieve = ($scirow/4)*100;
            }
        ?>

        <div class="panel panel-warning m_table">
            <p>과학과 달성률 : <?php echo $sci_achieve ?>%</p>
            <div class="panel-heading">과학과 획득정보</div>
            <div class="panel-body p_table_body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>타입</th>
                            <th>획득여부</th>
                            <th>앱 종류</th>
                            <th>획득날짜</th>
                        </tr>
                    </thead>
                <?php


                    while($sci = $mq1 -> fetch_array()){
                        // sci -> 과학
                        if(strpos($sci['kind'], "sci") !== false || strpos($sci['edu_type'], "sci") !== false){
                            $tit = str_replace("sci", "과학", $sci['kind']);
                            $edu = str_replace("sci", "과학", $sci['edu_type']);
                         }
                         // 종류에따라 글자 변환
                         if(strpos($tit, "_sticker_") !== false){
                             $kindtype = str_replace("_sticker_", " 스티커 ", $tit);
                         }
                         else if(strpos($tit, "_badge_") !== false){
                             $kindtype = str_replace("_badge_", " 배지 ", $tit);
                         }
                         else if(strpos($tit, "_stamp_") !== false){
                             $kindtype = str_replace("_stamp_", " 스탬프 ", $tit);
                         }
                         // 순서에따라 글자 변환
                         if(strpos($kindtype, "first") !== false){
                             $rekind = str_replace("first", "(1)", $kindtype);
                         }
                         else if(strpos($kindtype, "second") !== false){
                             $rekind = str_replace("second", "(2)", $kindtype);
                         }
                         else if(strpos($kindtype, "third") !== false){
                             $rekind = str_replace("third", "(3)", $kindtype);
                         }
                         else if(strpos($kindtype, "fourth") !== false){
                             $rekind = str_replace("fourth", "(4)", $kindtype);
                         }
                         // 교육앱 종류를 변환
                         if(strpos($edu, "_live") !== false){
                             $edutype = str_replace("_live", " 혼합형 앱", $edu);
                         }
                         else if(strpos($edu, "_experience") !== false){
                             $edutype = str_replace("_experience", " 체험형 앱", $edu);
                         }                        
                ?>
                    <tbody>
                        <tr>
                            <td><?php echo $rekind ?></td>
                            <td><?php echo $sci['get_flag'] ?></td>
                            <td><?php echo $edutype ?></td>
                            <td><?php echo $sci['date'] ?></td>
                        </tr>
                    </tbody>

                <?php
                    }
                ?>
                </table>
            </div>
        </div>

        <?php
            $mq1 = mq("select * from sticker where userID='".$session."' and edu_type like '%lang%' and not kind in('timeAttack')");

            $langrow = mysqli_num_rows($mq1);

            if($langrow == 0){
                $lang_achieve = 0;
            }
            else{
                $lang_achieve = ($langrow/4)*100;
            }

        ?>

        <div class="panel panel-info m_table">
            <p>국어과 달성률 : <?php echo $lang_achieve ?>%</p>
            <div class="panel-heading">국어과 획득정보</div>
            <div class="panel-body p_table_body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>타입</th>
                            <th>획득여부</th>
                            <th>앱 종류</th>
                            <th>획득날짜</th>
                        </tr>
                    </thead>
                <?php


                    while($lang = $mq1 -> fetch_array()){
                        // lang -> 국어
                        if(strpos($lang['kind'], "lang") !== false || strpos($lang['edu_type'], "lang") !== false){
                            $tit = str_replace("lang", "국어", $lang['kind']);
                            $edu = str_replace("lang", "국어", $lang['edu_type']);
                         }
                         // 종류에따라 글자 변환
                         if(strpos($tit, "_sticker_") !== false){
                             $kindtype = str_replace("_sticker_", " 스티커 ", $tit);
                         }
                         else if(strpos($tit, "_badge_") !== false){
                             $kindtype = str_replace("_badge_", " 배지 ", $tit);
                         }
                         else if(strpos($tit, "_stamp_") !== false){
                             $kindtype = str_replace("_stamp_", " 스탬프 ", $tit);
                         }
                         // 순서에따라 글자 변환
                         if(strpos($kindtype, "first") !== false){
                             $rekind = str_replace("first", "(1)", $kindtype);
                         }
                         else if(strpos($kindtype, "second") !== false){
                             $rekind = str_replace("second", "(2)", $kindtype);
                         }
                         else if(strpos($kindtype, "third") !== false){
                             $rekind = str_replace("third", "(3)", $kindtype);
                         }
                         else if(strpos($kindtype, "fourth") !== false){
                             $rekind = str_replace("fourth", "(4)", $kindtype);
                         }
                         // 교육앱 종류를 변환
                         if(strpos($edu, "_live") !== false){
                             $edutype = str_replace("_live", " 혼합형 앱", $edu);
                         }
                         else if(strpos($edu, "_experience") !== false){
                             $edutype = str_replace("_experience", " 체험형 앱", $edu);
                         }                           
                ?>
                    <tbody>
                        <tr>
                            <td><?php echo $rekind ?></td>
                            <td><?php echo $lang['get_flag'] ?></td>
                            <td><?php echo $edutype ?></td>
                            <td><?php echo $lang['date'] ?></td>
                        </tr>
                    </tbody>

                <?php
                    }
                ?>
                </table>
            </div>
        </div>

        <?php
            $mq1 = mq("select * from sticker where userID='".$session."' and edu_type like '%art%' and not kind in('timeAttack')");

            $artrow = mysqli_num_rows($mq1);

            if($artrow == 0){
                $art_achieve = 0;
            }
            else{
                $art_achieve = ($artrow/4)*100;
            }
        ?>

        <div class="panel panel-default m_table">
            <p>미술과 달성률 : <?php echo $art_achieve ?>%</p>
            <div class="panel-heading">미술과 획득정보</div>
            <div class="panel-body p_table_body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>타입</th>
                            <th>획득여부</th>
                            <th>앱 종류</th>
                            <th>획득날짜</th>
                        </tr>
                    </thead>
                <?php


                    while($art = $mq1 -> fetch_array()){
                        // art -> 미술
                        if(strpos($art['kind'], "art") !== false || strpos($art['edu_type'], "art") !== false){
                            $tit = str_replace("art", "미술", $art['kind']);
                            $edu = str_replace("art", "미술", $art['edu_type']);
                         }
                         // 종류에따라 글자 변환
                         if(strpos($tit, "_sticker_") !== false){
                             $kindtype = str_replace("_sticker_", " 스티커 ", $tit);
                         }
                         else if(strpos($tit, "_badge_") !== false){
                             $kindtype = str_replace("_badge_", " 배지 ", $tit);
                         }
                         else if(strpos($tit, "_stamp_") !== false){
                             $kindtype = str_replace("_stamp_", " 스탬프 ", $tit);
                         }
                         // 순서에따라 글자 변환
                         if(strpos($kindtype, "first") !== false){
                             $rekind = str_replace("first", "(1)", $kindtype);
                         }
                         else if(strpos($kindtype, "second") !== false){
                             $rekind = str_replace("second", "(2)", $kindtype);
                         }
                         else if(strpos($kindtype, "third") !== false){
                             $rekind = str_replace("third", "(3)", $kindtype);
                         }
                         else if(strpos($kindtype, "fourth") !== false){
                             $rekind = str_replace("fourth", "(4)", $kindtype);
                         }
                         // 교육앱 종류를 변환
                         if(strpos($edu, "_live") !== false){
                             $edutype = str_replace("_live", " 혼합형 앱", $edu);
                         }
                         else if(strpos($edu, "_experience") !== false){
                             $edutype = str_replace("_experience", " 체험형 앱", $edu);
                         }                               
                ?>
                    <tbody>
                        <tr>
                            <td><?php echo $rekind ?></td>
                            <td><?php echo $art['get_flag'] ?></td>
                            <td><?php echo $edutype ?></td>
                            <td><?php echo $art['date'] ?></td>
                        </tr>
                    </tbody>

                <?php
                    }
                ?>
                </table>
            </div>
        </div>

        <?php
            $allachieve = ($socialrow + $scirow + $georow + $langrow + $artrow)/24*100;
        ?>

        <div id="all_ach_div">
            <h3>총 달성률 : <?php echo round($allachieve, 2) ?>%</h3>
        </div>


        <div class="panel panel-success m_table">
            <div class="panel-heading">타임어택</div>
            <div class="panel-body p_table_body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>타입</th>
                            <th>기록</th>
                            <th>기록된 시간</th>
                        </tr>
                    </thead>
                <?php
                    $mq2 = mq("select * from sticker where userID='".$session."' and kind='timeAttack'");

                    while($timeatk = $mq2 -> fetch_array()){
                        if(strpos($timeatk['kind'], "timeAttack") !== false){
                            $tit = str_replace("timeAttack", "타임어택", $timeatk['kind']);
                        }
                ?>
                    <tbody>
                        <tr>
                            <td><?php echo $tit ?></td>
                            <td><?php echo $timeatk['time_report'] ?> 초</td>
                            <td><?php echo $timeatk['date'] ?></td>
                        </tr>
                    </tbody>

                <?php
                    }
                ?>
                </table>
            </div>
        </div>

    <?php
        // include "../common/footer.php";
    ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../../bootstrap/js/bootstrap.min.js"></script>

</body>
</html>
<?php
    if(!isset($_SESSION['userid'])){
        echo "<script> alert('잘못된접근입니다.');  location.href='../../index.php'; </script>";
    }
?>