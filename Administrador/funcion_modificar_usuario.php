<?php 
    $ci_modifi = $_GET['$ci_new'];
print_r($ci_modifi);
if (!empty($_POST['nombre']) && !empty($_POST['apellido']) && !empty($_POST['facultad'])) { 
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $facultad = $_POST['facultad'];
                                
    // Realiza la actualización en la base de datos
    $sql = "UPDATE usuarios SET nombre='$nombre', apellido='$apellido' WHERE ci='$ci_modifi'";
    print_r($sql);
    $conexion = new mysqli('localhost', 'root', '', 'reservasumss1');
    // Ejecuta la consulta
    if (mysqli_query($conexion, $sql)) {
        echo "<p>Usuario actualizado con éxito.</p>";
        // Redirige a la página de modificación con el parámetro ci_new
        header("Location: modificar_usuario.php?ci=$ci_modifi");
        exit; // ¡Importante! Asegúrate de salir del script después de la redirección.
    } else {
        echo "<p>Error al actualizar el usuario: " . mysqli_error($conexion) . "</p>";
    }                                
}    
            
?>
