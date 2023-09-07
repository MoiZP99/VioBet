<?php

require '../../includes/config/database.php';
$db = conectarDB();

$query = "SELECT c.id, c.Nombre_Negocio, c.Nombre_Emprendedor, c.Apellido1, c.Apellido2, c.Nom_Producto, c.Estado, c.Num_Telefono, c.Correo, c.Categoria, c.Imagen
FROM emprendedores c";
$resultado = mysqli_query($db, $query);

// header("Content-Type: application/xls");
// header("Content-Disposition: attachment; filename=Usuarios.xls");

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Usuarios.xls"');
header('Cache-Control: max-age=0');
?>

<table id="example1" class="table table-bordered table-striped table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre Negocio</th>
            <th>Nombre del Emprendedor</th>
            <th>Primer Apellido</th>
            <th>Segundo Apellido</th>
            <th>Producto</th>
            <th>Estado</th>
            <th>Teléfono</th>
            <th>Categoria</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($resultado->num_rows > 0) : ?>
            <?php while ($emprendedor = mysqli_fetch_assoc($resultado)) : ?>
                <tr>
                    <td><?php echo $emprendedor['id'] ?></td>
                    <td><?php echo $emprendedor['Nombre_Negocio'] ?></td>
                    <td><?php echo $emprendedor['Nombre_Emprendedor'] ?></td>
                    <td><?php echo $emprendedor['Apellido1'] ?></td>
                    <td><?php echo $emprendedor['Apellido2'] ?></td>
                    <td><?php echo $emprendedor['Nom_Producto'] ?></td>
                    <td><?php echo $emprendedor['Estado'] ?></td>
                    <td><?php echo $emprendedor['Num_Telefono'] ?></td>
                    <td><?php echo $emprendedor['Categoria'] ?></td>
                </tr>
            <?php endwhile; ?>
        <?php endif; ?>
    </tbody>