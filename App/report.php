<?php
	include 'reportePlantilla.php';
	require 'conexion.php';
	$sql=$misqli->query("SELECT * FROM orden " );

	
	$pdf = new PDF();
	$pdf->AliasNbPages();
	$pdf->AddPage();
	
	$pdf->SetFillColor(232,232,232);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(10,6,'#',1,0,'C',1);
	$pdf->Cell(50,6,'Pedido',1,0,'C',1);
	$pdf->Cell(20,6,'Valor',1,0,'C',1);
	$pdf->Cell(40,6,'Inicio',1,0,'C',1);
	$pdf->Cell(30,6,'Entrega',1,0,'C',1);
	$pdf->Cell(30,6,'Estado',1,1,'C',1);
	
	
	$pdf->SetFont('Arial','',10);
	
	while($row = $sql->fetch_assoc() )
	{
		$pdf->Cell(10,6,$row['id'] ,1,0,'C',1);
		$pdf->Cell(50,6, $row['nombre_orden'] ,1,0,'C',1);
		$pdf->Cell(20,6,"$ ". $row['valor_orden'] ,1,0,'C',1);
		$pdf->Cell(40,6, $row['fecha_orden'],1,0,'C',1);
		$pdf->Cell(30,6, $row['fecha_entrega_orden'],1,0,'C',1);
		if($row['estado'] == 0)
		{
			$pdf->Cell(30,6, "Pendiente",1,1,'C',1);
		}else
		{
			$pdf->Cell(30,6, "Exitoso",1,1,'C',1);
		}
	}
	$pdf->Output();
?>