<?php
$scompany=$_POST['scompany'];
$saddress=$_POST['saddress'];
$scity=$_POST['scity'];
$stel=$_POST['stel'];
$semail=$_POST['semail'];

$ccompany=$_POST['ccompany'];
$caddress=$_POST['caddress'];
$ccity=$_POST['ccity'];
$ctel=$_POST['ctel'];
$cemail=$_POST['cemail'];

$invoiceno="INVOICE NO : ".$_POST['invoiceno'];
$invoicedate="INVOICE DATE : ".$_POST['invoicddate'];

$lcno="L\C NO : ".$_POST['lcno'];
$lcdate="L\C DATE : ".$_POST['lcdate'];

$containerno="CONTAINER NO : ".$_POST['containerno'];
$sealno="SEAL NO : ".$_POST['sealno'];
$tinno="TIN NO : ".$_POST['tinno'];

//TERMS DELIVERY PAYMENT
$tod=$_POST['TOD'];

//Transport
$ddate=$_POST['ddate'];
$VF=$_POST['VF'];
$pol=$_POST['pol'];
$pod=$_POST['pod'];

//Transported Array
$array1=$_POST['array1'];
$array2=$_POST['array2'];
$array3=$_POST['array3'];
$array4=$_POST['array4'];


//php모듈을 불러옵니다.
include "Classes/PHPExcel.php";
$objPHPExcel = new PHPExcel();

//수정할 내용을 불러오기
$file = NULL;
$file = './exceldoc/EmptyInvoiceForm4.xlsx';
$objReader = PHPExcel_IOFactory::createReaderForFile($file,'Excel5');
$objPHPExcel = $objReader->load($file);

//여기까지 파일 불러오기 처리가 완료되어졌음.

//header("Content-Type:application/vnd.ms-excel");
//header("Content-Disposition: attachment;filename=".$filename.".xls");
//header("Cache-Control:max-age=0");
//
//$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, "Excel5");
//$objWriter -> save("php://output");

$count=27;
foreach($array1 as $key => $val){
    $objPHPExcel -> setActiveSheetIndex(0)
        -> setCellValue(sprintf("E%s", $count), $val);
    $count++;
}

$count=27;
foreach($array2 as $key => $val){
    $objPHPExcel -> setActiveSheetIndex(0)
        -> setCellValue(sprintf("F%s", $count), $val);
    $count++;
}

$count=27;
foreach($array3 as $key => $val){
    $objPHPExcel -> setActiveSheetIndex(0)
        -> setCellValue(sprintf("G%s", $count), $val);
    $count++;
}

$count=27;
foreach($array4 as $key => $val){
    $objPHPExcel -> setActiveSheetIndex(0)
        -> setCellValue(sprintf("H%s", $count), $val);
    $count++;
}



$objPHPExcel->setActiveSheetIndex(0)
    //seller
    ->setCellValue("A3", $scompany)
    ->setCellValue("A4", $saddress)
    ->setCellValue("A5", $scity)
    ->setCellValue("A6", $stel)
    ->setCellValue("A7", $semail)
    //consingee
    ->setCellValue("A9", $ccompany)
    ->setCellValue("A10", $caddress)
    ->setCellValue("A11", $ccity)
    ->setCellValue("A12", $ctel)
    ->setCellValue("A13", $cemail)
    //invoice
    ->setCellValue("F3", $invoiceno)
    ->setCellValue("F4", $invoicedate)
    //L/C
    ->setCellValue("F7", $lcno)
    ->setCellValue("F8", $lcdate)
    //Other Ref
    ->setCellValue("F15", $containerno)
    ->setCellValue("F16", $sealno)
    ->setCellValue("F17", $tinno)
    //TERMS DELIVERY PAYMENT
    ->setCellValue("F24", $tod)

    ->setCellValue("A21", $ddate)
    ->setCellValue("A23", $VF)
    ->setCellValue("D23", $pol)
    ->setCellValue("A26", $pod);

$objPHPExcel -> getActiveSheet() -> getStyle(sprintf("E27:H%s", $count-1)) -> getBorders() -> getAllBorders() -> setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);



header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename=Invoice.xls');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');

?>