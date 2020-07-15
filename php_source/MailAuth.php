<head>
    <!--메인페이지에 대한 스타일 리스트-->
    <!--    <link rel= "stylesheet" type="text/css" href="../css/common.css">-->
    <!--    <link rel= "stylesheet" type="text/css" href="./css/MainStyle.css">-->
</head>

<?php
//해당 메일 값을 받아 오는 처리를 합니다.
$email = $_GET['email'];
/*echo $email;*/
$connect = mysqli_connect('localhost', 'root', 'password', 'WEBService') or die("fail connect");
$query = "update account set verify='y' where email='$email'";

$connect->query($query);
?>

<style>
    /*[[[[register form style]]]]*/

    body {
        font-family: Arial, Helvetica, sans-serif;
        /*        background-color: black;*/
    }

    * {
        box-sizing: border-box;
    }

    /* Add padding to containers */

    .container {
        padding: 16px;
        background-color: white;
        width: 50%;
        margin-right: auto;
        margin-left: auto;
    }

    /* Full-width input fields */
    input[type=text], input[type=password] {
        width: 100%;
        padding: 15px;
        margin: 5px 0 0 0;
        /*margin: 5px 0 22px 0;*/
        display: inline-block;
        border: none;
        background: #f1f1f1;
    }

    input[type=text]:focus, input[type=password]:focus {
        background-color: #ddd;
        outline: none;
    }

    /* Overwrite default styles of hr */
    hr {
        border: 1px solid #f1f1f1;
        margin-bottom: 25px;
    }

    /* Set a style for the submit button */
    .registerbtn {
        background-color: #000000;
        color: white;
        padding: 16px 20px;
        margin: 8px 0;
        border: none;
        cursor: pointer;
        width: 100%;
        opacity: 0.9;
    }

    .registerbtn:hover {
        opacity: 1;
    }

    /*!* Add a blue text color to links *!
    a {
        color: dodgerblue;
    }*/

    /* Set a grey background color and center the text of the "sign in" section */
    .signin {
        background-color: #f1f1f1;
        text-align: center;
    }
</style>

</body>
<form method="post" action="/login_action_test.php" >
    <div class="container">
        <h1>Registration Finished Sucessfully.</h1>

        <hr>

        <label for="email"><b>Email</b></label>
        <input type="text" placeholder="Enter Email" name="id" required>

        <label for="psw"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="pw" required>



        <hr>
        <label for="psw" ><b style="margin-bottom: 10px">AutoLogin</b></label>

        <input type="checkbox" name="autologin" style="width:18px;height:18px;margin: 0px" value="1">

        <button type="submit" class="registerbtn">Login</button>
    </div>

</form>
<body>