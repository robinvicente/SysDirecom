<?php
    include('conexion.php');

    if(isset($_POST['id'])) {
        $id = $_POST['id'];
        $query = "DELETE FROM dbventas.cliente WHERE idCliente = $id";
        $result = mysqli_query($mysqliConnect, $query);

        if (!$result) {
            die('Query Failed.');
        }
        echo "Task Deleted Successfully";
    }
