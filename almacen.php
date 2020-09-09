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
    <title>Mostrar Poductos | Direcom SRL</title>
</head>
<body>
<?php include("includes/headeradmin.php") ?>
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
                            <h1 class="text-center"> Registrar Almacen</h1>
                            <br><input type="text" name="codalmacen" class="form-control" placeholder="Código" autofocus required>
                            <br><input type="text" name="almacen" class="form-control" placeholder="Nombre" autofocus required><br>
                            <input type="text" name="direccion" class="form-control" placeholder="Direccion" autofocus><br>
                        </div>
                        <input type="submit" class="btn btn-success btn-block" name="btn_ingresar" value="Registrar">
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php
    require_once 'conexion.php';

    function almacen() {
        if(!empty($_POST['almacen']) && !empty($_POST['direccion']) && !empty($_POST['codalmacen']) ){
            $almacen = true;
        }else{
            $almacen = false;
        }
        return $almacen;
    }

    if(almacen()) {

        $codAlmacen = mysqli_real_escape_string($mysqliConnect, $_POST['codalmacen']);
        $nombreAlmacen = mysqli_real_escape_string($mysqliConnect, $_POST['almacen']);
        $DirecAlmacen = mysqli_real_escape_string($mysqliConnect, $_POST['direccion']);

        $consult = "INSERT INTO dbventas.almacen(idalmacen,nombrealmacen, direccionalmacen) 
                                   VALUES ('$codAlmacen','$nombreAlmacen', '$DirecAlmacen')";


        if ($mysqliConnect->query($consult) === TRUE) {
            echo "<p>Registro exitoso</p>";
        } else {
            print "<p>Error</p>";
        }
    }elseif (!almacen()){
        print "<p>Llene todos los datos</p>";
    }
?>