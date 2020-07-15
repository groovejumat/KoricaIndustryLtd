<html>
<body>
<?php
if($_POST['chk_info']=="FOB"){
    $PriceCondition="[Free On Board]\n";
}
else if($_POST['chk_info']=="CNF"){
    $PriceCondition="[Cost & Freight]\n";
}
else if($_POST['chk_info']=="CIF"){
    $PriceCondition="[Cost Insurance Freight]\n";
}

?>
</body>
</html>

<?php
session_start();
//세션에서 받은 쇼핑카트 품목을 메일로 보내면 조회가 가능하다.
$firstline = $_SESSION['userid']."'s Order List";

$list.=$PriceCondition;

foreach($_SESSION["shopping_cart"] as $keys => $values) // 각각의 배열요소들을 모두 참조
{
//item id 값에 따라 품목 종류를 설정 해줌.
    $itemname=$values["item_itemid"];
    if($itemname>10 and $itemname<20 ){
        $itemname="Car";
    }

    else if($itemname>20 and $itemname<30 ){
        $itemname="Engine";
    }

    else{
        $itemname="AutoParts";
    }
     $list.="Item : ".$values["item_name"]."\t\t\t";
     $list.="Quantity : ".$values["item_quantity"]."\t\t\t";
     $list.="Description :" .$itemname."\n";
}
$list.="Please Check This.";

/*echo $list;//foreach 끝*/

$to = "braum6138@gmail.com";
$subject = "$firstline";
$message = "$firstline\n$list";
/*$headers = array(
    'From' => 'KoricaIndustriLtd.',
    'Reply-To' => $_SESSION['userid']
);*/

mail($to, $subject, $list);

?>
<script>
    alert("Your List Sended Sucessfully.");
    location.replace("upload.php");
</script>