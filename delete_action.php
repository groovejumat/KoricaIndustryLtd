<?php
$connect = mysqli_connect('localhost', 'root', 'password', 'WEBService') or die ("connect fail");
/*$id = $_GET[id];
$number = $_GET[number];*/

$id = $_POST[id];
$number = $_POST[number];

$query = "select id from board where number=$number"; //이거사용//
$result = $connect->query($query);
$rows = mysqli_fetch_assoc($result);

//비교를 할 아이디 값을 조회//
$usrid = $rows['id'];
?>

<?php
$connect = mysqli_connect('localhost', 'root', 'password', 'WEBService') or die ("connect fail");
/*$number = $_GET[number];
$title = $_GET[title];*/

$number = $_POST[number];
$title = $_GET[title];


$content = $_GET[content];
$date = date('Y-m-d H:i:s');

//세션 실행//
session_start();

//세션 변수가 없을 때(로그아웃 상태 일 때)//
if(!isset($_SESSION['userid'])) {
    ?>              <script>
        alert("You dont have permission");
        history.back(); //화면뒤로 되돌아 감. (삭제에 대한 처리 실패.)
    </script>
<?php   }

//세션의 아이디 정보 값이 유저의 아이디 값과 같다면 삭제처리를 한다.
else if($_SESSION['userid']==$usrid){
    $query = "delete from board where number=$number OR whose=$number*10-1";

    $result = $connect->query($query);
    if($result) {
        ?>
        <script>
            alert("delete complete.");
            location.replace("./index.php");
        </script>
    <?php    }
    else {
        echo "<br>".$id;
        echo "<br>".$number;
        echo "fail";
    }
}

//권한이 없을 때//
else {
    ?>              <script>
    alert("You dont have permission");
    history.back();
</script>
<?php   }
?>