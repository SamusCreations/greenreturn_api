<?php
//class color
class color
{
    //Listar en el API
    public function index()
    {
        //Obtener el listado del Modelo
        $color = new ColorModel();
        $response = $color->all();
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

        $color = new colorModel();
        $response = $color->get($param);
        $json = array(
            'status' => 200,
            'results' => $response
        );
        if (isset($response) && !empty($response)) {
            $json = array(
                'status' => 200,
                'results' => $response
            );
        } else {
            $json = array(
                'status' => 400,
                'results' => "No existe el color"
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
        $color = new colorModel();
        $response = $color->create($object);
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
        $color = new colorModel();
        $response = $color->update($object);
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