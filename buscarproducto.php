<?php

    include('conexion.php');


$search = $_POST['search'];
if(!empty($search)) {
        $query = "SELECT * FROM dbventas.producto WHERE  nombreproducto  LIKE '$search%' OR descripcionproducto  LIKE '$search%' ";
        $result = mysqli_query($mysqliConnect, $query);

        if(!$result) {
            die('Query Error' . mysqli_error($mysqliConnect));
        }

        $json = array();
        while($row = mysqli_fetch_array($result)) {
            $json[] = array(
                'id' => $row['idproducto'],
                'name' => $row['nombreproducto'],
                'phone' => $row['descripcionproducto']
            );
        }
        $jsonstring = json_encode($json);
        echo $jsonstring;
    }

?>

