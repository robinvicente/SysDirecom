<?php

    include('conexion.php');

    $search = $_POST['search'];
    if(!empty($search)) {
        $query = "SELECT * FROM dbventas.cliente WHERE cliente_rs  LIKE '$search%' OR telefonocliente  LIKE '$search%' ";
        $result = mysqli_query($mysqliConnect, $query);

        if(!$result) {
            die('Query Error' . mysqli_error($mysqliConnect));
        }

        $json = array();
        while($row = mysqli_fetch_array($result)) {
            $json[] = array(
                'id' => $row['idCliente'],
                'name' => $row['cliente_rs'],
                'phone' => $row['telefonocliente']
            );
        }
        $jsonstring = json_encode($json);
        echo $jsonstring;
    }

?>

