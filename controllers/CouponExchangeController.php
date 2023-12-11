<?php
//class CouponExchange
class coupon_exchange 
{
    //Listar en el API
    public function index()
    {
        //Obtener el listado del Modelo
        $CouponExchange = new CouponExchangeModel();
        $response = $CouponExchange->all();
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

        $CouponExchange = new CouponExchangeModel();
        $response = $CouponExchange->get($param);
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
                'results' => "No existe el Coupon Exchange"
            );
        }
        echo json_encode(
            $json,
            http_response_code($json["status"])
        );

    }

    public function getUserHistory($param)
    {

        $CouponExchange = new CouponExchangeModel();
        $response = $CouponExchange->getUserHistory($param);
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
                'results' => "No hay datos o no existe el Coupon Exchange"
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
        $material = new CouponExchangeModel();
        $response = $material->create($object);
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

    public function update()
    {
        $inputJSON = file_get_contents('php://input');
        $object = json_decode($inputJSON);
        $material = new CouponExchangeModel();
        $response = $material->update($object);
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

    public function getTotalExchanges($param)
    {
        //Obtener el listado del Modelo
        $CouponExchange = new CouponExchangeModel();
        $response = $CouponExchange->getTotalExchanges();
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

    public function getTotalCoins($param)
    {
        //Obtener el listado del Modelo
        $CouponExchange = new CouponExchangeModel();
        $response = $CouponExchange->getTotalCoins();
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
}