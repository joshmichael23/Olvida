<?php

// require_once('tcpdf_include.php');


// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

	//Page header
	public function Header() {
		// Logo
		// $this->SetMargins(24, 6, 24, true);
		// $image_file = K_PATH_IMAGES.'logo_example.jpg';
		// //Image($file, $x='', $y='', $w=0, $h=0, $type='', $link='', $align='', $resize=false, $dpi=300, $palign='', $ismask=false, 
		// $this->Image($image_file, 142, 10, 15, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);

		// Set font
		
		// Title
		// $this->SetY(20);
		//$this->Cell(0, 15, 'CERTIFICATE OF PARTICIPATION', 0, false, 'C', 0, '', 0, false, 'M', 'M');

		$this->SetTopMargin(50);
	}

	// Page footer
	public function Footer() {
		// Position at 15 mm from bottom
		$this->SetY(-15);
		// Set font
		$this->SetFont('helvetica', 'I', 8);
		// Page number
		//$this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
	}
}

// create new PDF document
$this->Mytcpdf = new MYPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$this->Mytcpdf->SetCreator(PDF_CREATOR);
$this->Mytcpdf->SetAuthor('Nicola Asuni');
$this->Mytcpdf->SetTitle('Certificate of Participation');
$this->Mytcpdf->SetSubject('TCPDF Tutorial');
$this->Mytcpdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$this->Mytcpdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$this->Mytcpdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$this->Mytcpdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$this->Mytcpdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$this->Mytcpdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$this->Mytcpdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$this->Mytcpdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$this->Mytcpdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$this->Mytcpdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$this->Mytcpdf->setLanguageArray($l);
}


foreach($real->result_array() AS $data){



// ---------------------------------------------------------

	// set font
	$this->Mytcpdf->SetFont('times', 'BI', 12);

	// add a page

	$this->Mytcpdf->AddPage();


	// set some text to print
	$txt2	 = <<<EOD
	TCPDF Example 003

	Custom page header and footer are defined by extending the TCPDF class and overriding the Header() and Footer() methods.
EOD;

	$FullName = $data['Name'];
	// $samplename = $data['first_name'] . " " . $data['last_name'];
	// $name = ucwords($samplename);

	$competition_name = $data['competition_name'];
	$sdate = $data['start_date'];
	$edate = $data['end_date'];

	$realdate = $data['date'];
	$teamname = $data['team_name'];

	if (strpos(strtolower($teamname), 'team') !== false) {
    $team = "of " . ucwords($teamname);
	}

	else{
    $team = "of Team " . ucwords($teamname);
	}

	$big = <<<EOD
CERTIFICATE OF PARTICIPATION
EOD;

	$txt = <<<EOD
	Recognizes and Certifies that
EOD;
// 	$txt = <<<EOD

// 	Certificate is given to $name for joining the programming competition $competition_name during $sdate until $edate.
// EOD;
	$name = <<< EOD
$FullName
EOD;
	
// 	$txt2 = <<<EOD

// 	of Team
// EOD;
	
	$comp = <<<EOD
Participated in the	$competition_name
EOD;

	$date=<<<EOD
$realdate
EOD;



	// print a block of text using Write()
	//Write($h, $txt, $link = '', $fill = false, $align = '', $ln = false, $stretch = 0, $firstline = false, $firstblock = false, $maxh = 0, $wadj = 0, $margin = '' )

	$fontname = TCPDF_FONTS::addTTFfont('C://Windows/Fonts/gara.ttf', 'TrueTypeUnicode', '', 96);
	$this->Mytcpdf->SetFont($fontname, 'B', 40);
	$this->Mytcpdf->Write(0, $big, '', 0, 'C', true, 0, false, false, 0);

	//SPACE
	$this->Mytcpdf->SetFont($fontname, 'B', 20);
	$this->Mytcpdf->Write(0, "", '', 0, 'C', true, 0, false, false, 0);

	$this->Mytcpdf->SetFont('helvetica', 'B', 15);
	$this->Mytcpdf->Write(0, $txt, '', 0, 'C', true, 0, false, false, 0);

	//SPACE
	$this->Mytcpdf->SetFont($fontname, 'B', 20);
	$this->Mytcpdf->Write(0, "", '', 0, 'C', true, 0, false, false, 0);

	$fontname = TCPDF_FONTS::addTTFfont('C://Windows/Fonts/garaIt.ttf', 'TrueTypeUnicode', '', 96);
	$this->Mytcpdf->SetFont($fontname, 'B', 60);
	$this->Mytcpdf->Write(0, $name, '', 0, 'C', true, 0, false, false, 0);

	$this->Mytcpdf->SetFont('helvetica', 'B', 25);
	$this->Mytcpdf->Write(0, $team, '', 0, 'C', true, 0, false, false, 0);

	//SPACE
	$this->Mytcpdf->SetFont($fontname, 'B', 20);
	$this->Mytcpdf->Write(0, "", '', 0, 'C', true, 0, false, false, 0);

	//SPACE
	$this->Mytcpdf->SetFont($fontname, 'B', 20);
	$this->Mytcpdf->Write(0, "", '', 0, 'C', true, 0, false, false, 0);

	$this->Mytcpdf->SetFont('helvetica', 'B', 15);
	$this->Mytcpdf->Write(0, $comp, '', 0, 'C', true, 0, false, false, 0);
	
	//SPACE
	$this->Mytcpdf->SetFont($fontname, 'B', 20);
	$this->Mytcpdf->Write(0, "", '', 0, 'C', true, 0, false, false, 0);

	$this->Mytcpdf->SetFont('helvetica', 'B', 25);
	$this->Mytcpdf->Write(0, $date, '', 0, 'C', true, 0, false, false, 0);


	// ---------------------------------------------------------
	$this->Mytcpdf->Endpage();
	//Close and output PDF document
}
	$this->Mytcpdf->Output('example_003.pdf', 'I');


//============================================================+
// END OF FILE
//============================================================+
?>