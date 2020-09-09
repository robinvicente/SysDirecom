<?php
require_once ('conexion.php');?>
<!doctype html>
<html lang="en">
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
    include ('includes/headervent.php');
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
                    <form id="task-form" action="_venderboleta.php" method="post">
                        <h1 style="font-size: 20px" class="text-left">Fecha venta</h1><br>
                        <p class="text-left">Ingese fecha por favor:</p>
                            <input type="date" id="fechaboleta" name="fechaboleta" class="form-control" autofocus><br>
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
                    <form id="task-form" action="_venderboleta.php" method="post" >
                        <h1 style="font-size: 20px" class="text-left">Boleta venta</h1>
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
                        <div class="form-group">
                            <input type="number" id="fechaboleta" name="cantidad" class="form-control" placeholder="Cantidad" autofocus>
                        </div>
                        <div class="form-group">
                            <p class="text-left">Fecha</p>
                            <select class="form-control input-sm" id="clienteVenta" name="fechaboletaf">
                                <option value="A">Selecciona</option>
                                <option value="0">Sin fecha</option>
                                <?php
                                $sql="SELECT dbventas.boletaventa.idboletaventa ,dbventas.boletaventa.fechaboletaventa from dbventas.boletaventa";
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

    if(!empty($_POST['fechaboleta'])){

        $fechaboleta = mysqli_real_escape_string($mysqliConnect, $_POST['fechaboleta']);

        $consult = "INSERT INTO dbventas.boletaventa (fechaboletaventa) value ('$fechaboleta') ";

        if($result = mysqli_query($mysqliConnect, $consult))
        {
            echo "<p class='text-center'>Registro exitoso</p>";
        }else
        {
            echo "Error: " . $consult . "<br>" . $mysqliConnect->error;
        }
    }

    if(!empty($_POST['cantidad'])){

        $cliente = mysqli_real_escape_string($mysqliConnect, $_POST['cliente']);
        $producto = mysqli_real_escape_string($mysqliConnect, $_POST['producto']);
        $cantidad = mysqli_real_escape_string($mysqliConnect, $_POST['cantidad']);
        $preciou = mysqli_real_escape_string($mysqliConnect, $_POST['preciounitario']);
        $importe = $preciou * $cantidad;
        $fechaboletaf = mysqli_real_escape_string($mysqliConnect, $_POST['fechaboletaf']);


            $consult = "INSERT INTO dbventas.detalleventa(cantidadproductoventa, importeventa,
                                  cliente_idCliente, producto_idproducto, boletaventa_idboletaventa) 
                                  value ('$cantidad', '$importe', '$cliente','$producto', $fechaboletaf) ";

        if($result = mysqli_query($mysqliConnect, $consult))
        {
            echo "<p class='text-center'>Registro exitoso</p>";
            $consult2 = "UPDATE dbventas.producto SET stockproducto = stockproducto - '$cantidad' WHERE dbventas.producto.idproducto = '$producto'";
            if($result = mysqli_query($mysqliConnect, $consult2))
                echo "<p class='text-center'>Stock actualizado</p>";
        }else
        {
            echo "Error: " . $consult . "<br>" . $mysqliConnect->error;
        }
    }


?>