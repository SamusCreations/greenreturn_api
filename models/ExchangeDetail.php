<?php
class ExchangeDetailModel
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
     * Obtiene todos los detalles de intercambio de materiales de la base de datos.
     *
     * @return array|false Retorna un array de objetos ExchangeDetail o false en caso de error.
     */
    public function all()
    {
        try {
            // Consulta SQL
            $vSql = "SELECT * FROM exchange_detail";

            // Ejecutar la consulta
            $vResultado = $this->enlace->ExecuteSQL($vSql);

            // Retornar el resultado como un array de objetos ExchangeDetail
            return $vResultado;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * Obtiene un detalle de intercambio de materiales por su ID de intercambio.
     *
     * @param int $id_exchange El ID del intercambio al que pertenece el detalle.
     * @return array|false Retorna un array de objetos ExchangeDetail o false en caso de error o si no se encuentra el detalle.
     */
    public function getByExchange($id_exchange)
    {
        try {
            // Consulta SQL
            $vSql = "SELECT * FROM exchange_detail WHERE id_exchange=$id_exchange";

            // Ejecutar la consulta
            $vResultado = $this->enlace->ExecuteSQL($vSql);

            // Retornar el resultado como un array de objetos ExchangeDetail
            return $vResultado;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * Crea un nuevo detalle de intercambio de materiales en la base de datos.
     *
     * @param object $objeto Un objeto ExchangeDetail con los datos del nuevo detalle.
     * @return object|false Retorna un objeto ExchangeDetail recién creado o false en caso de error.
     */
    public function create($objeto)
    {
        try {
            // Consulta SQL
            $vSql = "INSERT INTO exchange_detail (id_exchange, id_material, quantity, unit_cost, subtotal) " .
                    "VALUES ('$objeto->id_exchange', '$objeto->id_material', '$objeto->quantity', '$objeto->unit_cost', '$objeto->subtotal')";

            // Ejecutar la consulta
            $vResultado = $this->enlace->executeSQL_DML_last($vSql);

            // Retornar el detalle de intercambio de materiales recién creado
            return $this->get($vResultado);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * Actualiza un detalle de intercambio de materiales existente en la base de datos.
     *
     * @param object $objeto Un objeto ExchangeDetail con los datos actualizados del detalle.
     * @return object|false Retorna un objeto ExchangeDetail actualizado o false en caso de error.
     */
    public function update($objeto)
    {
        try {
            // Consulta SQL
            $vSql = "UPDATE exchange_detail SET id_material='$objeto->id_material', quantity='$objeto->quantity', " .
                    "unit_cost='$objeto->unit_cost', subtotal='$objeto->subtotal' WHERE id_exchange=$objeto->id_exchange";

            // Ejecutar la consulta
            $vResultado = $this->enlace->executeSQL_DML($vSql);

            // Retornar el detalle de intercambio de materiales actualizado
            return $this->get($objeto->id_exchange);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * Obtiene un detalle de intercambio de materiales por su ID.
     *
     * @param int $id El ID del detalle a buscar.
     * @return object|false Retorna un objeto ExchangeDetail o false en caso de error o si no se encuentra el detalle.
     */
    public function get($id)
    {
        try {
            // Consulta SQL
            $vSql = "SELECT * FROM exchange_detail WHERE id_exchange=$id";

            // Ejecutar la consulta
            $vResultado = $this->enlace->ExecuteSQL($vSql);

            // Retornar el resultado como un objeto ExchangeDetail
            return $vResultado;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
