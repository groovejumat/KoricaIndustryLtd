<?php
$uploadBase = './upload/';

foreach ($_FILES['upload']['name'] as $f => $name) {

    $name = $_FILES['upload']['name'][$f];
    $uploadName = explode('.', $name);

    // $fileSize = $_FILES['upload']['size'][$f];
    // $fileType = $_FILES['upload']['type'][$f];
    $uploadname = time().$f.'.'.$uploadName[1];
    $uploadFile = $uploadBase.$uploadname;

    echo "<br>".$_FILES['upload']['tmp_name'][$f], $uploadFile;
    echo "<br>".$uploadFile;

    if(move_uploaded_file($_FILES['upload']['tmp_name'][$f], $uploadFile)){
        echo 'success';
    }else{
        echo 'error';
    }
}

?>