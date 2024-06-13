<?php
require_once "./models/lineas.model.php";
class LineasController
{
    static public function index()
    {
        $data = LineasModel::index();
        $dataJson = array(
            "status" => "Success",
            "code" => 200,
            "lineas" => $data
        );
        echo json_encode($dataJson, true);
    }
    static public function create($data)
    {
        $response = LineasModel::create($data);
        if ($response == "Ok") {
            $dataJson = array(
                "status" => "Success",
                "code" => 200,
                "message" => "la linea se creo de forma correcta"
            );
            echo json_encode($dataJson, true);
        }
        else {
            $dataJson = array(
                "status" => "error",
                "code" => 404,
                "message" => $response
            );
            echo json_encode($dataJson, true);        }
    }

}