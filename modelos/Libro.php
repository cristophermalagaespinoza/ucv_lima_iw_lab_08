<?php

require_once __DIR__ . '/../config/conexion.php';

class Libro {
    private $db;

    public function __construct() {
        $this->db = Conexion::conectar();
    }

    public function registrar($titulo, $autor, $anio, $categoria) {
        $sql = "INSERT INTO libro (titulo, autor, anio, categoria)
                VALUES (?, ?, ?, ?)";

        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$titulo, $autor, $anio, $categoria]);
    }

    public function listar() {
        $sql = "SELECT * FROM libro ORDER BY id DESC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerPorId($id) {
        $sql = "SELECT * FROM libro WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizar($id, $titulo, $autor, $anio, $categoria) {
        $sql = "UPDATE libro
                SET titulo = ?, autor = ?, anio = ?, categoria = ?
                WHERE id = ?";

        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$titulo, $autor, $anio, $categoria, $id]);
    }

    public function eliminar($id) {
        $sql = "DELETE FROM libro WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$id]);
    }

    public function filtrarPorCategorias($categorias) {
        $placeholders = implode(',', array_fill(0, count($categorias), '?'));

        $sql = "SELECT * FROM libro
                WHERE categoria IN ($placeholders)
                ORDER BY titulo ASC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute($categorias);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}