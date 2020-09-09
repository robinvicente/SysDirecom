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
<?php
    include ('includes/headeradmin.php')
?>
<nav class="navbar navbar-expand-lg container">
    <h1 style="font-size: 18px; padding-top: 10px" >Mostrar productos</h1>
    <button class="navbar-toggler " type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
            <form class="form-inline my-2 my-lg-0">
                <input name="search" id="search" class="form-control mr-sm-2" type="search" placeholder="Buscar" aria-label="Search">
                <button class="btn btn-success my-2 my-sm-0" type="submit">Buscar</button>
            </form>
    </div>
</nav>
<div class="container">
    <div class="row p-3">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <!-- FORM TO ADD TASKS -->
                    <form id="task-form">
                        <h1 style="font-size: 20px" class="text-left">Editar Usuario</h1><br>
                        <div class="form-group">
                            <input type="text" id="usuario" placeholder="Nombre Usuario" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="text" id="apellido"  class="form-control" placeholder="Apellidos">
                        </div>
                        <div class="form-group">
                            <input type="text" id="clave"  class="form-control" placeholder="Clave">
                        </div>
                        <div class="form-group">
                            <input type="number" id="dni"  class="form-control" placeholder="DNI">
                        </div>
                        <div class="form-group">
                            <input type="text" id="direccion"  class="form-control" placeholder="Dirección">
                        </div>
                        <div class="form-group">
                            <input type="date" id="fechaingreso"  class="form-control" placeholder="Fecha de ingreso">
                        </div>
                        <div class="form-group">
                            <input type="number" id="telefono"  class="form-control" placeholder="Teléfono">
                        </div>
                        <div class="form-group">
                            <input type="text" id="tipo"  class="form-control" placeholder="Tipo de usuario">
                        </div>
                        <input type="hidden" id="taskId">
                        <button type="submit" class="btn btn-primary btn-block text-center">
                            Guardar
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- TABLE  -->
        <div class="col-md-8">
            <div class="card my-4" id="task-result">
                <div class="card-body">
                    <!-- SEARCH -->
                    <ul id="container"></ul>
                </div>
            </div>
            <table class="table table-bordered table-sm">
                <thead>
                <tr>
                    <td>Id</td>
                    <td>Nombre Usuario</td>
                    <td>Apellidos</td>
                    <td>DNI</td>
                    <td>Dirección</td>
                    <td>Fecha de ingreso</td>
                    <td>Teléfono</td>
                    <td>Tipo de Usuario</td>
                </tr>
                </thead>
                <tbody id="tasks"></tbody>
            </table>
        </div>
    </div>
</div>

<script
        src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script>
<!-- Frontend Logic -->
<script src="mostrarusuarios.js"></script>
</body>
</html>