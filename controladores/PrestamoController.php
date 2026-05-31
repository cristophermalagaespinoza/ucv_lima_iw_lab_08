<?php
require_once __DIR__ . '/../modelos/Prestamo.php';
require_once __DIR__ . '/../modelos/Libro.php';
require_once __DIR__ . '/../modelos/Usuario.php';

$prestamoModel = new Prestamo();
$libroModel = new Libro();
$usuarioModel = new Usuario();

$mensaje = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_libro = intval($_POST['id_libro']);
    $id_usuario = intval($_POST['id_usuario']);
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];

    if ($id_libro <= 0 || $id_usuario <= 0 || $fecha_inicio == "" || $fecha_fin == "") {
        $mensaje = "Debe completar todos los datos del préstamo.";
    } elseif ($fecha_fin < $fecha_inicio) {
        $mensaje = "La fecha final no puede ser menor que la fecha de inicio.";
    } else {
        $prestamoModel->registrar($id_libro, $id_usuario, $fecha_inicio, $fecha_fin);
        $mensaje = "Préstamo registrado correctamente.";
    }
}

$libros = $libroModel->listar();
$usuarios = $usuarioModel->listar();
$prestamos = $prestamoModel->listarRelacionado();

include __DIR__ . '/../vistas/prestamos.php';