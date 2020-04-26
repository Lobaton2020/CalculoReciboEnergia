<?php

require "conexion.php";

if (isset($_GET["id"]) && !empty($_GET["id"])) {
    $id = mysqli_real_escape_string($con, $_GET["id"]);
    if (mysqli_query($con, "DELETE FROM toma_recibo WHERE id={$id}")) {
        echo "<script> window.location.href='muestraRegistros.php?cod=Registro-eliminado#ultimo' </script>";
    } else {
        echo "<script> window.location.href='muestraRegistros.php?-lo-sentimos-hubo-un-error-al-eliminarlo' </script>";

    }
}
