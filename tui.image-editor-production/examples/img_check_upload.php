<?php
    // $chk = $_POST['chk'];
    // echo $chk;
    // echo $_GET['movfile'];
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <title>Document</title>
    <style>
        div.polaroid{
            width: 100%;
            max-width: 900px;
            background-color: white;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            margin-bottom: 25px;
            text-align: center;
        }
        div.container {
            text-align: center;
            padding: 10px 20px;
        }
        #imgimg{
            max-width: 100%;
        }
    </style>
</head>
<body>
    <div class="polaroid">
        <img alt="none" id="imgimg" />

        <div class="container">
            <p><?php echo $_GET['movfile']; ?></p>

            <div>
                <button class="btn btn-primary btn-lg" value="닫기" style="width:250px; margin-left:30px;" onclick="window.close()">닫기</button>
            </div>
        </div>
    </div>



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
    <script>
        var imgfileName = "<?= $_GET['movfile']; ?>";
    </script>
    <script src="../dist/image_watch.js"></script>
</body>
</html>

