<?php
$db_conn = @mysqli_connect("localhost", "root", "", "test");

if (!$db_conn) {
    $error = mysqli_connect_error();
    $errno = mysqli_connect_errno();
    print "$errno: $error\n";
    exit();
}
print "DB TEST OK";
mysqli_close($db_conn);
?>

