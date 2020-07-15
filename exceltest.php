<?php
include "Classes/PHPExcel.php";
$objPHPExcel = new PHPExcel();
$arrVelvet = array();

//쇼핑 세션에 저장 되어진 값을 만듬.

session_start();

$objPHPExcel -> setActiveSheetIndex(0)
    -> setCellValue("A1", "제품이름")
    -> setCellValue("B1", "제품수량")
    -> setCellValue("C1", "품목명");

$count = 2;

$file=$_SESSION['userid'].".xls";


foreach($_SESSION["shopping_cart"] as $keys => $values) // 각각의 배열요소들을 모두 참조
{
    $num = 2;

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

//    echo $values['itemname'];
//    echo $values['item_quantity'];
//    echo $itemname;

    $objPHPExcel -> setActiveSheetIndex(0)
        -> setCellValue(sprintf("A%s", $count), $values['item_name'])
        -> setCellValue(sprintf("B%s", $count), $values['item_quantity'])
        -> setCellValue(sprintf("C%s", $count), $itemname);
    $count++;
}


$objPHPExcel -> getActiveSheet() -> getColumnDimension("A") -> setWidth(30);
$objPHPExcel -> getActiveSheet() -> getColumnDimension("B") -> setWidth(12);
$objPHPExcel -> getActiveSheet() -> getColumnDimension("C") -> setWidth(30);


$objPHPExcel -> getActiveSheet() -> getStyle(sprintf("A1:C%s", $count-1)) -> getAlignment() -> setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel -> getActiveSheet() -> getStyle(sprintf("A1:C%s", $count-1)) -> getBorders() -> getAllBorders() -> setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$objPHPExcel -> getActiveSheet() -> getStyle("A1:D1") -> getFont() -> setBold(true);
$objPHPExcel -> getActiveSheet() -> getStyle("A1:D1") -> getFill() -> setFillType(PHPExcel_Style_Fill::FILL_SOLID) -> getStartColor() -> setRGB("CECBCA");
$objPHPExcel -> getActiveSheet() -> getStyle(sprintf("A2:C%s", $count-1)) -> getFill() -> setFillType(PHPExcel_Style_Fill::FILL_SOLID) -> getStartColor() -> setRGB("F4F4F4");


// getNumberFormat(), setFormatCode() 함수를 사용한다.
// setFormatCode() 함수에 앞자리 0이 출력되게끔 문자열의 자리수 만큼 0을 입력한다.
$objPHPExcel -> getActiveSheet() -> getStyle(sprintf("A2:C%s", $count-1)) -> getNumberFormat() -> setFormatCode("00000");



// 파일 내보내기 처리
$objPHPExcel -> getActiveSheet() -> setTitle("품목문서");
$objPHPExcel -> setActiveSheetIndex(0);
$filename = iconv("UTF-8", "EUC-KR", "품목문서");

//header("Content-Type:application/vnd.ms-excel");
//header("Content-Disposition: attachment;filename=".$filename.".xls");
//header("Cache-Control:max-age=0");

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, "Excel5");

//파일로 저장//
$objWriter->save("exceldoc/".$file);

//다운로드 파일로 출력//
//$objWriter -> save("php://output");
//


//$objWriter->save('exceldoc/test3.xlsx');
?>


<?php
session_start();
$id = $_SESSION['userid'].".xls";
$to = "braum6138@gmail.com";
$subject = "OrderList";

$message = "
<html>
<head>
<title>OrderList Excel</title>
<a href='192.168.244.100/exceldoc/$id'>[엑셀 파일 다운로드]</a>
</head>
<body>
<p>Please Check This Order List.</p>
<table>
<tr>
<th>Firstname</th>
<th>Lastname</th>
</tr>
<tr>
<td>John</td>
<td>Doe</td>
</tr>
</table>
</body>
</html>
";

// Always set content-type when sending HTML email
//$headers = "MIME-Version: 1.0" . "\r\n";
//$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

$headers .= "Content-type: text/html; charset=us-ascii\n";
$headers .= "MIME-Version: 1.0\n";



// More headers
$headers .= 'From: <webmaster@example.com>' . "\r\n";
$headers .= 'Cc: myboss@example.com' . "\r\n";



mail($to,$subject,$message,$headers);

?>

<script>
    alert("Your List Sended Sucessfully.");
    location.replace("upload.php");
</script>

