<?php
// Conectar a la base de datos
$host = "localhost";
$user = "root";
$password = "";
$database = "alumnos";
$conexion = new mysqli($host, $user, $password, $database);
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Obtener los datos del formulario HTML
$nombre = $_POST['nombre'];
$curp = $_POST['curp'];
$curso = $_POST['curso'];
$duracion = $_POST['duracion'];

// Insertar los datos en la tabla de la base de datos
$sql = "INSERT INTO datos (nombre, apellido, edad, carrera) VALUES ('$nombre', '$curp', '$curso', '$duracion')";
if ($conexion->query($sql) === FALSE) {
	die("Error al guardar los datos: " . $conexion->error);
}

// Generar el PDF utilizando la plantilla JPG
require('fpdf/fpdf.php');

// datos del formulario
$nombre_alumno = $_POST['nombre'];
$curp_alumno = $_POST['curp'];
$curso = $_POST['curso'];
$duracionc = $_POST['duracion'];

$pdf = new FPDF('L','mm','A4');
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
// Obtener el ancho y alto de la página
$width = $pdf->GetPageWidth();
$height = $pdf->GetPageHeight();

// imagen de la plantilla
$pdf->Image('CONSTANCIA.jpg',0,0,$width, $height);

// ajuste de datos en la plantilla
$pdf->SetXY(80, 70);
$pdf->Cell(40, 10, $nombre_alumno, 0, 0);

$pdf->SetXY(200, 70);
$pdf->Cell(40, 10, $curp_alumno, 0, 0);

$pdf->SetXY(95, 97);
$pdf->Cell(40, 10, $curso, 0, 0);

$pdf->SetXY(217, 97);
$pdf->Cell(40, 10, $duracionc, 0, 0);


$pdf->Output('constancia.pdf', 'D');
?>