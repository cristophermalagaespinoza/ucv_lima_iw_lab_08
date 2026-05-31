<?php

require_once __DIR__ . '/../config/conexion.php';

class Usuario {
    private $db;

    public function __construct() {
        $this->db = Conexion::conectar();
    }

    public function registrar($nombre, $correo, $membresia) {
        $sql = "INSERT INTO usuario (nombre, correo, membresia, prestamos)
                VALUES (?, ?, ?, 0)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$nombre, $correo, $membresia]);
    }

    public function listar() {
        $sql = "SELECT * FROM usuario ORDER BY id DESC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerPorId($id) {
        $sql = "SELECT * FROM usuario WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizar($id, $nombre, $correo, $membresia) {
        $sql = "UPDATE usuario
                SET nombre = ?, correo = ?, membresia = ?
                WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$nombre, $correo, $membresia, $id]);
    }

    public function eliminar($id) {
        $sql = "DELETE FROM usuario WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$id]);
    }

    public function listarOrdenadosPorPrestamos() {
        $sql = "SELECT * FROM usuario ORDER BY prestamos DESC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}