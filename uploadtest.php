<!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8">
</head>
<body>
<!-- 이미지 파일만 등록되게 accept 확장지 지정 -->
<div id="preview"></div><input type="file" name="" class="inp-img" accept=".gif, .jpg, .png"> <span class="btn-delete">삭제</span>
<script src="lib/jquery/2.2.3/jquery.min.js"></script>
<script type="text/javascript">

    // 등록 이미지 등록 미리보기
    function readInputFile(input) {
        if(input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#preview').html("<img src="+ e.target.result +">");
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $(".inp-img").on('change', function(){
        readInputFile(this);
    });


    // 등록 이미지 삭제 ( input file reset )
    function resetInputFile($input, $preview) {
        var agent = navigator.userAgent.toLowerCase();
        if((navigator.appName == 'Netscape' && navigator.userAgent.search('Trident') != -1) || (agent.indexOf("msie") != -1)) {
            // ie 일때
            $input.replaceWith($input.clone(true));
            $preview.empty();
        } else {
            //other
            $input.val("");
            $preview.empty();
        }
    }

    $(".btn-delete").click(function(event) {
        var $input = $(".inp-img");
        var $preview = $('#preview');
        resetInputFile($input, $preview);
    });
</script>
</body>
</html>
