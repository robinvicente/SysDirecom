<?php

    include('conexion.php');

    if(isset($_POST['id'])) {
        $nombre = $_POST['nombreP'];
        $descripcion = $_POST['descP'];
        $costo = $_POST['costoP'];
        $unidad = $_POST['unidadP'];
        $stock = $_POST['stockP'];
        $marca = $_POST['marcaP'];
        $id = $_POST['id'];

        $query = "UPDATE dbventas.producto SET nombreproducto = '$nombre',
                                descripcionproducto = '$descripcion' , 
                                costounitarioproducto = '$costo', unidadmedidaproducto = '$unidad',
                                stockproducto = '$stock', marcaproducto = '$marca' WHERE idproducto = '$id'";

        $result = mysqli_query($mysqliConnect, $query);

        if (!$result) {
            die('Query Failed.. mysqli_error($mysqliConnect)');
        }
        echo "Task Update Successfully";
    }

?>
