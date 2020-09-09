<?php

    include('conexion.php');

    if(isset($_POST['id'])) {
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $clave = $_POST['clave'];
        $dni = $_POST['dni'];
        $direccion = $_POST['direccion'];
        $fecha = $_POST['fecha'];
        $telefono = $_POST['telefono'];
        $tipo = $_POST['tipo'];
        $id = $_POST['id'];

        $query = "UPDATE dbventas.usuario SET nombreusuario = '$nombre',
                                apellidosusuario = '$apellido' , 
                                claveusuario = '$clave', dniusuario = '$dni',
                                direccionusuario = '$direccion' , fechaingreso = '$fecha'
                            , telefonousuario = '$telefono', tipousuario = '$tipo' WHERE idusuario = '$id'";

        $result = mysqli_query($mysqliConnect, $query);

        if (!$result) {
            die('Query Failed.. mysqli_error($mysqliConnect)');
        }
        echo "Task Update Successfully";
    }

?>
