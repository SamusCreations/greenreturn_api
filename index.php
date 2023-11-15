<?php
/* Mostrar errores */
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', "C:/xampp/htdocs/greenreturn_api/php_error_log");
/*Encabezada de las solicitudes*/
/*CORS*/
header("Access-Control-Allow-Origin: * ");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");

/*--- Requerimientos Clases o librerías*/
require_once "models/MySqlConnect.php";

/***--- Agregar todos los modelos*/
require_once "models/CantonModel.php";
require_once "models/CollectionCenterModel.php";
require_once "models/CouponModel.php";
require_once "models/DistrictModel.php";
require_once "models/ExchangeDetailModel.php";
require_once "models/MaterialExchangeModel.php";
require_once "models/MaterialModel.php";
require_once "models/ProvinceModel.php";
require_once "models/UserModel.php";
require_once "models/ColorModel.php";
require_once "models/CategoryModel.php";
require_once "models/RoleModel.php";
require_once "models/CouponExchangeModel.php";
require_once "models/MeasurementModel.php";


/***--- Agregar todos los controladores*/
require_once "controllers/CantonController.php";
require_once "controllers/CollectionCenterController.php";
require_once "controllers/CouponController.php";
require_once "controllers/DistrictController.php";
require_once "controllers/ExchangeDetailController.php";
require_once "controllers/MaterialExchangeController.php";
require_once "controllers/MaterialController.php";
require_once "controllers/ProvinceController.php";
require_once "controllers/UserController.php";
require_once "controllers/ColorController.php";
require_once "controllers/CategoryController.php";
require_once "controllers/RoleController.php";
require_once "controllers/CouponExchangeController.php";
require_once "controllers/MeasurementController.php";
require_once "controllers/ImageShowe.php";


//Enrutador
//RoutesController.php
require_once "controllers/RoutesController.php";
$index = new RoutesController();
$index->index();