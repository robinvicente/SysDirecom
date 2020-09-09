<?php

    require_once ('conexion.php');

    $query = "SELECT fa.idfactura AS 'ID-factura', bv.idboletaventa AS 'ID-boleta' ,cli.cliente_rs AS 'CLIENTE',  p.costounitarioproducto*dv.cantidadproductoventa AS 'TOTAL'
    FROM detalleventa AS dv
    INNER JOIN factura AS fa ON fa.idfactura=dv.factura_idfactura
    INNER JOIN cliente AS cli ON cli.idCliente=dv.cliente_idCliente
    INNER JOIN direcom AS d ON d.idDirecom=dv.Direcom_idDirecom
    INNER JOIN producto AS p ON p.idproducto=dv.producto_idproducto
    INNER JOIN boletaventa AS bv ON bv.idboletaventa=dv.boletaventa_idboletaventa";

    $result = mysqli_query($mysqliConnect, $query);
    if(!$result) {
        die('Query Failed'. mysqli_error($mysqliConnect));
    }

    $json = array();
    while($row = mysqli_fetch_array($result)) {
        $json[] = array(
            'id' => $row['ID-factura'],
            'idboleta' => $row['ID-boleta'],
            'cliente' => $row['CLIENTE'],
            'total' => $row['TOTAL'],
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
?>