<?php
$basedir = dirname(__FILE__);

$filePath = $basedir . "/test6.xlsx";
include_once $basedir . "/Classes/PHPExcel.php";
$old = "{ZD_GongSiMingChen}"; //被替换
$new = "浙江欧迪机械有限公司";  //替换新的 
//建立reader对象
$PHPReader = new PHPExcel_Reader_Excel2007();

//如果excel2007不能识别此文件则用excel5来读取,如果都不能识别  说明文件有问题
if (!$PHPReader->canRead($filePath)) {
    $PHPReader = new PHPExcel_Reader_Excel5();
    if (!$PHPReader->canRead($filePath)) {
        exit('无法识别此文件');
    }
}


//读取文件
$excel = $PHPReader->load($filePath);
//获取工作表总数
$sheetCount = $excel->getSheetCount();

//循环每张表的数据 表从0开始
//根据索引获取表的数据
$sheet = $excel->getSheet(0);
//获取总共行数
$maxRows = $sheet->getHighestRow();
$title = $sheet->getTitle();
//获取每行的字段数
$maxColumns = $sheet->getHighestColumn();
//字母列转为数字列
$maxColumns = PHPExcel_Cell::columnIndexFromString($maxColumns);
//数字列转为字母列
//PHPExcel_Cell::stringFromColumnIndex($i);
//因为第一行有字段名,所以从第二行开始循环
$PHPExcel = new \PHPExcel();
$PHPExcel->setActiveSheetIndex(0)->setTitle($title)->setMergeCells($sheet->getMergeCells());

for ($r = 1; $r <= $maxRows; $r++) {
    //列数是以第0列开始
    for ($c = 0; $c <= $maxColumns; $c++) {
        $column = PHPExcel_Cell::stringFromColumnIndex($c);
        $width = -1;
        if($r == 1){
            $width = $sheet->getColumnDimension($column)->getWidth();
           // echo $width."<br>";
        }
        $content = $sheet->getCellByColumnAndRow($c, $r)->getValue();
        $content = str_replace($old, $new, $content);
        //读取字段的数据
        //echo $content.'<br/>';
        $num = $column . $r;
        //echo $num . "---" . $content . "<br>";
        $style = $sheet->getCellByColumnAndRow($c, $r)->getStyle();
        $wrapText = $style->getAlignment()->getWrapText();
        $horizontal = $style->getAlignment()->getHorizontal();
        $vertical = $style->getAlignment()->getVertical();

        $newExcel = $PHPExcel->getActiveSheet()->setCellValueExplicit($num, $content, \PHPExcel_Cell_DataType::TYPE_STRING);
        if($width > 0){
            $newExcel->getColumnDimension($column)->setWidth($width);
        }
        $getfile = $style->getFill()->getFillType();
        echo $getfile;
        $styleArray = array(
            'font' => array(
                'bold' => $style->getFont()->getBold(),
                'size' => $style->getFont()->getSize(),
            )
            );
        if($getfile != PHPExcel_Style_Fill::FILL_NONE){
            $styleArray["fill"] = array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => $style->getFill()->getStartColor()->getRGB())
            );
        }
        //echo $num."---".$argbcolor."---".$rgbcolor."<br>";
        $PHPExcel->getActiveSheet()->getStyle($num)->applyFromArray($styleArray);
        $PHPExcel->getActiveSheet()->getStyle($num)->getFont()->getColor()->setARGB($style->getFont()->getColor()->getARGB())->setRGB($style->getFont()->getColor()->getRGB());
        $PHPExcel->getActiveSheet()->getStyle($num)->getAlignment()->setWrapText($wrapText)->setHorizontal($horizontal);
        $PHPExcel->getActiveSheet()->getStyle($num)->getAlignment()->setVertical($vertical);
    }
}
$objWriter = \PHPExcel_IOFactory::createWriter($PHPExcel, 'Excel2007');
$objWriter->save($filePath);