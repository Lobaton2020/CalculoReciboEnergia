<?php
session_start();

if(!isset($_SESSION["sesion"]) || empty($_SESSION["sesion"]) ){
   header("location:index.php");
}

?>
<?php

  include_once  "conexion.php";

  $sql_tipo = "SELECT * FROM tipo WHERE id = 1"; 
  $response_tipo = mysqli_query($con,$sql_tipo);
  $precio_kilovatio = mysqli_fetch_assoc($response_tipo)["valor"];

   $sql = "SELECT * FROM toma_recibo ORDER BY id ASC";
   $result = mysqli_query($con,$sql);
   $data = mysqli_fetch_all($result);


?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Calcular Recibo Luz</title>
  </head>
  <body>
      <h2 class="text-center mt-3">Calcular recibo Luz</h2>
      <div class="container">
  

           <form method="post" action="procesoRegistro.php">
           <div class="form-group">
             <label for="exampleInputEmail1">Actualiza el precio del KILOVATIO</label>
             <input type="text" class="form-control" name="precioKV"  value="<?php echo $precio_kilovatio; ?>" placeholder="Escribe el valor en KV (KiloVatios)">
           </div>

           <button type="submit" class="btn btn-success btn-block">Actualizar Precio KV</button>
         </form>
         <a href="index.php" class="card-link mb-4">Atras</a>

</div>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>