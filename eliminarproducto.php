<?php

    include('conexion.php');

    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $query = "DELETE FROM dbventas.producto WHERE idproducto = $id";
        $result = mysqli_query($mysqliConnect, $query);

        if (!$result) {
            die('Query Failed.');
        }
        echo "Task Deleted Successfully";
    }
