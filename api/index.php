<?php
// Esto permite solicitudes desde otros dominios (el frontend)
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");
header("Content-Type: application/json");

require_once 'controlador.php';

$controlador = new ControladorTareas();
$metodo = $_SERVER['REQUEST_METHOD'];

switch ($metodo) {

    case 'GET':
        $tareas = $controlador->listar();
        echo json_encode($tareas);
        break;

    case 'POST':
        $datos = json_decode(file_get_contents('php://input'), true);
        echo json_encode(
            $controlador->crear($datos['titulo'])
        );
        break;

    case 'PUT':
        $datos = json_decode(file_get_contents('php://input'), true);
        echo json_encode(
            $controlador->actualizar($datos['id'], $datos['titulo'], $datos['completada'])
        );
        break;

    case 'DELETE':
        $datos = json_decode(file_get_contents('php://input'), true);
        echo json_encode(
            $controlador->eliminar($datos['id'])
        );
        break;

    default:
        echo json_encode(['mensaje' => 'Método no permitido']);
        break;
}
?>
