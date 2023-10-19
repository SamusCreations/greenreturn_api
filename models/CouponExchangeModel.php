<?php
class CouponExchangeModel
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
            $vSql = "SELECT * FROM coupon_exchange";

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
            $vSql = "SELECT * FROM coupon_exchange WHERE id_coupon=$id";

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
            $vSql = "INSERT INTO coupon_exchange (id_coupon, id_user, qr_url, unit_cost) " .
                    "VALUES ('$objeto->id_coupon', '$objeto->id_user', '$objeto->qr_url', '$objeto->unit_cost')";

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
            $vSql = "UPDATE coupon_exchange SET id_user='$objeto->id_user', qr_url='$objeto->qr_url', unit_cost='$objeto->unit_cost' " .
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
