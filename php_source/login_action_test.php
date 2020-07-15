<?php

session_start();


$connect = mysqli_connect("localhost", "root", "password", "WEBService") or die("fail");

        //입력 받은 id와 password
        $id=$_POST['id'];

        $pw=$_POST['pw'];

        $nick=$_POST['pw'];

        $autolog=$_POST['autologin'];

        //쿠키저장하기
        if($autolog==1){
            //저장한 쿠키값 불러오기
            $password = 'password';

            // 256 bit 키를 만들기 위해서 비밀번호를 해시해서 첫 32바이트를 사용합니다.
            $password = substr(hash('sha256', $password, true), 0, 32);
            //echo "비밀번호 바이너리:" . $password . "<br/>";

            // Initial Vector(IV)는 128 bit(16 byte)입니다.
            $iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);

            // 암호화
            $encryptedid = base64_encode(openssl_encrypt($id, 'aes-256-cbc', $password, OPENSSL_RAW_DATA, $iv));

            // 암호화 된 해당 내용을 쿠키에 저장시킨다
            setcookie('cookieid', $encryptedid, time() + 86400);

            // 암호화
            $encryptedpass = base64_encode(openssl_encrypt($pw, 'aes-256-cbc', $password, OPENSSL_RAW_DATA, $iv));

            // 암호화 된 해당 내용을 쿠키에 저장시킨다
            setcookie('cookiepass', $encryptedpass, time() + 86400);
        }




        // 복호화
        $encryptedid=$_COOKIE['cookieid'];
        $decryptedid = openssl_decrypt(base64_decode($encryptedid), 'aes-256-cbc', $password, OPENSSL_RAW_DATA, $iv);

        $encryptedpass=$_COOKIE['cookiepass'];
        $decryptedpass = openssl_decrypt(base64_decode($encryptedpass), 'aes-256-cbc', $password, OPENSSL_RAW_DATA, $iv);

        //아이디가 있는지 검사(쿠키)
        $query = "select * from account where email='$decryptedid'";
        $resultcookie = $connect->query($query);


        //아이디가 있는지 검사(로그인)
        $query = "select * from account where email='$id'";
        $result = $connect->query($query);
        ?>


<?php        if(mysqli_num_rows($result)==1) {

    $row=mysqli_fetch_assoc($result);


    //해당 메일이 인증이 된 계정인이 안된계정인지에 대해서 확인하도록 함.
    if($row['verify']=="n"){
        ?>              <script>
            alert("This Account does not verified yet. ");
            history.back();
        </script>
        <?php
        exit;
    }



    //비밀번호가 맞다면 세션 생성
    if($row['pwd']==$pw){
        $_SESSION['userid']=$id;


        if(isset($_SESSION['userid'])){
            ?>      <script>
                //쿠키를 set get 하는 함수 (일 단위로 저장 시킨다)
                function setCookie(cookie_name, value, days) {
                    var exdate = new Date();
                    exdate.setDate(exdate.getDate() + days);
                    // 설정 일수만큼 현재시간에 만료값으로 지정

                    var cookie_value = escape(value) + ((days == null) ? '' : ';    expires=' + exdate.toUTCString());
                    document.cookie = cookie_name + '=' + cookie_value;
                }

                function getCookie(cookie_name) {
                    var x, y;
                    var val = document.cookie.split(';');

                    for (var i = 0; i < val.length; i++) {
                        x = val[i].substr(0, val[i].indexOf('='));
                        y = val[i].substr(val[i].indexOf('=') + 1);
                        x = x.replace(/^\s+|\s+$/g, ''); // 앞과 뒤의 공백 제거하기
                        if (x == cookie_name) {
                            return unescape(y); // unescape로 디코딩 후 값 리턴
                        }
                    }
                }

                //세션 저장해보기 (node js로 불러오는 것 실패)
                sessionStorage.setItem("userid","<?php echo $id?>");
                var sesseionid = sessionStorage.getItem("userid");
                console.log(sesseionid);
                console.log("hello this is test.");

                //쿠키 저장해보기.
                setCookie('myid', "<?php echo $id?>",1);
                console.log("저장되어진 쿠키의 값은 : " + getCookie('myid'));
                alert("Login Success.");



                location.replace("./upload.php?itemid=10");
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

}

else{
    ?>              <script>
        alert("Email address or password is incorrect.");
        history.back();
    </script>
    <?php
}


?>





        
<?php        if(mysqli_num_rows($result)==1) {

                $row=mysqli_fetch_assoc($result);

                //비밀번호가 맞다면 세션 생성
                if($row['pwd']==$pw){
                        $_SESSION['userid']=$id;


                        if(isset($_SESSION['userid'])){
                        ?>      <script>

                                        //세션 저장해보기 (node js로 불러오는 것 실패)
                                        sessionStorage.setItem("userid","<?php echo $id?>");
                                        var sesseionid = sessionStorage.getItem("userid");
                                        console.log(sesseionid);
                                        console.log("hello this is test.");

                                        //쿠키 저장해보기.

                                        alert("Login Success.");



                                        location.replace("./MainPage.php");
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

        }

                else{
?>              <script>
                        alert("Email address or password is incorrect.");
                        history.back();
                </script>
<?php
        }


?>

