<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once __DIR__ . '/../modelos/Prestamo.php';
require_once __DIR__ . '/../modelos/Usuario.php';
require_once __DIR__ . '/../modelos/Libro.php';

$prestamoModel = new Prestamo();
$usuarioModel = new Usuario();
$libroModel = new Libro();

$prestamosRelacionados = $prestamoModel->listarRelacionado();
$usuariosOrdenados = $usuarioModel->listarOrdenadosPorPrestamos();

$resultadoFechas = [];
$resultadoCategorias = [];

if (isset($_GET['buscar_fechas'])) {
    $desde = $_GET['desde'] ?? '';
    $hasta = $_GET['hasta'] ?? '';

    if ($desde != "" && $hasta != "") {
        $resultadoFechas = $prestamoModel->buscarPorFechas($desde, $hasta);
    }
}

if (isset($_GET['filtrar_categorias'])) {
    $categorias = $_GET['categorias'] ?? [];

    if (!empty($categorias)) {
        $resultadoCategorias = $libroModel->filtrarPorCategorias($categorias);
    }
}

include __DIR__ . '/../vistas/consultas.php';