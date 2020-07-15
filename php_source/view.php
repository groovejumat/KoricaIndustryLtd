<html>
<head>
    <!--메인페이지에 대한 스타일 리스트-->
    <!--    <link rel= "stylesheet" type="text/css" href="../css/common.css">-->
    <link rel= "stylesheet" type="text/css" href="./css/MainStyle.css?ver7">

</head>
<body>

<?php include("./MainHead.php"); ?>

</body>
</html>

<?php
$connect = mysqli_connect('localhost', 'root', 'password', 'WEBService'); /*데이터 연결*/
$number = $_GET['number']; /*해당 넘버 값을 get방식으로 받아옴*/
session_start(); /*세션시작*/
$query = "select title, content, date, hit, id from board where number =$number"; /*GET으로 가지고 온 넘버 값과 같은 값에 대한 내용을 가지고 오기*/
$result = $connect->query($query);
$rows = mysqli_fetch_assoc($result);

//세션의 id 값과 정보가 다르다면
if($rows['id']!=$_SESSION['userid']) {
    $hit = "update board set hit=hit+1 where number=$number";
    $connect->query($hit);
}

?>


<div class="card">
    <table class="view_table" align=center>
        <tr>
            <td colspan="4" class="view_title"><?php echo $rows['title']?></td>
        </tr>
        <tr>
            <td class="view_id">writer</td>
            <td class="view_id2"><?php echo $rows['id']?></td>
            <td class="view_hit">viewcount</td>
            <td class="view_hit2"><?php echo $rows['hit']?></td>
        </tr>


        <tr>
            <td colspan="4" class="view_content" valign="top">
                <?php echo $rows['content']?></td>
        </tr>
    </table>

    <form name="input" method="post" action="delete_action.php" id="nameform">
        <input type="hidden" name="number" value="<?=$number?>">
        <input type="hidden" name="id" value="<?php echo $_SESSION['userid'];?>">
    </form>

    <!-- MODIFY & DELETE -->
    <div class="view_btn">
        <button class="view_btn1" onclick="location.href='./index.php'">list</button>
        <button class="view_btn1" onclick="location.href='./modify.php?number=<?=$number?>&id=<?=$_SESSION['userid']?>'">modify</button>
        <button class="view_btn1" type="submit" form="nameform" value="Submit">delete</button>
<!--        <button class="view_btn1" onclick="location.href='./delete_action.php?number=<?/*=$number*/?>&id=<?/*=$_SESSION['userid']*/?>'">delete</button>-->
        <button class="view_btn1" onclick="location.href='./comment.php?number=<?=$number?>&id=<?=$_SESSION['userid']?>'">comment</button> <!--코멘트를 작성하기 위한 페이지로 이동하기-->

        <!--post test-->


    </div>
</div>