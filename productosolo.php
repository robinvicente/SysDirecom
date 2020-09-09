<?php

require_once ('conexion.php');

if(isset($_POST['id'])) {
    $id = mysqli_real_escape_string($mysqliConnect, $_POST['id']);

    $query = "SELECT * from dbventas.producto WHERE idproducto = {$id}";

    $result = mysqli_query($mysqliConnect, $query);
    if(!$result) {
        die('Query Failed'. mysqli_error($mysqliConnect));
    }

    $json = array();
    while($row = mysqli_fetch_array($result)) {
        $json[] = array(
            'id' => $row['idproducto'],
            'nombre' => $row['nombreproducto'],
            'desc' => $row['descripcionproducto'],
            'costo' => $row['costounitarioproducto'],
            'unidad' => $row['unidadmedidaproducto'],
            'stock' => $row['stockproducto'],
            'marca' => $row['marcaproducto']
        );
    }
    $jsonstring = json_encode($json[0]);
    echo $jsonstring;
}

?>

