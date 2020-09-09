<?php
    require_once('conexion.php');

    if(isset($_POST['user']) && isset($_POST['pass']))
    {
        $user = mysqli_real_escape_string($mysqliConnect, $_POST['user']);
        $pass = mysqli_real_escape_string($mysqliConnect, $_POST['pass']);
        $type = mysqli_real_escape_string($mysqliConnect, $_POST['type']);

        $query = "SELECT * FROM dbventas.usuario WHERE nombreusuario = '$user' AND tipousuario = '$type'";

        $result = $mysqliConnect->query($query);

        if (!$result) die ("Usurio no encontrado");
        elseif ($result->num_rows)
        {
            $row = $result->fetch_array(MYSQLI_NUM);

            if (password_verify($pass, $row[3]))
            {
                session_start();
                $_SESSION['NombreUsuario']=$row[1];
                echo htmlspecialchars("$row[2]: has ingresado como '$row[1]'");
                die ("<p><a href='producto.php'>Click para continuar</a></p>");
            }
            else
                echo "Contraseña incorrecta";
        }
        else die("Este usuario no fue encontrado");
    }
?>
