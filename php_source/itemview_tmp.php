<html>
<head>
    <!--메인페이지에 대한 스타일 리스트-->
    <link rel= "stylesheet" type="text/css" href="./css/MainStyle.css?"> <!--CSS파일변경이 반영되도록 설정하기-->
</head>
<?php include("MainHead.php"); ?>
<style>
    table {
        display: inline-block;
        border-collapse: separate;
        font-size: 20px;
        border-spacing: 0 20px;
        vertical-align: top;
    }

    .tdstyle {
        font-weight: bold;
        padding : 0px 20px
    }

    tr.trstyle {
        padding-bottom: 20px;
    }

    .divstyle {
        display: inline-block;
        margin: 2px 0;
        padding: 1px 3px;
        border-width: 2px;
        width: 40%;
        padding: 10px;
        vertical-align:top;
    }

    hr {
        border: 1px solid #f1f1f1;
        margin-bottom: 25px;
    }
</style>

<body>

<div class="card" align="center">
    <h2 align="center">Product Detail</h2>
    <hr>
    <div class="divstyle" style="width: 340px">
        <?php
        $subimgurl1=$_POST["subimgurl1"];
        $subimgurl2=$_POST["subimgurl2"];
        ?>

<!--        <?php /*if($subimgurl1!=NULL){
            */?>
            <img src='<?php /*echo $_POST["subimgurl1"];*/?>' style="width:100%">
            <?php
/*        }
        else{
            */?>
            <img src=img/no-image-icon.PNG style="width:100%">
        --><?php
/*        }*/?>

        <div class="container">
            <div class="mySlides" style="width: 100%;height:260px;overflow: hidden">
                <div class="numbertext">1 / 3</div>
                <img src='<?php echo $_POST["imageurl"];?>' style="max-width:100%;min-height:260px">
            </div>

            <div class="mySlides">
                <div class="numbertext">2 / 3</div>
                <?php if($subimgurl1!=NULL){
                    ?>
                    <img src='<?php echo $_POST["subimgurl1"];?>' style="width:100%;min-height:260px">
                    <?php
                }
                else{
                    ?>
                    <img src=img/no-image-icon.PNG style="width:100%;min-height:260px">
                    <?php
                }?>
            </div>

            <div class="mySlides">
                <div class="numbertext">3 / 3</div>
                <?php if($subimgurl2!=NULL){
                    ?>
                    <img src='<?php echo $_POST["subimgurl2"];?>' style="width:100%;min-height:260px">
                    <?php
                }
                else{
                    ?>
                    <img src=img/no-image-icon.PNG style="width:100%;min-height:260px">
                    <?php
                }?>
            </div>


            <a class="prev" onclick="plusSlides(-1)" style="text-align: left">❮</a>
            <a class="next" onclick="plusSlides(1)">❯</a>

            <div class="caption-container">
                <p id="caption" style="width:100%"></p>
            </div>

            <div class="row">
                <div class="column">
                    <img class="demo cursor" src='<?php echo $_POST["imageurl"];?>' style="width:100%;" onmouseover="currentSlide(1)" alt="Detail">
                </div>
                <div class="column">
                    <?php if($subimgurl1!=NULL){
                        ?>
                        <img class="demo cursor" src='<?php echo $_POST["subimgurl1"];?>' style="width:100%;" onmouseover="currentSlide(2)" alt="Detail">
                        <?php
                    }
                    else{
                        ?>
                        <img class="demo cursor" src=img/no-image-icon.PNG style="width:100%;" onmouseover="currentSlide(2)" alt="Detail">
                        <?php
                    }?>
                </div>
                <div class="column">
                    <?php if($subimgurl2!=NULL){
                        ?>
                        <img class="demo cursor" src='<?php echo $_POST["subimgurl2"];?>' style="width:100%;" onmouseover="currentSlide(3)" alt="Detail">
                        <?php
                    }
                    else{
                        ?>
                        <img class="demo cursor" src=img/no-image-icon.PNG style="width:100%;" onmouseover="currentSlide(3)" alt="Detail">
                        <?php
                    }?>
                </div>
            </div>
        </div>

        <script>
            var slideIndex = 1;
            showSlides(slideIndex);

            function plusSlides(n) {
                showSlides(slideIndex += n);
            }

            function currentSlide(n) {
                showSlides(slideIndex = n);
            }

            function showSlides(n) {
                var i;
                var slides = document.getElementsByClassName("mySlides");
                var dots = document.getElementsByClassName("demo");
                var captionText = document.getElementById("caption");
                if (n > slides.length) {slideIndex = 1}
                if (n < 1) {slideIndex = slides.length}
                for (i = 0; i < slides.length; i++) {
                    slides[i].style.display = "none";
                }
                for (i = 0; i < dots.length; i++) {
                    dots[i].className = dots[i].className.replace(" active", "");
                }
                slides[slideIndex-1].style.display = "block";
                dots[slideIndex-1].className += " active";
                captionText.innerHTML = dots[slideIndex-1].alt;
            }
        </script>
    </div>

    <div class="divstyle">
        <div align="left">
        <table>
            <!--            <tr class="trstyle">
                            <td style="padding: 0px 20px" >Used Car</td>
                        </tr>-->
            <tr class="trstyle">
                <td class="tdstyle">Product:</td>
                <td><?php echo $_POST["productname"];?></td>
            </tr>



            <!--            <div>
            <tr class="trstyle">
                <td class="tdstyle">Descrition</td>
                <td><?php /*echo $_GET["quantity"];*/?></td>
            </tr>
            </div>-->
        </table>
        </div>

        <div align="left" style="word-break:break-all;padding-left: 20px" >
            <p>this product detail part. this product detail part. this product detail part. this product detail part. this product detail part. this product detail part. this product detail part.</p>
        </div>

        <div align="center" style="word-break: break-all">
            <td><button class="view_btn1" type="submit" form="nameform" value="Submit">AddList</button></td>
<!--            <td><button class="view_btn1" type="submit" form="nameform" value="Submit">Order</button></td>-->
        </div>
    </div>
    <hr>

</div>
</body>
