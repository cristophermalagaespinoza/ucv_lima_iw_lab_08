<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Consultas de Negocio - Biblioteca Digital</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>

<h1>Consultas de Negocio - Biblioteca Digital</h1>

<nav>
    <a href="index.php?pagina=libros">Libros</a> |
    <a href="index.php?pagina=usuarios">Usuarios</a> |
    <a href="index.php?pagina=prestamos">Préstamos</a> |
    <a href="index.php?pagina=consultas">Consultas de negocio</a>
</nav>

<hr>

<h2>Acción 2: Mostrar información relacionada</h2>

<p>
    Esta consulta muestra la relación entre préstamo, libro y usuario mediante INNER JOIN.
</p>

<table border="1" cellpadding="8">
    <tr>
        <th>ID Préstamo</th>
        <th>Libro</th>
        <th>Autor</th>
        <th>Categoría</th>
        <th>Usuario</th>
        <th>Correo</th>
        <th>Membresía</th>
        <th>Fecha inicio</th>
        <th>Fecha fin</th>
    </tr>

    <?php foreach ($prestamosRelacionados as $p): ?>
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
        </tr>
    <?php endforeach; ?>
</table>

<hr>

<h2>Acción 3: Buscar préstamos por rango de fechas</h2>

<p>
    Esta consulta permite buscar préstamos realizados entre una fecha inicial y una fecha final usando BETWEEN.
</p>

<form method="GET">
    <input type="hidden" name="pagina" value="consultas">

    <label>Desde:</label>
    <input type="date" name="desde">

    <label>Hasta:</label>
    <input type="date" name="hasta">

    <button type="submit" name="buscar_fechas">Buscar</button>
</form>

<?php if (!empty($resultadoFechas)): ?>

    <h3>Resultados de búsqueda por fechas</h3>

    <table border="1" cellpadding="8">
        <tr>
            <th>ID Préstamo</th>
            <th>Libro</th>
            <th>Usuario</th>
            <th>Fecha inicio</th>
            <th>Fecha fin</th>
        </tr>

        <?php foreach ($resultadoFechas as $r): ?>
            <tr>
                <td><?php echo $r['id']; ?></td>
                <td><?php echo $r['libro']; ?></td>
                <td><?php echo $r['usuario']; ?></td>
                <td><?php echo $r['fecha_inicio']; ?></td>
                <td><?php echo $r['fecha_fin']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

<?php elseif (isset($_GET['buscar_fechas'])): ?>

    <p>No se encontraron préstamos en el rango seleccionado.</p>

<?php endif; ?>

<hr>

<h2>Acción 4: Mostrar usuarios ordenados por cantidad de préstamos</h2>

<p>
    Esta consulta muestra los usuarios ordenados de mayor a menor cantidad de préstamos usando ORDER BY.
</p>

<table border="1" cellpadding="8">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Correo</th>
        <th>Membresía</th>
        <th>Cantidad de préstamos</th>
    </tr>

    <?php foreach ($usuariosOrdenados as $u): ?>
        <tr>
            <td><?php echo $u['id']; ?></td>
            <td><?php echo $u['nombre']; ?></td>
            <td><?php echo $u['correo']; ?></td>
            <td><?php echo $u['membresia']; ?></td>
            <td><?php echo $u['prestamos']; ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<hr>

<h2>Acción 5: Filtrar libros por categorías</h2>

<p>
    Esta consulta permite filtrar libros por una o varias categorías usando IN.
</p>

<form method="GET">
    <input type="hidden" name="pagina" value="consultas">

    <label>
        <input type="checkbox" name="categorias[]" value="Programación">
        Programación
    </label>

    <label>
        <input type="checkbox" name="categorias[]" value="Base de Datos">
        Base de Datos
    </label>

    <label>
        <input type="checkbox" name="categorias[]" value="Ingeniería Web">
        Ingeniería Web
    </label>

    <label>
        <input type="checkbox" name="categorias[]" value="Redes">
        Redes
    </label>

    <button type="submit" name="filtrar_categorias">Filtrar</button>
</form>

<?php if (!empty($resultadoCategorias)): ?>

    <h3>Libros filtrados por categoría</h3>

    <table border="1" cellpadding="8">
        <tr>
            <th>ID</th>
            <th>Título</th>
            <th>Autor</th>
            <th>Año</th>
            <th>Categoría</th>
        </tr>

        <?php foreach ($resultadoCategorias as $libro): ?>
            <tr>
                <td><?php echo $libro['id']; ?></td>
                <td><?php echo $libro['titulo']; ?></td>
                <td><?php echo $libro['autor']; ?></td>
                <td><?php echo $libro['anio']; ?></td>
                <td><?php echo $libro['categoria']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

<?php elseif (isset($_GET['filtrar_categorias'])): ?>

    <p>No se encontraron libros en las categorías seleccionadas.</p>

<?php endif; ?>

</body>
</html>