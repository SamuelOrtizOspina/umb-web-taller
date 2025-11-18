<?php
require_once 'db.php';

// CREATE (Crear)
function crearTarea($titulo) {
    global $conexion;
    // Usar htmlspecialchars para prevenir XSS
    $titulo_seguro = htmlspecialchars($titulo);
    $sql = "INSERT INTO tareas (titulo) VALUES ('$titulo_seguro')";
    mysqli_query($conexion, $sql);
}

// READ (Leer)
function obtenerTareas() {
    global $conexion;
    $sql = "SELECT * FROM tareas";
    $resultado = mysqli_query($conexion, $sql);
    $tareas = [];
    while ($fila = mysqli_fetch_assoc($resultado)) {
        $tareas[] = $fila;
    }
    return $tareas;
}

// UPDATE (Actualizar)
function actualizarTarea($id, $titulo, $completada) {
    global $conexion;
    $titulo_seguro = htmlspecialchars($titulo);
    $comp = $completada ? 1 : 0;

    $sql = "UPDATE tareas 
            SET titulo = '$titulo_seguro', completada = $comp 
            WHERE id = $id";

    mysqli_query($conexion, $sql);
}

// DELETE (Eliminar)
function eliminarTarea($id) {
    global $conexion;
    $sql = "DELETE FROM tareas WHERE id = $id";
    mysqli_query($conexion, $sql);
}
?>
