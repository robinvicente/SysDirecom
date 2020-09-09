<?php

require_once ('conexion.php');

if(isset($_POST['id'])) {
    $id = mysqli_real_escape_string($mysqliConnect, $_POST['id']);

    $query = "SELECT * from dbventas.cliente WHERE idCliente = {$id}";

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
    $jsonstring = json_encode($json[0]);
    echo $jsonstring;
}

?>
