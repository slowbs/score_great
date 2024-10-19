<?php
session_start();
if (!isset($_SESSION['user_login'])) { // ถ้าไม่ได้เข้าระบบอยู่
    header("location: login.php"); // redirect ไปยังหน้า login.php
    exit;
}

// include_once("./function.php");
// $objCon = connectDB(); // เชื่อมต่อฐานข้อมูล

$input = $_POST['selected_date'];
$date = str_replace('/', '-', $input);
$date_forget = date("Y-n-j", strtotime($date));  
$filename = date("d-m-Y", strtotime($date));  
$date_name = date("d/m/Y", strtotime($date));

// echo 'filename : ' . $filename . '<br>';
// echo 'date_forget : ' . $date_forget . '<br>';
// echo 'date_name : ' . $date_name . '<br>';

require_once('../Classes/PHPExcel.php');

$excel = new PHPExcel();
$excel->setActiveSheetIndex(0);
$excel->getActiveSheet()->getStyle('A1:H4')->getAlignment()
	->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$styleArray = array(
	'borders' => array(
		'allborders' => array(
			'style' => PHPExcel_Style_Border::BORDER_THIN
		)
	)
);

$excel->getActiveSheet()->getStyle('A1:H4')->applyFromArray($styleArray);
unset($styleArray);
$excel->getActiveSheet()->mergeCells('A1:H1');
$excel->getActiveSheet()->setCellValue('A1', 'ระบบประเมินความพึงพอใจ การให้บริการ');
$excel->getActiveSheet()->setCellValue('A2', 'รายการ');
$excel->getActiveSheet()->setCellValue('B2', 'น้อยมาก');
$excel->getActiveSheet()->setCellValue('C2', 'น้อย');
$excel->getActiveSheet()->setCellValue('D2', 'ปานกลาง');
$excel->getActiveSheet()->setCellValue('E2', 'มาก');
$excel->getActiveSheet()->setCellValue('F2', 'มากที่สุด');
$excel->getActiveSheet()->setCellValue('G2', 'จำนวน');
$excel->getActiveSheet()->setCellValue('H2', 'เฉลี่ย');

include '../connect.php';
$sql = "select 'การให้บริการภาพรวม' as name,
(select count(*) from score where score = 1 and position = 1 and date(date_time) = '$date_forget') as a,
(select count(*) from score where score = 2 and position = 1 and date(date_time) = '$date_forget') as b,
(select count(*) from score where score = 3 and position = 1 and date(date_time) = '$date_forget') as c,
(select count(*) from score where score = 4 and position = 1 and date(date_time) = '$date_forget') as d,
(select count(*) from score where score = 5 and position = 1 and date(date_time) = '$date_forget') as e,
(select count(*) from score where position = 1 and date(date_time) = '$date_forget') as f,
(SELECT sum(score)/count(*) as sum FROM `score` WHERE position = 1 and date(date_time) = '$date_forget') as avg
UNION
select 'การให้บริการห้องจ่ายยา'as name,
(select count(*) from score where score = 1 and position = 2 and date(date_time) = '$date_forget') as a,
(select count(*) from score where score = 2 and position = 2 and date(date_time) = '$date_forget') as b,
(select count(*) from score where score = 3 and position = 2 and date(date_time) = '$date_forget') as c,
(select count(*) from score where score = 4 and position = 2 and date(date_time) = '$date_forget') as d,
(select count(*) from score where score = 5 and position = 2 and date(date_time) = '$date_forget') as e,
(select count(*) from score where position = 2 and date(date_time) = '$date_forget') as f,
(SELECT sum(score)/count(*) as sum FROM `score` WHERE position = 2 and date(date_time) = '$date_forget') as avg";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
	$i = 3;
	while ($row = mysqli_fetch_assoc($result)) {
		$excel->getActiveSheet()->setCellValue('A' . $i, $row['name'])->getColumnDimension('A')
			// ->setAutoSize(true);
			->setWidth(25);
		$excel->getActiveSheet()->setCellValue('B' . $i, $row['a']);
		$excel->getActiveSheet()->setCellValue('C' . $i, $row['b']);
		$excel->getActiveSheet()->setCellValue('D' . $i, $row['c']);
		$excel->getActiveSheet()->setCellValue('E' . $i, $row['d']);
		$excel->getActiveSheet()->setCellValue('F' . $i, $row['e']);
		$excel->getActiveSheet()->setCellValue('G' . $i, $row['f']);
		$excel->getActiveSheet()->setCellValue('H' . $i, $row['avg']);
		$i++;
	}
}
$objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
$objWriter->save(str_replace(__FILE__, '../export/export_' . $filename . '.xlsx', __FILE__));



require_once('../TCPDF/examples/tcpdf_include.php');

