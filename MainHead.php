    <?php
    session_start();
    //저장한 쿠키값 불러오기
    $password = 'password';

    // 256 bit 키를 만들기 위해서 비밀번호를 해시해서 첫 32바이트를 사용합니다.
    $password = substr(hash('sha256', $password, true), 0, 32);

    $iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);

    $encryptedid=$_COOKIE['cookieid'];
    $decryptedid = openssl_decrypt(base64_decode($encryptedid), 'aes-256-cbc', $password, OPENSSL_RAW_DATA, $iv);
    //echo $decryptedid;

    $encryptedpass=$_COOKIE['cookiepass'];
    $decryptedpass = openssl_decrypt(base64_decode($encryptedpass), 'aes-256-cbc', $password, OPENSSL_RAW_DATA, $iv);
    //echo $decryptedpass;

    $connect = mysqli_connect("localhost", "root", "password", "WEBService") or die("fail");

    //아이디가 있는지 검사(쿠키)
    $query = "select * from account where email='$decryptedid'";
    $result = $connect->query($query);

    if(mysqli_num_rows($result)==1) {

                $row=mysqli_fetch_assoc($result);

                //비밀번호가 맞다면 세션 생성
                if($row['pwd']==$decryptedpass){
                        $_SESSION['userid']=$decryptedid;
                        //echo $_SESSION['userid'];


                        if(isset($_SESSION['userid'])){
                        ?>      <script>

        //세션 저장해보기 (node js로 불러오는 것 실패)
        sessionStorage.setItem("userid","<?php echo $decryptedid?>");
        var sesseionid = sessionStorage.getItem("userid");
        console.log(sesseionid);


    </script>
    <?php
    }



    else{
        echo "session fail";
    }
    }

    else {
    ?>              <script>
        alert("Email address or password is incorrect.");
        history.back();
    </script>
    <?php
    }

    }?>


<div class="header">
<!--    <img src="/img/korica%20mark2.png" height="80" style="vertical-align: bottom;">-->
    <h1><a href="upload.php?itemid=10" style="text-decoration:none;color:#000000" >
            Korica Industry Ltd</a></h1> <!--밑줄 표시 밑 내용 바뀜-->
<p style="font-weight: bolder">Used Car & AutoParts</p>
</div>

<div class="topnav">
<!--    <a href="upload.php?itemid=1">UsedCar</a>
    <a href="upload.php?itemid=2">UsedEngine</a>
    <a href="upload.php?itemid=3">SpareParts</a>
-->

    <!--UsedCar Parts-->
    <div class="dropdown">
        <button class="dropbtn">
            <a href="upload.php?itemid=10">UsedCar</a>
        </button>
        <div class="dropdown-content">
<!--            <form action="upload.php" method="get" style='background:none;border:none;padding:0;margin:0'>
                <button type="submit" name="itemid" value=1 class="btn-link">UsedCar</button>
            </form>
            <form action="upload.php" method="get" style='background:none;border:none;padding:0;margin:0'>
                <button type="submit" name="itemid" value=2 class="btn-link">UsedEngine</button>
            </form>-->

            <a href="upload.php?itemid=11">Hyundai</a>
            <a href="upload.php?itemid=12">Kia</a>
            <a href=#>Daewoo</a>
            <a href="upload.php?itemid=14">Honda</a>
            <a href="upload.php">Ssang young</a>
            <a href="#">Nissan</a>
            <a href="#">Toyota</a>
            <a href="#">Ford</a>

        </div>
    </div>

    <!--UsedEngine Parts-->
    <div class="dropdown">
        <button class="dropbtn">
            <a href="upload.php?itemid=20">UsedEngine</a>
        </button>
<!--        <div class="dropdown-content">
            <a href="upload.php">item21</a>
            <a href="upload.php">item22</a>
            <a href="upload.php">item23</a>
            <a href="upload.php">item24</a>
            <a href="upload.php">item25</a>
        </div>-->
    </div>

    <!--Auto Parts-->
    <div class="dropdown">
        <button class="dropbtn">
            <a href="upload.php?itemid=30">AutoParts</a>
        </button>
<!--        <div class="dropdown-content">
            <a href="upload.php">item31</a>
            <a href="upload.php">item32</a>
            <a href="upload.php">item33</a>
            <a href="upload.php">item34</a>
            <a href="upload.php">item35</a>
        </div>-->
    </div>
    <a onclick="location.href='./index.php'" style="float:right">board</a>







<?php
    //echo $_SESSION['userid'];
    if(isset($_SESSION['userid'])) {
        //echo "hello";
        $id=$_SESSION['userid']
        ?> <!--세션이 세팅되어져 있다면 -->
        <a onclick="location.href='./logout_action.php'" style="float:right">Logout</a>
        <a href="shoppinglist.php"style="float:right">Cart</a>
<!--        <a href="node?id=<?php /*echo $_SESSION['userid']*/?>" style="float:right">Chatting</a>-->

        <a href="javascript:void(0);" style="float:right" onclick="window.open('node','채팅','width=800,height=800,scrollbars=no')">Chatting</a>


        <a href="makeInvoice.php"style="float:right">Make Invoice</a>
<!--        <input name="newThread" type="button" value="채팅방 입장하기" onclick="window.open('node','채팅','width=800,height=800,scrollbars=no')"/>-->
        <?php
    }
    else {
        ?>              <a onclick="location.href='./login_test.php'" style="float:right">Login</a> <!--아닌 상태라면-->
    <?php   }
    ?>
</div>