<?php
$conexion = mysqli_connect("mysql-banca-turing-paloma.alwaysdata.net", "432299", "rootpass1234");
$usarBd = mysqli_select_db($conexion, "banca-turing-paloma_bbdd");
$crearTabla = mysqli_query($conexion, "CREATE TABLE IF NOT EXISTS cliente (
                                                        dni VARCHAR(255) NOT NULL PRIMARY KEY,
                                                        nombre VARCHAR(255) NOT NULL,
                                                        direccion VARCHAR(255) NOT NULL,
                                                        telefono VARCHAR(255) NOT NULL
                                                    );");

$accion = $_POST["accion"] ?? "";
$dni = $_POST["dni"] ?? "";
$nombre = $_POST["nombre"] ?? "";
$direccion = $_POST["direccion"] ?? "";
$telefono = $_POST["telefono"] ?? "";
$dniAntiguo = $_POST["dniAntiguo"] ?? "";
