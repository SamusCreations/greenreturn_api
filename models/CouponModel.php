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
            // Consulta SQL
            $vSql = "SELECT * FROM coupon";

            // Ejecutar la consulta
            $vResultado = $this->enlace->ExecuteSQL($vSql);

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
    public function create($objeto)
    {
        try {
            // Consulta SQL
            $vSql = "INSERT INTO coupon (name, description, image_url, id_category, unit_cost, start_date, end_date) " .
                    "VALUES ('$objeto->name', '$objeto->description', '$objeto->image_url', '$objeto->id_category', '$objeto->unit_cost', '$objeto->start_date', '$objeto->end_date')";

            // Ejecutar la consulta
            $vResultado = $this->enlace->executeSQL_DML_last($vSql);

            // Retornar el cupón recién creado
            return $this->get($vResultado);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * Actualiza un cupón existente en la base de datos.
     *
     * @param object $objeto Un objeto Coupon con los datos actualizados del cupón.
     * @return object|false Retorna un objeto Coupon actualizado o false en caso de error.
     */
    public function update($objeto)
    {
        try {
            // Consulta SQL
            $vSql = "UPDATE coupon SET name='$objeto->name', description='$objeto->description', image_url='$objeto->image_url', " .
                    "id_category='$objeto->id_category', unit_cost='$objeto->unit_cost', start_date='$objeto->start_date', end_date='$objeto->end_date' " .
                    "WHERE id_coupon=$objeto->id_coupon";

            // Ejecutar la consulta
            $vResultado = $this->enlace->executeSQL_DML($vSql);

            // Retornar el cupón actualizado
            return $this->get($objeto->id_coupon);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
