<html>
<head>
    <!--메인페이지에 대한 스타일 리스트-->
    <link rel= "stylesheet" type="text/css" href="./css/MainStyle.css"> <!--CSS파일변경이 반영되도록 설정하기-->

</head>
<body>
<?php include("MainHead.php"); ?>

<!--중요: 게시판 보드 쿼리실행 -->
<?php
$connect = mysqli_connect('localhost', 'root', 'password', 'WEBService') or die ("connect fail");

$query ="update board set whose = number*10 where depth=0"; //쿼리에 있는 int형 whose 필드에 자신의 키 값*10 한 값을 넣어준다.
$connect->query($query);

$query ="select * from board order by whose desc";
$result = $connect->query($query);

$total = mysqli_num_rows($result); //현재 총 라인 갯수 확인
$rows = mysqli_num_rows($result); //현재 총 줄 수의 값 확인

//페이징에 대한 공부하기//
if(isset($_GET['page'])) {
    $page = $_GET['page']; //페이징 점버링 값이 setteing되어져 있으면 번호를 $page에 담는다.
} else {
    $page = 1; //아니라면 1(디폴트페이지를 보여준다)
}

$onePage=10; //한 페이지에 보여줄 게시글의 수
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
    $paging .= '<li class="page page_start"><a href="./index.php?page=1">first</a></li>';
}
//첫 섹션이 아니라면 이전 버튼을 생성
if($currentSection!=1){
    $paging .= '<li class="page"><a href="./index.php?page='.$prevPage.'">"<<"</a></li>';
}

//해당 섹션을 표시하고, 해당 섹션에 따라서 맞는 페이지를 보여주고, 현재페이지 번호에 표시를 해준다//
for($i=$CurrentSectionfirstPage; $i<=$lastPage;$i++){
    if($i==$page){
        $paging.='<li class="page current">'.$i.'</li>';
    }else{
        $paging.='<li class="page"><a href="./index.php?page='.$i.'">'.$i.'</a></li>';
    }
}

//현재 서있는 섹션이 마지막 섹션이 아니라면, 다음 버튼을 생성
if($currentSection!=$allSection){ //현재있는 섹션의 값과 전체 색션의 값을 비교하여 판단
    $paging.='<li class="page page_next"><a href="./index.php?page='.$nextPage.'">">>"</a></li>';
}

//마지막 페이지가 아니라면 끝 버튼을 생성
if($page != $allPage) {
    $paging .= '<li class="page page_end"><a href="./index.php?page=' . $allPage . '">last</a></li>';
} //끝 버튼이 필요할지는 고민하기.....

$paging .= '</ul>';

/*페이징 처리가 끝났다*/
/*echo "<br>".$onePage;
echo "<br>".$page;*/
$currentLimit=($onePage*$page)-$onePage;//몇번째에 있는 글부터 가져오는지
$sqlLimit='limit '.$currentLimit.','.$onePage;//limit sql구문???
/*echo "<br>".$sqlLimit;*/

$sql2='select * from board order by whose desc '.$sqlLimit;//원하는 개수만큼 가지고 오기.
/*echo "<br>".$sql2;*/
/*$sql2= 'select * from board order by whose desc limit 0,5';*/
$pagingresult=$connect->query($sql2);
$rowstest = mysqli_num_rows($pagingresult);
/*echo "<br>".$rowstest;*/



/*로그인 세션스타트 하기*/
?>

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
/*    table .even{
        background: #efefef;
    }*/

    .text{
        text-align:center;
        padding-top:20px;
        color:#000000
    }

    .text:hover{
/*        text-decoration: underline;*/
    }
    a:link {color : black; text-decoration:none;}

    table a:visited {color : black;}
    .tdstyle td:hover {text-decoration : underline;}
    /*a:hover { text-decoration : underline;}*/

    /*Mouse Over Test*/
    td.row:hover { background-color: ghostwhite; }

    .paging li {display: inline-block; height: 20px; margin: 0 5px; padding: 0 5px; border: 1px solid #666; background: rgba(222, 200, 238, 0); line-height: 21px;}

    .paging li.current
    .paging li:hover {background: #666;}
    .paging li.current
    .paging li:hover a { color: #ddd;}


</style>
<body>

<div class="card">
    <h2 align=center>board</h2>
    <table align = center>
        <thead align = "center">
        <tr>
            <td width = "50" align="center" style="font-weight: bold">Num</td>
            <td width = "500" align = "center" style="font-weight: bold">Title</td>
            <td width = "100" align = "center" style="font-weight: bold">Writer</td>
            <td width = "200" align = "center" style="font-weight: bold">Date</td>
            <td width = "50" align = "center" style="font-weight: bold">View</td>
        </tr>
        </thead>



        <!--페이징 용도를 쓰기 위한 tbody 생성.-->
        <tbody>
        <?php
        $total=mysqli_num_rows($pagingresult);; //하나에 페이지에 들어가는 갯수는 페이지의 갯수와 같다.
        while($rows = mysqli_fetch_assoc($pagingresult)){ //DB에 저장된 데이터 수 (열 기준)

            ?>
            <tr>
                <td width = "50" align = "center"><?php echo $total?></td> <!--글 번호-->

                <?php if($rows['depth']>0) {?>
                    <td width = "500" align = "left" class="row">
                        <a href = "view.php?number=<?php echo $rows['number']?>"> <!--실제 글 구분 숫자를 지정하여 작성한다.-->
                        <?php echo "    ↘[REPLAY]".$rows['title']?></td>
                <?php } else { ?>
                    <td width = "500" align = "left" class="row">
                        <a href = "view.php?number=<?php echo $rows['number']?>"> <!--실제 글 구분 숫자를 지정하여 작성한다.-->
                        <?php echo $rows['title']?></td>

                <?php } ?>
                <td width = "100" align = "center" class=""><?php echo $rows['id']?></td><!--작성자 아이디-->
                <td width = "200" align = "center"><?php echo $rows['date']?></td>  <!--날짜-->
                <td width = "50" align = "center"><?php echo $rows['hit']?></td> <!--조회수-->
            </tr>
            <?php
            $total--;
        }
        ?>
        </tbody>
    </table>
    <div class="paging" align="center">
        <?php echo $paging ?>
    </div>

    <div class = text>
        <div class="view_btn">
            <button class="view_btn1" onClick="location.href='./write.php'">Write</button>
        </div>
    </div>
</div class>
</body>
</html>