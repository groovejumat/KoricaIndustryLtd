<?php
//php모듈을 불러옵니다.
    include "Classes/PHPExcel.php";
    $objPHPExcel = new PHPExcel();

    //수정할 내용을 불러오기
$file = NULL;
$file = './exceldoc/MYFORM.xlsx';
$objReader = PHPExcel_IOFactory::createReaderForFile($file,'Excel5');
$objPHPExcel = $objReader->load($file);

//여기까지 파일 불러오기 처리가 완료되어졌음.

//header("Content-Type:application/vnd.ms-excel");
//header("Content-Disposition: attachment;filename=".$filename.".xls");
//header("Cache-Control:max-age=0");
//
//$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, "Excel5");
//$objWriter -> save("php://output");

$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue("A4", "2008 부산시 영도구 신선동 3가 ")
    ->setCellValue("B3", 80)
    ->setCellValue("B3", 100)
    ->setCellValue("C3", 70);

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename=sample5.xls');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');


exit;
    ?>