<?php
require "conexion.php";

//Comprueba si existe la PK (dni)
$comprueba = mysqli_query($conexion, "SELECT COUNT(dni) FROM cliente WHERE dni='$dni'");
$resultado = mysqli_fetch_array($comprueba);
$existe = $resultado[0] > 0;


// Añade un nuevo cliente /////////////////////////////////////////////

if ($accion == "agregar") {
    if (!$existe) {
        // INSERT INTO cliente VALUES ("1234", "Pepe", "Calle Grande", 1234567)
        $insercion = "INSERT INTO cliente VALUES ('$dni', '$nombre', '$direccion', '$telefono')";
        mysqli_query($conexion, $insercion);
        echo "<script>window.location.href = 'index.php';</script>";
    } else {
        echo "<script>alert('El DNI ya existe!!');
        window.location.href = 'index.php'</script>;";

    }
}
