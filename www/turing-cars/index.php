<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css">
  <title>Turing Cars</title>
</head>

<body>
  <h1>Turing Cars</h1>
  <img src="./img/turing-cars.jpg" alt="">

  <?php

// conexion
$conexion = mysqli_connect("db", "root", "test");

if (!$conexion) {
    echo "Error de conexión: " . mysqli_connect_error();
}

// creación BBDD
$crearBd = mysqli_query($conexion, "CREATE DATABASE IF NOT EXISTS concesionario");

if (!$crearBd) {
    echo "Error creando bbdd: " . mysqli_error($conexion);
}

// uso bbdd
$usarBd = mysqli_select_db($conexion, "concesionario");


// creación tablas
$crearTabla = mysqli_query($conexion, "CREATE TABLE IF NOT EXISTS Coche (
                                                        matricula VARCHAR(255) NOT NULL PRIMARY KEY,
                                                        marca VARCHAR(255) NOT NULL,
                                                        modelo VARCHAR(255) NOT NULL
                                                    );");

if (!$crearTabla) {
    echo "Error creando tabla: " . mysqli_error($conexion);
}

//inserción de datos
$datos = [
  "matricula" => ["1234ABC", "1234CBA", "4321ABC"],
  "marca" => ["FORD", "AUDI", "NISSAN"],
  "modelo"=> ["FIESTA", "A3", "QASHQAI"]

];
// echo "<pre>";
// var_dump($datos);
// echo "</pre>";


for ($i=0; $i <=2 ; $i++) { 

    $matricula = $datos["matricula"][$i];
    $marca = $datos["marca"][$i];
    $modelo = $datos["modelo"][$i];

   $insert = "INSERT IGNORE INTO Coche  (`matricula`, `marca`, `modelo`) VALUES ('$matricula', '$marca', '$modelo');";

   mysqli_query($conexion, $insert);

}


// $datos = mysqli_query($conexion, "INSERT INTO Coche (`matricula`, `marca`, `modelo`) 
//                                 VALUES ('1234ABC', 'FORD', 'FIESTA'),
//                                        ('1234CBA', 'AUDI', 'A3'),
//                                        ('4321ABC', 'NISSAN', 'QASHQAI');");



//consulta
$consulta = mysqli_query($conexion, "SELECT matricula, marca, modelo FROM Coche");

if (!$consulta) {
    echo "Error en la consulta: " . mysqli_error($conexion);
}
?>


  <table>
    <tr>
      <th>Matrícula</th>
      <th>Marca</th>
      <th>Modelo</th>
    </tr>
    <?php
    while ($registro = mysqli_fetch_array($consulta)) {
      ?>
      <tr>
        <td><?= $registro["matricula"] ?></td>
        <td><?= $registro["marca"] ?></td>
        <td><?= $registro["modelo"] ?></td>
      </tr>
      <?php
    }
    ?>
  </table>
</body>

</html>