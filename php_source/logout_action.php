<?php

session_start();

$connect = mysqli_connect("localhost","root","password","WEBService"); //요청 목록에 추가 할 내용 점검하기.


//쇼핑카트 세션이 존재하면 해당 세션에 대해서 db저장 작업 처리를 해준다. (중요작업)
            if(!empty($_SESSION["shopping_cart"]))
            {
                $total = 0;
                echo "<br>".$_SESSION['userid'];
                foreach($_SESSION["shopping_cart"] as $keys => $values) // 각각의 배열요소들을 모두 참조
                {
                    $item_name=$values["item_name"];
                    $item_quantity=$values["item_quantity"];
                    $item_price=$values["item_price"];
                    $item_itemid=$values["item_itemid"];
                    $email=$_SESSION['userid'];
                    ?>
                    <tr>
                        <td><?php echo $values["item_name"]; ?></td>
                        <td><?php echo $values["item_quantity"]; ?></td>
                        <td><?php echo $values["item_price"]; ?></td>
                        <td><?php echo $values["item_itemid"]; ?></td>


                        <!--세션 종료시에 디비 등록 작업을 처리할 수 있도록 한다.-->
                    </tr>

                    <?php
                    $query = "INSERT INTO `Mylist` (`id`, `productname`, `quantity`, `itemid`, `email`) VALUES (NULL, '$item_name', '$item_quantity','$item_itemid', '$email')"; //세션정보 데이터를 담는 쿼리문 요청
                    $result = $connect->query($query); //쿼리문 실행
                    $total = $total + ($values["item_quantity"] * $values["item_price"]);
                }   //foreach 끝
                ?>

<!--                <tr>
                    <td colspan="3" align="right">총금액</td>
                    <td align="right"><?php /*echo number_format($total,2);*/?> </td>
                    <td></td>
                </tr>-->

                <?php
            } //if문 끝

setcookie("cookieid", "", time() - 3600);
setcookie("cookiepass", "", time() - 3600);

$result = session_destroy();
if($result) {
    ?>
    <script>
        alert("Logout.");
        history.back();
    </script>
<?php   }
?>
