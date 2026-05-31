<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Biblioteca Digital</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>

<h1>Sistema de Gestión de Biblioteca Digital</h1>

<nav>
    <a href="index.php?pagina=libros">Libros</a> |
    <a href="index.php?pagina=usuarios">Usuarios</a> |
    <a href="index.php?pagina=prestamos">Préstamos</a> |
    <a href="index.php?pagina=consultas">Consultas de negocio</a>
</nav>

<p><?php echo $mensaje; ?></p>

<h2>
    <?php echo $libroEditar ? 'Editar libro' : 'Registrar libro'; ?>
</h2>

<form method="POST">
    <input type="hidden" name="accion" value="<?php echo $libroEditar ? 'actualizar' : 'registrar'; ?>">
    <input type="hidden" name="id" value="<?php echo $libroEditar['id'] ?? ''; ?>">

    <input 
        type="text" 
        name="titulo" 
        placeholder="Título"
        value="<?php echo $libroEditar['titulo'] ?? ''; ?>"
    >

    <input 
        type="text" 
        name="autor" 
        placeholder="Autor"
        value="<?php echo $libroEditar['autor'] ?? ''; ?>"
    >

    <input 
        type="number" 
        name="anio" 
        placeholder="Año"
        value="<?php echo $libroEditar['anio'] ?? ''; ?>"
    >

    <select name="categoria">
    <option value="">Seleccione categoría</option>

    <option value="Programación"
        <?php echo (($libroEditar['categoria'] ?? '') == 'Programación') ? 'selected' : ''; ?>>
        Programación
    </option>

    <option value="Base de Datos"
        <?php echo (($libroEditar['categoria'] ?? '') == 'Base de Datos') ? 'selected' : ''; ?>>
        Base de Datos
    </option>

    <option value="Ingeniería Web"
        <?php echo (($libroEditar['categoria'] ?? '') == 'Ingeniería Web') ? 'selected' : ''; ?>>
        Ingeniería Web
    </option>

    <option value="Redes"
        <?php echo (($libroEditar['categoria'] ?? '') == 'Redes') ? 'selected' : ''; ?>>
        Redes
    </option>
</select>

    <button type="submit">
        <?php echo $libroEditar ? 'Actualizar' : 'Registrar'; ?>
    </button>

    <?php if ($libroEditar): ?>
        <a href="index.php?pagina=libros">Cancelar</a>
    <?php endif; ?>
</form>

<h2>Listado de libros</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Título</th>
        <th>Autor</th>
        <th>Año</th>
        <th>Categoría</th>
        <th>Acciones</th>
    </tr>

    <?php foreach ($libros as $libro): ?>
        <tr>
            <td><?php echo $libro['id']; ?></td>
            <td><?php echo $libro['titulo']; ?></td>
            <td><?php echo $libro['autor']; ?></td>
            <td><?php echo $libro['anio']; ?></td>
            <td><?php echo $libro['categoria']; ?></td>
            <td>
                <a href="index.php?pagina=libros&editar=<?php echo $libro['id']; ?>">
                    Editar
                </a>
                |
                <a 
                    href="index.php?pagina=libros&eliminar=<?php echo $libro['id']; ?>"
                    onclick="return confirm('¿Está seguro de eliminar este libro?');"
                >
                    Eliminar
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

</body>
</html>