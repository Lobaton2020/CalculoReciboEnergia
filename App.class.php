<?php

class App
{

    private static $db = null;
    public static function verifySession()
    {
        session_start();
        if (!isset($_SESSION["sesion"]) || empty($_SESSION["sesion"])) {
            header("location:index.php");
        }
    }

    private static function filterAndOrderData($data)
    {
        require_once "helper.php";
        $result_data = [];
        $i = 0;
        foreach ($data as $item) {
            if ($i != 0) {
                $key = "num_kilovatio";
                $new_item = [
                    "id" => $item["id"],
                    "{$key}" => $item[$key] - $data[($i - 1)][$key],
                    "fecha" => getDatetime($item["fecha"], "no-html")
                ];
                array_push($result_data, $new_item);
            }
            $i++;
        }
        return $result_data;
    }

    public static function getJsonForChar($months = 7)
    {
        $dateEnd = date("Y-m-d", time() + 2629743);
        $dateInit = date("Y-m-d", time() - (2629743 * $months));
        try {
            self::$db = require_once "conexion.php";
            $query = "SELECT * FROM toma_recibo WHERE fecha BETWEEN '{$dateInit}' AND '{$dateEnd}' ORDER BY id asc limit {$months}";
            $result = mysqli_query(self::$db, $query);
            $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
            $data = self::filterAndOrderData($data);
            return json_encode($data);
        } catch (Exception $e) {
            return "[]";
        }
    }
}
