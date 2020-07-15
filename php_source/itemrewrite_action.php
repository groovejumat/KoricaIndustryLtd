<?php
echo "<br>확인해보자".$_FILES["fileToUpload"]["name"]; //순수하게 파일의 이름 이었다.
$target_dir = "./productimage/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$target_file2 = $target_dir . basename($_FILES["fileToUpload2"]["name"]);
$target_file3 = $target_dir . basename($_FILES["fileToUpload3"]["name"]);

//해당 파일들이 Null값인 경우에는 다음과 같이 처리한다.
$id=$_POST["hidden_id"];
/*$conn = mysqli_connect('localhost', 'root', 'password', 'WEBService') or die ("connect fail");
$query = "SELECT * FROM product where id='$id'";
$result = mysqli_query($conn, $query);
while($data = mysqli_fetch_array($result)) {
    $productname=$data['productname'];
    $productid=$data['itemid'];

    $img1=$data['imgurl'];
    $img2=$data['subimgurl1'];
    $img3=$data['subimgurl2'];

    $filename=$data['filename'];
    $filename2=$data['filename2'];
    $filename3=$data['filename3'];

    $detail=$data['detail'];
}*/

//이름 값이 없을 때는 기존값에 있는 파일을 가지고 온다.
/*$target_dir = "./productimage/";
if(basename($_FILES["fileToUpload"]["name"])==NULL){
    $target_file = $target_dir . $filename;
    echo "<br>".$target_file;
}
else{
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
}

if(basename($_FILES["fileToUpload2"]["name"])==NULL){
    $target_file2 = $target_dir . $filename2;
    echo "<br>".$target_file2;
}
else{
    $target_file2 = $target_dir . basename($_FILES["fileToUpload2"]["name"]);
}

if(basename($_FILES["fileToUpload3"]["name"])==NULL){
    $target_file3 = $target_dir . $filename3;
    echo "<br>".$target_file3;
}
else{
    $target_file3 = $target_dir . basename($_FILES["fileToUpload3"]["name"]);
}


//사진 2번과 3번이 없을 경위 target_file을 NULL로 만든다.

if($filename2==NULL){
    $target_file2=NULL;
}

if($filename3==NULL){
    $target_file3=NULL;
}*/


$filename2=$_FILES["fileToUpload2"]["name"];
if($filename2==NULL){
    $target_file2=NULL;
}
$filename3=$_FILES["fileToUpload3"]["name"];
if($filename3==NULL){
    $target_file3=NULL;
}


/*echo "<br>" .$target_file;
echo "<br>" .$target_file2;
echo "<br>" .$target_file3;*/

/*echo "<br>" . $_POST[itemname]; *//*제품과 가격정보에 대한 조회를 확인해보기 위한 용도.*/
/*echo "<br>" . $_POST[price];
echo "<br>" . $_POST[itemid];*/

//사진 검사 작업 시작
$uploadOk = 1;
/*$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 1;
    }
}*/

// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 1;
}
// Check file size
/*if ($_FILES["fileToUpload"]["size"] > 5000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}*/
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 1;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
/*    echo '<br>타겟파일'.$target_file;
    echo '<br>파일 업로드 이름'.$_FILES["fileToUpload"]["name"];*/

    //업로드를 하는 파일이 실제로 존재 한다면 경로에 파일 등록 처리를 한 후 변경 쿼리 실행.
    //겨기가 문제인데



            if($target_file!=NULL){
                move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
            }

            if($target_file2!=NULL){
                move_uploaded_file($_FILES["fileToUpload2"]["tmp_name"], $target_file2);
            }

            if($target_file3!=NULL){
                move_uploaded_file($_FILES["fileToUpload3"]["tmp_name"], $target_file3);
            }



            //이미지 파일의 존재 유무 확인하기.
            /*database에 업로드 정보를 기록하자.
            - 파일이름(혹은 url)
            - 파일사이즈
            - 파일형식
            */
            $id=$_POST["hidden_id"];
/*            echo "<br>" .$id;*/

            $productname=$_POST["itemname"];
/*            echo "<br>" .$productname;*/

            $price=$_POST["price"];
/*            echo "<br>" .$price;*/

            $quantity=$_POST["quantity"];
/*            echo "<br>" .$quantity;*/

            $itemid=$_POST["itemid"];
/*            echo "<br>" .$itemid;*/

            $detail=$_POST["detail"];
/*            echo "<br>" .$detail;*/



            $filename = $_FILES["fileToUpload"]["name"];
            $size = $_FILES["fileToUpload"]["size"];
            $imgurl = "http://192.168.244.100/productimage/". $_FILES["fileToUpload"]["name"];
            $imgurl2 = "http://192.168.244.100/productimage/". $_FILES["fileToUpload2"]["name"];
            $imgurl3 = "http://192.168.244.100/productimage/". $_FILES["fileToUpload3"]["name"];

            if($target_file2==NULL){
                $imgurl2=NULL;
            }
            if($target_file3==NULL){
                $imgurl3=NULL;
            }

            $conn = mysqli_connect('localhost', 'root', 'password', 'WEBService') or die ("connect fail");

            //첫업로드 파일에 첫번째 사진이 있다.
            if($_FILES["fileToUpload"]["tmp_name"]!=NULL){
                $sql = "update product set productname='$productname', filename='$filename' ,imgurl='$imgurl', itemid='$itemid', detail='$detail' where id='$id'";
                mysqli_query($conn, $sql);
            }

            //업로드 파일에 두번째 사진이 있다.
            if($_FILES["fileToUpload2"]["tmp_name"]!=NULL){
                $sql = "update product set productname='$productname', filename2='$filename2' ,subimgurl1='$imgurl2', itemid='$itemid', detail='$detail' where id='$id'";
                mysqli_query($conn, $sql);
            }

            //업르도 프알에 세번재 사진이 있다.
            if($_FILES["fileToUpload3"]["tmp_name"]!=NULL){
                $sql = "update product set productname='$productname', filename3='$filename3' ,subimgurl2='$imgurl3', itemid='$itemid', detail='$detail' where id='$id'";
                mysqli_query($conn, $sql);
            }

            //세가지 이미지 모두 변공이 없는 경우에는 제목과 상세 내용만 수정하기.
            else{
                $sql = "update product set productname='$productname', itemid='$itemid', detail='$detail' where id='$id'";
                mysqli_query($conn, $sql);
            }



            mysqli_close($conn);


            echo "<p>The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.</p>";
            echo "<br><img src=/uploads/". basename( $_FILES["fileToUpload"]["name"]). " width=400>";
            echo "<br><button type='button' onclick=\"location.href='./upload.php'\">돌아가기</button>";
            ?>
            <script>
                alert("제품이 수정되었습니다.");
                self.close();
                //location.replace("./upload.php");
            </script>
            <?php

}
?>


