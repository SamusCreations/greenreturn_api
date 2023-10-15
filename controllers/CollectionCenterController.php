<?php
//class CollectionCenter
class collection_center
{
    //Listar en el API
    public function index()
    {
        //Obtener el listado del Modelo
        $center = new CollectionCenterModel();
        $response = $center->all();
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
    public function get($id)
    {

        $center = new CollectionCenterModel();
        $response = $center->get($id);
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
                'results' => "No existe el Collection Center"
            );
        }
        echo json_encode(
            $json,
            http_response_code($json["status"])
        );

    }

    public function getMaterialCollection($id)
    {

        $center = new CollectionCenterModel();
        $response = $center->getMaterialCollection($id);
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
                'results' => "No existe el Collection Center"
            );
        }
        echo json_encode(
            $json,
            http_response_code($json["status"])
        );

    }
}