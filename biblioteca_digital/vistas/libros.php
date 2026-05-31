<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Biblioteca Digital - Libros</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>

<h1>Sistema de Gestión de Biblioteca Digital</h1>

<nav>
    <a href="index.php?pagina=libros">Libros</a>
    <a href="index.php?pagina=prestamos">Préstamos</a>
    <a href="index.php?pagina=consultas">Consultas de negocio</a>
</nav>

<h2>Registrar libro</h2>

<p><?php echo $mensaje; ?></p>

<form method="POST">
    <input type="text" name="titulo" placeholder="Título del libro">
    <input type="text" name="autor" placeholder="Autor">
    <input type="number" name="anio" placeholder="Año">
    <input type="text" name="categoria" placeholder="Categoría">
    <button type="submit">Registrar</button>
</form>

<h2>Listado de libros</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Título</th>
        <th>Autor</th>
        <th>Año</th>
        <th>Categoría</th>
    </tr>

    <?php foreach ($libros as $libro): ?>
    <tr>
        <td><?php echo $libro['id']; ?></td>
        <td><?php echo $libro['titulo']; ?></td>
        <td><?php echo $libro['autor']; ?></td>
        <td><?php echo $libro['anio']; ?></td>
        <td><?php echo $libro['categoria']; ?></td>
    </tr>
    <?php endforeach; ?>
</table>

</body>
</html>