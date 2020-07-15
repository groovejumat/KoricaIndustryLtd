<head>
    <?php
    session_start();
    echo $_SESSION['agree'];
    ?>
    <!--메인페이지에 대한 스타일 리스트-->
    <!--    <link rel= "stylesheet" type="text/css" href="../css/common.css">-->
<!--    <link rel= "stylesheet" type="text/css" href="./css/MainStyle.css">-->
</head>

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

<form method="post" action="/join_action2.php" >
    <div class="container">
        <h1>Register</h1>
        <p>Please fill in this form to create an account.</p>
        <hr>

        <label for="email"><b>Email</b></label>
        <input type="text" placeholder="Enter Email" name="email" required>

        <label for="psw"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="pw" required>

        <label for="psw-repeat"><b>Repeat Password</b></label>
        <input type="password" placeholder="Repeat Password" name="repw" required>

        <label for="Tel"><b>Tel</b></label>
        <input type="text" placeholder="Enter Tel" name="tel" required>

        <label for=""><b>Company or Nick</b></label>
        <input type="text" placeholder="Company or NickName" name="company" required>

        <label for="Address"><b>Address</b></label>
        <input type="text" placeholder="Enter Address" name="address" required>

        <hr>
        <p>By creating an account you agree to our <a href="javascript:void(0);" onclick="window.open('termprivacy.php','채팅','width=800,height=800,scrollbars=no')">Terms & Privacy</a>.</p>

<!--        <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>-->

        <button type="submit" class="registerbtn">Register</button>
    </div>

    <div class="container signin">
        <p>Already have an account? <a href="#">Sign in</a>.</p>
    </div>
</form>