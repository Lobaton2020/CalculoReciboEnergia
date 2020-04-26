<?php
include_once "helper.php";
include_once "conexion.php";
session_start();

if (!isset($_SESSION["sesion"]) || empty($_SESSION["sesion"])) {
    header("location:index.php");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = mysqli_real_escape_string($con, $_POST["id"]);
    $kilovatios = mysqli_real_escape_string($con, $_POST["numero-kilovatios"]);
    $valor = mysqli_real_escape_string($con, $_POST["valor"]);
    $fecha = mysqli_real_escape_string($con, $_POST["fecha"]);
    $sql = "UPDATE toma_recibo SET fecha= '{$fecha}',valor={$valor},num_kilovatio={$kilovatios} WHERE id={$id}";

    if (mysqli_query($con, $sql)) {
        echo "<script> window.location.href='muestraRegistros.php?registro-actualizado' </script>";
    } else {
        echo "<script> window.location.href='muestraRegistros.php?-lo-sentimos-hubo-un-error-al-actualizarlo' </script>";
    }
}

if (isset($_GET["id"]) && !empty($_GET["id"])) {

    $id = mysqli_real_escape_string($con, $_GET["id"]);
    $result = mysqli_query($con, "SELECT * FROM toma_recibo where id = {$id}");
    $datos = mysqli_fetch_assoc($result);
}
?>

<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <title>Calcular Recibo Luz</title>
  </head>
  <body>
      <div class="container">
        <h2 class="text-center mt-3">Actualizar recibo</h2>
        <a href="muestraRegistros.php" class="card-link mb-4">Atras</a>
             <form action="" method="post">
                 <input type="hidden" name="id" value="<?php echo $datos["id"]; ?>">
             <div class="form-group">
               <label for="exampleInputEmail1">Actualiza la medicion</label>
                 <input type="text" class="form-control" name="numero-kilovatios" value="<?php echo $datos["num_kilovatio"]; ?>"  required>
               </div>
               <div class="form-group">
                 <label for="exampleInputEmail1">Actualiza el precio por Kilovatio</label>
                 <input type="text" class="form-control" name="valor" value="<?php echo $datos["valor"]; ?>"  required >
               </div>
               <div class="form-group">
                 <label for="exampleInputEmail1">Actualiza Fecha en la que registrarte la toma</label>
                 <input type="date" class="form-control" name="fecha" value="<?php echo $datos["fecha"]; ?>"  required>
               </div>
               <div class="form-group">
                 <input type="submit" class="btn btn-success btn-block" name="actualizar-registro" value="Actualizar datos"  >
               </div>
             </form>
      </div>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

  </body>
</html>
