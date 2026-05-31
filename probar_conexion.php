<?php

require_once __DIR__ . '/config/conexion.php';

$conexion = Conexion::conectar();

if ($conexion) {
    echo "Conexión correcta a la base de datos biblioteca_digital";
}