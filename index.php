<?php
$pagina = $_GET['pagina'] ?? 'libros';

if ($pagina == 'libros') {
    require_once 'controladores/LibroController.php';
} elseif ($pagina == 'prestamos') {
    require_once 'controladores/PrestamoController.php';
} elseif ($pagina == 'consultas') {
    require_once 'controladores/ConsultaController.php';
} else {
    require_once 'controladores/LibroController.php';
}