<?php
    require_once ('conexion.php');

    $query = "SELECT * from dbventas.producto";
    $result = mysqli_query($mysqliConnect, $query);
    if(!$result) {
        die('Query Failed'. mysqli_error($mysqliConnect));
    }

    $json = array();
    while($row = mysqli_fetch_array($result)) {
        $json[] = array(
            'id' => $row['idproducto'],
            'nameprodcuto' => $row['nombreproducto']
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
?>
