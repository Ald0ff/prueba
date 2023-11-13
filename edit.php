<?php
include("db.php");

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $query = "SELECT * FROM registro WHERE id = $id";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_array($result);
        $nombre = $row["nombre"];
        $correo = $row["correo"];
        $telefono = $row["telefono"];
        $fecha = $row["fecha"];
    }
}

if (isset($_POST['update'])) {
    $nombre = $_POST["nombre"];
    $correo = $_POST["correo"];
    $telefono = $_POST["telefono"];
    $fecha = $_POST["fecha"];

    $query = "UPDATE registro set nombre = '$nombre', correo = '$correo', telefono = '$telefono', fecha = '$fecha' WHERE id = $id";

    mysqli_query($conn, $query);
    header("Location: index.php");
}

?>

<?php include('includes/head.php') ?>

<div class="container p-4">
    <div class="row">
        <div class="col-md-4 mx-auto">
            <div class="card card-body">
                <form action="edit.php?id=<?php echo $_GET['id']; ?>" method="POST">
                    <div class="form-group mb-3">
                        <input value="<?php echo $nombre ?>" type="text" name="nombre" class="form-control" placeholder="Nombre y Apellido" autofocus>
                    </div>
                    <div class="form-group mb-3">
                        <input value="<?php echo $correo ?>" type="text" name="correo" class="form-control" placeholder="Correo" autofocus>
                    </div>
                    <div class="form-group mb-3">
                        <input value="<?php echo $telefono ?>" type="number" name="telefono" class="form-control" placeholder="Teléfono" autofocus>
                    </div>
                    <div class="form-group mb-3">
                        <input value="<?php echo $fecha ?>" type="date" name="fecha" class="form-control" placeholder="Fecha de nacimiento" autofocus>
                    </div>

                    <button type="submit" name="update" class="btn btn-success"> Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php') ?>