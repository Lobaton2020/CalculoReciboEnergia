<?php
session_start();
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
<?php

if (isset($_GET["logout"])) {
    session_destroy();
    echo "<script> window.location.href = 'index.php'; </script>";
}

if (!isset($_SESSION["sesion"]) || empty($_SESSION["sesion"])) {

    $numran = random_int(1, 5);
    switch ($numran) {
        case 1:
            $pregunta = "Como se llama tu mascota de color negro";
            $cod = "R1";
            break;
        case 2:
            $pregunta = "En que año se graduó ivan";
            $cod = "R2";
            break;
        case 3:
            $pregunta = "Que marca de celulares prefiere y recomienda ivan";
            $cod = "R3";
            break;
        case 4:
            $pregunta = "lugar de nacimiento de andres";
            $cod = "R4";
            break;
        case 5:
            $pregunta = "lugar de nacimiento de ivan";
            $cod = "R5";
            break;
        default;
            echo "LO SENTIMOS SE PRESENÓ UN ERROR";
    }

    if (isset($_POST["cod"]) || !empty($_POST["cod"])) {

        switch ($_POST["cod"]) {
            case "R1":
                $respuesta = ($_POST["respuesta"] === "felicito") ? true : false;
                break;
            case "R2":
                $respuesta = ($_POST["respuesta"] === "2011") ? true : false;
                break;
            case "R3":
                $respuesta = ($_POST["respuesta"] === "motorola") ? true : false;
                break;
            case "R4":
                $respuesta = ($_POST["respuesta"] === "villavicencio") ? true : false;
                break;
            case "R5":
                $respuesta = ($_POST["respuesta"] === "acacias") ? true : false;
                break;
            default;
                $respuesta = false;
        }

        if ($respuesta === true) {
            $_SESSION["sesion"] = "Validado";

            echo "<script> window.location.href = 'index.php'; </script> ";
        } else {
            echo "<script> window.location.href = 'index.php'; </script>";
        }
    }

?>
    <div class="container">
        <h3 class="my-4 text-center">INGRESA RESPUESTA DE VERIFICAION</h3>
        <form method="post">
            <label for="recibe">¿ <?php echo $pregunta ?> ?</label>
            <div class="form-group">
                <input type="hidden" name="cod" value="<?php echo $cod ?>">
                <input type="password" class="form-control" autofocus name="respuesta" placeholder="Ingresa la respuesta">
                <small>Por favor el texto en minusculas</small>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-info btn-block" value="Enviar Verificacion">
            </div>

        </form>
    </div>
<?php
} else {

?>

    <body>
        <h2 class="text-center mt-3">Calcular recibo Luz</h2>
        <div class="container">

            <?php if (!isset($_GET["r"])) { ?>

                <form method="post" action="procesoRegistro.php">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Escribe el ultimo valor del contador del dia de Hoy</label>
                        <input type="text" class="form-control" name="numRecibo" placeholder="Escribe el valor en KV (KiloVatios)">
                    </div>

                    <button type="submit" onclick="if(!confirm('¿Seguro agregaras este recibo ?')){ return false; }" class="btn btn-primary btn-block">Registrar Recibo</button>
                    <a href="muestraRegistros.php" class="card-link">Ver registros</a>
                    <a href="muestraPrecioKV.php" class="card-link">Ver Precio KV</a>
                    <a href="muestraGrafico.php" class="card-link">Ver en Grafico</a>
                    <a href="index.php?logout" class="card-link">Cerrar Sesion</a>
                </form>

                <?php } elseif (isset($_GET["r"])) {
                if ($_GET["r"] == 1) {
                ?>
                    <div class="card" style="">
                        <div class="card-body">
                            <h5 class="card-title">Total A pagar</h5>
                            <h6 class="card-subtitle mb-2 text-muted">Desde <?php echo $_GET["f1"] . " Hasta " . $_GET["f2"]; ?></h6>
                            <p class="card-text h1"><?php echo number_format($_GET["total"], 0, ",", "."); ?></p>
                            <a href="index.php" class="card-link">Atras</a>
                            <a href="muestraRegistros.php" class="card-link">Ver registros</a>
                            <a href="muestraPrecioKV.php" class="card-link">Ver Precio KV</a>
                            <a href="index.php?logout" class="card-link">Cerrar Sesion</a>
                        </div>
                    </div>

                <?php
                }
                ?>

            <?php } else {
                echo "<script> window.location.href='index.php' </script>";
            }
            ?>

        </div>
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>

</html>

<?php } ?>