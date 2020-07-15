this is php_action3;
<?php
$target_dir = "./productimage/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$target_file2 = $target_dir . basename($_FILES["fileToUpload2"]["name"]);
$target_file3 = $target_dir . basename($_FILES["fileToUpload3"]["name"]);



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
echo "<br>" .$target_file3;

echo "<br>" . $_POST[itemname]; /*제품과 가격정보에 대한 조회를 확인해보기 위한 용도.*/
/*echo "<br>" . $_POST[price];
echo "<br>" . $_POST[itemid];*/

//사진 검사 작업 시작
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}

// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 1;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 5000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    echo $target_file;
    echo $_FILES["fileToUpload"]["tmp_name"];
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
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
        $productname=$_POST["itemname"];
/*        echo "<br>" .$productname;*/

        $price=$_POST["price"];
/*        echo "<br>" .$price;*/

        $quantity=$_POST["quantity"];
/*        echo "<br>" .$quantity;*/

        $itemid=$_POST["itemid"];
/*        echo "<br>아이템 아이디 : " .$itemid;*/

        $detail=$_POST["detail"];
/*        echo "<br>" .$detail;*/



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
//product 테이블에 이미지정보를 저장하자.
        $sql = "insert into product(productname, price, quantity ,filename,filename2,filename3, imgurl, subimgurl1, subimgurl2, size, itemid, detail) values('$productname','$price','$quantity','$filename','$filename2','$filename3','$imgurl','$imgurl2','$imgurl3','$size','$itemid','$detail')";
/*        echo $sql;*/
        mysqli_query($conn, $sql);
        mysqli_close($conn);


        /*        include_once 'config.php';*/
        echo "<p>The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.</p>";
        echo "<br><img src=/uploads/". basename( $_FILES["fileToUpload"]["name"]). " width=400>";
        echo "<br><button type='button' onclick=\"location.href='./upload.php'\">돌아가기</button>";
        ?>
        <script>
        alert("제품이 등록되었습니다.");
        self.close();
        //location.replace("./upload.php");
        </script>
<?php
    } else {
        echo "<p>Sorry, there was an error uploading your file.</p>";
        echo "<br><button type='button' onclick=\"location.href='./upload.php'\">돌아가기</button>";
    }
}
?>


