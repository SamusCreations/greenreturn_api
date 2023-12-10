<?php
class CouponModel
{
    private $enlace; // Objeto para la conexión a la base de datos

    /**
     * Constructor de la clase.
     * Inicializa la conexión a la base de datos.
     */
    public function __construct()
    {
        $this->enlace = new MySqlConnect();
    }

    /**
     * Obtiene todos los cupones de la base de datos.
     *
     * @return array|false Retorna un array de objetos Coupon o false en caso de error.
     */
    public function all()
    {
        try {
            // Consulta SQL con JOIN a la tabla category
            $vSql = "SELECT c.*, ca.name AS category_name
                 FROM coupon c
                 INNER JOIN category ca ON c.id_category = ca.id_category";
        
            // Ejecutar la consulta
            $vResultado = $this->enlace->ExecuteSQL($vSql);
            

            // Retornar el resultado como un array de objetos Coupon
            return $vResultado;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function availableCoupons()
    {
        try {
            // Consulta SQL con JOIN a la tabla category
            $vSql = "SELECT c.*, ca.name AS category_name
                 FROM coupon c
                 INNER JOIN category ca ON c.id_category = ca.id_category";

            // Ejecutar la consulta

            $vResultado = $this->enlace->ExecuteSQL($vSql);
            for ($i = 0; $i < count($vResultado); $i++) {
                $startDate = $vResultado[$i]->start_date;
                $startDate_substring = substr($startDate, 0, 10);
                $endDate = $vResultado[$i]->end_date;
                $endDate_substring = substr($endDate, 0, 10);
                $vResultado[$i]->end_date = $endDate_substring;
                $vResultado[$i]->start_date = $startDate_substring;
            
                if ($vResultado[$i]->end_date <= date("Y-m-d")) {
                    array_splice($vResultado, $i, 1);
                    $i--; // Reduce el contador para ajustarse a la eliminación del elemento
                }
            }
            
            // Retornar el resultado como un array de objetos Coupon
            return $vResultado;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }


    /**
     * Obtiene un cupón por su ID.
     *
     * @param int $id El ID del cupón a buscar.
     * @return object|false Retorna un objeto Coupon o false en caso de error o si no se encuentra el cupón.
     */
    public function get($id)
    {
        try {
            // Consulta SQL
            $vSql = "SELECT * FROM coupon WHERE id_coupon=$id";


            // Ejecutar la consulta
            $vResultado = $this->enlace->ExecuteSQL($vSql);
            $startDate = $vResultado[0]->start_date;
            $startDate_substring = substr($startDate, 0, 10);
            $endDate = $vResultado[0]->end_date;
            $endDate_substring = substr($endDate, 0, 10);
            $vResultado[0]->end_date = $endDate_substring;
            $vResultado[0]->start_date = $startDate_substring;
            if (!empty($vResultado)) {
                //Obtener objeto
                $vResultado = $vResultado[0];
                $categoryModel = new CategoryModel();

                //---category
                $category = $categoryModel->get($vResultado->id_category);
                //Asignar category al objeto  
                $vResultado->category = $category[0];

            }

            // Retornar el resultado como un objeto Coupon
            return $vResultado;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }



    /**
     * Crea un nuevo cupón en la base de datos.
     *
     * @param object $objeto Un objeto Coupon con los datos del nuevo cupón.
     * @return object|false Retorna un objeto Coupon recién creado o false en caso de error.
     */
    public function create($objeto, $fileToUpload)
    {
        try {
            //Consulta sql
            //Identificador autoincrementable
            $target_dir = __DIR__ . "/photos/";
            $target_name = $objeto['name'] . '.png';
            $target_file = $target_dir . $target_name;
            $imageTotal = 'http://localhost:81/greenreturn_api/models/photos/' . $target_name;
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            } else {
                echo "Sorry, there was an error uploading your file.";
            }

            $start_date = $objeto['start_date'];
            $end_date = $objeto['end_date'];


            // cambio de prueba
            $vSql = "Insert into coupon (name, description,image_url, id_category, unit_cost, start_date, end_date)" .
                "Values ('" . $objeto['name'] . "', '" .
                $objeto['description'] . "','" .
                $imageTotal . "','" .
                $objeto['id_category'] . "','" .
                $objeto["unit_cost"] . "','" .
                $start_date . "','" .
                $end_date . "')";



            //Ejecutar la consulta
            $vResultado = $this->enlace->executeSQL_DML_last($vSql);
            // Retornar el objeto creado
            return $this->get($vResultado);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function update($objeto, $fileToUpload)
    {
        try {
            //Consulta sql

            $target_dir = __DIR__ . "/photos/";
            $target_name = $objeto['id_coupon'] .$objeto['name'] . '.png';
            $target_file = $target_dir . $target_name;
            $imageTotal = 'http://localhost:81/greenreturn_api/models/photos/' . $target_name;

            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
               
            } else {
                echo "Sorry, there was an error uploading your file.";
            }

            $vSql = "UPDATE coupon 
        SET name = '" . $objeto['name'] . "',
            description = '" . $objeto['description'] . "',
            image_url = '" . $imageTotal . "',
            id_category = '" . $objeto['id_category'] . "',
            unit_cost = '" . $objeto['unit_cost'] . "',
            start_date = '" . $objeto['start_date'] . "', 
            end_date = '" . $objeto['end_date'] . "'
        WHERE id_coupon = " . $objeto['id_coupon'];

            //Ejecutar la consulta
            $vResultado = $this->enlace->executeSQL_DML($vSql);
            // Retornar el objeto actualizado
            return $this->get($objeto['id_coupon']);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
