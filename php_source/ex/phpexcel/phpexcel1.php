<?php
include usr/local/lib/php/vendor/PHPExcel/PHPExcel-1.8/Classes/PHPExcel.php
function column_char($i) { return chr( 65 + $i ); }
 
// 자료 생성
$headers = array('ID','부서ID','이름','이메일','나이');
$rows = array(
	array(1, 1, '한놈', 'maarten@example.com', 24),
	array(2, 1, '두시기', 'paul@example.com', 30),
	array(3, 2, '석삼', 'bill.a@example.com', 29),
	array(4, 3, '석삼', 'bill.g@example.com', 28),
);
$data = array_merge(array($headers), $rows);
 
// 스타일 지정
$widths = array(6, 8, 8, 30, 6);
$header_bgcolor = 'FFABCDEF';
 
// 엑셀 생성
$last_char = column_char( count($headers) - 1 );
 
$excel = new PHPExcel();
$excel->setActiveSheetIndex(0)->getStyle( "A1:${last_char}1" )->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB($header_bgcolor);
$excel->setActiveSheetIndex(0)->getStyle( "A:$last_char" )->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)->setWrapText(true);
foreach($widths as $i => $w) $excel->setActiveSheetIndex(0)->getColumnDimension( column_char($i) )->setWidth($w);
$excel->getActiveSheet()->fromArray($data,NULL,'A1');
$writer = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
$writer->save('test.xlsx');
echo "Done...\n";
