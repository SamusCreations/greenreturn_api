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

                //---user
                $userModel = new UserModel();
                $user = $userModel->get($vResultado->id_user);
                //Asignar user al objeto  
                $vResultado->user = $user;

                //---collection center
                $ccModel = new CollectionCenterModel();
                $cc = $ccModel->get($vResultado->id_collection_center);
                //Asignar cc al objeto  
                $vResultado->collection_center = $cc;

                //---ExchangeDetail 
                //Consulta sql
                $vSql = "SELECT ed.*, m.name
                FROM exchange_detail ed
                JOIN material_exchange me ON ed.id_exchange = me.id_exchange
                JOIN material m ON ed.id_material = m.id_material
                WHERE me.id_exchange =$id";

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
     * Obtiene el historial de intercambios de un centro de acopio por su ID.
     *
     * @param int $id El ID del centro de acopio a buscar.
     * @return object|false Retorna un array de objetos MaterialExchange o false en caso de error o si no se encuentra el centro de acopio.
     */
    public function getCollectionCenterHistory($id)
    {
        try {
            // Consulta SQL
            $vSql = "SELECT me.* FROM material_exchange me 
         JOIN collection_center cc ON me.id_collection_center = cc.id_collection_center
         WHERE cc.id_collection_center = $id ORDER BY me.date_created;";


            // Ejecutar la consulta
            $vResultado = $this->enlace->ExecuteSQL($vSql);

            // Retornar el resultado como un array de objetos MaterialExchange
            return $vResultado;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * Obtiene el historial de intercambios de un usuario por su ID.
     *
     * @param int $id El ID del usuario a buscar.
     * @return object|false Retorna un array de objetos MaterialExchange o false en caso de error o si no se encuentra el usuario.
     */
    public function getUserHistory($id)
    {
        try {
            // Consulta SQL
            $vSql = "SELECT me.*, cc.name as cc_name
            FROM material_exchange me
            JOIN user u ON me.id_user = u.id_user
            JOIN collection_center cc ON me.id_collection_center = cc.id_collection_center
            WHERE u.id_user = $id
            ORDER BY me.date_created;";

            // Ejecutar la consulta
            $vResultado = $this->enlace->ExecuteSQL($vSql);

            // Retornar el resultado como un array de objetos MaterialExchange
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
                    "VALUES ('$vResultado', '$detail->id_material', '$detail->quantity', '$detail->unit_cost', '$detail->subtotal')";
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
                    "VALUES ('$objeto->id_exchange', '$detail->id_material', '$detail->quantity', '$detail->unit_cost', '$detail->subtotal')";
                $this->enlace->executeSQL_DML($vSql);
            }

            // Retornar el intercambio de materiales actualizado
            return $this->get($objeto->id_exchange);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
