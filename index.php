<?php include("conexion.php") ?>
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
<?php include("includes/headerlogin.php") ?>

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
                    <form action="signin.php" method="post">
                        <div class="form-group">
                            <h1 class="text-center"> Acceso</h1><br>
                                <select class="form-control" name="type">
                                    <option value="Vendedor">Vendedor</option>
                                    <option value="Cajero">Cajero</option>
                                    <option value="Administrador">Administrador</option>
                                </select>
                            <br><input type="text" name="user" class="form-control" placeholder="Usuario" autofocus><br>
                            <input type="password" name="pass" class="form-control" placeholder="Clave" autofocus><br>
                        </div>
                        <input type="submit" class="btn btn-success btn-block" name="btn_ingresar" value="Ingresar"><pre></pre>
                        <p class="text-center" >Llene los datos</p>
                    </form>
                </div>
            </div>
        </div>
    </div> 
