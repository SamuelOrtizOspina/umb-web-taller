<?php
// CORS para permitir solicitudes del frontend
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

// Responder de inmediato las solicitudes OPTIONS
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

require_once 'controlador.php';

$controlador = new ControladorTareas();
$metodo = $_SERVER['REQUEST_METHOD'];

switch ($metodo) {

    // ----------------------------------------------------
    //               LISTAR TAREAS (GET)
    // ----------------------------------------------------
    case 'GET':
        $tareas = $controlador->listar();
        echo json_encode($tareas);
        break;

    // ----------------------------------------------------
    //               CREAR TAREA (POST)
    // ----------------------------------------------------
    case 'POST':
        $datos = json_decode(file_get_contents('php://input'), true);

        // Validar que llegue "titulo"
        if (!isset($datos['titulo']) || empty(trim($datos['titulo']))) {
            echo json_encode(["error" => "El campo 'titulo' es obligatorio"]);
            break;
        }

        $titulo = trim($datos['titulo']);

        $nueva = $controlador->crear($titulo);
        echo json_encode($nueva);
        break;

    // ----------------------------------------------------
    //               ACTUALIZAR TAREA (PUT)
    // ----------------------------------------------------
    case 'PUT':
        $datos = json_decode(file_get_contents('php://input'), true);

        if (!isset($datos['id']) || !isset($datos['titulo']) || !isset($datos['completada'])) {
            echo json_encode(["error" => "Datos incompletos para actualizar"]);
            break;
        }

        $actualizada = $controlador->actualizar(
            $datos['id'],
            $datos['titulo'],
            $datos['completada']
        );

        echo json_encode($actualizada);
        break;

    // ----------------------------------------------------
    //               ELIMINAR TAREA (DELETE)
    // ----------------------------------------------------
    case 'DELETE':
        $datos = json_decode(file_get_contents('php://input'), true);

        if (!isset($datos['id'])) {
            echo json_encode(["error" => "Falta el id para eliminar"]);
            break;
        }

        $eliminada = $controlador->eliminar($datos['id']);
        echo json_encode($eliminada);
        break;

    // ----------------------------------------------------
    //               DEFAULT
    // ----------------------------------------------------
    default:
        echo json_encode(["error" => "Método no permitido"]);
        break;
}
?>
