<?php

    require_once ('conexion.php');

    $query = "SELECT * from dbventas.usuario ";
    $result = mysqli_query($mysqliConnect, $query);
    if(!$result) {
        die('Query Failed'. mysqli_error($mysqliConnect));
    }

    $json = array();
    while($row = mysqli_fetch_array($result)) {
        $json[] = array(
            'id' => $row['idusuario'],
            'nombreU' => $row['nombreusuario'],
            'apellidosU' => $row['apellidosusuario'],
            'claveU' => $row['claveusuario'],
            'dniU' => $row['dniusuario'],
            'direcU' => $row['direccionusuario'],
            'fechaU' => $row['fechaingreso'],
            'telefonoU' => $row['telefonousuario'],
            'tipoU' => $row['tipousuario']
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
    ?>