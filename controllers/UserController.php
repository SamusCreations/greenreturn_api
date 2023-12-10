<?php
//Cargar todos los paquetes
require_once "vendor/autoload.php";
use Firebase\JWT\JWT;

//class user

class user
{
    private $secret_key = 'e0d17975bc9bd57eee132eecb6da6f11048e8a88506cc3bffc7249078cf2a77a';
    //Listar en el API
    public function index()
    {
        //Obtener el listado del Modelo
        $user = new UserModel();
        $response = $user->all();
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

        $user = new UserModel();
        $response = $user->get($param);
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
                'results' => "No existe el user"
            );
        }
        echo json_encode(
            $json,
            http_response_code($json["status"])
        );

    }

    public function getUserByRole($id)
    {
        $user = new UserModel();
        $response = $user->getUserByRole($id);
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

    public function getAvailableAdministrators($param)
    {
        //Obtener el listado del Modelo
        $user = new UserModel();
        $response = $user->getAvailableAdministrators($param);
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
        $user = new UserModel();
        $response = $user->create($object);
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

    public function createForm()
    {
        $inputJSON = file_get_contents('php://input');
        $object = json_decode($inputJSON);
        $user = new UserModel();
        $response = $user->createForm($object);
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
        $user = new UserModel();
        $response = $user->update($object);
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

    public function changePassword()
    {
        $inputJSON = file_get_contents('php://input');
        $object = json_decode($inputJSON);
        $user = new UserModel();
        $response = $user->changePassword($object);
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

    public function login()
    {

        $inputJSON = file_get_contents('php://input');
        $object = json_decode($inputJSON);
        $usuario = new UserModel();
        $response = $usuario->login($object);
        if (isset($response) && !empty($response) && $response != false) {
            // Datos que desea incluir en el token JWT
            $data = [
                'id_user' => $response->id_user,
                'email' => $response->email,
                'role' => $response->role->name,
            ];
            // Generar el token JWT 
            $jwt_token = JWT::encode($data, $this->secret_key, 'HS256');
            $json = array(
                'status' => 200,
                'results' => $jwt_token
            );
        } else {
            $json = array(
                'status' => 200,
                'results' => "Usuario no valido"
            );
        }
        echo json_encode(
            $json,
            http_response_code($json["status"])
        );

    }

    public function authorize()
    {
        try {

            $token = null;
            $headers = apache_request_headers();
            if (isset($headers['Authentication'])) {
                $matches = array();
                preg_match('/Bearer\s(\S+)/', $headers['Authentication'], $matches);
                if (isset($matches[1])) {
                    $token = $matches[1];
                    return true;
                }
            }
            return false;

        } catch (Exception $e) {
            return false;
        }
    }

    public function addCoins()
    {
        $inputJSON = file_get_contents('php://input');
        $object = json_decode($inputJSON);
        $user = new UserModel();
        $response = $user->addCoins($object);
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

    public function getWallet($param)
    {

        $user = new UserModel();
        $response = $user->getWallet($param);
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
                'results' => "No existe el user"
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
        $user = new UserModel();
        $response = $user->disable($object);
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