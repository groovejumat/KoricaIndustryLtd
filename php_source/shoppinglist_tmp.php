<html>
<head>
    <!--메인페이지에 대한 스타일 리스트-->
    <!--    <link rel= "stylesheet" type="text/css" href="../css/common.css">-->
    <link rel= "stylesheet" type="text/css" href="../css/MainStyle.css">
</head>
<style>
    table{
        border-top: 1.5px solid #000000;
        border-collapse: collapse;
    }
    tr{
        border-bottom: 1.4px solid #000000;
        padding: 10px;

    }
    td{
        border-bottom: 1px solid #efefef;
        padding: 10px;

    }
</style>
<body>

<?php include("./MainHead.php"); ?>

</body>
</html>

<?php

//세션 실행 현재 아이디 + 쇼핑카트 정보 보관 중//
session_start();
$connect = mysqli_connect("localhost","root","password","WEBService"); //디비 연결//

//세션의 아이디 값을 가진 Mylist칼럼들만 추출 해서, 배열에 담는다
//1.참조할 id값 담아놓기
$email=$_SESSION['userid'];


if(!isset($_SESSION["shopping_cart"])){

    //2.db쿼리 요청 (세션의 이메일 값과 같은 컬럼만을 추출 하도록)
    $query="SELECT * FROM Mylist where email='$email'";
    //3.쿼리실행
    $result = $connect->query($query);
    //4. 불러온 값을 조회.
    /*$data = mysqli_fetch_array($result);*/
    /*echo '<br>'.var_dump($data['productname']);
    echo '<br>'.mysqli_num_rows($result);*/

    $queryfordelete="DELETE FROM Mylist where email='$email'";
    //불러온 정보들은 삭제//
    $connect->query($queryfordelete);

    //5. 세션 배열값을 디비를 참조하여 생성하기 이건 처음 한번만 실행 되어져야한다.
    $i = 0;
    while ($data = mysqli_fetch_array($result)) {
        echo '<br>' . $email;
        echo '<br>' . $data['productname'];
        $item_array = array(
            'item_id' => $data['id'],
            'item_name' => $data['productname'],
            'item_price' => 77,
            'item_quantity' => $data["quantity"],
            'item_itemid' => $data["itemid"]
        );
        $_SESSION["shopping_cart"][$i] = $item_array;
        $i++;
        echo '<br>' . $i;
    }
}


//로그인 세션 점검 (로그인 상태에 있어야지만 장바구니 기능을 사용 할 수 있으니까.)
$URL = "./login_test.php";
if(!isset($_SESSION['userid'])) {
    ?>
    <script>
        alert("you need to login");
        location.replace("<?php echo $URL?>");
    </script>
    <?php
}



//name 속성이 add_to_cart 인 form태그에 submit 버튼을 눌렀을때
if(isset($_POST["add_to_cart"])) //add to cart 값이 세팅이 되어졌을 때//
{

    //쇼핑카트 세션 배열이 존재한다면
    if(isset($_SESSION["shopping_cart"]))
    {

        //참고:https://www.w3schools.com/php/func_array_column.asp
        //값이 배열로 이루어진 배열에서 key 값이 item_id인 값을 찾아서 배열로 리턴
        $item_array_id = array_column($_SESSION["shopping_cart"],"item_name"); //item id 값에 대한 array 정보들//


        /*        echo "<br>".array_search($_GET["id"],$item_array_id);*/
        $renew=array_search($_GET["id"],$item_array_id); // 같은 아이디값이 있으면 해당 위치의 세션 배열 정보를 바꾸어 준다. ex) 3위치에 넣은 아이템이 같은 종류가 있는 경우에는,

        //특정한 값 뽑아 오기

        //클릭한 상품의 id가 $item_array_id 배열에 존재 하지 않으면
        if(!in_array($_POST["hidden_name"], $item_array_id))
        {
            //shopping_cart 세션 배열에 들어있는 배열의 수
            $count =  count($_SESSION["shopping_cart"]);

            echo "<br>카운트 값은".$count;

            //클릭한 상품의 데이터를 배열에 넣는다.
            $item_array = array(
                'item_id' => $_GET["id"],
                'item_name' => $_POST["hidden_name"],
                'item_price' => $_POST["hidden_price"],
                'item_quantity' => $_POST["quantity"],
                'item_itemid' => $_POST["hidden_itemid"]
            );

            //shopping_cart 세션 배열에서 그 다음 방부터 차례로 넣는다.
            $_SESSION["shopping_cart"][$count] = $item_array; //해당 값에 그냥 추가 시키면된다.

            ?>
            <!--            <script>
                            alert("add confirm");
                            history.back();
                        </script>-->
            <?php

        }else //선택한 제품이 배열에 존재하는 경우에는 수량을 늘린다.
        {

            echo '<script>alert("This item already exist.")</script>';
            echo '<script>history.back()</script>';

        }


        //쇼핑카트 세션 배열이 존재하지 않는다면(즉, 제일 처음 카트 버튼을 눌렀을 때)
    }else
    {
        $item_array = array(
            'item_id' => $_GET["id"],
            'item_name' => $_POST["hidden_name"],
            'item_price' => $_POST["hidden_price"],
            'item_quantity' => 1,
            'item_itemid' => $_POST["hidden_itemid"]
            /*            'item_quantity' => $_POST["quantity"]*/

        );

        //key 값이 shopping_cart 인 배열 0번 방에 상품 배열을 넣었다.
        $_SESSION["shopping_cart"][0] = $item_array;

        ?>
        <!--        <script>
                    alert("add confirm");
                    history.back();
                </script>-->
        <?php

        //echo var_dump($_SESSION["shopping_cart"]);
        //array(1) { [0]=> array(4) { ["item_id"]=> string(1) "1" ["item_name"]=> string(14) "Samsung J2 Pro" ["item_price"]=> string(6) "100.00" ["item_quantity"]=> string(1) "1" } }

        //echo var_dump($_SESSION["shopping_cart"][0]);
        //array(4) { ["item_id"]=> string(1) "1" ["item_name"]=> string(14) "Samsung J2 Pro" ["item_price"]=> string(6) "100.00" ["item_quantity"]=> string(1) "1" }
    }

}