// extend TCPF with custom functions
class MYPDF extends TCPDF
{

	// Load table data from file
	public function LoadData($date_forget)
	{
		// Read file lines
		// $lines = file($file);
		include '../connect.php';
		// $date_forget = '2022-12-15';
        // $date_forget = date("Y-m-d", strtotime($date));
		$sql = "select 'การให้บริการภาพรวม' as name,
		(select count(*) from score where score = 1 and position = 1 and date(date_time) = '$date_forget') as a,
		(select count(*) from score where score = 2 and position = 1 and date(date_time) = '$date_forget') as b,
		(select count(*) from score where score = 3 and position = 1 and date(date_time) = '$date_forget') as c,
		(select count(*) from score where score = 4 and position = 1 and date(date_time) = '$date_forget') as d,
		(select count(*) from score where score = 5 and position = 1 and date(date_time) = '$date_forget') as e,
		(select count(*) from score where position = 1 and date(date_time) = '$date_forget') as f,
		(SELECT sum(score)/count(*) as sum FROM `score` WHERE position = 1 and date(date_time) = '$date_forget') as avg
		UNION
		select 'การให้บริการห้องจ่ายยา'as name,
		(select count(*) from score where score = 1 and position = 2 and date(date_time) = '$date_forget') as a,
		(select count(*) from score where score = 2 and position = 2 and date(date_time) = '$date_forget') as b,
		(select count(*) from score where score = 3 and position = 2 and date(date_time) = '$date_forget') as c,
		(select count(*) from score where score = 4 and position = 2 and date(date_time) = '$date_forget') as d,
		(select count(*) from score where score = 5 and position = 2 and date(date_time) = '$date_forget') as e,
		(select count(*) from score where position = 2 and date(date_time) = '$date_forget') as f,
		(SELECT sum(score)/count(*) as sum FROM `score` WHERE position = 2 and date(date_time) = '$date_forget') as avg";
		$result = mysqli_query($conn, $sql);
		if (mysqli_num_rows($result) > 0) {
			while ($row = mysqli_fetch_assoc($result)) {
				$data[] = $row;
				// $data = array();
				// foreach($lines as $line) {
				// 	$data[] = explode(';', chop($line));
				// }
			}
			// print_r($data);
		}
		return $data;
	}

	//Page header
	// public function Header()
	// {
	// 	// Logo
	// 	// $image_file = K_PATH_IMAGES . 'logo_example.jpg';
	// 	// $this->Image($image_file, 10, 10, 15, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
	// 	// Set font
	// 	$this->SetFont('freeserif', 'B', 20);
	// 	// Title
	// 	$this->Cell(0, 15, 'ผลการประเมินประจำวัน', 0, false, 'C', 0, '', 0, false, 'M', 'M');
	// }

