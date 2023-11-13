<?php
// Incluye la conexión a la base de datos
include("db.php");

// Verifica si el formulario ha sido enviado
if (isset($_POST["save_task"])) {
    // Recoge los datos enviados desde el formulario
    $nombre = $_POST["nombre"];
    $correo = $_POST["correo"];
    $telefono = $_POST["telefono"];
    $fecha = $_POST["fecha"];
    $foto = $_POST["foto"];

    // Define el directorio donde se guardarán las imágenes
    $target_dir = "uploads/";
    // Crea la ruta completa del archivo a guardar 
    $target_file = $target_dir . basename($_FILES["foto"]["name"]);
    // Obtiene la extensión del archivo en minúsculas
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    // Obtiene el nombre del archivo
    $foto = basename($_FILES["foto"]["name"]);

    // Prepara la consulta SQL para insertar los datos en la base de datos
    $query = "INSERT INTO registro(nombre, correo, telefono, fecha, foto) VALUES ('$nombre', '$correo', '$telefono', '$fecha', '$foto')";
    // Ejecuta la consulta
    $result = mysqli_query($conn, $query);

    // Verifica si la consulta fue exitosa
    if (!$result) {
        die('Query failed');
    }

    // Establece un mensaje de éxito en la sesión
    $_SESSION['message'] = 'Guardado correctamente';
    $_SESSION['message_type'] = "success";

    // Redirige al usuario a la página principal
    header('Location: index.php');
}
?>
