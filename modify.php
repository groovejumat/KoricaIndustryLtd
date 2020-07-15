<html>
<head>
    <!--메인페이지에 대한 스타일 리스트-->
    <link rel= "stylesheet" type="text/css" href="./css/MainStyle.css"> <!--CSS파일변경이 반영되도록 설정하기-->
</head>
<body>
<?php include("MainHead.php"); ?>

<?php
$connect = mysqli_connect('localhost', 'root', 'password', 'WEBService') or die ("connect fail");
$id = $_GET[id];

$number = $_GET[number];

$query = "select title, content, date, id from board where number=$number"; //이거사용//
$result = $connect->query($query);
$rows = mysqli_fetch_assoc($result);

$title = $rows['title'];
$content = $rows['content'];
$usrid = $rows['id'];
?>

<?php
session_start();


$URL = "./modify.php";

/*해당 글의 작성자가 맞는지에 대한 세션의 상태를 비교*/
if(!isset($_SESSION['userid'])) {
    ?>              <script>
        alert("You dont have permission");
        history.back();
    </script>
<?php   }

//세션에 대한 권한이 있을 대에 대한 처리//
else if($_SESSION['userid']==$usrid) {
?>

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
<div class="card">
<form method = "post" action = "modify_action.php" id="nameform">
    <table  style="padding-top:50px" align = center width=700 border=0 cellpadding=2 >
        <tr>
            <td height=50 align= center bgcolor=#ccc><span style="color: white; ">modify</span></td>
        </tr>
        <tr>
            <td bgcolor=white>
                <table class = "table2">
                    <tr>
                        <td>writer</td>
                        <td><input type="hidden" name="id" value="<?=$_SESSION['userid']?>"><?=$_SESSION['userid']?></td>
                        <input type="hidden" name="number" value="<?=$number?>">
                    </tr>

                    <tr>
                        <td>title</td>
                        <td><input type = text name = title size=60 value="<?=$title?>"></td>
                    </tr>

                    <tr>
                        <td>contents</td>
                        <td><textarea name = content cols=85 rows=15><?=$content?></textarea></td>
                    </tr>

                </table>

                <div class="view_btn">
                    <button class="view_btn1" type="submit" form="nameform" value="Submit">Submit</button>
                </div>
            </td>
        </tr>
    </table>
</form>
</div>
    <?php   }
//권한이 없을 때//
    else {
        ?>              <script>
            alert("You dont have permission");
            history.back();
        </script>
    <?php   }
    ?>
</body>
</html>