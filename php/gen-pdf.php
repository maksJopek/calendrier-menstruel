<?php
// Setting locale
date_default_timezone_set("Europe/Warsaw");

// Include the main TCPDF library (search for installation path).
require_once("tcpdf/tcpdf.php");

// Custom Header and Footer
class MYPDF extends TCPDF
{
  //Page header
  public function Header()
  {
    // Logo
    $image_file = K_PATH_IMAGES . 'logo_example.jpg';
    /* $this->Image($image_file, 10, 10, 15, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false); */
    // Set font
    $this->SetFont('helvetica', 'B', 12);
    // Title
    $this->Cell(0, 15, 'PDF wygenerowano: ' . (new DateTime())->format("d-m-Y H:i:s"), 0, false, 'C', 0, '', 0, false, 'M', 'M');
  }

  // Page footer
  public function Footer()
  {
    // Position at 15 mm from bottom
    $this->SetY(-15);
    // Set font
    $this->SetFont('helvetica', 'I', 8);
    // Page number
    $this->Cell(0, 10, 'Page ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
  }

  // Colored table
  public function ColoredTable($header = ["dzień", "temp."], $data = [[1, 2], [3, 4], [4, 5]])
  {
    require "get-data.php";
    $data = [];
    $d = getChartData()[0];
    foreach ($d as $k => $v) {
      if ($v === NULL)
        array_push($data, [$k + 1, "brak pom."]);
      elseif ($v < 0)
        array_push($data, [$k + 1, "choroba"]);
      else
        array_push($data, [$k + 1, $v]);
    }
    // Colors, line width and bold font
    /* $this->SetFillColor(255, 0, 0); */
    /* $this->SetTextColor(255); */
    /* $this->SetDrawColor(128, 0, 0); */
    /* $this->SetLineWidth(0.3); */
    /* $this->SetFont('', 'B'); */
    $this->SetFont('dejavusans', 'B', 10, '', true);
    // Header
    $x = 150;
    $y = 120;
    $w = array(16, 35);
    $this->SetXY($x, $y);
    $num_headers = count($header);

    for ($i = 0; $i < $num_headers; ++$i) {
      $this->Cell($w[$i], 6, $header[$i], 1, 0, 'C', 1);
    }
    $this->Ln();
    $this->SetFont('dejavusans', '', 10, '', true);
    // Color and font restoration
    /* $this->SetFillColor(224, 235, 255); */
    /* $this->SetTextColor(0); */
    /* $this->SetFont('Arial 15'); */
    // Data
    /* $fill = 0; */
    /* $this->SetXY($x, $y + 7); */
    foreach ($data as $key => $row) {
      /* $this->Cell($w[0], 6, $row[0], 'LR', 0, 'L', $fill); */
      //Cell($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=0, $link='', $stretch=0, $ignore_min_height=false, $calign='T', $valign='M')
      /* T : cell top C : center B : cell bottom</li><li>A : font top</li><li>L : font baseline</li><li>D : font bottom */
      $this->SetXY($x, $y + 6 + (5 * $key));
      $this->Cell($w[0], 5, $row[0], 'LRB', align: 'C');
      $this->SetXY($x + $w[0], $y + 6 + (5 * $key));
      $this->Cell($w[1], 5, $row[1], 'LRB', align: 'C');
      /* $this->Cell($w[2], 6, number_format($row[2]), 'LR', 0, 'R', $fill); */
      /* $this->Cell($w[3], 6, $row[3], 'LR', 0, 'R', $fill); */
      $this->Ln();
      /* $fill = !$fill; */
    }
    /* $this->Cell(array_sum($w), 0, '', 'T'); */
  }
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Maksymilian Jopek');
$pdf->SetTitle('Temperature of bb');
$pdf->SetSubject('Temperatures');
$pdf->SetKeywords('temperatures, women, chart, table');

// set default header data
/* $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 001', PDF_HEADER_STRING, array(0, 64, 255), array(0, 64, 128)); */
/* $pdf->setFooterData(array(0, 64, 0), array(0, 64, 128)); */

// set header and footer fonts
/* $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN)); */
/* $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA)); */

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->SetFont('dejavusans', '', 14, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();

// set text shadow effect
$pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));

// Set some content to print
/* <div style="width: 5px; height: 5px; border-radius: 100%; background-color: red;">\2022</div> - Choroba<br> */
$html = <<<EOD
Legenda:<br>
&nbsp;&nbsp; - Choroba<br>
&nbsp;&nbsp; - Brak pomiaru
EOD;

// Print text using writeHTMLCell()
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
$pdf->Image('@' . `php ./generate-chart.php`, x: 5, y: 10, w: 200, h: 100, type: "PNG");

/* include "generate-png.php"; */

/* $pdf->Image('@' . genPng(), x: 5, y: 10, w: 300, h: 150, type: "PNG"); */
// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)
$pdf->writeHTMLCell(w: 0, h: 0, x: 10, y: 120, html: $html, ln: 0, align: 'L');

$pdf->writeHTMLCell(w: 0, h: 0, x: 120, y: 120, html: "Pomiary:", ln: 1, align: '');
$pdf->ColoredTable();

$pdf->Circle(12.5, 135.6, 2, style: 'F', fill_color: array(255, 0, 0));
$pdf->Circle(12.5, 129.6, 2, style: 'F', fill_color: array(100, 100, 100));

// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('bb-temperatures.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
