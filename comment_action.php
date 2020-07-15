<?php
$connect = mysqli_connect('localhost', 'root', 'password', 'WEBService') or die ("connect fail");

//글작성 번호 및 아이디값을 받아오도록 하기 (매우 중요)//
$id = $_POST[id];
$number = $_POST[number];
$query = "select title, content, date, id from board where number=$number"; //이거사용//
$result = $connect->query($query);
$rows = mysqli_fetch_assoc($result);
$date = date('Y-m-d H:i:s');

$title = $rows['title'];
$content = $rows['content'];
$usrid = $rows['id'];
$ctitle = $_POST["title"];
$ccontent = $_POST["content"];

$id = $_POST[id];
$number = $_POST[number];
$whose = $number*10-1;

//코멘트 번호를 참고하기 위해서 만들어 주는 기능.
/*$query ="select * from board where ";
$result = $connect->query($query);
$total = mysqli_num_rows($result);*/





echo "<br>".$number;
echo "<br>".$ctitle;
echo "<br>".$ccontent;
echo "<br>".$date;
echo "<br>".$ccontent;
echo "<br>".$id;
echo "<br>".$pw;

$query = "insert into board (number,title, content, date, hit, id, password,depth,whose) 
                        values(NULL,'$ctitle', '$ccontent', '$date',0, '$id', '$pw',1,$number*10-1)"; /*"board"라는 테이블에 데이터를 저장하기*/

$result = $connect->query($query);

if($result){
    $URL = './index.php';
    ?>                  <script> /*스크립트가 사용시에는 php구문이 닫여야 한다.*/
        alert("<?php echo "Comment Successfully."?>");
        location.replace("<?php echo $URL?>");
    </script>
    <?php
}
else{
    echo '<br>'."FAIL";
}

mysqli_close($connect);

?>