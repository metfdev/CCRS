<?php

/*---------- Incluyendo configuraciones ----------*/
require_once "../../config/app.php";
require_once "../../autoload.php";

namespace App\Controllers;


use App\Models\cotizacionModel;


class PDF extends FPDF
{
  public function exportarCotizacion()
  {
    $idCotizacion = $_POST['id_cotizacion'];

    $cotizacionModel = new cotizacionModel();

    $cotizacionModel = $cotizacionModel->getDetallesCotizacionModel($idCotizacion);

    $solicitante = $cotizacionModel[0]['id_users'];
    $fecha = $cotizacionModel[0]['fecha'];
    $departamento = $cotizacionModel[0]['departamento'];
    $cliente = $cotizacionModel[0]['nombre_cliente'];
    $modelo = $cotizacionModel[0]['modelo_carro'];
    $ano = $cotizacionModel[0]['ano_carro'];
    $placa = $cotizacionModel[0]['placa_carro'];
    $vin = $cotizacionModel[0]['vin_carro'];
    $repuestos = $cotizacionModel[0]['data_repuestos'];
    $notas = $cotizacionModel[0]['nota'];


    // Crear una nueva instancia de FPDF
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 16);

    // Título del PDF
    $pdf->Cell(0, 10, 'Cotizacion #' . $idCotizacion, 0, 1, 'C');
    $pdf->Ln(10);

    // Información de la cotización
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, 'Solicitante: ' . $solicitante, 0, 1);
    $pdf->Cell(0, 10, 'Fecha: ' . $fecha, 0, 1);
    $pdf->Cell(0, 10, 'Departamento: ' . $departamento, 0, 1);
    $pdf->Ln(5);

    // Datos del cliente y vehículo
    $pdf->Cell(0, 10, 'Cliente: ' . $cliente, 0, 1);
    $pdf->Cell(0, 10, 'Modelo: ' . $modelo, 0, 1);
    $pdf->Cell(0, 10, 'Ano: ' . $ano, 0, 1);
    $pdf->Cell(0, 10, 'Placa: ' . $placa, 0, 1);
    $pdf->Cell(0, 10, 'VIN: ' . $vin, 0, 1);
    $pdf->Ln(5);

    // Tabla de repuestos y montos
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(40, 10, 'Nro. Parte', 1);
    $pdf->Cell(60, 10, 'Nombre', 1);
    $pdf->Cell(30, 10, 'Cantidad', 1);
    $pdf->Cell(30, 10, 'Monto', 1);
    $pdf->Ln();

    $pdf->SetFont('Arial', '', 12);
    foreach ($repuestos as $dataRepuesto) {
        $pdf->Cell(40, 10, $dataRepuesto['nroParte'], 1);
        $pdf->Cell(60, 10, $dataRepuesto['nombre'], 1); // Aquí debes agregar el nombre del repuesto si lo tienes
        $pdf->Cell(30, 10, $dataRepuesto['cantidad'], 1); // Aquí debes agregar la cantidad si la tienes
        $pdf->Cell(30, 10, $dataRepuesto['monto'], 1);
        $pdf->Ln();
    }

    // Notas
    $pdf->Ln(10);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0, 10, 'Notas:', 0, 1);
    $pdf->SetFont('Arial', '', 12);
    $pdf->MultiCell(0, 10, $notas, 1);

    // Generar el PDF y enviarlo al navegador
    $pdf->Output('D', 'cotizacion_' . $idCotizacion . '.pdf');
}

}


?>