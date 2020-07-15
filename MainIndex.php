<?php
 session_start();
 ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="./css/common.css">
</head>

 <body>
 <div id="wrap"> <!--div 태그는 내부에서 파일 별로 구분을 하는 것을 돕는다. (페이지의 머리 내용 메뉴 부분등에 대한 구분 점 지정하기.)-->
     <div id="header">
         <?php include "./lib/top_login1.php"; ?>
         </div> <!-- end of header -->

         <div id="menu">
             <?php include "./lib/top_menu1.php"; ?>
         </div> <!-- end of menu -->

      <div id="content">
          <div id="main_img"><img src="./img/main_img.jpg"></div>
      </div> <!-- end of content -->
 </div> <!-- end of wrap -->


 </body>
 </html>