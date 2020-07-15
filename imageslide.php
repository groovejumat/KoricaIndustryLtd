<!DOCTYPE html>
<html>
<title>W3.CSS</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<style>
    .mySlides {display:none;}
</style>
<body>

<?php
$connect = mysqli_connect("localhost", "root", "password", "WEBService") or die("fail");

//아이디가 있는지 검사(로그인)
$id=$_GET['id'];

/*echo $id;*/

$query = "select * from product where id='$id'";
$result = $connect->query($query);
$row=mysqli_fetch_assoc($result);

/*echo $row['imgurl'];
echo $row['subimgurl1'];
echo $row['subimgurl2'];*/
?>


<!--<h2 class="w3-center">Manual Slideshow</h2>-->

<div class="w3-content w3-display-container">

    <?php
    if($_GET['num']==1){
        ?>
        <img class="mySlides" src="<?php echo $row['imgurl']?>" style="width:100%">

        <!--1번 이미지가 있을 때만 표시.-->
        <?php
        if($row['subimgurl1']!=NULL){?>
            <img class="mySlides" src="<?php echo $row['subimgurl1']?>" style="width:100%">
            <?php
        }
        ?>

        <!--2번 이미지가 있을 때만 표시.-->
        <?php
        if($row['subimgurl2']!=NULL){?>
            <img class="mySlides" src="<?php echo $row['subimgurl2']?>" style="width:100%">
            <?php
        }
        ?>
    <?php
    }

    else if($_GET['num']==2){
        ?>
        <!--1번 이미지가 있을 때만 표시.-->
        <?php
        if($row['subimgurl1']!=NULL){?>
            <img class="mySlides" src="<?php echo $row['subimgurl1']?>" style="width:100%">
            <?php
        }
        ?>

        <!--2번 이미지가 있을 때만 표시.-->
        <?php
        if($row['subimgurl2']!=NULL){?>
            <img class="mySlides" src="<?php echo $row['subimgurl2']?>" style="width:100%">
            <?php
        }
        ?>
        <img class="mySlides" src="<?php echo $row['imgurl']?>" style="width:100%">
        <?php
    }

    else if($_GET['num']==3){
        ?>
        <?php
        if($row['subimgurl2']!=NULL){?>
            <img class="mySlides" src="<?php echo $row['subimgurl2']?>" style="width:100%">
            <?php
        }
        ?>

        <img class="mySlides" src="<?php echo $row['imgurl']?>" style="width:100%">

        <?php
        if($row['subimgurl1']!=NULL){?>
            <img class="mySlides" src="<?php echo $row['subimgurl1']?>" style="width:100%">
            <?php
        }
        ?>
    <?php
    }
    ?>



<!--    <img class="mySlides" src="<?php /*echo $row['imgurl']*/?>" style="width:100%">
    <img class="mySlides" src="<?php /*echo $row['subimgurl1']*/?>" style="width:100%">
    <img class="mySlides" src="<?php /*echo $row['subimgurl2']*/?>" style="width:100%">-->


    <button class="w3-button w3-black w3-display-left" onclick="plusDivs(-1)">&#10094;</button>
    <button class="w3-button w3-black w3-display-right" onclick="plusDivs(1)">&#10095;</button>
</div>

<script>
    var slideIndex = 1;
    showDivs(slideIndex);

    function plusDivs(n) {
        showDivs(slideIndex += n);
    }

    function showDivs(n) {
        var i;
        var x = document.getElementsByClassName("mySlides");
        if (n > x.length) {slideIndex = 1}
        if (n < 1) {slideIndex = x.length}
        for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";
        }
        x[slideIndex-1].style.display = "block";
    }
</script>

</body>
</html>
