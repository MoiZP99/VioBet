<?php

require '../../includes/config/database.php';
$db = conectarDB();

$consulta = ("SELECT usuarios.Nombre, usuarios.Apellido, usuarios.Email, rol.Nombre_Rol 
              FROM usuarios INNER JOIN rol ON usuarios.Rol_Id = rol.Id");
$resultado = mysqli_query($db, $consulta);

// header("Content-Type: application/xls");
// header("Content-Disposition: attachment; filename=Usuarios.xls");

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Usuarios.xls"');
header('Cache-Control: max-age=0');
?>

<table class="table table-striped table-dark">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Rol de Usuario</th>
            <th>Email</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($resultado->num_rows > 0) : ?>
            <?php while ($usuario = mysqli_fetch_assoc($resultado)) : ?> 
                <tr>
                    <td><?php echo $usuario['Nombre'] ?></td>
                    <td><?php echo $usuario['Apellido'] ?></td>
                    <td> <?php echo $usuario['Nombre_Rol'] ?></td>
                    <td><?php echo $usuario['Email'] ?></td>
                </tr>
            <?php endwhile; ?>
        <?php endif; ?>
    </tbody>