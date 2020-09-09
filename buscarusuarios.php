<?php

    include('conexion.php');


    $search = $_POST['search'];
    if(!empty($search)) {
        $query = "SELECT * FROM dbventas.usuario WHERE  nombreusuario  LIKE '$search%' OR apellidosusuario  LIKE '$search%' ";
        $result = mysqli_query($mysqliConnect, $query);

        if(!$result) {
            die('Query Error' . mysqli_error($mysqliConnect));
        }

        $json = array();
        while($row = mysqli_fetch_array($result)) {
            $json[] = array(
                'id' => $row['idusuario'],
                'name' => $row['nombreusuario'],
                'phone' => $row['apellidosusuario']
            );
        }
        $jsonstring = json_encode($json);
        echo $jsonstring;
    }

?>

