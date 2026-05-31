<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Usuarios - Biblioteca Digital</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>

<h1>Gestión de Usuarios</h1>

<nav>
    <a href="index.php?pagina=libros">Libros</a> |
    <a href="index.php?pagina=usuarios">Usuarios</a> |
    <a href="index.php?pagina=prestamos">Préstamos</a> |
    <a href="index.php?pagina=consultas">Consultas de negocio</a>
</nav>

<p><?php echo $mensaje; ?></p>

<h2>
    <?php echo $usuarioEditar ? 'Editar usuario' : 'Registrar usuario'; ?>
</h2>

<form method="POST">
    <input type="hidden" name="accion" value="<?php echo $usuarioEditar ? 'actualizar' : 'registrar'; ?>">
    <input type="hidden" name="id" value="<?php echo $usuarioEditar['id'] ?? ''; ?>">

    <input 
        type="text" 
        name="nombre" 
        placeholder="Nombre completo"
        value="<?php echo $usuarioEditar['nombre'] ?? ''; ?>"
    >

    <input 
        type="email" 
        name="correo" 
        placeholder="Correo electrónico"
        value="<?php echo $usuarioEditar['correo'] ?? ''; ?>"
    >

    <select name="membresia">
        <option value="">Seleccione membresía</option>

        <option value="Básica" 
            <?php echo (($usuarioEditar['membresia'] ?? '') == 'Básica') ? 'selected' : ''; ?>>
            Básica
        </option>

        <option value="Estudiante" 
            <?php echo (($usuarioEditar['membresia'] ?? '') == 'Estudiante') ? 'selected' : ''; ?>>
            Estudiante
        </option>

        <option value="Docente" 
            <?php echo (($usuarioEditar['membresia'] ?? '') == 'Docente') ? 'selected' : ''; ?>>
            Docente
        </option>

        <option value="Premium" 
            <?php echo (($usuarioEditar['membresia'] ?? '') == 'Premium') ? 'selected' : ''; ?>>
            Premium
        </option>
    </select>

    <button type="submit">
        <?php echo $usuarioEditar ? 'Actualizar usuario' : 'Registrar usuario'; ?>
    </button>

    <?php if ($usuarioEditar): ?>
        <a href="index.php?pagina=usuarios">Cancelar</a>
    <?php endif; ?>
</form>

<h2>Listado de usuarios</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Correo</th>
        <th>Membresía</th>
        <th>Préstamos</th>
        <th>Acciones</th>
    </tr>

    <?php foreach ($usuarios as $usuario): ?>
        <tr>
            <td><?php echo $usuario['id']; ?></td>
            <td><?php echo $usuario['nombre']; ?></td>
            <td><?php echo $usuario['correo']; ?></td>
            <td><?php echo $usuario['membresia']; ?></td>
            <td><?php echo $usuario['prestamos']; ?></td>
            <td>
                <a href="index.php?pagina=usuarios&editar=<?php echo $usuario['id']; ?>">
                    Editar
                </a>
                |
                <a 
                    href="index.php?pagina=usuarios&eliminar=<?php echo $usuario['id']; ?>"
                    onclick="return confirm('¿Está seguro de eliminar este usuario?');"
                >
                    Eliminar
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

</body>
</html>