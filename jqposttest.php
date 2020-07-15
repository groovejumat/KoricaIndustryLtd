<?php
//echo $_POST['array1'][0];
//echo $_POST['array1'][1];
//echo $_POST['array1'][2];
$array1=$_POST['array1'];
$array2=$_POST['array2'];
$array3=$_POST['array3'];

foreach($array1 as $key => $val){
    print $val;
}

foreach($array2 as $key => $val){
    print $val;
}

foreach($array3 as $key => $val){
    print $val;
}