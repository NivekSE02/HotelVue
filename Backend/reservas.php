<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type");
// Permitir solicitudes OPTIONS (preflight)
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}
$datos = json_decode(file_get_contents("php://input"));
error_log(print_r($datos, true));

$conexion = new mysqli("localhost", "root", "", "clienteshotel");
if ($conexion->connect_error) {
    http_response_code(500);
    echo json_encode(["mensaje" => "Error de conexión"]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Si viene ?tipo=XYZ, entonces buscar habitación libre
    if (isset($_GET['tipo'])) {
        $tipo = $conexion->real_escape_string($_GET['tipo']);
        $sql = "
            SELECT h.id AS habitacion_id
            FROM habitaciones h
            JOIN tipos_habitacion th ON h.tipo_id = th.id
            WHERE th.nombre = '$tipo'
              AND h.id NOT IN (SELECT habitacion_id FROM reservas WHERE estado = 'activa')
            LIMIT 1
        ";
        $resultado = $conexion->query($sql);
        $fila = $resultado->fetch_assoc();

        echo json_encode([
            "habitacion_id" => $fila ? $fila['habitacion_id'] : null
        ]);
        exit;
    }

    // Si no viene ?tipo=..., devolvemos el resumen por tipo
    $sql = "
        SELECT th.nombre AS tipo_nombre, COUNT(*) AS reservas_activas
        FROM reservas r
        JOIN habitaciones h ON r.habitacion_id = h.id
        JOIN tipos_habitacion th ON h.tipo_id = th.id
        GROUP BY th.nombre
    ";
    $resultado = $conexion->query($sql);
    $respuesta = [];
    while ($row = $resultado->fetch_assoc()) {
        $respuesta[] = $row;
    }
    echo json_encode($respuesta);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $datos = json_decode(file_get_contents("php://input"));

    if (!isset($datos->habitacion_id, $datos->cliente_nombre, $datos->cliente_correo)) {
        http_response_code(400);
        echo json_encode(["mensaje" => "Datos incompletos"]);
        exit;
    }

    $habitacion_id = intval($datos->habitacion_id);
    $nombre = $datos->cliente_nombre;
    $correo = $datos->cliente_correo;

    if (empty(trim($nombre)) || empty(trim($correo))) {
        http_response_code(400);
        echo json_encode(["mensaje" => "Nombre y correo no pueden estar vacíos"]);
        exit;
    }

   $stmt = $conexion->prepare("INSERT INTO reservas (habitacion_id, nombre_cliente, correo_cliente, fecha_reserva) VALUES (?, ?, ?, CURDATE())");
    if (!$stmt) {
        http_response_code(500);
        echo json_encode(["mensaje" => "Error en la preparación de la consulta"]);
        exit;
    }

    $stmt->bind_param("iss", $habitacion_id, $nombre, $correo);

    try {
       if ($stmt->execute()) {
    echo json_encode(["mensaje" => "Reserva exitosa"]);
} else {
    http_response_code(500);
    echo json_encode(["mensaje" => "Error al guardar reserva: " . $stmt->error]);
    error_log("Error al ejecutar stmt: " . $stmt->error);
}

    } catch (mysqli_sql_exception $e) {
        if (strpos($e->getMessage(), 'No hay más habitaciones disponibles de este tipo') !== false) {
            http_response_code(409);
            echo json_encode(["mensaje" => "No hay más habitaciones disponibles de este tipo"]);
        } else {
            http_response_code(500);
            echo json_encode(["mensaje" => "Error al guardar reserva: " . $e->getMessage()]);
        }
    }

    $stmt->close();
    $conexion->close();
    exit;
}

http_response_code(405);
echo json_encode(["mensaje" => "Método no permitido"]);
