<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once __DIR__ . '/../modelos/Usuario.php';

$usuarioModel = new Usuario();
$mensaje = "";
$usuarioEditar = null;

/* ELIMINAR USUARIO */
if (isset($_GET['eliminar'])) {
    $id = intval($_GET['eliminar']);

    try {
        $usuarioModel->eliminar($id);
        $mensaje = "Usuario eliminado correctamente.";
    } catch (PDOException $e) {
        $mensaje = "No se puede eliminar el usuario porque tiene préstamos registrados.";
    }
}

/* CARGAR DATOS PARA EDITAR */
if (isset($_GET['editar'])) {
    $id = intval($_GET['editar']);
    $usuarioEditar = $usuarioModel->obtenerPorId($id);
}

/* REGISTRAR O ACTUALIZAR USUARIO */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accion = $_POST['accion'] ?? 'registrar';
    $id = intval($_POST['id'] ?? 0);
    $nombre = trim($_POST['nombre'] ?? '');
    $correo = trim($_POST['correo'] ?? '');
    $membresia = trim($_POST['membresia'] ?? '');

    if ($nombre == "" || $correo == "" || $membresia == "") {
        $mensaje = "Todos los campos son obligatorios.";
    } elseif (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        $mensaje = "El correo ingresado no es válido.";
    } else {
        try {
            if ($accion == 'actualizar' && $id > 0) {
                $usuarioModel->actualizar($id, $nombre, $correo, $membresia);
                $mensaje = "Usuario actualizado correctamente.";
                $usuarioEditar = null;
            } else {
                $usuarioModel->registrar($nombre, $correo, $membresia);
                $mensaje = "Usuario registrado correctamente.";
            }
        } catch (PDOException $e) {
            $mensaje = "No se pudo guardar el usuario. Verifique que el correo no esté repetido.";
        }
    }
}

$usuarios = $usuarioModel->listar();

include __DIR__ . '/../vistas/usuarios.php';