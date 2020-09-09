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
                    <form action="signup.php" method="post">
                        <div class="form-group">
                            <h1 class="text-center small">Registrar Usurio</h1>
                                <br><input type="text" name="nombreusuario" class="form-control" placeholder="Nombres" autofocus required><br>
                                <input type="text" name="apellidosusuario" class="form-control" placeholder="Apellidos" autofocus required><br>
                                <input type="password" name="claveusuario" class="form-control" placeholder="Clave" autofocus required><br>
                                <input type="password" name="reclaveusuario" class="form-control" placeholder="Repita su clave" autofocus required><br>
                                <input type="number" name="dniusuario" class="form-control" placeholder="DNI" autofocus required><br>
                                <input type="text" name="direccionusuario" class="form-control" placeholder="Dirección" autofocus required><br>
                                <input type="date" name="fechaingreso" class="form-control" placeholder="Fecha de contratación" autofocus required><br>
                                <input type="number" name="telefonousuario" class="form-control" placeholder="Numero de teléfono" autofocus required><br>
                                <select name="tipousuario" id="sector" class="form-control" required>
                                    <option class="form-control" value="Vendedor">Vendedor</option>
                                    <option class="form-control" value="Cajero">Cajero</option>
                                    <option class="form-control" value="Administrador">Administrador</option>
                                </select>
                        </div>
                        <input type="submit" class="btn btn-success btn-block" name="btn_ingresar" value="Registrar"><pre></pre>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php
    require_once('conexion.php');

    function emptyValues()
    {
        if(!empty($_POST['nombreusuario']) && !empty($_POST['apellidosusuario']) && !empty($_POST['dniusuario']) && !empty($_POST['direccionusuario'])
            && !empty($_POST['fechaingreso']) && !empty($_POST['telefonousuario']) && !empty($_POST['tipousuario']) && !empty($_POST['claveusuario']))
            $statusValues = true;
        else
            $statusValues = false;

        return $statusValues;

    }
    function userNameValidation()
    {
        if (preg_match('/^[a-zA-Z0-9]{5,}$/', $_POST["nombreusuario"])) { // for english chars + numbers only
            $stateUserName = true;
        }else{
            $stateUserName = false;
        }
        return $stateUserName;
    }

    if(emptyValues()  && userNameValidation()) {
        function VerificationOfIdenticalPasswords()
        {
            if ($_POST['claveusuario'] === $_POST['reclaveusuario'])
                $StatusOfIdenticalPasswords = true;
            else
                $StatusOfIdenticalPasswords = false;
            return $StatusOfIdenticalPasswords;
        }
    }
    if(emptyValues() && userNameValidation() && VerificationOfIdenticalPasswords()){
        function ExistenceOfUserName()
        {
            global $mysqliConnect;
            $Clean_UserExistenceOfUserName = mysqli_real_escape_string($mysqliConnect , $_POST['nombreusuario']);

            $queryExistenceOfUserName = "SELECT * FROM dbventas.usuario WHERE nombreusuario = '$Clean_UserExistenceOfUserName'";

            if ($resultExistenceOfUserName = mysqli_query($mysqliConnect, $queryExistenceOfUserName)) {
                $number_of_rowsUser = mysqli_num_rows($resultExistenceOfUserName);
                if($number_of_rowsUser >= 1)
                    $StateOfExistenceOfUserName = false;
                else
                    $StateOfExistenceOfUserName = true;
            } else{
                printf("Could not insert record: %s\n", mysqli_error($mysqliConnect));
            }
            return $StateOfExistenceOfUserName;
        }
    }

    if(emptyValues() && userNameValidation() && VerificationOfIdenticalPasswords() && ExistenceOfUserName()) {
        $nombreusuario = mysqli_real_escape_string($mysqliConnect, $_POST['nombreusuario']);
        $apellidosusuario = mysqli_real_escape_string($mysqliConnect, $_POST['apellidosusuario']);
        $claveusuario = mysqli_real_escape_string($mysqliConnect, password_hash($_POST["claveusuario"], PASSWORD_DEFAULT));
        $dniusuario = mysqli_real_escape_string($mysqliConnect, $_POST['dniusuario']);
        $direccionusuario = mysqli_real_escape_string($mysqliConnect, $_POST['direccionusuario']);
        $fechaingreso = mysqli_real_escape_string($mysqliConnect, $_POST['fechaingreso']);
        $telefonousuario = mysqli_real_escape_string($mysqliConnect, $_POST['telefonousuario']);
        $tipousuario = mysqli_real_escape_string($mysqliConnect, $_POST['tipousuario']);

        $query = "INSERT INTO dbventas.usuario (nombreusuario, apellidosusuario, claveusuario , dniusuario, direccionusuario, fechaingreso, 
                         telefonousuario, tipousuario) VALUES('$nombreusuario', '$apellidosusuario', '$claveusuario','$dniusuario', 
                                                              '$direccionusuario', '$fechaingreso', '$telefonousuario', '$tipousuario')";
        if($result = mysqli_query($mysqliConnect, $query))
        {
            echo "<p>Registro exitoso</p>";
        }else
        {
            echo "Error: " . $query . "<br>" . $mysqliConnect->error;
        }

    }elseif (!emptyValues()){
        print '<p>Llene todos los campos.</p>';
    }elseif (!userNameValidation()){
        print ('<p>Nombre de usuario no valido.</p>');
    }elseif (!VerificationOfIdenticalPasswords()) {
        print ('<p>Las contraseñas no son iguales, intentalo de nuevo.</p>');
    }elseif(!ExistenceOfUserName()){
        print ('<p>El usuario ya está registrado, intentalo de nuevo.</p>');
    }
?>
