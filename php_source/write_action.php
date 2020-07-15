<?php
$connect = mysqli_connect("localhost", "root", "password", "WEBService") or die("fail"); /*해당 mysqli를 통해서 WEBService라는 데이터베이스를 이용합니다*/

/*GET방식을 통해서 받아오는 정보들을 저장하기*/
$id = $_POST[name];                      //Writer
$pw = $_POST[pw];                        //Password
$title = $_POST[title];                  //Title
$content = $_POST[content];              //Content
$date = date('Y-m-d H:i:s');            //Date


$URL = './index.php';                   //return URL

$query =


$query = "insert into board (number,title, content, date, hit, id, password) 
                        values(null,'$title', '$content', '$date',0, '$id', '$pw')"; /*"board"라는 테이블에 데이터를 저장하기*/


$result = $connect->query($query);
if($result){
    ?>                  <script> /*스크립트가 사용시에는 php구문이 닫여야 한다.*/
        alert("<?php echo "Post uploaded successfully."?>");
        location.replace("<?php echo $URL?>");
    </script>
    <?php
}
else{
    echo '<br>'."$id";
    echo '<br>'."$pw";
    echo '<br>'."$title";
    echo '<br>'."FAIL";
}

mysqli_close($connect);
?>
