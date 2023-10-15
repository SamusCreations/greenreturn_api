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
}