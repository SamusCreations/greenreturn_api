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
    public function getByUser($id)
    {

        $center = new CollectionCenterModel();
        $response = $center->getByUser($id);
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

    public function getCountByMaterial($param)
    {
        //Instancia del modelo
        $center = new CollectionCenterModel();
        //Acción del modelo a ejecutar
        $response = $center->getCountByMaterial($param);
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
        echo json_encode($json,
            http_response_code($json["status"])
        );
    }

    public function getMonthExchanges($param)
    {

        $MaterialExchange = new CollectionCenterModel();
        $response = $MaterialExchange->getMonthExchanges($param);
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
        echo json_encode($json,
            http_response_code($json["status"])
        );
    }

    public function getTotalCoins($param)
    {
        //Instancia del modelo
        $center = new CollectionCenterModel();
        //Acción del modelo a ejecutar
        $response = $center->getTotalCoins($param);
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
        echo json_encode($json,
            http_response_code($json["status"])
        );
    }

    public function getCoinsByCollectionCenter($param)
    {
        //Instancia del modelo
        $center = new CollectionCenterModel();
        //Acción del modelo a ejecutar
        $response = $center->getCoinsByCollectionCenter();
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
        echo json_encode($json,
            http_response_code($json["status"])
        );
    }

    public function create()
    {
        $inputJSON = file_get_contents('php://input');
        $object = json_decode($inputJSON);
        $CollectionCenter = new CollectionCenterModel();
        $response = $CollectionCenter->create($object);
        if (isset($response) && !empty($response)) {
            $json = array(
                'status' => 200,
                'results' => $response
            );
        } else {
            $json = array(
                'status' => 400,
                'total' => 0,
                'results' => "Error al insertar"
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
        $CollectionCenter = new CollectionCenterModel();
        $response = $CollectionCenter->update($object);
        if (isset($response) && !empty($response)) {
            $json = array(
                'status' => 200,
                'results' => $response
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

    public function disable()
    {
        $inputJSON = file_get_contents('php://input');
        $object = json_decode($inputJSON);
        $CollectionCenter = new CollectionCenterModel();
        $response = $CollectionCenter->disable($object);
        if (isset($response) && !empty($response)) {
            $json = array(
                'status' => 200,
                'results' => $response
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