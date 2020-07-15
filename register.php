<head>
    <!--메인페이지에 대한 스타일 리스트-->
    <!--    <link rel= "stylesheet" type="text/css" href="../css/common.css">-->
    <link rel= "stylesheet" type="text/css" href="./css/MainStyle.css">
</head>

<form action="/join_action2.php">
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
        <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>

        <button type="submit" class="registerbtn">Register</button>
    </div>

    <div class="container signin">
        <p>Already have an account? <a href="#">Sign in</a>.</p>
    </div>
</form>