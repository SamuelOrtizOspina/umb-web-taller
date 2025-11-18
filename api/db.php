<?php
// Conexión a MySQL en Railway
$conexion = mysqli_connect(
    "yamabiko.proxy.rlwy.net", // HOST
    "root",                    // USER
    "bLYphGfChqLdVOMqocBxXVtJuLGokFAR", // PASSWORD
    "railway",                 // DATABASE
    48601                      // PORT
);

// Validación de conexión
if (mysqli_connect_errno()) {
    echo "Error al conectar a MySQL: " . mysqli_connect_error();
    exit();
}

// Nota: mysql_ está obsoleto. Aquí usamos mysqli_ que es la versión actual.
?>
