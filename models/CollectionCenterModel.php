<?php
class CollectionCenterModel
{
    public $enlace;
    public function __construct()
    {
        $this->enlace = new MySqlConnect();
    }

    /*Listar todos los centros de acopio*/
    public function all()
    {
        try {
            //Consulta sql
            $vSql = "SELECT * FROM collection_center;";

            //Ejecutar la consulta
            $vResultado = $this->enlace->ExecuteSQL($vSql);

            // Retornar el objeto
            return $vResultado;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /*Obtener centro de acopio por id*/
    public function get($id)
    {
        try {
            //Consulta sql
            $vSql = "SELECT * FROM collection_center where id_collection_center=$id";

            //Ejecutar la consulta
            $vResultado = $this->enlace->ExecuteSQL($vSql);
            // Retornar el objeto
            return $vResultado;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /* Obtener todo los Material de un Collection Center */
    public function getMaterialCollection($id)
    {
        try {
            //Consulta sql
            $vSql = "SELECT m.* FROM material m" . 
            "JOIN material_collection mc ON m.id_material = mc.id_material" .
            "WHERE mc.id_collection_center = $id";

            //Ejecutar la consulta
            $vResultado = $this->enlace->ExecuteSQL($vSql);
            // Retornar el objeto
            return $vResultado;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function create($objeto)
{
    try {
        //Consulta SQL
        $vSql = "INSERT INTO collection_center (name, id_province, id_canton, id_district, address, telephone, schedule, id_user, active) " .
                "VALUES ('$objeto->name', $objeto->id_province, $objeto->id_canton, $objeto->id_district, '$objeto->address', $objeto->telephone, '$objeto->schedule', $objeto->id_user, $objeto->active)";

        //Ejecutar la consulta
        $vResultado = $this->enlace->executeSQL_DML_last($vSql);
        // Retornar el objeto creado
        return $this->get($vResultado);
    } catch (Exception $e) {
        die($e->getMessage());
    }
}

public function update($objeto)
{
    try {
        //Consulta SQL
        $vSql = "UPDATE collection_center SET name = '$objeto->name', id_province = $objeto->id_province, id_canton = $objeto->id_canton, id_district = $objeto->id_district, " .
                "address = '$objeto->address', telephone = $objeto->telephone, schedule = '$objeto->schedule', id_user = $objeto->id_user, active = $objeto->active " .
                "WHERE id_collection_center = $objeto->id_collection_center";

        //Ejecutar la consulta
        $vResultado = $this->enlace->executeSQL_DML($vSql);
        // Retornar el objeto actualizado
        return $this->get($objeto->id_collection_center);
    } catch (Exception $e) {
        die($e->getMessage());
    }
}

}