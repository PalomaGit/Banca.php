<?php
require "conexion.php";

//Comprueba si existe la PK (dni)
$comprueba = mysqli_query($conexion, "SELECT COUNT(dni) FROM cliente WHERE dni='$dni' AND dni != '$dniAntiguo'");
$resultado = mysqli_fetch_array($comprueba);
$existe = $resultado[0] > 0;


// Actualiza un cliente con un determinado DNI ////////////////////////
if ($accion == "actualizar") {
    if (!$existe) {
        // UPDATE cliente SET dni="123", nombre="Antonio", direccion="Campanillas" WHERE dni="567"
        $actualizacion = "UPDATE cliente SET dni='$dni', nombre='$nombre', direccion='$direccion', telefono='$telefono' WHERE dni='$dniAntiguo'";
        mysqli_query($conexion, $actualizacion);
        echo "<script>window.location.href = 'index.php';</script>";

    } else {
        echo "<script>alert('El DNI ya existe!!');
        window.location.href = 'index.php'</script>;";
    }
}
