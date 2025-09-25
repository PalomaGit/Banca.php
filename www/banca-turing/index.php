<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" integrity="sha384-tViUnnbYAV00FLIhhi3v/dWt3Jxw4gZQcNoSCxCIFNJVCx7/D55/wXsrNIRANwdD" crossorigin="anonymous">
  <link rel="stylesheet" href="css/style.css">
  <title>Banca Turing</title>
</head>
<body>

  <div id="principal">

  <div class="card">

    <div id="titulo">
      <h1 class="text-center">Banca Turing</h1>
    </div>

    <?php

    $conexion = mysqli_connect("db", "root", "test");
      $crearBd = mysqli_query($conexion, "CREATE DATABASE IF NOT EXISTS banco");
      $usarBd = mysqli_select_db($conexion, "banco");
      $crearTabla = mysqli_query($conexion, "CREATE TABLE IF NOT EXISTS cliente (
                                                        dni VARCHAR(255) NOT NULL PRIMARY KEY,
                                                        nombre VARCHAR(255) NOT NULL,
                                                        direccion VARCHAR(255) NOT NULL,
                                                        telefono VARCHAR(255) NOT NULL,
                                                        dniAntiguo VARCHAR(255) NULL
                                                    );");


      $accion = $_POST["accion"] ?? "";
      $dni = $_POST["dni"] ?? "";
      $nombre = $_POST["nombre"] ?? "";
      $direccion = $_POST["direccion"] ?? "";
      $telefono = $_POST["telefono"] ?? "";
      $dniAntiguo = $_POST["dniAntiguo"] ?? "";
      
      
      // Añade un nuevo cliente /////////////////////////////////////////////
      if ($accion == "agregar") {
        // INSERT INTO cliente VALUES ("1234", "Pepe", "Calle Grande", 1234567)
        $insercion = "INSERT INTO cliente VALUES ('$dni', '$nombre', '$direccion', '$telefono', '$dniAntiguo')";
        mysqli_query($conexion, $insercion);
      }

      // Elimina un cliente con un determinado DNI //////////////////////////
      if ($accion == "eliminar") {
        // DELETE FROM cliente WHERE dni="12345"
        $borrado = "DELETE FROM cliente WHERE dni='$dni'";
        mysqli_query($conexion, $borrado);
      }

      // Actualiza un cliente con un determinado DNI ////////////////////////
      if ($accion == "actualizar") {
        
        // UPDATE cliente SET dni="123", nombre="Antonio", direccion="Campanillas" WHERE dni="567"
        $actualizacion = "UPDATE cliente SET dni='$dni', nombre='$nombre', direccion='$direccion', telefono='$telefono', dniAntiguo = '$dniAntiguo' WHERE dni='$dniAntiguo'";
        mysqli_query($conexion, $actualizacion);
      }



      // Listado de clientes ////////////////////////////////////////////////
      $consulta = mysqli_query($conexion, "SELECT dni, nombre, direccion, telefono FROM cliente ORDER BY nombre");
    ?>

    <table class="table table-striped">
      <tr>
        <th>DNI</th>
        <th>Nombre</th>
        <th>Dirección</th>
        <th>Teléfono</th>
        <th></th>
        <th></th>
      </tr>
        <?php
        while ($registro = mysqli_fetch_array($consulta)) {
          if (($accion == "modificar") && ($dni == $registro["dni"])) {
            // Fila que queremos modificar
        ?>
            <tr class="fila-modificable">
              <form action="#" method="post">
                <td><input type="text" name="dni" value="<?= $registro["dni"] ?>"></td>
                <td><input type="text" name="nombre" value="<?= $registro["nombre"] ?>"></td>
                <td><input type="text" name="direccion" value="<?= $registro["direccion"] ?>"></td>
                <td><input type="text" name="telefono" value="<?= $registro["telefono"] ?>"></td>
                <td>
                  <input type="hidden" name="accion" value="actualizar">
                  <input type="hidden" name="dniAntiguo" value="<?= $registro["dni"] ?>">
                  <button type="submit" class="btn btn-success">
                    <i class="bi bi-check-lg"></i>
                    Aceptar
                  </button>
                </td>
              </form>
              <td>
                <form action="#" method="post">
                  <button type="submit" class="btn btn-danger">
                    <i class="bi bi-x-lg"></i>
                    Cancelar
                  </button>
                </form>
              </td>
            </tr>

          <?php
          } else {
            // Fila normal
          ?>
            <tr>
              <td><?= $registro["dni"] ?></td>
              <td><?= $registro["nombre"] ?></td>
              <td><?= $registro["direccion"] ?></td>
              <td><?= $registro["telefono"] ?></td>
              <td>
                <form action="#" method="post">
                  <input type="hidden" name="accion" value="eliminar">
                  <input type="hidden" name="dni" value="<?= $registro["dni"] ?>">
                  <button
                    type="submit"
                    class="btn btn-danger"
                    <?= $accion == "modificar" ? "disabled" : "" ?>>
                    <i class="bi bi-trash"></i>
                    Borrar
                  </button>
                </form>
              </td>
              <td>
                <form action="#" method="post">
                  <input type="hidden" name="accion" value="modificar">
                  <input type="hidden" name="dni" value="<?= $registro["dni"] ?>">
                  <button
                    type="submit"
                    class="btn btn-primary"
                    <?= $accion == "modificar" ? "disabled" : "" ?>>
                    <i class="bi bi-pencil"></i>
                    Modificar
                  </button>
                </form>
              </td>
            </tr>
        <?php
          } // if
        } // while

        if ($accion != "modificar") {
        ?>
          <tr>
            <form action="#" method="post">
            <input type="hidden" name="accion" value="agregar">
            <td><input type="text" name="dni" required></td>
            <td><input type="text" name="nombre" required></td>
            <td><input type="text" name="direccion" required></td>
            <td><input type="text" name="telefono" required></td>
            <td>
              <button type="submit" class="btn btn-success">
                <i class="bi bi-plus"></i>
                Añadir
              </button>
            </td>
            </form>
          </tr>
          <?php
          }
          ?>
    </table>

    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>