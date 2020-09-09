<?php
include('conexion.php');

if(isset($_POST['id'])) {
    $id = $_POST['id'];
    $query = "DELETE FROM dbventas.usuario WHERE idusuario = $id";
    $result = mysqli_query($mysqliConnect, $query);

    if (!$result) {
        die('Query Failed.');
    }
    echo "Task Deleted Successfully";
}
