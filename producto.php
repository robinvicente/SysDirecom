<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- FONT AWESOEM -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>

</body>
</html>
    <div class="justify-content-md-end bg-dark">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark container">
            <a class=" navbar-brand" href="#">Direcom</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            </button>
            <div class="collapse navbar-collapse pl-3" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link " href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Productos
                        </a>
                        <div class="dropdown-menu bg-dark " aria-labelledby="navbarDropdown">
                            <a class="dropdown-item text-white bg-dark" href="producto.php">Ingresar procuto</a>
                            <a class="dropdown-item text-white bg-dark" href="_mostrarproducto.php">Mostrar Productos</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link " href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Ventas
                        </a>
                        <div class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item text-white bg-dark" href="#">Vender boleta</a>
                            <a class="dropdown-item text-white bg-dark" href="#">Vender factura</a>
                        </div>
                    </li>

                </ul>
            </div>
            <a class=" nav-item text-white" href="#">Salir</a>
        </nav>
    </div>
    <div class="container p-4">
        <div class="row">
            <div class="col-md-4 mx-auto">
                <?php if(isset($_SESSION['message'])) { ?>
                    <div class="alert alert-<?=$_SESSION['message_type'];?> alert-dismissible fade show" role="alert">
                        <?= $_SESSION['message'] ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php session_unset();} ?>
                <div class="card card-body">
                    <form method="post">
                        <div class="form-group">
                            <h1 class="text-center"> Registrar Producto</h1>
                            <br><input type="text" name="nombreproducto" class="form-control" placeholder="Nombre" autofocus required><br>
                            <input type="text" name="marca" class="form-control" placeholder="Marca" autofocus><br>
                            <input type="text" name="descripccion" class="form-control" placeholder="Descripción" autofocus required><br>
                            <input type="text" name="costounitario"     class="form-control" placeholder="Costo unitario del producto" autofocus><br>
                            <input type="text" name="unidadmedida" class="form-control" placeholder="Unidad de medida" autofocus><br>
                            <input type="number" name="stock" class="form-control" placeholder="Stock" autofocus><br>
                            <select class="form-control" name="typec">
                                <option value="usb">Usb</option>
                                <option value="mochila">Mochila</option>
                                <option value="mouse">Mouse</option>
                                <option value="teclado">Teclado</option>
                                <option value="hdd">Disco Duros</option>
                                <option value="ssd">Discos SSD</option>
                                <option value="monitor">Monitor</option>
                                <option value="targetasdevdideo">Targeta de viedo</option>
                                <option value="procesador">Procesasore</option>
                                <option value="router">Router</option>
                                <option value="camara=">Cámara</option>
                                <option value="papeleria">Papelería</option>
                                <option value="targetamadre">Targeta Madre</option>
                                <option value="stereo">Stereo</option>
                                <option value="audifono">Audífono</option>
                                <option value="acccompu">Accesorios para computadora</option>
                                <option value="accimpresora">Accesorios para impresora</option>
                            </select><br>
                            <select class="form-control" name="typea">
                                <option value="ALM">Almacen Talavera</option>
                            </select>
                        </div>
                        <input type="submit" class="btn btn-success btn-block" name="btn_ingresar" value="Registrar">
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php
    require_once 'conexion.php';

    function all() {
        if(!empty($_POST['nombreproducto']) && !empty($_POST['marca']) &&
            !empty($_POST['descripccion']) && !empty($_POST['costounitario']) &&
            !empty($_POST['unidadmedida']) && !empty($_POST['stock'])){
            $all = true;
        }else{
            $all = false;
        }
        return $all;
    }


    if (all()){
        function costoUnitario(){
            if (preg_match("/^([0-9]+\.+[0-9]|[0-9])+$/", $_POST['costounitario'])){
                $costoUnitario = true;
            }else{
                $costoUnitario = false;
            }
            return $costoUnitario;
        }
    }

    if (all()){
        function unidadMedida(){
            if (preg_match("/^[a-z]+$/i", $_POST['unidadmedida'])){
                $unidadMedida = true;
            }else{
                $unidadMedida = false;
            }
            return $unidadMedida;
        }
    }

    if (all()){
        function stock(){
            if (preg_match("/^[0-9]+$/", $_POST['stock'])){
                $stock = true;
            }else{
                $stock = false;
            }
            return $stock;
        }
    }

    if(all() && stock() && unidadMedida() && costoUnitario()){

        $nombreProducto = mysqli_real_escape_string($mysqliConnect, $_POST['nombreproducto']);
        $marcaProducto = mysqli_real_escape_string($mysqliConnect, $_POST['marca']);
        $DescripProducto = mysqli_real_escape_string($mysqliConnect, $_POST['descripccion']);
        $costoProducto = mysqli_real_escape_string($mysqliConnect, $_POST['costounitario']);
        $unidadMedidaProducto = mysqli_real_escape_string($mysqliConnect, $_POST['unidadmedida']);
        $stockProducto = mysqli_real_escape_string($mysqliConnect, $_POST['stock']);
        $alamcenProducto = mysqli_real_escape_string($mysqliConnect, $_POST['typea']);
        $categoriaProducto = mysqli_real_escape_string($mysqliConnect, $_POST['typec']);

        $consult = "INSERT INTO dbventas.producto (nombreproducto, marcaproducto, descripcionproducto,   
                               costounitarioproducto, unidadmedidaproducto, stockproducto,  almacen_idalmacen , categoria_idcategoria) 
                               VALUES ('$nombreProducto', '$marcaProducto','$DescripProducto',
                                       '$costoProducto',  '$unidadMedidaProducto', '$stockProducto',  '$alamcenProducto','$categoriaProducto')";


        if ($mysqliConnect->query($consult) === TRUE) {
            echo "<p class='text-center'>Registro exitoso</p>";
        } else {
            /*print "<p class='text-center'>El costo  del producto solo tienes dos decimales.</p>";*/
            echo $mysqliConnect->error;
        }
    }elseif (!all()){
        print "<p class='text-center'>Llene todos los campos</p>";
    }elseif (!unidadMedida()){
        print "<p class='text-center'>El campo de la unidad de medida solo es texto.</p>";
    }elseif (!costoUnitario()){
        print "<p class='text-center'>El costo unitario tiene el siguiente formato: 10.50 </p>";
    }elseif (!all()){
        print "<p class='text-center'>En stock solo es numeros enteros positivos.</p>";
    }

?>