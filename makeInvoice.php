<head>
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

</body>
<form method="post" action="/makeInvoice_acton.php" >
<!--    <form method="post" action="#" name="invoice">-->
    <div class="container">
        <h1>Make Invoice</h1>

        <hr>
        <h2>Seller</h2>

        <label for="email"><b>Company</b></label>
        <input type="text" placeholder="Enter Company" name="scompany">

        <label for="psw"><b>Address</b></label>
        <input type="text" placeholder="Enter Address" name="saddress" >

        <label for="psw"><b>City</b></label>
        <input type="text" placeholder="Enter Tel" name="scity">

        <label for="psw"><b>Tel</b></label>
        <input type="text" placeholder="Tel" name="stel">

        <label for="psw"><b>Email</b></label>
        <input type="text" placeholder="Enter Email" name="semail">

        <hr>
        <h2>Consignee</h2>

        <label for="email"><b>Company</b></label>
        <input type="text" placeholder="Enter Company" name="ccompany">

        <label for="psw"><b>Address</b></label>
        <input type="text" placeholder="Enter Address" name="caddress">

        <label for="psw"><b>City</b></label>
        <input type="text" placeholder="Enter Tel" name="ccity">

        <label for="psw"><b>Tel</b></label>
        <input type="text" placeholder="Tel" name="ctel">

        <label for="psw"><b>Email</b></label>
        <input type="text" placeholder="Enter Email" name="cemail">

        <hr>
        <h2>Invoice NO & DATE</h2>

        <label for="email"><b>NO</b></label>
        <input type="text" placeholder="Invoice No" name="invoiceno">

        <label for="psw"><b>Date</b></label>
        <input type="text" placeholder="Date" name="invoicddate">

        <hr>
        <h2>LC NO & DATE</h2>

        <label for="email"><b>NO</b></label>
        <input type="text" placeholder="LC No" name="lcno">

        <label for="psw"><b>Date</b></label>
        <input type="text" placeholder="Date" name="lcdate">


        <hr>
        <h2>Other References</h2>
        <label for="email"><b>Container Number</b></label>
        <input type="text" placeholder="ContainerNo" name="containerno">

        <label for="psw"><b>Seal Number</b></label>
        <input type="text" placeholder="SealNumber" name="sealno">

        <label for="psw"><b>TIN Number</b></label>
        <input type="text" placeholder="Date" name="tinno">


        <hr>
        <h2>Terms of delivery and payment</h2>

        <input type="text" placeholder="" name="TOD">

        <hr>
        <h2>Transport</h2>
        <label for="email"><b>Departure Date</b></label>
        <input type="text" placeholder="ddate" name="ddate">
        <label for="email"><b>Vessel/Flight</b></label>
        <input type="text" placeholder="VF" name="VF">
        <label for="email"><b>Port of Loading</b></label>
        <input type="text" placeholder="pol" name="pol">
        <label for="email"><b>Port of Discharge</b></label>
        <input type="text" placeholder="pod" name="pod">


        <hr>
        <h2>Product Table</h2>
        <button id='btn-add-row' type="button">Add row</button>
        <button id='btn-delete-row' type="button">Delete row</button>
        <table id="mytable" border="0" cellspacing="2">
            <tr>
                <th><input type="text" name="array1[]" placeholder="head" style="background-color: #aaaaaa"></th>
                <th><input type="text" name="array2[]" placeholder="head" style="background-color: #aaaaaa"></th>
                <th><input type="text" name="array3[]" placeholder="head" style="background-color: #aaaaaa"></th>
                <th><input type="text" name="array4[]" placeholder="head" style="background-color: #aaaaaa"></th>
            </tr>
        </table>


        <button type="submit" class="registerbtn">Make Invoice</button>
    </div>
</form>
<body>


<script src="//code.jquery.com/jquery.min.js"></script>
<script>
    $('#btn-add-row').click(function() {
        var time = new Date().toLocaleTimeString();
        $('#mytable > tbody:last').append('<tr><td><input type="text" name="array1[]"></td><td><input type="text" name="array2[]"></td><td><input type="text" name="array3[]"></td><td><input type="text" name="array4[]"></td></tr>');
    });
    $('#btn-delete-row').click(function() {
        $('#mytable > tbody:last > tr:last').remove();
    });
</script>

