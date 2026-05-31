<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

$pagina = $_GET['pagina'] ?? 'libros';

if ($pagina == 'libros') {
    require_once __DIR__ . '/controladores/LibroController.php';

} elseif ($pagina == 'usuarios') {
    require_once __DIR__ . '/controladores/UsuarioController.php';

} elseif ($pagina == 'prestamos') {
    require_once __DIR__ . '/controladores/PrestamoController.php';

} elseif ($pagina == 'consultas') {
    require_once __DIR__ . '/controladores/ConsultaController.php';

} else {
    require_once __DIR__ . '/controladores/LibroController.php';
}