<?php
require_once ("./controllers/Lineas.controller.php");
$routesArray = explode("/", $_SERVER['REQUEST_URI']);
//echo json_encode(array_filter($routesArray), true);

if (count(array_filter($routesArray)) >= 2) {
    switch ($routesArray[2]) {
        case 'lineas':
            if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "GET") {
                $data = new LineasController();
                $data::index();
                return;
            }
            if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "POST") {
                if (
                    isset($_POST["Nombre_linea"])&&
                    isset($_POST["estado"])
                ) {
                    $data = array("Nombre_linea"=>$_POST["Nombre_linea"],
                    "estado"=>$_POST["estado"]);
                }
                $crearlinea= new LineasController();
                $crearlinea::create($data);
            }
            break;
    }
}