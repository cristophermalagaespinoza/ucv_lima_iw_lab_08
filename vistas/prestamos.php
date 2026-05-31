<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Préstamos - Biblioteca Digital</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>

<h1>Gestión de Préstamos</h1>

<nav>
    <a href="index.php?pagina=libros">Libros</a> |
    <a href="index.php?pagina=usuarios">Usuarios</a> |
    <a href="index.php?pagina=prestamos">Préstamos</a> |
    <a href="index.php?pagina=consultas">Consultas de negocio</a>
</nav>

<p><?php echo $mensaje; ?></p>

<h2>
    <?php echo $prestamoEditar ? 'Editar préstamo' : 'Registrar préstamo'; ?>
</h2>

<form method="POST">
    <input type="hidden" name="accion" value="<?php echo $prestamoEditar ? 'actualizar' : 'registrar'; ?>">
    <input type="hidden" name="id" value="<?php echo $prestamoEditar['id'] ?? ''; ?>">

    <select name="id_libro">
        <option value="">Seleccione libro</option>
        <?php foreach ($libros as $libro): ?>
            <option value="<?php echo $libro['id']; ?>"
                <?php echo (($prestamoEditar['id_libro'] ?? '') == $libro['id']) ? 'selected' : ''; ?>>
                <?php echo $libro['titulo']; ?>
            </option>
        <?php endforeach; ?>
    </select>

    <select name="id_usuario">
        <option value="">Seleccione usuario</option>
        <?php foreach ($usuarios as $usuario): ?>
            <option value="<?php echo $usuario['id']; ?>"
                <?php echo (($prestamoEditar['id_usuario'] ?? '') == $usuario['id']) ? 'selected' : ''; ?>>
                <?php echo $usuario['nombre']; ?>
            </option>
        <?php endforeach; ?>
    </select>

    <input 
        type="date" 
        name="fecha_inicio"
        value="<?php echo $prestamoEditar['fecha_inicio'] ?? ''; ?>"
    >

    <input 
        type="date" 
        name="fecha_fin"
        value="<?php echo $prestamoEditar['fecha_fin'] ?? ''; ?>"
    >

    <button type="submit">
        <?php echo $prestamoEditar ? 'Actualizar préstamo' : 'Registrar préstamo'; ?>
    </button>

    <?php if ($prestamoEditar): ?>
        <a href="index.php?pagina=prestamos">Cancelar</a>
    <?php endif; ?>
</form>

<h2>Listado de préstamos relacionados</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Libro</th>
        <th>Autor</th>
        <th>Categoría</th>
        <th>Usuario</th>
        <th>Correo</th>
        <th>Membresía</th>
        <th>Fecha inicio</th>
        <th>Fecha fin</th>
        <th>Acciones</th>
    </tr>

    <?php foreach ($prestamos as $p): ?>
        <tr>
            <td><?php echo $p['id']; ?></td>
            <td><?php echo $p['libro']; ?></td>
            <td><?php echo $p['autor']; ?></td>
            <td><?php echo $p['categoria']; ?></td>
            <td><?php echo $p['usuario']; ?></td>
            <td><?php echo $p['correo']; ?></td>
            <td><?php echo $p['membresia']; ?></td>
            <td><?php echo $p['fecha_inicio']; ?></td>
            <td><?php echo $p['fecha_fin']; ?></td>
            <td>
                <a href="index.php?pagina=prestamos&editar=<?php echo $p['id']; ?>">
                    Editar
                </a>
                |
                <a 
                    href="index.php?pagina=prestamos&eliminar=<?php echo $p['id']; ?>"
                    onclick="return confirm('¿Está seguro de eliminar este préstamo?');"
                >
                    Eliminar
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

</body>
</html>