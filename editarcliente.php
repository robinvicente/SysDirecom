<?php

    include('conexion.php');

    if(isset($_POST['id'])) {
        $nombre = $_POST['nombre'];
        $direccion = $_POST['direccion'];
        $ruc = $_POST['ruc'];
        $correocliente = $_POST['correo'];
        $telefono = $_POST['telefono'];
        $id = $_POST['id'];

        $query = "UPDATE dbventas.cliente SET cliente_rs = '$nombre',
                            direccioncliente = '$direccion' , 
                            ruccliente = '$ruc', correocliente = '$correocliente',
                            telefonocliente = '$telefono' WHERE idCliente = '$id'";

        $result = mysqli_query($mysqliConnect, $query);

        if (!$result) {
            die('Query Failed.. mysqli_error($mysqliConnect)');
        }   
        echo "Task Update Successfully";
    }

?>
