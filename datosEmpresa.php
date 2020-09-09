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
                            <h1 class="text-center"> Datos de la Empresa:</h1>
                            <br><input type="text" name="codempresa" class="form-control" placeholder="Código Empresa" autofocus required>
                            <br><input type="text" name="rmdirecom" class="form-control" placeholder="Nombre" autofocus required>
                            <br><input type="text" name="direcciondirecom" class="form-control" placeholder="Dirección" autofocus required><br>
                            <input type="text" name="rucdirecom" class="form-control" placeholder="Ruc" autofocus><br>
                            <input style="height: 5em" type="text" name="descripdirecom" class="form-control" placeholder="Descripción" autofocus><br>
                        </div>
                        <input type="submit" class="btn btn-success btn-block" name="btn_ingresar" value="Registrar">
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php
    require_once 'conexion.php';

    function empresa() {
        if(!empty($_POST['codempresa']) && !empty($_POST['rmdirecom']) && !empty($_POST['direcciondirecom']) && !empty($_POST['rucdirecom'])
        && !empty($_POST['descripdirecom'])){
            $empresa = true;
        }else{
            $empresa = false;
        }
        return $empresa;
    }

    if(empresa()) {

        $codEmpresa = mysqli_real_escape_string($mysqliConnect, $_POST['codempresa']);
        $nombreEmpresa = mysqli_real_escape_string($mysqliConnect, $_POST['rmdirecom']);
        $DireccionEmpresa = mysqli_real_escape_string($mysqliConnect, $_POST['direcciondirecom']);
        $RucEmpresa = mysqli_real_escape_string($mysqliConnect, $_POST['rucdirecom']);
        $DescripEmpresa = mysqli_real_escape_string($mysqliConnect, $_POST['descripdirecom']);

        $consult = "INSERT INTO dbventas.direcom(idDirecom,rmdirecom, direcciondirecom, rucdirecom, descripciondirecom) 
                                   VALUES ('$codEmpresa','$nombreEmpresa', '$DireccionEmpresa', '$RucEmpresa', '$DescripEmpresa')";

        if ($mysqliConnect->query($consult) === TRUE) {
            echo "<p>Registro exitoso</p>";
        } else {
            print "<p>Error</p>";
        }
    }elseif (!empresa()){
        print "<p class='text-center'>Llene todos los datos</p>";
    }
?>