<?php include("includes/header.php") ?>
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
                        <h1 class="text-center"> Realizar Ventas</h1>
                        <br><input type="date" name="fechaventa" class="form-control" placeholder="Fecha    " autofocus required><br>
                        <br><input type="number" name="cantidad" class="form-control" placeholder="Cantidad de productos" autofocus required><br>
                        <br><input type="number" name="descuento" class="form-control" placeholder="Descuento" autofocus required><br>
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
