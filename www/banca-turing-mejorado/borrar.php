<?php
    require "conexion.php";
      // Elimina un cliente con un determinado DNI //////////////////////////
      if ($accion == "eliminar") {
        // DELETE FROM cliente WHERE dni="12345"
        $borrado = "DELETE FROM cliente WHERE dni='$dni'";
        mysqli_query($conexion, $borrado);
      }
      
header("location: index.php");