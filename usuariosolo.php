<?php

require_once ('conexion.php');

if(isset($_POST['id'])) {
    $id = mysqli_real_escape_string($mysqliConnect, $_POST['id']);

    $query = "SELECT * from dbventas.usuario WHERE idusuario = {$id}";

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
            'dniU' => $row['dniusuario'],
            'direcU' => $row['direccionusuario'],
            'fechaU' => $row['fechaingreso'],
            'telefonoU' => $row['telefonousuario'],
            'tipoU' => $row['tipousuario']
        );
    }
    $jsonstring = json_encode($json[0]);
    echo $jsonstring;
}

?>

