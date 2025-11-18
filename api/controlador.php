<?php
require_once 'modelo.php';

class ControladorTareas {

    public function listar() {
        return obtenerTareas();
    }

    public function crear($titulo) {
        crearTarea($titulo);
        return ["mensaje" => "Tarea creada"];
    }

    public function actualizar($id, $titulo, $completada) {
        actualizarTarea($id, $titulo, $completada);
        return ["mensaje" => "Tarea actualizada"];
    }

    public function eliminar($id) {
        eliminarTarea($id);
        return ["mensaje" => "Tarea eliminada"];
    }
}
?>
