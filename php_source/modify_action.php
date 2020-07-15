<?php
$connect = mysqli_connect('localhost', 'root', 'password', 'WEBService') or die ("connect fail");
$number = $_POST[number];
echo "<br>".$number;
$title = $_POST[title];
echo "<br>".$title;
$content = $_POST[content];
echo "<br>".$content;
$date = date('Y-m-d H:i:s');
$query = "update board set title='$title', content='$content', date='$date' where number=$number";
$result = $connect->query($query);
if($result) {
    ?>
    <script>
        alert("modify confirm");
        location.replace("./view.php?number=<?=$number?>");
    </script>
<?php    }
else {
    echo "fail";
}
?>