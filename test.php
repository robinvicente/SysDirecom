<?php
require_once ('conexion.php');?>
<select class="form-control input-sm" id="clienteVenta" name="preciounitario">
    <option value="A">Selecciona</option>
    <option value="0">Sin cliente</option>
    <?php

    $sql="SELECT idproducto, costounitarioproducto, nombreproducto
				from dbventas.producto";
    $result=mysqli_query($mysqliConnect,$sql);
    while ($row=mysqli_fetch_row($result)):
        ?>
        <option value="<?php echo $row[1] ?>"><?php echo $row[2]?> - <?php echo $row[1]?></option>
    <?php endwhile; ?>
</select>