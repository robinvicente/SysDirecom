<?php

    require_once ('conexion.php');

        $query = "SELECT d.rmdirecom AS EMPRESA, d.direcciondirecom AS 'DIRECCION-EMPRESA' ,d.descripciondirecom AS 'DESCRIPCION',cli.cliente_rs AS 'NOMBRE-CLIENTE',cli.direccioncliente 
        AS 'DIRECCION-CLIENTE',bv.fechaboletaventa AS 'FECHA', dv.cantidadproductoventa as 'CANTIDAD-PRODUCTO',p.descripcionproducto AS 'DESCRIPCION-PRODUCTO',
        p.costounitarioproducto AS 'PRECIO-UNITARIO', dv.importeventa AS 'IMPORTE',p.costounitarioproducto*dv.cantidadproductoventa AS 'TOTAL'
        FROM detalleventa AS dv 
        INNER JOIN factura AS fa ON fa.idfactura=dv.factura_idfactura 
        INNER JOIN cliente AS cli ON cli.idCliente=dv.cliente_idCliente 
        INNER JOIN direcom AS d ON d.idDirecom=dv.Direcom_idDirecom
        INNER JOIN producto AS p ON p.idproducto=dv.producto_idproducto
        INNER JOIN boletaventa AS bv ON  bv.idboletaventa=dv.boletaventa_idboletaventa";

    $result = mysqli_query($mysqliConnect, $query);
    if(!$result) {
        die('Query Failed'. mysqli_error($mysqliConnect));
    }

    $json = array();
    while($row = mysqli_fetch_array($result)) {
        $json[] = array(
            'EMPRESA' => $row['EMPRESA'],
            'DIRECCION-EMPRESA' => $row['DIRECCION-EMPRESA'],
            'DESCRIPCION' => $row['DESCRIPCION'],
            'NOMBRE-CLIENTE' => $row['NOMBRE-CLIENTE'],
            'DIRECCION-CLIENTE' => $row['DIRECCION-CLIENTE'],
            'FECHA' => $row['FECHA'],
            'CANTIDAD-PRODUCTO' => $row['CANTIDAD-PRODUCTO'],
            'DESCRIPCION-PRODUCTO' => $row['DESCRIPCION-PRODUCTO'],
            'PRECIO-UNITARIO' => $row['PRECIO-UNITARIO'],
            'IMPORTE' => $row['IMPORTE'],
            'TOTAL' => $row['TOTAL']
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
?>
