<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once __DIR__ . '/../modelos/Libro.php';

$libroModel = new Libro();
$mensaje = "";
$libroEditar = null;

/* ELIMINAR LIBRO */
if (isset($_GET['eliminar'])) {
    $id = intval($_GET['eliminar']);

    try {
        $libroModel->eliminar($id);
        $mensaje = "Libro eliminado correctamente.";
    } catch (PDOException $e) {
        $mensaje = "No se puede eliminar el libro porque está relacionado con un préstamo.";
    }
}

/* CARGAR DATOS PARA EDITAR */
if (isset($_GET['editar'])) {
    $id = intval($_GET['editar']);
    $libroEditar = $libroModel->obtenerPorId($id);
}

/* REGISTRAR O ACTUALIZAR LIBRO */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accion = $_POST['accion'] ?? 'registrar';
    $id = intval($_POST['id'] ?? 0);
    $titulo = trim($_POST['titulo'] ?? '');
    $autor = trim($_POST['autor'] ?? '');
    $anio = intval($_POST['anio'] ?? 0);
    $categoria = trim($_POST['categoria'] ?? '');

    if ($titulo == "" || $autor == "" || $categoria == "") {
        $mensaje = "Todos los campos son obligatorios.";
    } elseif ($anio < 1500 || $anio > date("Y")) {
        $mensaje = "El año del libro no es válido.";
    } else {
        if ($accion == 'actualizar' && $id > 0) {
            $libroModel->actualizar($id, $titulo, $autor, $anio, $categoria);
            $mensaje = "Libro actualizado correctamente.";
            $libroEditar = null;
        } else {
            $libroModel->registrar($titulo, $autor, $anio, $categoria);
            $mensaje = "Libro registrado correctamente.";
        }
    }
}

$libros = $libroModel->listar();

include __DIR__ . '/../vistas/libros.php';