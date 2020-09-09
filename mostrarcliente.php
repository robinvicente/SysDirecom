<?php

    require_once ('conexion.php');

    $query = "SELECT * from dbventas.cliente";
    $result = mysqli_query($mysqliConnect, $query);
    if(!$result) {
        die('Query Failed'. mysqli_error($mysqliConnect));
    }

    $json = array();
    while($row = mysqli_fetch_array($result)) {
        $json[] = array(
            'id' => $row['idCliente'],
            'namecliente' => $row['cliente_rs'],
            'addresscliente' => $row['direccioncliente'],
            'ruccliente' => $row['ruccliente'],
            'emailcliente' => $row['correocliente'],
            'phonecliente' => $row['telefonocliente']
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
?>
