<html>
<head>
    <!--메인페이지에 대한 스타일 리스트-->
    <!--    <link rel= "stylesheet" type="text/css" href="../css/common.css">-->
    <link rel= "stylesheet" type="text/css" href="./css/MainStyle.css">
</head>
<body>

<?php include("./MainHead.php"); ?>

</body>
</html>


<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="Generator" content="EditPlus®">
    <meta name="Author" content="">
    <meta name="Keywords" content="">
    <meta name="Description" content="">
    <title>Document</title>
<body>
<div class="wholecolumn">
    <div class="card">
        <!--클릭한 품목에 따라서 상품정보가 다르게 나올 수 있도록 만들어 놓기-->
        <?php
        session_start(); //세션 실행
        //계정 정보 실행하기 편집 모드 실행

        //세션 아이디 검사 --관리자 계정 일 경우--
        if($_SESSION['userid']=="groovejumat@naver.com"){
            $edit=True;
        }

        $get=$_GET["itemid"]; ##아이템 품목 번호를 참조합니다.
        if($get=="1"){
            $itemTitle="Used Car";
        }
        else if($get=="2"){
            $itemTitle="Used Engine";
        }
        else if($get==="3"){
            $itemTitle="Auto Parts";
        }
        ?>

        <h2 align="center"><?php echo "$itemTitle"; ?></h2>
        <hr>
        <div class="grid-container">
            <?php
            $get=$_GET["itemid"];
            $get=(int)$get;
            ?>

            <?php
            $conn = mysqli_connect('localhost', 'root', 'password', 'WEBService') or die ("connect fail");
            if(mysqli_connect_errno()){
                echo "연결실패! ".mysqli_connect_error();
            }
            else if($get==10){
                $query = "SELECT * FROM product where itemid between 10 and 20";
            }
            else if($get==20){
                $query = "SELECT * FROM product where itemid between 20 and 30";
            }
            else if($get==30){
                $query = "SELECT * FROM product where itemid between 30 and 40";
            }
            else if($get!=null) {
                $query = "SELECT * FROM product where itemid='$get'";
            }
            else {
                $query = "SELECT * FROM product order by itemid";
            }
            $result = mysqli_query($conn, $query);


            while($data = mysqli_fetch_array($result)){
                //품목에 따른 문자열 이름 부여하기//
                if($data['itemid']==11){
                    $itemtitle="Hyundai";
                }
                else if($data['itemid']==12){
                    $itemtitle="KIA";
                }
                else if($data['itemid']==13){
                    $itemtitle="Daewoo";
                }
                else if($data['itemid']==14){
                    $itemtitle="Honda";
                }
                else if($data['itemid']>20 and $data['itemid']<30) {
                    $itemtitle="Engine";
                }
                else{
                    $itemtitle="Autoparts";
                }

                ?>
                <div class="grid-item">
                    <div class="productcard">
                        <form action="itemview.php" method="post" enctype="multipart/form-data">
                            <!--쿼리를 통해서 해당 데이터에 있는 제품 정보 리스트들을 긁어 옵니다.-->
                            <input type="hidden" name="id" value="<?php echo $data['id'];?>">
                            <input type="hidden" name="productname" value="<?php echo $data['productname'];?>">
                            <input type="hidden" name="price" value="<?php echo $data['price'];?>">
                            <input type="hidden" name="quantity" value="<?php echo $data['quantity'];?>">
                            <input type="hidden" name="subimgurl1" value="<?php echo $data['subimgurl1'];?>">
                            <input type="hidden" name="subimgurl2" value="<?php echo $data['subimgurl2'];?>">
                            <button type="submit" name="imageurl" value="<?php echo $data['imgurl'];?>" style='background:none;border:none;padding:0'><img src='<?php echo $data['imgurl'];?>' width=230 height=230 alt="SomeAlternateText"></button>
                        </form>
                        <h1><?php echo $data["productname"] ?></h1>
                        <p class="price" style="font-weight: bold"><?php echo $itemtitle?></p>
                        <form method="post" action="/shoppinglist.php?action=add&id=<?php echo $data["id"]; ?>">
                            <input type="hidden" name="quantity" class="form-control" value="<?php echo 1 ?>" />
                            <input type="hidden" name="hidden_itemid" value="<?php echo $data["itemid"] ?>" />
                            <input type="hidden" name="hidden_name" value="<?php echo $data["productname"] ?>" />
                            <input type="hidden" name="hidden_price" value="<?php echo $data["price"] ?>" />
                            <p><button type="submit" name="add_to_cart">Add to List</button></p>
                        </form>
                        <form method="post" action="delete_item.php">
                            <input type="hidden" name="hidden_id" value="<?php echo $data["id"] ?>" />
                            <input type="hidden" name="hidden_filename" value="<?php echo $data["filename"] ?>" />
                            <input type="hidden" name="hidden_filename2" value="<?php echo $data["filename2"] ?>" />
                            <input type="hidden" name="hidden_filename3" value="<?php echo $data["filename3"] ?>" />
                            <?php //현재 관리자 계정일 경우에만 나타나 지도록 만들기.
                            if ($edit==True) {
                                ?>
                                <input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-success" value="삭제하기"/>
                                <?php
                            }?>
                        </form>

                    </div>
                </div>


                <!--            <p>'<?php /*echo $data['filename'];*/?>'</p>
        </div>-->


                <!--        <div class="jb-wrap">
            <img src='<?php /*echo $data['imgurl'];*/?>' width=200 height=200>
            <div class="jb-text">
                <p>'<?php /*echo $data['filename'];*/?>'</p>
            </div>
        </div>-->
                <!--        <img src='<?php /*echo $data['imgurl'];*/?>' width=200 height=200>-->
                <?php
            }
            mysqli_close($conn);
            ?>
        </div>
    </div>
</div>

<?php //현재 관리자 계정일 경우에만 나타나 지도록 만들기.
if ($edit==True) {
    ?>
    <input name="newThread" type="button" value="상품 추가하기" onclick="window.open('itemupload.php','상품등록하기','width=800,height=800,scrollbars=no')"/>


    <?php
}?>
</body>
</html>
