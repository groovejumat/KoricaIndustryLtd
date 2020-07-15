
<style>
.page {
margin: 1em auto;
max-width: 768px;
display: flex;
align-items: flex-start;
flex-wrap: wrap;
height: 100%;
}

.box {
padding: 0.5em;
width: 100%;
margin:0.5em;
}

.box-2 {
padding: 0.5em;
width: calc(100%/2 - 1em);
}

.options label,
.options input{
width:4em;
padding:0.5em 1em;
}
.btn{
background:white;
color:black;
border:1px solid black;
padding: 0.5em 1em;
text-decoration:none;
margin:0.8em 0.3em;
display:inline-block;
cursor:pointer;
}

.hide {
display: none;
}

img {
max-width: 100%;
}
</style>


<main class="page">
    <h2>Upload ,Crop and save.</h2>
    <!-- input file -->
    <div class="box">
        <input type="file" id="file-input">
    </div>
    <!-- leftbox -->
    <div class="box-2">
        <div class="result"></div>
    </div>
    <!--rightbox-->
    <div class="box-2 img-result hide">
        <!-- result of crop -->
        <img class="cropped" src="" alt="">
    </div>
    <!-- input file -->
    <div class="box">
        <div class="options hide">
            <label> Width</label>
            <input type="number" class="img-w" value="300" min="100" max="1200" />
        </div>
        <!-- save btn -->
        <button class="btn save hide">Save</button>
        <!-- download btn -->
        <a href="" class="btn download hide">Download</a>
    </div>
</main>