if(isset($_GET["action"]))
{
    if($_GET["action"]=="delete")
    {
        //shopping_cart 세션 배열에 존재하는 배열들을 $values 에 넣는다.
        foreach($_SESSION["shopping_cart"] as $keys => $values)
        {
            //배열의 item_id 값이 클릭한 id 값과 같으면
            if($values["item_name"] == $_GET["id"])
            {
                //세션에서 제거한다.
                unset($_SESSION["shopping_cart"][$keys]);
                echo '<script>alert("List deledted.")</script>';
                echo '<script>window.location="shoppinglist.php"</script>';
            }
        }
    }
}
?>

<!DOCTYPE html>

<html>
<head>
    <title>php session을 이용한 장바구니</title>
    <!--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>-->
    <!--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />-->
    <!--    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>-->
</head>

<body>

<div class="card">
    <h2 align=center>Added List<?php echo $count?></h2>
    <h4 align=center>Choose Your Price Condition</h4>
    <h4>
        <div align="center">
            <form action="/sendmail.php" method="POST" id="chk_info">
                <input type="radio" name="chk_info" value="FOB">FOB
                <input type="radio" name="chk_info" value="CNF">CNF
                <input type="radio" name="chk_info" value="CIF">CIF
            </form>
        </div>
    </h4>
    <table align = center>

        <thead align = "center">
        <tr>

            <td width = "200" align="left" style="font-weight: bold">Item</td>
            <td width = "200" align = "center" style="font-weight: bold">RequiredQuantity</td>
            <td width = "200" align = "center" style="font-weight: bold">Description</td>
            <td width = "100" align = "center" style="font-weight: bold"><?php echo $count?></td>
        </tr>
        </thead>

        <!--페이징 용도를 쓰기 위한 tbody 생성.-->
        <tbody>
        <?php
        //쇼핑카트에 물건이 존재하면!
        if(!empty($_SESSION["shopping_cart"]))
        {
            $total = 0;
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
                ?>

                <tr>
                    <td><?php echo $values["item_name"]; ?></td>
                    <td align="center"><input type="number" value="<?php echo $values["item_quantity"]; ?>" min="1"></td>
                    <!--                        <td><?php /*echo $values["item_price"]; */?></td>-->
                    <!--                        <td><?php /*echo number_format($values["item_quantity"] * $values["item_price"],2);*/?></td>-->
                    <!--                    <td align="center"><?php /*echo $values["item_itemid"]; */?></td>-->
                    <td align="center"><?php echo $itemname; ?></td>
                    <td><a href="shoppinglist.php?action=delete&id=<?php echo $values["item_name"]?>"> <button>remove</button> </a></td>
                    <!--세션 종료시에 디비 등록 작업을 처리할 수 있도록 한다.-->
                </tr>

                <?php
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
        ?>
        </tbody>
    </table>
    <div class="paging">
        <?php echo $paging ?>
    </div>



    <div class = text>
        <div class="view_btn">
            <button class="view_btn1" type="submit" form="chk_info" style="width: fit-content">Send Your List</button>
        </div>
    </div>



</div class>
</body>

</html>
