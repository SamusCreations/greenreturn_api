<?php
//class material
class material
{
    //Listar en el API
    public function index()
    {
        //Obtener el listado del Modelo
        $material = new MaterialModel();
        $response = $material->all();
        //Si hay respuesta
        if (isset($response) && !empty($response)) {
            //Armar el json
            $json = array(
                'status' => 200,
                'results' => $response
            );
        } else {
            $json = array(
                'status' => 400,
                'results' => "No hay registros"
            );
        }
        echo json_encode(
            $json,
            http_response_code($json["status"])
        );
    }
    public function get($param)
    {

        $material = new MaterialModel();
        $response = $material->get($param);
        $json = array(
            'status' => 200,
            'results' => $response
        );
        echo json_encode(
            $json,
            http_response_code($json["status"])
        );

    }
    public function getMaterialColor($idMaterial)
    {
        $material = new MaterialModel();
        $response = $material->getMaterialColor($idMaterial);
        //Si hay respuesta
        if (isset($response) && !empty($response)) {
            //Armar el json
            $json = array(
                'status' => 200,
                'results' => $response
            );
        } else {
            $json = array(
                'status' => 400,
                'results' => "No hay registros"
            );
        }
        echo json_encode(
            $json,
            http_response_code($json["status"])
        );
    }

    public function create()
    {
        $inputJSON = file_get_contents('php://input');
        $object = json_decode($inputJSON);
        $material = new MaterialModel();
        $response = $material->create($object);
        if (isset($response) && !empty($response)) {
            $json = array(
                'status' => 200,
                'total' => count($response),
                'results' => $response[0]
            );
        } else {
            $json = array(
                'status' => 400,
                'total' => 0,
                'results' => "No hay registros"
            );
        }
        echo json_encode(
            $json,
            http_response_code($json["status"])
        );

    }

    public function update()
    {
        $inputJSON = file_get_contents('php://input');
        $object = json_decode($inputJSON);
        $material = new MaterialModel();
        $response = $material->update($object);
        if (isset($response) && !empty($response)) {
            $json = array(
                'status' => 200,
                'total' => count($response),
                'results' => $response[0]
            );
        } else {
            $json = array(
                'status' => 400,
                'total' => 0,
                'results' => "No hay registros"
            );
        }
        echo json_encode(
            $json,
            http_response_code($json["status"])
        );

    }
}