<?php
$conexion = mysqli_connect("db", "root", "test");
$crearBd = mysqli_query($conexion, "CREATE DATABASE IF NOT EXISTS banco");
$usarBd = mysqli_select_db($conexion, "banco");
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
