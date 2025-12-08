<?php

/*---------- Incluyendo configuraciones ----------*/
require_once "../../config/app.php";
require_once "../../autoload.php";


/*---------- Instancia al controlador venta ----------*/
use libraries\pdf\FPDF;


class PDF extends FPDF
{

  // Cabecera de página
  function Header()
  {

    $this->Image('./../../Public/Views/Img/Toyorientelogo.png', 10, 5, 40); //logo de la empresa,moverDerecha,moverAbajo,tamañoIMG
    $this->SetFont('Arial', 'B', 19); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto
    $this->Cell(45); // Movernos a la derecha
    $this->SetTextColor(0, 0, 0); //color
    //creamos una celda o fila
    $this->Cell(110, 15, utf8_decode('TOYORIENTE C.A'), 0, 1, 'C', 0); // AnchoCelda,AltoCelda,titulo,borde(1-0),saltoLinea(1-0),posicion(L-C-R),ColorFondo(1-0)
    $this->Ln(3); // Salto de línea
    $this->SetTextColor(103); //color

    /* UBICACION */
    $this->Cell(10);  // mover a la derecha
    $this->SetFont('Arial', 'B', 10);
    $this->Cell(96, 10, utf8_decode("Ubicación : ANACO"), 0, 0, '', 0);
    $this->Ln(5);

    /* TELEFONO */
    $this->Cell(10);  // mover a la derecha
    $this->SetFont('Arial', 'B', 10);
    $this->Cell(59, 10, utf8_decode("Teléfono : 0282-4255553"), 0, 0, '', 0);
    $this->Ln(5);

    /* COREEO */
    $this->Cell(10);  // mover a la derecha
    $this->SetFont('Arial', 'B', 10);
    $this->Cell(85, 10, utf8_decode("Correo : INFO@TOYORIENTE.COM "), 0, 0, '', 0);
    $this->Ln(5);

    /* TELEFONO */
    $this->Cell(10);  // mover a la derecha
    $this->SetFont('Arial', 'B', 10);
    $this->Cell(85, 10, utf8_decode("Sucursal : 0282-4255553"), 0, 0, '', 0);
    $this->Ln(10);

    $this->SetTextColor(0, 0, 0);
    $this->Cell(10);  // mover a la derecha
    $this->SetFont('Arial', 'B', 10);
    $this->Cell(85, 10, utf8_decode("Revisado por:_______________    Firma:_____________"), 0, 0, 'R', 0);
    $this->Ln(0);

    $this->SetTextColor(0, 0, 0);
    $this->Cell(100);  // mover a la derecha
    $this->SetFont('Arial', 'B', 10);
    $this->Cell(85, 10, utf8_decode(" Verificado por:____________    Firma:_____________ "), 0, 1, 'R', 0);
    $this->Ln(5);




    /* TITULO DE LA TABLA */
    //color
    $this->SetTextColor(0, 0, 0);
    $this->Cell(50); // mover a la derecha
    $this->SetFont('Arial', 'B', 15);
    $this->Cell(100, 10, utf8_decode("HERRAMIENTAS ESPECIALES"), 0, 1, 'C', 0);
    $this->Ln(7);

    /* CAMPOS DE LA TABLA */
    //color
    $this->SetFillColor(33, 37, 41); //colorFondo
    $this->SetTextColor(255, 255, 255); //colorTexto
    $this->SetDrawColor(163, 163, 163); //colorBorde
    $this->SetFont('Arial', 'B', 10);
    $this->Cell(10, 10, utf8_decode('CAT.'), 1, 0, 'C', 1);
    $this->Cell(50, 10, utf8_decode('NOMBRE(SST)'), 1, 0, 'C', 1);
    $this->Cell(20, 10, utf8_decode('N.PARTE'), 1, 0, 'C', 1);
    $this->Cell(15, 10, utf8_decode('DISP'), 1, 0, 'C', 1);
    $this->Cell(30, 10, utf8_decode('IMAGEN'), 1, 0, 'C', 1);
    $this->Cell(65, 10, utf8_decode('DESCRIPCION'), 1, 1, 'C', 1);
  }

  // Pie de página
  function Footer()
  {
    $this->SetY(-15); // Posición: a 1,5 cm del final
    $this->SetFont('Arial', 'I', 8); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto
    $this->Cell(0, 10,  iconv('UTF-8', 'ISO-8859-1', 'Página '). $this->PageNo() . '/{nb}', 0, 0, 'C'); //pie de pagina(numero de pagina)

    $this->SetY(-15); // Posición: a 1,5 cm del final
    $this->SetFont('Arial', 'I', 8); //tipo fuente, cursiva, tamañoTexto
    $hoy = date('d/m/Y');
    $this->Cell(355, 10, iconv('UTF-8', 'ISO-8859-1', $hoy), 0, 0, 'C'); // pie de pagina(fecha de pagina)
  }
}

$pdf = new PDF();
$pdf->SetFont('Arial', '', 8);
$pdf->SetDrawColor(163, 163, 163); //colorBorde

$field2cat = "prueba";
$field3sst = "prueba";
$field4npart = "prueba";
$field5img = "prueba";
$field6descrip = "prueba";
$field7cant = "prueba";

/* TABLA */
$pdf->Cell(10, 25, iconv('UTF-8', 'ISO-8859-1', $field2cat), 1, 0, 'C', 0);
$pdf->Cell(50, 25, iconv('UTF-8', 'ISO-8859-1', $field3sst), 1, 0, 'C', 0);
$pdf->Cell(20, 25, iconv('UTF-8', 'ISO-8859-1', $field4npart), 1, 0, 'C', 0);
$pdf->Cell(15, 25, iconv('UTF-8', 'ISO-8859-1', $field7cant), 1, 0, 'C', 0);
$pdf->Cell(30, 25, $pdf->Image("../." . $field5img, $D, $pdf->GetY(), 25, 24), 1, 0, 'C');
$pdf->Cell(65, 25, iconv('UTF-8', 'ISO-8859-1', $field6descrip), 1, 1, "C", 0);;

$Reporte_H_Especiales_FV = $pdf->Output('Reporte_HEspeciales_FV.pdf', 'I'); 

unset($pdf);
unset($field2cat);
unset($field3sst);
unset($field4npart);
unset($field5img);
unset($field6descrip);
unset($field7cant);

exit;
?>