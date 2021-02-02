<?php
require_once "App.class.php";
App::verifySession();
$data = App::getJsonForChar();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grafico de recibos</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js" integrity="sha512-d9xgZrVZpmmQlfonhQUvTR7lMPtO7NkZMkA0ABN3PHCbKA5nqylQ/yWlFAyY6hYgdF1Qh6nYiuADWwKB4C2WSw==" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <script id="data-chart">
        <?php echo $data ?>
    </script>
    <div class="container">
        <h3 class="my-4 text-center">Graficos de los ultimos peridos</h3>
        <div>
            <a href="index.php" class="card-link">Regresar</a>
        </div>
        <div>
            <canvas id="container-chart" width="00" height="400"></canvas>
        </div>
    </div>

    <script>
        function getConfiguration(data) {
            let dates = data.map(({
                fecha
            }) => fecha);
            let values = data.map(({
                num_kilovatio,
            }) => num_kilovatio);
            return [
                dates,
                values
            ]
        }
        let data = JSON.parse(document.querySelector("#data-chart").textContent);
        const [dates, values] = getConfiguration(data)
        console.log(dates, values)
        let ctx = document.querySelector("#container-chart"),
            color = "rgba(54, 162, 235, 0.2)",
            borderColor = 'rgba(54, 162, 235, 1)',
            myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: dates,
                    datasets: [{
                        label: 'Consumo en KV',
                        data: values,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
    </script>
</body>

</html>