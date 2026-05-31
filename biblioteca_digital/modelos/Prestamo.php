<?php
require_once __DIR__ . '/../config/conexion.php';

class Prestamo {
    private $db;

    public function __construct() {
        $this->db = Conexion::conectar();
    }

    public function registrar($id_libro, $id_usuario, $fecha_inicio, $fecha_fin) {
        $sql = "INSERT INTO prestamo (id_libro, id_usuario, fecha_inicio, fecha_fin)
                VALUES (?, ?, ?, ?)";

        $stmt = $this->db->prepare($sql);
        $resultado = $stmt->execute([$id_libro, $id_usuario, $fecha_inicio, $fecha_fin]);

        if ($resultado) {
            $sqlUsuario = "UPDATE usuario 
                           SET prestamos = prestamos + 1
                           WHERE id = ?";
            $stmtUsuario = $this->db->prepare($sqlUsuario);
            $stmtUsuario->execute([$id_usuario]);
        }

        return $resultado;
    }

    public function listar() {
        $sql = "SELECT * FROM prestamo ORDER BY id DESC";
        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function listarRelacionado() {
        $sql = "SELECT 
                    p.id,
                    l.titulo AS libro,
                    l.autor,
                    l.categoria,
                    u.nombre AS usuario,
                    u.correo,
                    u.membresia,
                    p.fecha_inicio,
                    p.fecha_fin
                FROM prestamo p
                INNER JOIN libro l ON p.id_libro = l.id
                INNER JOIN usuario u ON p.id_usuario = u.id
                ORDER BY p.fecha_inicio DESC";

        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorFechas($fecha_inicio, $fecha_fin) {
        $sql = "SELECT 
                    p.id,
                    l.titulo AS libro,
                    u.nombre AS usuario,
                    p.fecha_inicio,
                    p.fecha_fin
                FROM prestamo p
                INNER JOIN libro l ON p.id_libro = l.id
                INNER JOIN usuario u ON p.id_usuario = u.id
                WHERE p.fecha_inicio BETWEEN ? AND ?
                ORDER BY p.fecha_inicio ASC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([$fecha_inicio, $fecha_fin]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function actualizar($id, $id_libro, $id_usuario, $fecha_inicio, $fecha_fin) {
        $sql = "UPDATE prestamo 
                SET id_libro = ?, id_usuario = ?, fecha_inicio = ?, fecha_fin = ?
                WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$id_libro, $id_usuario, $fecha_inicio, $fecha_fin, $id]);
    }

    public function eliminar($id) {
        $sql = "DELETE FROM prestamo WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$id]);
    }
}