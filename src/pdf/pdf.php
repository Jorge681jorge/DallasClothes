<?php
require('pdf/fpdf.php');

class PDF extends FPDF
{
    // Cabecera de página
    function Header()
    {
        // Logo
        $this->Image('img/sell.png', 10, 8, 30);
        // Arial bold 15
        $this->SetFillColor(000000); //Fondo verde de celda
        $this->SetTextColor(240, 255, 240); //Letra color blanco
        $this->SetFont('Helvetica', 'B', 25);

        // Movernos a la derecha
        $this->Cell(35);
        // Título
        $this->Cell(155, 30, "Dalla's Clothes", 0, 0, 'C', true);

        // Salto de línea
        $this->Ln(35);
    }
    // Pie de página
    function Footer()
    {
        $this->SetFillColor(000000); //Fondo de celda
        $this->SetTextColor(240, 255, 240); //Letra color
        $this->SetFont('Helvetica', 'B', 25);

        // Posición: a 2,5 cm del final
        $this->SetY(-25);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 15);
        // Movernos a la derecha
        $this->Cell(-15);
        // Título
        $this->Cell(220, 25, "Dalla's clothes", 0, 0, 'C', true);
    }

    // Una tabla más completa
    function ImprovedTable($idF)
    {
        $this->SetFont('Arial','B',14); 
        $this->Cell(0, 10, 'PRODUCTOS ADQUIRIDOS', 0, 0, 'C');
        $this->Ln();
        // Anchuras de las columnas
        $w = array(53, 43, 47, 47);
        // Cabeceras
        $this->Cell($w[0], 7, "Nombre", 1, 0, 'C');
        $this->Cell($w[1], 7, "Cantidad", 1, 0, 'C');
        $this->Cell($w[2], 7, "Precio unidad", 1, 0, 'C');
        $this->Cell($w[3], 7, "Precio total", 1, 0, 'C');
        $this->Ln();
        // Datos
        $this->SetFont('Arial','',14); 
        $fac = new Factura($idF);
        $fac ->consultarLog();
        $prods = new FacturaProducto("", "", "", $fac->getIdFactura(),"");
        $arreg = $prods ->consultarTodos();
        foreach($arreg as $prod){
            $pd = new Producto($prod->getIdProducto());
            $pd->consultar();
            $this->Cell($w[0], 6, strtoupper($pd->getNombre()), 'LR');
            $this->Cell($w[1], 6, $prod->getCantidad(), 'LR');
            $this->Cell($w[2], 6, $pd->getPrecio(), 'LR', 0, 'R');
            $this->Cell($w[3], 6, $prod->getPrecio(), 'LR', 0, 'R');
            $this->Ln();
        }
        // Línea de cierre
        $this->Cell(array_sum($w), 0, '', 'T');
        $this->Ln();
        $this->Cell(0, 8, 'Total de la compra= $'.$fac->getValor(), 0, 0, 'R');
        $this->Ln();
    }

    function ChapterBody($idC,$idF)
    {
        $cli = new Cliente($idC);
        $cli->consultar();
        $fac = new Factura($idF);
        $fac ->consultarLog();
        $this->Cell(95, 7, "Factura: ".$fac->getIdFactura(), 1, 0, 'L');
        $this->Cell(95, 7, "Fecha: ".$fac->getFecha(), 1, 1, 'L');
        $this->Ln();
        $this->Cell(0, 8, 'Cliente = '.$cli->getNombre()." ".$cli->getApellido(), 1, 0, 'L');
        $this->Ln();
        $this->Cell(0, 8, 'Correo = '.$cli->getCorreo(), 1, 0, 'L');
        $this->Ln();
        $this->Ln();
    }
    function generar($idF,$idC)
    {
        $pdf = new PDF();
        $pdf->SetFont('Arial', '', 14);
        $pdf->AddPage();
        $pdf->ChapterBody($idC,$idF);
        $pdf->ImprovedTable($idF);
        $pdf->Output('factura.pdf', 'F');
    }
}
