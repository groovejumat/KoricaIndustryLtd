<style>
    table.table2{ /*"table2"형태의 옵션을 지정해서 사용하기*/
        border-collapse: separate;
        border-spacing: 1px;
        text-align: left;
        line-height: 1.5;
        border-top: 1px solid #ccc;
        margin : 20px 10px;
    }
    table.table2 tr { /*"table2" tr 스타일을 지정해서 사용하기*/
        width: 50px;
        padding: 10px;
        font-weight: bold;
        vertical-align: top;
        border-bottom: 1px solid #ccc;
    }
    table.table2 td { /*"table2" td의 스타일을 지정해서 사용하기*/
        width: 100px;
        padding: 10px;
        vertical-align: top;
        border-bottom: 1px solid #ccc;
    }
</style>

<!--해당 세선이 없다면 초기화면으로 되돌아갑니다.-->
<?php
session_start();
$URL = "./login_test.php";
if(!isset($_SESSION['userid'])) {
    ?>
    <script>
        alert("you need to login");
        location.replace("<?php echo $URL?>");
    </script>
    <?php
}
?>

<body>
<div class="card">
<form method = "get" action = "write_action.php"> <!--GET의 방식으로 write_action.php방식을 취해 준다.-->
    <table  style="padding-top:50px" align = center width=700 border=0 cellpadding=2 >
        <tr>
            <td  height=50 align= center bgcolor=#ccc><span style="color: white; ">Inquiry board</span></td>
        </tr>
        <tr>
            <td bgcolor=white>
                <table class = "table2">
                    <tr>
                        <td>writer</td>
                        <td><input type = hidden name = name  value='<?php echo $_SESSION['userid']?>' size=0><?php echo $_SESSION['userid']?></td>
                    </tr>

                    <tr>
                        <td>theme</td>
                        <td><input type = text name = title size=60></td>
                    </tr>

                    <tr>
                        <td>content</td>
                        <td><textarea name = content cols=85 rows=15></textarea></td>
                    </tr>

                    <tr>
                        <td>password</td>
                        <td><input type = password name = pw size=10 maxlength=10></td>
                    </tr>

                </table>

                <div style="text-align: center;"> <!--text align방식을 취해서 center 처리를 해준다.-->
                    <input type = "submit" value="submit"> <!--해당 폼을 제출하게 되면 write_action.php방식이 실행 된다.-->
                </div>
            </td>
        </tr>
    </table>
</form>
</div>
</body>
</html>
