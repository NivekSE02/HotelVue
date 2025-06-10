<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

$conexion = new mysqli("localhost", "root", "", "clienteshotel");

if ($conexion->connect_error) {
    http_response_code(500);
    echo json_encode(["mensaje" => "Error de conexión"]);
    exit;
}

$tipo = $_GET['tipo'] ?? '';
if (empty($tipo)) {
    http_response_code(400);
    echo json_encode(["mensaje" => "Tipo no especificado"]);
    exit;
}

$sql = "
    SELECT h.id AS habitacion_id
    FROM habitaciones h
    JOIN tipos_habitacion th ON h.tipo_id = th.id
    WHERE th.nombre = ?
    AND h.id NOT IN (SELECT habitacion_id FROM reservas)
    LIMIT 1
";

$stmt = $conexion->prepare($sql);
$stmt->bind_param("s", $tipo);
$stmt->execute();
$resultado = $stmt->get_result();
$fila = $resultado->fetch_assoc();

echo json_encode([
    "habitacion_id" => $fila["habitacion_id"] ?? null
]);

$conexion->close();
?>
