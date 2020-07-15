<?php
$conn = mysqli_connect('localhost', 'root', 'password', 'WEBService') or die ("connect fail"); //DB연결
//반아온 id 값과 같은 데이터를 삭제 처리
$item_id=$_POST['hidden_id'];
$item_filename=$_POST['hidden_filename'];
$item_filename2=$_POST['hidden_filename2'];
$item_filename3=$_POST['hidden_filename3'];

//echo '<br>'.$item_id;
//echo '<br>'.$item_filename;

$target_dir = "./productimage/";
$target_file = $target_dir . $item_filename;
$target_file2 = $target_dir . $item_filename2;
$target_file3 = $target_dir . $item_filename3;

//echo '<br>'.$target_file;

if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
}

/*unlink($target_file);
if( !unlink($target_file) ) {
    echo "failed\n";
}
else {
    echo "success\n";
}

unlink($target_file2);
if( !unlink($target_file2) ) {
    echo "failed\n";
}
else {
    echo "success\n";
}

unlink($target_file3);
if( !unlink($target_file3) ) {
    echo "failed\n";
}
else {
    echo "success\n";
}*/

$query = "DELETE FROM product where id='$item_id'";

$result = mysqli_query($conn, $query);

echo '<script>alert("Item Deleted.")</script>';
echo '<script>history.back()</script>';

?>