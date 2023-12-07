<?php
//class coupon
class coupon
{
    //Listar en el API
    public function index()
    {
        //Obtener el listado del Modelo
        $coupon = new CouponModel();
        $response = $coupon->all();
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

        $coupon = new CouponModel();
        $response = $coupon->get($param);
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
                'results' => "No existe el coupon"
            );
        }
        echo json_encode(
            $json,
            http_response_code($json["status"])
        );

    }

    

    public function create()
    {
        $imagenDataExists = (isset($_FILES['fileToUpload']) && $_FILES['fileToUpload']['error'] === UPLOAD_ERR_OK);
        if (!$imagenDataExists) {
            $json = array(
                'status' => 400,
                'results' => "No se creó el recurso"
            );
            echo json_encode($json);
        } else {
            $inputJSON = file_get_contents('php://input');
        $object = json_decode($inputJSON);
        $coupon = new CouponModel();
        $response = $coupon->create($_POST, $_FILES['fileToUpload']);
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
        }
        
        echo json_encode(
            $json,
            http_response_code($json["status"])
        );

    }

    public function updateCoupon()
    {
        $inputJSON = file_get_contents('php://input');
        $object = json_decode($inputJSON);
        $coupon = new CouponModel();
        $response = $coupon->update($object);
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