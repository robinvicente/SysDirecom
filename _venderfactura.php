<?php
require_once ('conexion.php');?>
    <!doctype html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <title>Hacer Venta | Direcom SRL</title>
    </head>
    <body>
    <?php
        include ('includes/headervent.php')
    ?>

    <!--<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <form class="form-inline my-2 my-lg-0">
                    <input name="search" id="search" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-success my-2 my-sm-0" type="submit">Search</button>
                </form>
        </div>
    </nav>-->
    <div class="container text-center">
        <div class="row p-3">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-body">
                        <!-- FORM TO ADD TASKS -->
                        <form id="task-form" action="_venderfactura.php" method="post">
                            <h1 style="font-size: 20px" class="text-left">Fecha venta</h1><br>
                            <p class="text-left">Ingese fecha de emisión</p>
                            <input type="date" id="fechaboleta" name="fechafacturae" class="form-control" autofocus><br>
                            <p class="text-left">Ingese fecha  de vencimiento</p>
                            <input type="date" id="fechaboleta" name="fechafacturav" class="form-control" autofocus><br>
                            <button type="submit" class="btn btn-primary btn-block text-center">
                                Guardar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card">
                    <div class="card-body">
                        <!-- FORM TO ADD TASKS -->
                        <form id="task-form" action="_venderfactura.php" method="post" >
                            <h1 style="font-size: 20px" class="text-left">Factura venta</h1>
                            <hr>
                            <p class="text-left">Cliente</p>
                            <select class="form-control input-sm" id="clienteVenta" name="cliente">
                                <option value="A">Selecciona</option>
                                <?php
                                $sql="SELECT idcliente , cliente_rs from dbventas.cliente";
                                $result=mysqli_query($mysqliConnect,$sql);
                                while ($row=mysqli_fetch_row($result)):
                                    ?>
                                    <option value="<?php echo $row[0] ?>"><?php echo $row[1]?></option>
                                <?php endwhile; ?>
                            </select>
                            <br><div class="form-group">
                                <p class="text-left">Producto</p>
                                <select class="form-control input-sm" id="clienteVenta" name="producto">
                                    <option value="A">Selecciona</option>
                                    <?php
                                    $sql="SELECT idproducto,nombreproducto
                                from dbventas.producto";
                                    $result=mysqli_query($mysqliConnect,$sql);
                                    while ($row=mysqli_fetch_row($result)):
                                        ?>
                                        <option value="<?php echo $row[0] ?>"><?php echo $row[1]?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                            <div class="class-group">
                                <select class="form-control input-sm" id="clienteVenta" name="preciounitario">
                                    <option value="A">Selecciona</option>
                                    <option value="0">Sin cliente</option>
                                    <?php

                                    $sql="SELECT idproducto, costounitarioproducto, nombreproducto from dbventas.producto";
                                    $result=mysqli_query($mysqliConnect,$sql);
                                    while ($row=mysqli_fetch_row($result)):
                                        ?>
                                        <option value="<?php echo $row[1] ?>"><?php echo $row[2]?> - <?php echo $row[1]?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div><br>
                            <div class="class-group">
                                <input type="number" id="cantidad_" name="cantidad" class="form-control" placeholder="Cantidad de productos" autofocus ><br>
                            </div>
                            <div class="form-group">
                                <p class="text-left">Fecha</p>
                                <select class="form-control input-sm" id="clienteVenta" name="fechafacturaf">
                                    <option value="A">Selecciona</option>
                                    <option value="0">Sin fecha</option>
                                    <?php
                                    $sql="SELECT dbventas.factura.idfactura ,dbventas.factura.fechaemision from dbventas.factura";
                                    $result=mysqli_query($mysqliConnect,$sql);
                                    while ($row=mysqli_fetch_row($result)):
                                        ?>
                                        <option value="<?php echo $row[0] ?>"><?php echo $row[1]?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                            <input type="hidden" id="taskId_">
                            <button type="submit" class="btn btn-primary btn-block text-center">
                                Agregar
                            </button><br>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    </body>
    </html>

<?php

if(!empty($_POST['fechafacturae']) && !empty($_POST['fechafacturav'])){

    $fechae = mysqli_real_escape_string($mysqliConnect, $_POST['fechafacturae']);
    $fechav = mysqli_real_escape_string($mysqliConnect, $_POST['fechafacturav']);

    $consult = "INSERT INTO dbventas.factura (fechaemision, fechavencimiento, igvfactura) value ('$fechae', '$fechav', 18.00) ";

    if($result = mysqli_query($mysqliConnect, $consult))
    {
        echo "<p class='text-center'>Registro exitoso</p>";
    }else
    {
        echo "Error: " . $consult . "<br>" . $mysqliConnect->error;
    }
}

    if(!empty($_POST['cantidad'])){

        $clienteF = mysqli_real_escape_string($mysqliConnect, $_POST['cliente']);
        $productoF = mysqli_real_escape_string($mysqliConnect, $_POST['producto']);
        $cantidadF = mysqli_real_escape_string($mysqliConnect, $_POST['cantidad']);
        $preciouF = mysqli_real_escape_string($mysqliConnect, $_POST['preciounitario']);
        $importeF = $preciouF * $cantidadF;
        $igv = $importeF + ($importeF * 0.18);
        $importeF = $igv;
        $fechafacturaf = mysqli_real_escape_string($mysqliConnect, $_POST['fechafacturaf']);


        $consult = "INSERT INTO dbventas.detalleventa(cantidadproductoventa, importeventa,
                                      cliente_idCliente, producto_idproducto, factura_idfactura) 
                                      value ('$cantidadF', '$importeF', '$clienteF','$productoF', $fechafacturaf) ";

        if($result = mysqli_query($mysqliConnect, $consult))
        {
            echo "<p class='text-center'>Registro exitoso</p>";
            $consult2 = "UPDATE dbventas.producto SET stockproducto = stockproducto - '$cantidadF' WHERE dbventas.producto.idproducto = '$productoF'";
            if($result = mysqli_query($mysqliConnect, $consult2))
                echo "<p class='text-center'>Stock actualizado</p>";
        }else
        {
            echo "Error: " . $consult . "<br>" . $mysqliConnect->error;
        }
    }


?>