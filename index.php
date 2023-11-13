<?php
// Incluye la conexión a la base de datos
include("db.php");
?>
<?php
// Incluye el archivo del encabezado de la página
include('includes/head.php')
?>
<div class="container p-4">
    <!-- Estructura de fila y columnas utilizando Bootstrap -->
    <div class="row">
        <!-- Columna para el formulario -->
        <div class="col-md-4 mb-4">
            <!-- Verificar si hay un mensaje en la sesión para mostrarlo -->
            <?php if (isset($_SESSION['message'])) { ?>
                <div class="alert alert-<?= $_SESSION['message_type'] ?> alert-dismissible fade show" role="alert">
                    <?= $_SESSION['message'] ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php
                // Limpia los datos de la sesión después de mostrar el mensaje
                session_unset();
            } ?>
            <!-- Tarjeta para el formulario de registro -->
            <div class="card card-body">
                <!-- Formulario para ingresar datos del usuario -->
                <form action="save_task.php" method="POST">
                    <!-- Campo para el nombre -->
                    <div class="form-group mb-3">
                        <input type="text" name="nombre" class="form-control" placeholder="Nombre y Apellido" autofocus>
                    </div>
                    <!-- Campo para el correo -->
                    <div class="form-group mb-3">
                        <input type="text" name="correo" class="form-control" placeholder="Correo" autofocus>
                    </div>
                    <!-- Campo para el teléfono -->
                    <div class="form-group mb-3">
                        <input type="number" name="telefono" class="form-control" placeholder="Teléfono" autofocus>
                    </div>
                    <!-- Campo para la fecha de nacimiento -->
                    <div class="form-group mb-3">
                        <input type="date" name="fecha" class="form-control" placeholder="Fecha de nacimiento" autofocus>
                    </div>
                    <!-- Campo para subir una foto -->
                    <div class="form-group mb-3">
                        <input type="file" name="foto" class="form-control" placeholder="Foto de perfil" autofocus>
                    </div>
                    <!-- Botón para enviar el formulario -->
                    <input type="submit" name="save_task" class="btn btn-success btn-block" value="save task">
                </form>
            </div>
        </div>

        <!-- Columna para mostrar los datos registrados -->
        <div class="col-md-8 table-responsive">
            <!-- Tabla para mostrar los datos -->
            <table class="table table-bordered ">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Teléfono</th>
                        <th>Fecha de nacimiento</th>
                        <th>Foto de perfil</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Consulta para obtener los datos de los usuarios
                    $query = 'Select * from registro';
                    $result = mysqli_query($conn, $query);

                    // Iterar sobre cada fila de la base de datos y mostrarla
                    while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?php echo $row['nombre'] ?></td>
                            <td><?php echo $row['correo'] ?></td>
                            <td><?php echo $row['telefono'] ?></td>
                            <td><?php echo $row['fecha'] ?></td>
                            <!-- Mostrar la imagen del usuario -->
                            <td>
                                <img src='./uploads/<?php echo   $row["foto"]  ?>' />
                            </td>
                            <!-- Opciones para editar y eliminar -->
                            <td>
                                <a class="btn btn-secondary" href="edit.php?id=<?php echo $row['id'] ?>">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <a class="btn btn-danger" href="delete.php?id=<?php echo $row['id'] ?>">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php
// Incluye el archivo del pie de página
include('includes/footer.php');
