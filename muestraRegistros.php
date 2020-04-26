<?php
include "helper.php";
session_start();

if (!isset($_SESSION["sesion"]) || empty($_SESSION["sesion"])) {
    header("location:index.php");
}

?>
<?php

include_once "conexion.php";

$sql = "SELECT * FROM toma_recibo ORDER BY id ASC";
$result = mysqli_query($con, $sql);
$data = mysqli_fetch_all($result);

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
    <style>

         @media(min-width:768px){
              .d-none-pc{
               display: none;
              }
         }

         @media(max-width:768px){
              .d-none-celular{
               display: none;

              }
         }
    </style>
  </head>
  <body>
    <h2 class="text-center mt-3">Calcular recibo Luz</h2>
     <div class="container">
  <a href="index.php" class="card-link mb-4">Atras</a>
      <div class="table-responsive">
         <table class="table d-none-celular">
         <thead>
           <tr>
             <th scope="col">#</th>
             <th scope="col">Fecha</th>
             <th scope="col">KiloVatios</th>
             <th scope="col">Consumo KV</th>
             <th scope="col">Total</th>
             <th scope="col">Tools</th>
           </tr>
         </thead>
         <tbody>
<?php $class = "";?>
<?php for ($i = 0; $i < count($data); $i++) {?>
  <?php if (!$i > 0) {$o = $i;} else { $o = $i - 1;?>
    <?php $kilovatios = $data[$i][3] - $data[$o][3];?>
    <?php $total = $data[$i][2] * ($data[$i][3] - $data[$o][3]);?>
    <?php if ($i == (count($data) - 1)) {$class = "style='background:#eeeeee'";}?>
<!-- se muesta solo en celular -->
<div class="card-colums d-none-pc ">

    <div class="card my-3 "  <?php echo $class; ?> >
    <div class="card-body">
      <h5 class="card-title">Pagado: <?php echo number_format($total, 0, ",", "."); ?> COP</h5>
      <p class="card-text">
        Codigo : <?php echo $data[$i][0]; ?> <br>
        Periodo: <?php echo $data[$o][3] . " - " . $data[$i][3]; ?><br>
        Consumo: <?php echo $kilovatios; ?><br>
        Valor x KV: <?php echo $data[$i][2]; ?> Pesos<br>
        Total: <?php echo number_format($total, 0, ",", "."); ?> Pesos <br>
        <a class="btn btn-light"  href="actualizarRegistro.php?id=<?php echo $data[$i][0] ?>"><i class="fas fa-pen"></i></a>
        <?php if ($i == (count($data) - 1)) {$val = $data[$i][3];?>
          <a class="btn btn-light float-right"   href="eliminarRegistro.php?id=<?php echo $data[$i][0] ?>" onclick="return confirm('¿Seguro quiere eliminar este registro?');"><i class="fas fa-trash"></i></a>
       <?php }?>

      </p>
      <p class="card-text"><small class="text-muted">Desde <?php echo getDatetime($data[$o][1]) . " Hasta " . getDatetime($data[$i][1]); ?></small></p>
    </div>
  </div>
</div>
<!-- fin -->
<!-- se muestra solo en pc -->

            <tr <?php echo $class; ?>>
             <th><?php echo $data[$i][0]; ?></th>
             <td>Desde <?php echo getDatetime($data[$o][1]) . " Hasta " . getDatetime($data[$i][1]); ?></td>
             <td><?php echo $data[$o][3] . " - " . $data[$i][3]; ?></td>
             <td><?php echo $kilovatios; ?></td>
             <td><?php echo number_format($total, 1, ",", "."); ?></td>
             <td>
               <a class="btn btn-light " href="actualizarRegistro.php?id=<?php echo $data[$i][0] ?>"><i class="fas fa-pen"></i></a>
               <?php if ($i == (count($data) - 1)) {$val = $data[$i][3];?>
                <a  class="btn btn-light"  href="eliminarRegistro.php?id=<?php echo $data[$i][0] ?>" onclick="return confirm('¿Seguro quiere eliminar este registro?');"><i class="fas fa-trash"></i> </a>
               <?php }?>
              </td>
           </tr>
<!-- fin -->

    <?php }?>
    <?php }?>

         </table>
      </div>
    </div>
    <div id="ultimo"></div>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/js/all.min.js"></script>
  </body>
</html>


