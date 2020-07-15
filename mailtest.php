<?php
session_start();
$id = $_SESSION['userid'].".xls";
$to = "braum6138@gmail.com";
$subject = "OrderList";

$message = "
<html>
<head>
<title>OrderList Excel</title>
<a href='192.168.244.100/exceldoc/$id'>[엑셀 파일 다운로드]</a>
</head>
<body>
<p>Please Check This Order List.</p>
<table>
<tr>
<th>Firstname</th>
<th>Lastname</th>
</tr>
<tr>
<td>John</td>
<td>Doe</td>
</tr>
</table>
</body>
</html>
";

// Always set content-type when sending HTML email
//$headers = "MIME-Version: 1.0" . "\r\n";
//$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

$headers .= "Content-type: text/html; charset=us-ascii\n";
$headers .= "MIME-Version: 1.0\n";



// More headers
$headers .= 'From: <webmaster@example.com>' . "\r\n";
$headers .= 'Cc: myboss@example.com' . "\r\n";



mail($to,$subject,$message,$headers);

?>

<script>
    alert("Your List Sended Sucessfully.");
    location.replace("upload.php");
</script>
