<?php

// Include database connection
$ci_modi=$_GET['ci_mo'];
// Check if the form has been submitted
if (isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['facultad'])) {
    // Get the form data
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $facultad = $_POST['facultad'];

    // Construct the SQL query to update the user information
    $sql = "UPDATE usuarios SET nombre='.'$nombre'.', apellido='.'$apellido'.' WHERE ci='.'$ci_modi'.';";
    $conexion= new mysqli('localhost','root','','ProyectoTIS');
    // Execute the query
    if (mysqli_query($conexion, $sql)) {
        echo "<p>Usuario actualizado con éxito.</p>";
        header("../Paginas/Administrador/modificar_cuenta_usuario.php?ci_new='$ci_modi'");
    } else {
        echo "<p>Error al actualizar el usuario: " . mysqli_error($conexion) . "</p>";
    }
}

?>
