<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once __DIR__ . '/../modelos/Prestamo.php';
require_once __DIR__ . '/../modelos/Libro.php';
require_once __DIR__ . '/../modelos/Usuario.php';

$prestamoModel = new Prestamo();
$libroModel = new Libro();
$usuarioModel = new Usuario();

$mensaje = "";
$prestamoEditar = null;

/* ELIMINAR PRÉSTAMO */
if (isset($_GET['eliminar'])) {
    $id = intval($_GET['eliminar']);

    try {
        $prestamoModel->eliminar($id);
        $mensaje = "Préstamo eliminado correctamente.";
    } catch (PDOException $e) {
        $mensaje = "No se pudo eliminar el préstamo.";
    }
}

/* CARGAR DATOS PARA EDITAR */
if (isset($_GET['editar'])) {
    $id = intval($_GET['editar']);
    $prestamoEditar = $prestamoModel->obtenerPorId($id);
}

/* REGISTRAR O ACTUALIZAR PRÉSTAMO */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accion = $_POST['accion'] ?? 'registrar';
    $id = intval($_POST['id'] ?? 0);
    $id_libro = intval($_POST['id_libro'] ?? 0);
    $id_usuario = intval($_POST['id_usuario'] ?? 0);
    $fecha_inicio = $_POST['fecha_inicio'] ?? '';
    $fecha_fin = $_POST['fecha_fin'] ?? '';

    if ($id_libro <= 0 || $id_usuario <= 0 || $fecha_inicio == "" || $fecha_fin == "") {
        $mensaje = "Debe completar todos los datos del préstamo.";
    } elseif ($fecha_fin < $fecha_inicio) {
        $mensaje = "La fecha final no puede ser menor que la fecha de inicio.";
    } else {
        if ($accion == 'actualizar' && $id > 0) {
            $prestamoModel->actualizar($id, $id_libro, $id_usuario, $fecha_inicio, $fecha_fin);
            $mensaje = "Préstamo actualizado correctamente.";
            $prestamoEditar = null;
        } else {
            $prestamoModel->registrar($id_libro, $id_usuario, $fecha_inicio, $fecha_fin);
            $mensaje = "Préstamo registrado correctamente.";
        }
    }
}

$libros = $libroModel->listar();
$usuarios = $usuarioModel->listar();
$prestamos = $prestamoModel->listarRelacionado();

include __DIR__ . '/../vistas/prestamos.php';