<?php

$privacy= $_POST['privacy'];

$terms= $_POST['terms'];

if($privacy!=NULL and $terms!=NULL){
    //$_SESSION['agree']="ok";
    setcookie('agree', "ok", time() + 3600);


    //세션에 저장해서 관리
    ?>
    <script>
    alert("Agree to Terms & Privacy complete.");
    self.close();
    </script>
<?php
}
else{

    //페이지 뒤로가기 처리
    ?>
    <script>
        alert("Please Agree to terms & privacy.");
        history.back();
    </script>
    <?php
}
?>