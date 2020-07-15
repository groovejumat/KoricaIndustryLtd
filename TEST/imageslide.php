
<style>
/*    .slide body {
        font-family: Arial;
        margin: 0;
        width: 300px;
        height: 300px;
    }*/

    * {
        box-sizing: border-box;
    }

/*    img {
        vertical-align: middle;
    }*/

    /* Position the image container (needed to position the left and right arrows) */

</style>
<body class="slide">

<h2 style="text-align:center">Slideshow Gallery</h2>

<div class="container">
    <div class="mySlides">
        <div class="numbertext">1 / 3</div>
        <img src="../img/KakaoTalk_20191218_014013562.jpg" style="max-width:300px;max-height:300px;">
    </div>

    <div class="mySlides">
        <div class="numbertext">2 / 3</div>
        <img src="../img/KakaoTalk_20191218_135033465.jpg" style="width:300px">
    </div>

    <div class="mySlides">
        <div class="numbertext">3 / 3</div>
        <img src="../img/KakaoTalk_20191218_013935089.jpg" style="width:300px">
    </div>


    <a class="prev" onclick="plusSlides(-1)">❮</a>
    <a class="next" onclick="plusSlides(1)">❯</a>

    <div class="caption-container">
        <p id="caption"></p>
    </div>

    <div class="row">
        <div class="column">
            <img class="demo cursor" src="../img/KakaoTalk_20191218_014013562.jpg" style="width:100% " onclick="currentSlide(1)" alt="The Woods">
        </div>
        <div class="column">
            <img class="demo cursor" src="../img/KakaoTalk_20191218_135033465.jpg" style="width:100%" onclick="currentSlide(2)" alt="Cinque Terre">
        </div>
        <div class="column">
            <img class="demo cursor" src="../img/KakaoTalk_20191218_013935089.jpg" style="width:100%" onclick="currentSlide(3)" alt="Mountains and fjords">
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

</body>
</html>
