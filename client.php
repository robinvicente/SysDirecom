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
<?php include("includes/headervent.php") ?>
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
                            <h1 class="text-center"> Registrar cliente</h1>
                            <br><input type="text" name="nombrecliente" class="form-control" placeholder="Nombre o razón social" autofocus required><br>
                                <input type="text" name="direccioncliente" class="form-control" placeholder="Dirección" autofocus required><br>
                                <input type="number" name="ruccliente" class="form-control" placeholder="Ruc (Opcional)" autofocus><br>
                                <input type="email" name="emailcliente" class="form-control" placeholder="Correo electrónico (Opcional)" autofocus><br>
                                <input type="number" name="telefonocliente" class="form-control" placeholder="Teléfono (Opcional)" autofocus><br>
                        </div>
                        <input type="submit" class="btn btn-success btn-block" name="btn_ingresar" value="Registrar">
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php
    require_once 'conexion.php';
//  Definiciones de funciones para la validacion de los formularios
    function clienteBasic(){
        if(!empty($_POST['nombrecliente']) && !empty($_POST['direccioncliente'])  && empty($_POST['ruccliente'])
            && empty($_POST['emailcliente']) && empty($_POST['telefonocliente']))
        {
            $estadoValoresClienteBasic = true;
        }else
        {
            $estadoValoresClienteBasic = false;
        }
        return $estadoValoresClienteBasic;
    }


    if(!empty($_POST['nombrecliente']))
    {
        function existeCliente(){
            global $mysqliConnect;
            global $StateOfExistenceOfUser;

            $Clean_EmailExistenceOfUser = mysqli_real_escape_string($mysqliConnect , $_POST['nombrecliente']);

            $queryExistenceOfUserEmail = "SELECT * FROM dbventas.cliente WHERE cliente_rs = '$Clean_EmailExistenceOfUser'";

            if ($resultExistenceOfUserEmail  = mysqli_query($mysqliConnect, $queryExistenceOfUserEmail)) {
                $number_of_rowsEmail = mysqli_num_rows($resultExistenceOfUserEmail);
                if($number_of_rowsEmail >= 1)
                    $StateOfExistenceOfUser = false;
                else
                    $StateOfExistenceOfUser = true;
            } else {
                printf("Could not insert record: %s\n", mysqli_error($mysqliConnect));
            }
            return $StateOfExistenceOfUser;
        }

    }

    if (!empty($_POST['nombrecliente']))
    {
        function nombresRegulares()
        {
            if(preg_match('/^(?=.{3,45}$)[a-zñA-ZÑ](\s?[a-zñA-ZÑ])*$/', $_POST['nombrecliente'])
            && preg_match('/^[a-zA-Z1-9À-ÖØ-öø-ÿ]+\.?(( |\-)[a-zA-Z1-9À-ÖØ-öø-ÿ]+\.?)* (((#|[nN][oO]\.?) ?)?\d{1,4}(( ?[a-zA-Z0-9\-]+)+)?)$/D', $_POST['direccioncliente'])){
                $nombreRegular = true;

            }else
            {
                $nombreRegular = false;
            }
            return $nombreRegular;
        }
    }
    if (!empty($_POST['nombrecliente']))
    {
        function emailRegular()
        {
            if(preg_match('/^[a-z0-9_\-]+(\.[_a-z0-9\-]+)*@([_a-z0-9\-]+\.)+([a-z]{2}|aero|asia|arpa|biz|cat|com|coop|edu|gov|info|int|jobs|mil|mobi|museum|name|net|org|pro|tel|travel|xxx)$/D',
                $_POST['nombrecliente'])){
                $emailRegular = true;

            }else
            {
                $emailRegular = false;
            }
            return $emailRegular;
        }
    }

    if (!empty($_POST['nombrecliente']))
    {
        function ruc()
        {

            if(strlen($_POST['ruccliente']) == 11){
                $ruc = true;
            }else
            {
                $ruc = false;
            }
            return $ruc;
        }
    }

    if (!empty($_POST['nombrecliente']))
    {
        function telefono()
        {

            if(strlen($_POST['telefonocliente']) == 9){
                $telefono = true;
            }else
            {
                $telefono = false;
            }
            return $telefono;
        }
    }

    function clienteBasicEmail(){
        if(!empty($_POST['nombrecliente']) && !empty($_POST['direccioncliente'])  && !empty($_POST['emailcliente'])
        && empty($_POST['telefonocliente']) && empty($_POST['ruccliente']))
        {
            $estadoValoresClienteBasicEmail = true;
        }else
        {
            $estadoValoresClienteBasicEmail = false;
        }
        return $estadoValoresClienteBasicEmail;
    }

    function clienteBasicPhone(){
        if(!empty($_POST['nombrecliente']) && !empty($_POST['direccioncliente'])  && !empty($_POST['telefonocliente'])
        && empty($_POST['emailcliente']) && empty($_POST['ruccliente']))
        {
            $estadoValoresClienteBasicPhone = true;
        }else
        {
            $estadoValoresClienteBasicPhone = false;
        }
        return $estadoValoresClienteBasicPhone;
    }

    function clienteBasicEmailPhone(){
        if(!empty($_POST['nombrecliente']) && !empty($_POST['direccioncliente'])  && !empty($_POST['emailcliente']) && !empty($_POST['telefonocliente'])
        && empty($_POST['ruccliente']))
        {
            $estadoValoresClienteBasicEmailPhone = true;
        }else
        {
            $estadoValoresClienteBasicEmailPhone = false;
        }
        return $estadoValoresClienteBasicEmailPhone;
    }

    function empresaCompeta(){
        if(!empty($_POST['nombrecliente']) && $_POST['direccioncliente'] && !empty($_POST['ruccliente'])
            && !empty($_POST['emailcliente']) && !empty($_POST['telefonocliente']))
        {
            $estadoValoresEmpresaCompleta = true;
        }else
        {
            $estadoValoresEmpresaCompleta = false;
        }
        return $estadoValoresEmpresaCompleta;
    }

    function empresaBasic(){
        if(!empty($_POST['nombrecliente']) && $_POST['direccioncliente'] && !empty($_POST['ruccliente'])
            && empty($_POST['telefonocliente']) && empty($_POST['emailcliente']))
        {
            $estadoValoresEmpresaBasic = true;
        }else
        {
            $estadoValoresEmpresaBasic = false;
        }
        return $estadoValoresEmpresaBasic;
    }

    function empresaEmail(){
        if(!empty($_POST['nombrecliente']) && $_POST['direccioncliente'] && !empty($_POST['ruccliente']) && !empty($_POST['emailcliente'])
        && empty($_POST['telefonocliente']))
        {
            $estadoValoresEmpresaEmail = true;
        }else
        {
            $estadoValoresEmpresaEmail = false;
        }
        return $estadoValoresEmpresaEmail;
    }

    function empresaPhone(){
        if(!empty($_POST['nombrecliente']) && $_POST['direccioncliente'] && !empty($_POST['ruccliente']) && !empty($_POST['telefonocliente'])
        && empty($_POST['emailcliente']))
        {
            $estadoValoresEmpresaPhone = true;
        }else
        {
            $estadoValoresEmpresaPhone = false;
        }
        return $estadoValoresEmpresaPhone;
    }

    if(empresaCompeta()) {
        if (nombresRegulares() && existeCliente() && ruc() && telefono() && emailRegular()) {
            $nombrecliente = mysqli_real_escape_string($mysqliConnect, $_POST['nombrecliente']);
            $direccioncliente = mysqli_real_escape_string($mysqliConnect, $_POST['direccioncliente']);
            $ruccliente = mysqli_real_escape_string($mysqliConnect, $_POST['ruccliente']);
            $emailcliente = mysqli_real_escape_string($mysqliConnect, $_POST['emailcliente']);
            $telefonocliente = mysqli_real_escape_string($mysqliConnect, $_POST['telefonocliente']);


            $consult = "INSERT INTO dbventas.cliente (cliente_rs, direccioncliente,  ruccliente, correocliente, telefonocliente)
                     VALUES ('$nombrecliente', '$direccioncliente',
                     '$ruccliente','$emailcliente',  '$telefonocliente')";

            if ($mysqliConnect->query($consult) === TRUE) {
                echo "<p style='text-align: center'>Registro exitoso</p>";
            } else {
                echo "Error: " . $consult . "<br>" . $mysqliConnect->error;
            }
        } elseif (!nombresRegulares()) {
            print '<p style="text-align: center">Los nombres no son regulares, intentalo de nuevo.</p>';
        } elseif (!existeCliente()) {
            print '<p style="text-align: center">El cliente ya existe.</p>';
        } elseif (!ruc()) {
            print '<p style="text-align: center">El ruc tiene que tener 11 digitos.</p>';
        } elseif (!telefono()) {
            print '<p style="text-align: center">El número de telefono tiene 9 dígitos.</p>';
        }elseif (!emailRegular()) {
            print '<p style="text-align: center">Ingrese una direccion de correo legítima.</p>';
        }
    }else{
        print '<p style="text-align: center"><strong>Considere:</strong><br>Los dos primeros campos son obligatorios y los demás son opcionales según considere.</p>';
    }

    if (empresaBasic()) {
        if (ruc()) {
            $nombrecliente = mysqli_real_escape_string($mysqliConnect, $_POST['nombrecliente']);
            $direccioncliente = mysqli_real_escape_string($mysqliConnect, $_POST['direccioncliente']);
            $ruccliente = mysqli_real_escape_string($mysqliConnect, $_POST['ruccliente']);


            $consult = "INSERT INTO dbventas.cliente (cliente_rs, direccioncliente,  ruccliente)
                         VALUES ('$nombrecliente', '$direccioncliente',
                         '$ruccliente')";

            if ($mysqliConnect->query($consult) === TRUE) {
                echo "<p>Registro exitoso</p>";
            } else {
                echo "Error: " . $consult . "<br>" . $mysqliConnect->error;
            }

        } elseif (!ruc()) {
            print '<p style="text-align: center">El ruc tiene que tener 11 digitos.</p>';
        }
    }

    if (empresaEmail()){
        if(ruc() && emailRegular())
        {
            $nombrecliente = mysqli_real_escape_string($mysqliConnect, $_POST['nombrecliente']);
            $direccioncliente = mysqli_real_escape_string($mysqliConnect, $_POST['direccioncliente']);
            $ruccliente = mysqli_real_escape_string($mysqliConnect, $_POST['ruccliente']);
            $emailcliente = mysqli_real_escape_string($mysqliConnect, $_POST['emailcliente']);


            $consult = "INSERT INTO dbventas.cliente (cliente_rs, direccioncliente,  ruccliente, correocliente)
                             VALUES ('$nombrecliente', '$direccioncliente',
                             '$ruccliente','$emailcliente')";

            if ($mysqliConnect->query($consult) === TRUE) {
                echo "<p>Registro exitoso</p>";
            } else {
                echo "Error: " . $consult . "<br>" . $mysqliConnect->error;
            }

        }elseif (!ruc())
        {
            print '<p style="text-align: center">El ruc tiene que tener 11 digitos.</p>';
        }elseif (!emailRegular()) {
            print '<p style="text-align: center">Ingrese una direccion de correo legítima.</p>';
        }
    }

    if (empresaPhone()) {
        if (ruc() && telefono()) {
            $nombrecliente = mysqli_real_escape_string($mysqliConnect, $_POST['nombrecliente']);
            $direccioncliente = mysqli_real_escape_string($mysqliConnect, $_POST['direccioncliente']);
            $ruccliente = mysqli_real_escape_string($mysqliConnect, $_POST['ruccliente']);
            $telefonocliente = mysqli_real_escape_string($mysqliConnect, $_POST['telefonocliente']);


            $consult = "INSERT INTO dbventas.cliente (cliente_rs, direccioncliente,  ruccliente,  telefonocliente)
                         VALUES ('$nombrecliente', '$direccioncliente',
                         '$ruccliente',  '$telefonocliente')";

            if ($mysqliConnect->query($consult) === TRUE) {
                echo "<p>Registro exitoso</p>";
            } else {
                echo "Error: " . $consult . "<br>" . $mysqliConnect->error;
            }

        } elseif (!ruc()) {
            print '<p style="text-align: center">El ruc tiene que tener 11 digitos.</p>';
        } elseif (!telefono()) {
            print '<p style="text-align: center">El número de telefono tiene 9 dígitos.</p>';
        }
    }


    if (clienteBasic()) {
        if (nombresRegulares() && existeCliente()) {
            $nombrecliente = mysqli_real_escape_string($mysqliConnect, $_POST['nombrecliente']);
            $direccioncliente = mysqli_real_escape_string($mysqliConnect, $_POST['direccioncliente']);

            $consult = "INSERT INTO dbventas.cliente (cliente_rs, direccioncliente)
                     VALUES ('$nombrecliente', '$direccioncliente')";

            if ($mysqliConnect->query($consult) === TRUE) {
                echo "<p>Registro exitoso</p>";
            } else {
                echo "Error: " . $consult . "<br>" . $mysqliConnect->error;
            }
        } elseif (!nombresRegulares()) {
            print '<p style="text-align: center">Los nombres no son regulares, intentalo de nuevo.</p>';
        } elseif (!existeCliente()) {
            print '<p style="text-align: center">El cliente ya existe.</p>';
        }
    }

    if(clienteBasicEmail()) {
        if (nombresRegulares() && existeCliente() && emailRegular()) {
            $nombrecliente = mysqli_real_escape_string($mysqliConnect, $_POST['nombrecliente']);
            $direccioncliente = mysqli_real_escape_string($mysqliConnect, $_POST['direccioncliente']);
            $emailcliente = mysqli_real_escape_string($mysqliConnect, $_POST['emailcliente']);

            $consult = "INSERT INTO dbventas.cliente (cliente_rs, direccioncliente, correocliente)
                     VALUES ('$nombrecliente', '$direccioncliente', '$emailcliente')";

            if ($mysqliConnect->query($consult) === TRUE) {
                echo "<p>Registro exitoso</p>";
            } else {
                echo "Error: " . $consult . "<br>" . $mysqliConnect->error;
            }
        } elseif (!nombresRegulares()) {
            print '<p style="text-align: center">Los nombres no son regulares, intentalo de nuevo.</p>';
        } elseif (!existeCliente()) {
            print '<p style="text-align: center">El cliente ya existe.</p>';
        }elseif (!emailRegular()) {
            print '<p style="text-align: center">Ingrese una direccion de correo legítima.</p>';
        }
    }

    if(clienteBasicPhone()) {
        if (nombresRegulares() && existeCliente() && telefono()) {
            $nombrecliente = mysqli_real_escape_string($mysqliConnect, $_POST['nombrecliente']);
            $direccioncliente = mysqli_real_escape_string($mysqliConnect, $_POST['direccioncliente']);
            $telefonocliente = mysqli_real_escape_string($mysqliConnect, $_POST['telefonocliente']);

            $consult = "INSERT INTO dbventas.cliente (cliente_rs, direccioncliente, telefonocliente)
                         VALUES ('$nombrecliente', '$direccioncliente', '$telefonocliente')";

            if ($mysqliConnect->query($consult) === TRUE) {
                echo "<p>Registro exitoso</p>";
            } else {
                echo "Error: " . $consult . "<br>" . $mysqliConnect->error;
            }
        } elseif (!nombresRegulares()) {
            print '<p style="text-align: center">Los nombres no son regulares, intentalo de nuevo.</p>';
        } elseif (!existeCliente()) {
            print '<p style="text-align: center">El cliente ya existe.</p>';
        } elseif (!telefono()) {
            print '<p style="text-align: center">El número de telefono tiene 9 dígitos.</p>';
        }
    }

    if (clienteBasicEmailPhone()) {
        if (nombresRegulares() && existeCliente() && telefono() && emailRegular()) {
            $nombrecliente = mysqli_real_escape_string($mysqliConnect, $_POST['nombrecliente']);
            $direccioncliente = mysqli_real_escape_string($mysqliConnect, $_POST['direccioncliente']);
            $telefonocliente = mysqli_real_escape_string($mysqliConnect, $_POST['telefonocliente']);
            $emailcliente = mysqli_real_escape_string($mysqliConnect, $_POST['emailcliente']);

            $consult = "INSERT INTO dbventas.cliente (cliente_rs, direccioncliente, correocliente,telefonocliente)
                         VALUES ('$nombrecliente', '$direccioncliente', ' $emailcliente','$telefonocliente')";

            if ($mysqliConnect->query($consult) === TRUE) {
                echo "<p>Registro exitoso</p>";
            } else {
                echo "Error: " . $consult . "<br>" . $mysqliConnect->error;
            }
        } elseif (!nombresRegulares()) {
            print '<p style="text-align: center">Los nombres no son regulares, intentalo de nuevo.</p>';
        } elseif (!existeCliente()) {
            print '<p style="text-align: center">El cliente ya existe.</p>';
        } elseif (!telefono()) {
            print '<p style="text-align: center">El número de telefono tiene 9 dígitos.</p>';
        }elseif (!emailRegular()) {
            print '<p style="text-align: center">Ingrese una direccion de correo legítima.</p>';
        }
    }

?>