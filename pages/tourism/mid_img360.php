<?php 
    include "../common/db.php";
    $title = $_GET['title'];
    $sql = mq("select 360img from midtable where title='".$title."'");
    $imgboard = $sql -> fetch_array();
?>

<!-- <script src="https://cdn.bootcss.com/aframe/0.7.1/aframe.min.js"></script> -->
<script src="https://aframe.io/releases/0.9.2/aframe.min.js"></script>
    <script src="https://unpkg.com/aframe-particle-system-component@1.0.x/dist/aframe-particle-system-component.min.js"></script>
    <script src="https://unpkg.com/aframe-extras.ocean@%5E3.5.x/dist/aframe-extras.ocean.min.js"></script>
    <script src="https://unpkg.com/aframe-gradient-sky@1.0.4/dist/gradientsky.min.js"></script>

<?php
    if($imgboard['360img'] == ""){
        echo "360 이미지 없음";
    } else{
?>

    <a-scene>
        <a-sky src="../../img/mid_img/<?php echo $imgboard['360img'] ?>" rotation="0 -130 0"></a-sky>
    </a-scene>



<?php
    }
?>