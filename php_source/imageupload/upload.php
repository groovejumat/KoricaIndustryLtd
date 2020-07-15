<html>
<head>
    <!--메인페이지에 대한 스타일 리스트-->
<!--    <link rel= "stylesheet" type="text/css" href="../css/common.css">-->
    <link rel= "stylesheet" type="text/css" href="../css/MainStyle.css?ver1">

</head>
<body>

<?php include("../MainHead.php"); ?>

</body>
</html>


<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="Generator" content="EditPlus®">
    <meta name="Author" content="">
    <meta name="Keywords" content="">
    <meta name="Description" content="">
    <title>Document</title>
<body>
<div style="width: 300px; margin:0 auto;">
    <h3>이미지 파일 업로드 연습</h3>

        <form action="upload_action2.php" method="post" enctype="multipart/form-data">
            Select image to upload:
            <input type="file" name="fileToUpload" id="fileToUpload">
            <input type="submit" value="Upload Image" name="submit">
        </form>
</div>
<div class="wholecolumn" >
    <div class="card">
    <?php
    include_once 'config.php';
    $conn = mysqli_connect('localhost', 'root', 'password', 'WEBService') or die ("connect fail");
    if(mysqli_connect_errno()){
        echo "연결실패! ".mysqli_connect_error();
    }
    $query = "SELECT * FROM images";
    $result = mysqli_query($conn, $query);

    while($data = mysqli_fetch_array($result)){

/*        echo '<li style=\'float:left; margin: 2px;\'>';
        echo '<img src='.$data['imgurl'].' width=200 height=200><br>';
        echo ($data['filename']);
        echo '</li>';*/
        ?>

        <div>
            <img src='<?php echo $data['imgurl'];?>' width=200 height=200>
            <p>'<?php echo $data['filename'];?>'</p>
        </div>


<!--        <div class="jb-wrap">
            <img src='<?php /*echo $data['imgurl'];*/?>' width=200 height=200>
            <div class="jb-text">
                <p>'<?php /*echo $data['filename'];*/?>'</p>
            </div>
        </div>-->
<!--        <img src='<?php /*echo $data['imgurl'];*/?>' width=200 height=200>-->
        <?php
    }

    mysqli_close($conn);
    ?>
    </div>
</div>

</body>
</html>