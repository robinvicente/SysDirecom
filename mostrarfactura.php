<?php

    require_once ('conexion.php');

    $query = "SELECT d.rmdirecom AS EMPRESA, d.direcciondirecom AS 'DIRECCION-EMPRESA' ,d.descripciondirecom AS 'DESCRIPCION',cli.cliente_rs AS 'NOMBRE-CLIENTE',cli.direccioncliente 
    AS 'DIRECCION-CLIENTE', cli.ruccliente AS 'RUC-CLIENTE',dv.cantidadproductoventa as 'CANTIDAD-PRODUCTO',p.descripcionproducto AS 'DESCRIPCCION-PRODUCTO',
    p.costounitarioproducto AS 'PRECIO-UNITARIO', dv.importeventa AS 'IMPORTE',fa.igvfactura AS 'IGV',p.costounitarioproducto*dv.cantidadproductoventa AS 'TOTAL'
    FROM detalleventa AS dv 
    INNER JOIN factura AS fa ON fa.idfactura=dv.factura_idfactura 
    INNER JOIN cliente AS cli ON cli.idCliente=dv.cliente_idCliente 
    INNER JOIN direcom AS d ON d.idDirecom=dv.Direcom_idDirecom
    INNER JOIN producto AS p ON p.idproducto=dv.producto_idproducto";

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
            'RUC-CLIENTE' => $row['RUC-CLIENTE'],
            'CANTIDAD-PRODUCTO' => $row['CANTIDAD-PRODUCTO'],
            'DESCRIPCION-PRODUCTO' => $row['DESCRIPCION-PRODUCTO'],
            'PRECIO-UNITARIO' => $row['PRECIO-UNITARIO'],
            'IMPORTE' => $row['IMPORTE'],
            'IGV' => $row['IGV'],
            'TOTAL' => $row['TOTAL']
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
?>
