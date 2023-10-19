<?php
class MaterialExchangeModel
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
     * Obtiene todos los intercambios de materiales de la base de datos.
     *
     * @return array|false Retorna un array de objetos MaterialExchange o false en caso de error.
     */
    public function all()
    {
        try {
            // Consulta SQL
            $vSql = "SELECT * FROM material_exchange";

            // Ejecutar la consulta
            $vResultado = $this->enlace->ExecuteSQL($vSql);

            // Retornar el resultado como un array de objetos MaterialExchange
            return $vResultado;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * Obtiene un intercambio de materiales por su ID.
     *
     * @param int $id El ID del intercambio a buscar.
     * @return object|false Retorna un objeto MaterialExchange o false en caso de error o si no se encuentra el intercambio.
     */
    public function get($id)
    {
        try {
            // Consulta SQL
            $vSql = "SELECT * FROM material_exchange WHERE id_exchange=$id";

            // Ejecutar la consulta
            $vResultado = $this->enlace->ExecuteSQL($vSql);
            if (!empty($vResultado)) {
                //Obtener objeto
                $vResultado = $vResultado[0];

                //---ExchangeDetail 
                //Consulta sql
                $vSql = "SELECT ed.* FROM exchange_detail ed " .
                    "JOIN material_exchange me ON ed.id_exchange = me.id_exchange " .
                    "WHERE me.id_exchange = $id";

                //Ejecutar la consulta
                $listadoDetail = $this->enlace->ExecuteSQL($vSql);

                //Asignar ExchangeDetail al objeto
                $vResultado->details = $listadoDetail;
            }

            // Retornar el resultado como un objeto MaterialExchange
            return $vResultado;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * Crea un nuevo intercambio de materiales en la base de datos.
     *
     * @param object $objeto Un objeto MaterialExchange con los datos del nuevo intercambio.
     * @return object|false Retorna un objeto MaterialExchange recién creado o false en caso de error.
     */
    public function create($objeto)
    {
        try {
            // Consulta SQL
            $vSql = "INSERT INTO material_exchange (id_user, id_collection_center, total) VALUES ('$objeto->id_user', '$objeto->id_collection_center', '$objeto->total')";

            // Ejecutar la consulta
            $vResultado = $this->enlace->executeSQL_DML_last($vSql);

            //--- Detail ---
            //Crear elementos a insertar en exchange_detail
            $details = $objeto->details;

            foreach ($details as $detail) {
                $vSql = "INSERT INTO exchange_detail (id_exchange, id_material, quantity, unit_cost, subtotal) " .
                    "VALUES ('$detail->id_exchange', '$detail->id_material', '$detail->quantity', '$detail->unit_cost', '$detail->subtotal')";
                $this->enlace->executeSQL_DML($vSql);
            }

            // Retornar el intercambio de materiales recién creado
            return $this->get($vResultado);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * Actualiza un intercambio de materiales existente en la base de datos.
     *
     * @param object $objeto Un objeto MaterialExchange con los datos actualizados del intercambio.
     * @return object|false Retorna un objeto MaterialExchange actualizado o false en caso de error.
     */
    public function update($objeto)
    {
        try {
            // Consulta SQL
            $vSql = "UPDATE material_exchange SET id_user='$objeto->id_user', id_collection_center='$objeto->id_collection_center', total='$objeto->total' WHERE id_exchange=$objeto->id_exchange";

            // Ejecutar la consulta
            $vResultado = $this->enlace->executeSQL_DML($vSql);

            //--- exchange_detail ---
            //Borrar detalles existentes asignados
            $vSql = "Delete from exchange_detail Where id_exchange = $objeto->id_exchange";
            $vResultado = $this->enlace->executeSQL_DML($vSql);

            //Crear elementos a insertar en exchange_detail
            $details = $objeto->details;

            foreach ($details as $detail) {
                $vSql = "INSERT INTO exchange_detail (id_exchange, id_material, quantity, unit_cost, subtotal) " .
                    "VALUES ('$detail->id_exchange', '$detail->id_material', '$detail->quantity', '$detail->unit_cost', '$detail->subtotal')";
                $this->enlace->executeSQL_DML($vSql);
            }

            // Retornar el intercambio de materiales actualizado
            return $this->get($objeto->id_exchange);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