	// Colored table
	public function ColoredTable($header, $data)
	{
		// Colors, line width and bold font
		$this->setFillColor(0, 76, 153);
		$this->setTextColor(255);
		$this->setDrawColor(128, 0, 0);
		$this->setLineWidth(0.3);
		$this->setFont('', 'B');
		// Header
		$w = array(60, 30, 30, 30, 30, 30, 30, 30);
		$num_headers = count($header);
		for ($i = 0; $i < $num_headers; ++$i) {
			$this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', 1);
		}
		$this->Ln();
		// Color and font restoration
		$this->setFillColor(224, 235, 255);
		$this->setTextColor(0);
		$this->setFont('');
		// Data
		$fill = 0;
		foreach ($data as $row) {
			$this->Cell($w[0], 6, $row['name'], 'LR', 0, 'C', $fill);
			$this->Cell($w[1], 6, $row['a'], 'LR', 0, 'C', $fill);
			$this->Cell($w[2], 6, $row['b'], 'LR', 0, 'C', $fill);
			$this->Cell($w[3], 6, $row['c'], 'LR', 0, 'C', $fill);
			$this->Cell($w[4], 6, $row['d'], 'LR', 0, 'C', $fill);
			$this->Cell($w[5], 6, $row['e'], 'LR', 0, 'C', $fill);
			$this->Cell($w[6], 6, $row['f'], 'LR', 0, 'C', $fill);
			$this->Cell($w[7], 6, $row['avg'], 'LR', 0, 'C', $fill);
			// $this->Cell($w[2], 6, number_format($row[2]), 'LR', 0, 'R', $fill);
			// $this->Cell($w[3], 6, number_format($row[3]), 'LR', 0, 'R', $fill);
			$this->Ln();
			$fill = !$fill;
		}
		$this->Cell(array_sum($w), 0, '', 'T');
	}
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('ผลการประเมินประจำวัน');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->setHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 011', PDF_HEADER_STRING);
// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set header and footer fonts
$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->setDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->setMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP - 10, PDF_MARGIN_RIGHT);
$pdf->setHeaderMargin(PDF_MARGIN_HEADER);
$pdf->setFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->setAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
	require_once(dirname(__FILE__) . '/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->setFont('freeserif', '', 12);

// add a page
$pdf->AddPage('L', 'A4');

$html = '<h1 style="text-align: center">ผลการประเมินประจำวัน</h1>
<h2 style="text-align: center">ประจำวันที่ ' . $filename . '</h2><br>';

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');


// column titles
$header = array('รายการ', 'น้อยมาก', 'น้อย', 'ปานกลาง', 'ดี', 'ดีมาก', 'จำนวน', 'เฉลี่ย');

// data loading
$data = $pdf->LoadData($date_forget);

// print colored table
$pdf->ColoredTable($header, $data);

// ---------------------------------------------------------

// close and output PDF document
// $pdf->Output('example_011.pdf', 'I');
// $pdf->Output(__FILE__ . '.pdf', 'F', __FILE__);

// Output on localhost
// $pdf->Output(__DIR__ . '../pdf/' . $filename .'.pdf', 'F');

//OUTput on Host
$pdf->Output(__DIR__ . '/../pdf/pdf_' . $filename . '.pdf', 'F');


// $token = "2o8uKi8xrEoTYDmGHuEW6W2j7oxY8bheDApgfYRUJo4"; // LINE Token test
$token = "j7ln4sEmXpPftBZvVzlahFPMs4xn9ZzCEsGBye6g5aG"; // LINE Token
//Message
// $mymessage = "คะแนนประจำวันที่: " . date('d/m/Y') . "\n"; //Set new line with '\n'
$mymessage = "คะแนนประจำวันที่: " . $date_name . "\n"; //Set new line with '\n' test
//on Host
$mymessage .= "Excel: https://www.phuketcityhospital.org/score/export/export_" . $filename . ".xlsx \n \n";
$mymessage .= "PDF: https://www.phuketcityhospital.org/score/pdf/pdf_" . $filename . ".pdf";


//on localhost
// $mymessage .= "Excel: http://localhost/score/export/export_" . $filename . ".xlsx \n \n";
// $mymessage .= "PDF: http://localhost/score/pdf/pdf_" . $filename . ".pdf";

// $imageFile = new CURLFILE('screenshot/' . $filename . '.png'); // Local Image file Path
// $sticker_package_id = '2';  // Package ID sticker
// $sticker_id = '34';    // ID sticker
$data = array(
	'message' => $mymessage,
	// 'link' => $linkdownload,
	// 'imageFile' => $imageFile
	// 'stickerPackageId' => $sticker_package_id,
	// 'stickerId' => $sticker_id
);
$chOne = curl_init();
curl_setopt($chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify");
curl_setopt($chOne, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($chOne, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($chOne, CURLOPT_POST, 1);
curl_setopt($chOne, CURLOPT_POSTFIELDS, $data);
curl_setopt($chOne, CURLOPT_FOLLOWLOCATION, 1);
$headers = array('Method: POST', 'Content-type: multipart/form-data', 'Authorization: Bearer ' . $token,);
curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers);
curl_setopt($chOne, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec($chOne);
//Check error
if (curl_error($chOne)) {
	echo 'error:' . curl_error($chOne);
} else {
	$result_ = json_decode($result, true);
	echo "status : " . $result_['status'];
	echo "message : " . $result_['message'];
}
//Close connection
curl_close($chOne);

// $mymessage = "ทดสอบส่ง Link";
// $data = array(
//     'message' => $mymessage
// );

// $chOne = curl_init();
// curl_setopt($chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify");
// curl_setopt($chOne, CURLOPT_SSL_VERIFYHOST, 0);
// curl_setopt($chOne, CURLOPT_SSL_VERIFYPEER, 0);
// curl_setopt($chOne, CURLOPT_POST, 1);
// curl_setopt($chOne, CURLOPT_POSTFIELDS, $data);
// curl_setopt($chOne, CURLOPT_FOLLOWLOCATION, 1);
// $headers = array('Method: POST', 'Content-type: multipart/form-data', 'Authorization: Bearer ' . $token,);
// curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers);
// curl_setopt($chOne, CURLOPT_RETURNTRANSFER, 1);
// $result = curl_exec($chOne);
// //Check error
// if (curl_error($chOne)) {
//     echo 'error:' . curl_error($chOne);
// } else {
//     $result_ = json_decode($result, true);
//     echo "status : " . $result_['status'];
//     echo "message : " . $result_['message'];
// }
// //Close connection
// curl_close($chOne);


header("location: /score/login/select_date.php");
