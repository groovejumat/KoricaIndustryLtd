<?php
include "Classes/PHPExcel.php";
$objPHPExcel = new PHPExcel();

$arrVelvet = array();

// 앞자리가 0으로 끝나는 숫자값을 number에 담는다.
$arrVelvet[1] = array("number" => "00001", "name" => "아이린", "position" => "센터, 리더, 메인래퍼", "birthday" => "03월 29일");
$arrVelvet[2] = array("number" => "00002", "name" => "슬기", "position" => "리드보컬, 메인댄서", "birthday" => "02월 10일");
$arrVelvet[3] = array("number" => "00003", "name" => "웬디", "position" => "메인보컬", "birthday" => "02월 21일");
$arrVelvet[4] = array("number" => "00004", "name" => "조이", "position" => "리드래퍼, 서브보컬", "birthday" => "09월 03일");
$arrVelvet[5] = array("number" => "00005", "name" => "예리", "position" => "서브래퍼, 서브보컬", "birthday" => "03월 05일");

$objPHPExcel -> setActiveSheetIndex(0)
    -> setCellValue("A1", "NO.")
    -> setCellValue("B1", "이름")
    -> setCellValue("C1", "포지션")
    -> setCellValue("D1", "생일");

$count = 2;
foreach($arrVelvet as $key => $val) {
    $num = 2 + $key;
    $objPHPExcel -> setActiveSheetIndex(0)
/*        -> setCellValue(sprintf("A%s", $num), $val['number'])
        -> setCellValue(sprintf("B%s", $num), $val['name'])
        -> setCellValue(sprintf("C%s", $num), $val['position'])
        -> setCellValue(sprintf("D%s", $num), $val['birthday']);*/
        -> setCellValue(sprintf("A%s", $count),"레드벨벳 짱짱맨")
        -> setCellValue(sprintf("B%s", $count), $val['name'])
        -> setCellValue(sprintf("C%s", $count), $val['position'])
        -> setCellValue(sprintf("D%s", $count), $val['birthday']);
    $count++;
}

$objPHPExcel -> getActiveSheet() -> getColumnDimension("A") -> setWidth(10);
$objPHPExcel -> getActiveSheet() -> getColumnDimension("B") -> setWidth(12);
$objPHPExcel -> getActiveSheet() -> getColumnDimension("C") -> setWidth(30);
$objPHPExcel -> getActiveSheet() -> getColumnDimension("D") -> setWidth(15);

$objPHPExcel -> getActiveSheet() -> getStyle(sprintf("A1:D%s", $count)) -> getAlignment() -> setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel -> getActiveSheet() -> getStyle(sprintf("A1:D%s", $count)) -> getBorders() -> getAllBorders() -> setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$objPHPExcel -> getActiveSheet() -> getStyle("A1:D1") -> getFont() -> setBold(true);
$objPHPExcel -> getActiveSheet() -> getStyle("A1:D1") -> getFill() -> setFillType(PHPExcel_Style_Fill::FILL_SOLID) -> getStartColor() -> setRGB("CECBCA");
$objPHPExcel -> getActiveSheet() -> getStyle(sprintf("A2:D%s", $count)) -> getFill() -> setFillType(PHPExcel_Style_Fill::FILL_SOLID) -> getStartColor() -> setRGB("F4F4F4");


// getNumberFormat(), setFormatCode() 함수를 사용한다.
// setFormatCode() 함수에 앞자리 0이 출력되게끔 문자열의 자리수 만큼 0을 입력한다.
$objPHPExcel -> getActiveSheet() -> getStyle(sprintf("A2:A%s", $count)) -> getNumberFormat() -> setFormatCode("00000");




$objPHPExcel -> getActiveSheet() -> setTitle("레드벨벳");
$objPHPExcel -> setActiveSheetIndex(0);
$filename = iconv("UTF-8", "EUC-KR", "레드벨벳");

header("Content-Type:application/vnd.ms-excel");
header("Content-Disposition: attachment;filename=".$filename.".xls");
header("Cache-Control:max-age=0");

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, "Excel5");
$objWriter -> save("php://output");
?>