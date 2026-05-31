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
    <a href="index.php?pagina=libros">Libros</a>
    <a href="index.php?pagina=prestamos">Préstamos</a>
    <a href="index.php?pagina=consultas">Consultas de negocio</a>
</nav>

<h2>Registrar préstamo</h2>

<p><?php echo $mensaje; ?></p>

<form method="POST">
    <select name="id_libro">
        <option value="">Seleccione libro</option>
        <?php foreach ($libros as $libro): ?>
            <option value="<?php echo $libro['id']; ?>">
                <?php echo $libro['titulo']; ?>
            </option>
        <?php endforeach; ?>
    </select>

    <select name="id_usuario">
        <option value="">Seleccione usuario</option>
        <?php foreach ($usuarios as $usuario): ?>
            <option value="<?php echo $usuario['id']; ?>">
                <?php echo $usuario['nombre']; ?>
            </option>
        <?php endforeach; ?>
    </select>

    <input type="date" name="fecha_inicio">
    <input type="date" name="fecha_fin">

    <button type="submit">Registrar préstamo</button>
</form>

<h2>Préstamos registrados</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Libro</th>
        <th>Usuario</th>
        <th>Fecha inicio</th>
        <th>Fecha fin</th>
    </tr>

    <?php foreach ($prestamos as $p): ?>
    <tr>
        <td><?php echo $p['id']; ?></td>
        <td><?php echo $p['libro']; ?></td>
        <td><?php echo $p['usuario']; ?></td>
        <td><?php echo $p['fecha_inicio']; ?></td>
        <td><?php echo $p['fecha_fin']; ?></td>
    </tr>
    <?php endforeach; ?>
</table>

</body>
</html>