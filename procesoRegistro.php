<?php
session_start();

if (!isset($_SESSION["sesion"]) || empty($_SESSION["sesion"])) {
    header("location:index.php");
}

?>
<?php

include_once "conexion.php";

if (isset($_POST["numRecibo"]) && !empty($_POST["numRecibo"])) {

    $numRecibe = mysqli_real_escape_string($con, $_POST["numRecibo"]);
    $date = date("Y-m-d");

    $response_tipo = mysqli_query($con, "SELECT * FROM tipo WHERE id = 1");
    $precio_kilovatio = mysqli_fetch_assoc($response_tipo)["valor"];

    $query = mysqli_query($con, "SELECT * FROM toma_recibo ORDER BY id DESC");
    $id = mysqli_fetch_assoc($query)["id"];

    $response = mysqli_query($con, "SELECT * FROM toma_recibo WHERE id = {$id}");
    $numAnterior = mysqli_fetch_assoc($response)["num_kilovatio"];
    $numRecibe = intval($numRecibe);
    $numAnterior = intval($numAnterior);

    if ($numRecibe > $numAnterior) {
        $sql = "INSERT INTO toma_recibo values (null,'{$date}',{$precio_kilovatio},{$numRecibe})";
        if (mysqli_query($con, $sql)) {
            echo "<script> window.location.href='muestraRegistros.php#ultimo' </script>";
        } else {
            echo "<script> window.location.href='index.php?cod=No_se_pudo_agregar' </script>";
        }
    } else {
        echo "<script> window.location.href='index.php?cod=el-numero-debe-ser-mayor' </script>";
    }

} else {
    // echo "<script> window.location.href='index.php' </script>";
}
// ------------------------- actualizacion del precio del kilovatio
if (isset($_POST["precioKV"]) && !empty($_POST["precioKV"])) {

    if (is_numeric($_POST["precioKV"])) {

        $_POST["precioKV"] = mysqli_real_escape_string($con, $_POST["precioKV"]);

        $num = intval($_POST['precioKV']);
        $sql = "UPDATE tipo SET valor = {$_POST['precioKV']} WHERE id = 1";

        if (mysqli_query($con, $sql)) {

            echo "<script> window.location.href='muestraPrecioKV.php?cod=Actualizado_Correctamente' </script>";

        }
    } else {
        echo "<script> window.location.href='muestraPrecioKV.php?cod=error' </script>";
    }

} else {
    echo "<script> window.location.href='muestraPrecioKV.php?cod=error' </script>";
}
