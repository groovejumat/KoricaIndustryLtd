<?php

$connect = mysqli_connect('localhost', 'root', 'password', 'WEBService') or die("fail connect");

$id=$_POST[email];
$pass=$_POST[pw];
$repass=$_POST[repw];
$tel=$_POST[tel];
$company=$_POST[company];
$address=$_POST[address];

//echo "<br>" . $_POST[email]; /*제품과 가격정보에 대한 조회를 확인해보기 위한 용도.*/
//echo "<br>" . $_POST[pw];
//echo "<br>" . $_POST[repw];
//echo "<br>" . $_POST[tel];
//echo "<br>" . $_POST[company];
//echo "<br>" . $_POST[address];

$date = date('Y-m-d H:i:s');

//약관동의 유무 체크하기.
if($_COOKIE['agree']==NULL){
    ?>

    <script>
        alert("Please Check Agree.");
        history.back();
    </script>

    <?php
    exit;
}

//값이 있으므로 해당 쿠키를 삭제 처리//
setcookie('agree', "", time() - 1000);

//echo "<br>" . $date;
//데이터 내에서 같은 아이디가 있는지에 대해서 조회하기
//아이디가 있는지 검사
$query = "select * from account where email='$id'";
$result = $connect->query($query);
    if(mysqli_num_rows($result)==1) {
        ?>

        <script>
        alert("this email already exists!!");
        history.back();
        </script>

        <?php
    }


//입력한 폼에서 비밀번호가 같은지 안 같은지에 대한 처리하기
    else if($pass!=$repass){
        ?>

        <script>
        alert("password and repassword were not same.");
        history.back();
        </script>

        <?php
    }




//입력받은 데이터를 멤버 테이블에 저장
/*$query = "insert into member (id, pw, email, date, permit) values ('$id', '$pw', '$email', '$date', 0)";*/
else {
    $query = "INSERT INTO `account` (`memberSeq`, `email`, `pwd`, `tel`, `company`, `addr`, `date`) VALUES (NULL,'$id', '$pass', '$tel', '$company', '$address', '$date')";
    /*$query = "INSERT INTO `account` (`memberSeq`, `email`, `pwd`, `tel`, `company`, `addr`, `date`) VALUES (NULL, 'fsdfwe', 'fsdf', 'sdffwefsf', 'sdfasdf', 'sadfsadfsadf', '2019-12-04 00:00:00')";*/

//현재 날린 쿼리에 대해서 정보를 조회
    $result = $connect->query($query);

//저장이 됬다면 (result = true) 가입 완료
    if ($result) {
        ?>
        <script>
            alert('Registration complete.');
            location.replace("./authmailsend.php");
            <?php
            session_start();

            $to = $id;
            $subject = "KoricaIndustryLtd : Registered Email Verify";
            $message = "
            <html>
            <head>
            <title>Please Verify this email.</title>
            <p>Thank you for creating your KoricaIndustry Account.</p>
            <p>To complete your registration, click the link below</p>
                        <a href=https://korica.coo.kr/MailAuth.php?email=$id>[Comfirm My Account]</a>

         

            </head>
            <body>
<!--            <p>Email Test</p>-->
            <table>
            <tr>
            <th></th>
            <th></th>
            </tr>
            <tr>
            <td></td>
            <td></td>
            </tr>
            </table>
            </body>
            </html>
            ";

            // Always set content-type when sending HTML email
            //$headers = "MIME-Version: 1.0" . "\r\n";
            //$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

            $headers .= "Content-type: text/html; charset=us-ascii\n";
            $headers .= "MIME-Version: 1.0\n";



            // More headers
            $headers .= 'From: <webmaster@example.com>' . "\r\n";




            mail($to,$subject,$message,$headers);

            ?>
        </script>

    <?php } else {
        ?>
        <script>
            alert("fail");
        </script>
    <?php }

    mysqli_close($connect);
}
?>

