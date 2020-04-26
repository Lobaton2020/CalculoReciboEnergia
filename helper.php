<?php
function getDatetime($fecha)
{

    $date = new DateTime($fecha);

    $mes = [1 => "Enero",
        2 => "Febrero",
        3 => "Marzo",
        4 => "Abril",
        5 => "Mayo",
        6 => "Junio",
        7 => "Julio",
        8 => "Agosto",
        9 => "Sertiembre",
        10 => "Octubre",
        11 => "Noviembre",
        12 => "Diciembre"];

    $dia = [0 => "Lunes",
        1 => "Martes",
        2 => "Miercoles",
        3 => "Jueves",
        4 => "Viernes",
        5 => "Sabado",
        6 => "Domingo"];

    $string_formato = $dia[$date->format("w")] .
    " <em><b>" . $date->format("j") .
    " de " . $mes[$date->format("n")] .
    "</b></em> del " . $date->format("Y");

    return $string_formato;
}
