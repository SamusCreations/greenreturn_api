<?php
class UserModel
{
    public $enlace;
    public function __construct()
    {
        $this->enlace = new MySqlConnect();
    }

    /*Listar todos los usuarios*/
    public function all()
    {
        try {
            //Consulta sql
            $vSql = "SELECT * FROM user;";

            //Ejecutar la consulta
            $vResultado = $this->enlace->ExecuteSQL($vSql);

            // Retornar el objeto
            return $vResultado;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /*Obtener el usuario según el id*/
    public function get($id)
    {
        try {
            //Consulta sql
            $vSql = "SELECT * FROM user where id_user=$id";

            //Ejecutar la consulta
            $vResultado = $this->enlace->ExecuteSQL($vSql);
            // Retornar el objeto
            return $vResultado;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /*Obtener los usuarios según el rol */
    public function getUserByRole($idRole)
    {
        try {
            //Consulta SQL
            $vSQL = "SELECT u.id_user, u.identification, u.`name`," .
                " u.surname, u.email, u.id_role, r.`name`, u.`active`" .
                " FROM `user` u, `role` r" .
                " where u.id_role=r.id_role and r.id_role=$idRole;";
            //Establecer conexión

            //Ejecutar la consulta
            $vResultado = $this->enlace->executeSQL($vSQL);
            //Retornar el resultado
            return $vResultado;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function getUserRoleForm($idRole)
    {
        try {
            //Consulta SQL
            $vSQL = "SELECT u.id_user, u.identification, u.`name`," .
            " u.surname, u.email, u.id_role, r.`name`, u.`active`" .
            " FROM `user` u, `role` r" .
            " where u.id_role=r.id_role and r.id_role=$idRole;";
            //Establecer conexión

            //Ejecutar la consulta
            $vResultado = $this->enlace->executeSQL($vSQL);
            //Retornar el resultado
            return $vResultado;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

}