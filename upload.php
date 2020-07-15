<html>
<head>
    <!--메인페이지에 대한 스타일 리스트-->
<!--    <link rel= "stylesheet" type="text/css" href="../css/common.css">-->
    <link rel= "stylesheet" type="text/css" href="./css/MainStyle.css">
</head>
<body>

<?php include("./MainHead.php"); ?>



</body>
<style>
    .paging li {display: inline-block; height: 20px; margin: 0 5px; padding: 0 5px; border: 1px solid #666; background: rgba(222, 200, 238, 0); line-height: 21px;}

    .paging li.current
    .paging li:hover {background: #666;}
    .paging li.current {background: #aaaaaa;}
    .paging li:hover a { color: #000000;}

</style>
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

<div class="row">
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
        <?php //현재 관리자 계정일 경우에만 나타나 지도록 만들기.
        if ($edit==True) {
            ?>
            <input name="newThread" type="button" value="상품 추가하기" onclick="window.open('itemupload.php','상품등록하기','width=800,height=800,scrollbars=no')"/>


            <?php
        }?>
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
                $query = "SELECT * FROM product where itemid between 10 and 20 order by id desc";
            }
            else if($get==20){
                $query = "SELECT * FROM product where itemid between 20 and 30 order by id desc";
            }
            else if($get==30){
                $query = "SELECT * FROM product where itemid between 30 and 40 order by id desc";
            }
            else if($get!=null) {
                $query = "SELECT * FROM product where itemid='$get'";
            }
            else {
                $query = "SELECT * FROM product order by itemid order by id desc";
            }
            $result = mysqli_query($conn, $query);

            //페이징 기능 적용 시키기//
            $total = mysqli_num_rows($result); //현재 총 라인 갯수 확인
            $rows = mysqli_num_rows($result); //현재 총 줄 수의 값 확인

            //페이징에 대한 공부하기//
            if(isset($_GET['page'])) {
                $page = $_GET['page']; //페이징 점버링 값이 setteing되어져 있으면 번호를 $page에 담는다.
            } else {
                $page = 1; //아니라면 1(디폴트페이지를 보여준다)
            }

            $onePage=4; //한 페이지에 보여줄 게시글의 수
            $allPage=ceil($total/$onePage);//전체 페이지의 수

            if($page<1 || ($allPage && $page) > $allPage) { //전체 페이지 수 && 페이지 번호 가 전체 페이지 수보다 클 경우?
                ?>
                <script>
                    alert("This Page is not exist.");
                    history.back();
                </script>
                <?php
                exit;
            }
            $oneSection=5; //한번에 보여 줄 총 페이지 수 [1] [2] [3] .... 이런거
            $currentSection= ceil($page/$oneSection); //현재 보여줘야 되는 구역체크 페이지 번호 가 13번이면, [10],[11],[12]... 이런식으로
            $allSection=ceil($allPage/$oneSection); // 전체 섹션의 수

            $CurrentSectionfirstPage=($currentSection*$oneSection)-($oneSection-1); //현재 섹션의 번호*보여줄 섹션의 범위(현재는5) - 현재 섹션의 번호-1 //현재 색션의 처음페이지에 대한 정보.

            if($currentSection==$allSection){ //현재의 섹션이 마지막 섹션 상태라면
                $lastPage=$allPage; //$allPage(전체페이지의수)가 마지막 페이지가 되어진다.
            }
            else{
                $lastPage=$currentSection*$oneSection;//해당 섹션의 마지막 페이지
            }

            $prevPage = (($currentSection - 1) * $oneSection); //이전 섹션, [6]...[10] 상태 일 때에,  [1]...[5]를 보여주도록 하는 역할.
            $nextPage = (($currentSection + 1) * $oneSection); //다음 섹션으로 이동하기

            $paging = '<ul>'; // 페이징을 저장할 변수?????

            /*echo "<br>달러페이지 : ".$page;*/
            //첫 페이지가 아닌 상황이라면??
            if($page != 1){ //처음 버튼을 생성 해주어야 한다//
                //$paging .= '<li class="page page_start"><a href="./upload.php?page=1&itemid='.$get.'">first</a></li>';
            }
            //첫 섹션이 아니라면 이전 버튼을 생성
            if($currentSection!=1){
                $paging .= '<li class="page"><a href="./upload.php?page='.$prevPage.'&itemid='.$get.'"><</a></li>';
            }

            //해당 섹션을 표시하고, 해당 섹션에 따라서 맞는 페이지를 보여주고, 현재페이지 번호에 표시를 해준다//
            for($i=$CurrentSectionfirstPage; $i<=$lastPage;$i++){
                //마지막 페이지가 1만 있을 경우에는 보이지 않기
                if($lastPage==1){

                }

                else{

                    if($i==$page){
                        $paging.='<li class="page current" style="background: gainsboro">'.$i.'</li>';
                    }else{
                        $paging.='<li class="page" style="text-decoration: none"><a href="./upload.php?page='.$i.'&itemid='.$get.'" style="color:black;text-decoration:none">'.$i.'</a></li>';
                    }

                }
            }

            //현재 서있는 섹션이 마지막 섹션이 아니라면, 다음 버튼을 생성
            if($currentSection!=$allSection){ //현재있는 섹션의 값과 전체 색션의 값을 비교하여 판단
                $paging.='<li class="page page_next"><a href="./upload.php?page='.$nextPage.'&itemid='.$get.'">></a></li>';
            }

            //마지막 페이지가 아니라면 끝 버튼을 생성
            if($page != $allPage) {
                //$paging .= '<li class="page page_end"><a href="./upload.php?page=' . $allPage . '&itemid='.$get.'">last</a></li>';
            } //끝 버튼이 필요할지는 고민하기.....

            $paging .= '</ul>';

            /*페이징 처리가 끝났다*/
            /*echo "<br>".$onePage;
            echo "<br>".$page;*/
            $currentLimit=($onePage*$page)-$onePage;//몇번째에 있는 글부터 가져오는지
            $sqlLimit='limit '.$currentLimit.','.$onePage;//limit sql구문???
            //echo "<br>".$sqlLimit;

            //해당 부분 쿼리에서 문제가 발생한다. phpmyadmin에서 테스트 해보기.
            if(mysqli_connect_errno()){
                echo "연결실패! ".mysqli_connect_error();
            }
            else if($get==10){
                $sql2 = 'SELECT * FROM product where itemid between 10 and 20 order by id desc '.$sqlLimit;
            }
            else if($get==20){
                $sql2 = 'SELECT * FROM product where itemid between 20 and 30 order by id desc '.$sqlLimit;
            }
            else if($get==30){
                $sql2 = 'SELECT * FROM product where itemid between 30 and 40 order by id desc '.$sqlLimit;
            }
            else if($get!=null) {
                $sql2 = 'SELECT * FROM product where itemid='.$get .' order by id desc '.$sqlLimit ; //해당 쿼리가 안터지고 있는 상태이다.
            }
            else {
                $sql2 = 'SELECT * FROM product order by id desc '.$sqlLimit;
            }

            //$sql2='select * from product where order by whose desc '.$sqlLimit;//원하는 개수만큼 가지고 오기.
            /*echo "<br>".$sql2;*/
            /*$sql2= 'select * from board order by whose desc limit 0,5';*/
            $pagingresult=$connect->query($sql2);
            $rowstest = mysqli_num_rows($pagingresult);
            /*echo "<br>".$rowstest;*/


            while($data = mysqli_fetch_array($pagingresult)){
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
                        <form action="itemview.php" method="get" enctype="multipart/form-data">
                            <!--쿼리를 통해서 해당 데이터에 있는 제품 정보 리스트들을 긁어 옵니다.-->
                            <input type="hidden" name="id" value="<?php echo $data['id'];?>">
                            <input type="hidden" name="productname" value="<?php echo $data['productname'];?>">
                            <button type="submit" name="imageurl" value="<?php echo $data['imgurl'];?>" style='background:none;border:none;padding:0'><img src='<?php echo $data['imgurl'];?>' width=230 height=200 alt="SomeAlternateText"></button>
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


                        <form method="post" action="rewrite_item.php" target="popup" onsubmit="window.open('rewrite_item.php', 'popup', 'width=800, height=800');">

                            <input type="hidden" name="hidden_id" value="<?php echo $data["id"] ?>" />
<!--                            <input type="hidden" name="hidden_name" value="<?php /*echo $data["productname"] */?>" />
                            <input type="hidden" name="hidden_name" value="<?php /*echo $data["id"] */?>" />
                            <input type="hidden" name="hidden_filename" value="<?php /*echo $data["filename"] */?>" />
                            <input type="hidden" name="hidden_filename2" value="<?php /*echo $data["filename2"] */?>" />
                            <input type="hidden" name="hidden_filename3" value="<?php /*echo $data["filename3"] */?>" />-->
                            <?php //현재 관리자 계정일 경우에만 나타나 지도록 만들기.
                            if ($edit==True) {
                                ?>
                                <input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-success" value="수정하기"/>
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
        <div class="paging" align="center">
            <?php echo $paging ?>
        </div>
    </div>
</div>
</div>

<div class="footer" style="background-color: #333;padding: 10px">
    <footer>
        <p style="color: white"><strong>Korica Industry Ltd.</strong></p>
        <p style="color: white">Contact email : tkjoo6138@gmail.com</p>
        <p style="color: white">Address : Korea Busan Sinsun Yeoundo </p>
        <p style="color: white">Tel : 82-51-413-3758 &nbsp;&nbsp;&nbsp;&nbsp; Business Number : 103-01-78910</p>
    </footer>
</div>

</body>
</html>
