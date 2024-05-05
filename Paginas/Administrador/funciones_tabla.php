<?php
require '../../config/conexion.php';

$columns = ['nombre','correo','ci'];
$table = "usuarios";

$campo = isset($_POST['ci']) ? $conexion->real_escape_string($_POST['ci']) : null;

$where = '';

if($campo != null){
    $where = "WHERE (";
    
    $cont = count($columns);
    for ($i = 0; $i < $cont; $i++){
        $where .= $columns[$i] ." LIKE '%". $campo . "%' OR ";
    }
    $where = substr_replace($where, "", -3);
    $where .= ")";
}

$query = "SELECT * FROM $table $where ";

$resultado = $conexion->query($query);
$num_rows = $resultado->num_rows;

$html = '';
if($num_rows > 0){
    $html .= '<div class="tabla-container">';
    $html .= '<table>';
    while($row = $resultado->fetch_assoc()){
     
        $html .= '<tr>';
        $html .= '<td>' . $row['nombre'] . '</td>';
        $html .= '<td>' . $row['correo'] . '</td>';
        $html .= '<td>' . $row['ci'] . '</td>';
        $html .= '<td><a href="modificar_cuenta_usuario.php?ci_new=' . $row['ci'] . '" class="btn btn-primary">Modificar</a></td>';
        $html .= '</tr>';
    
    }
    $html .= '</table>';
    $html .= '</div>';

}else{
    $html .= '<div class="tabla-container">';
    $html .= '<table>';
    $html .= '<tr>';
    $html .= '<td colspan="7">Sin resultados</td>';
    $html .= '</tr>';
    $html .= '</table>';
    $html .= '</div>';
}
echo json_encode($html, JSON_UNESCAPED_UNICODE);
?>