<?php
include 'LocalhostConnection.php';

$orderNumber = $_GET['onumber'];
	$query = "SELECT * FROM customerDetails WHERE order_id = ".$orderNumber.";";
$queryOrder = "SELECT o.order_id,p.product_name,o.quantity,o.total_price FROM orderDetails o JOIN products p ON o.product_id = p.product_id WHERE order_id = ".$orderNumber.";";
	$res = mysqli_query($link,$query);
	$res2 = mysqli_query($link,$queryOrder);
//	$rowCount = mysqli_num_rows($res);	
	$cRow = mysqli_fetch_array($res);
	$order = mysqli_fetch_array($res2);
$updateQuery = "UPDATE orderDetails SET status = 'Shipped',date_of_order = current_date() WHERE orderID = ".$cRow['1'].";";
$updateResult = mysqli_query($link,$updateQuery);	
ob_start();
require("fpdf.php");
//require("fpdf.php");
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont("Arial","B",14);
$pdf->Cell(0,10,"Auto Parts Invoice",1,1,'C');
$pdf->SetFont("Arial","B",12);

$pdf->Cell(75,10,"Order ID",1,0,'C');
$pdf->SetFont("Arial","",12);
$pdf->Cell(115,10,$order['0'],1,1,'C');

$pdf->SetFont("Arial","B",12);
$pdf->Cell(75,10,"Product",1,0,'C');
$pdf->SetFont("Arial","",12);
$pdf->Cell(115,10,$order['1'],1,1,'C');

$pdf->SetFont("Arial","B",12);
$pdf->Cell(75,10,"Quantity",1,0,'C');
$pdf->SetFont("Arial","",12);
$pdf->Cell(115,10,$order['2'],1,1,'C');

$pdf->SetFont("Arial","B",12);
$pdf->Cell(75,10,"Amount Paid",1,0,'C');
$pdf->SetFont("Arial","",12);
$pdf->Cell(115,10,"$".$order['3']."",1,1,'C');

$pdf->Cell(75,10,"",'LR',0,'C');
$pdf->Cell(115,10,$cRow['1'],'LR',1,'C');
$pdf->Cell(75,10,"",'LR',0,'C');
$pdf->Cell(115,10,$cRow['2'],'LR',1,'C');
$pdf->SetFont("Arial","B",14);
$pdf->Cell(75,10,"Address:",'LR',0,'C');
$pdf->SetFont("Arial","",12);
$pdf->Cell(115,10,$cRow['3'],'LR',1,'C');
$pdf->Cell(75,10,"",'LR',0,'C');
$pdf->Cell(115,10,$cRow['4'],'LR',1,'C');
$pdf->Cell(75,10,"",'LR',0,'C');
$pdf->Cell(115,10,$cRow['5'],'LR',1,'C');
$pdf->Cell(75,10,"",'LRB',0,'C');
$pdf->Cell(115,10,$cRow['6'],'LRB',1,'C');


$pdf->output();

?>
