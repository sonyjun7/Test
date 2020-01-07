<?php 
    include "../common/db.php";
    $title = $_GET['title'];
    $sql = mq("select 360img from eltable where title='".$title."'");
    $imgboard = $sql -> fetch_array();
?>

<script src="https://cdn.bootcss.com/aframe/0.7.1/aframe.min.js"></script>
    <script src="https://unpkg.com/aframe-particle-system-component@1.0.x/dist/aframe-particle-system-component.min.js"></script>
    <script src="https://unpkg.com/aframe-extras.ocean@%5E3.5.x/dist/aframe-extras.ocean.min.js"></script>
    <script src="https://unpkg.com/aframe-gradient-sky@1.0.4/dist/gradientsky.min.js"></script>

<?php
    if($imgboard['360img'] == ""){
        echo "360 이미지 없음";
    } else{
?>
<a-scene>
    <a-sky src="../../img/el_img/<?php echo $imgboard['360img'] ?>"></a-sky>
    <a-entity camera look-controls position="0 1.6 0"></a-entity>
    <!-- <a-entity camera touch-controls></a-entity> -->

    <!-- <a-animation attribute="rotation" fill="forwards" easing="linear" dur="15000" from="0 0 0" to="0 360 0" repeat="indefinite"></a-animation> -->
  
    <!-- <a-sky src="../../img/el_img/<?php //echo $imgboard['360img'] ?>" rotation="0 0 0"></a-sky> -->
</a-scene>
<?php
    }
?>