<?php
class RoleModel
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
     * Obtiene todos los roles de la base de datos.
     *
     * @return array|false Retorna un array de objetos role o false en caso de error.
     */
    public function all()
    {
        try {
            // Consulta SQL
            $vSql = "SELECT * FROM role";

            // Ejecutar la consulta
            $vResultado = $this->enlace->ExecuteSQL($vSql);

            // Retornar el resultado como un array de objetos role
            return $vResultado;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * Obtiene un role por su ID.
     *
     * @param int $id El ID del role a buscar.
     * @return object|false Retorna un objeto role o false en caso de error o si no se encuentra el role.
     */
    public function get($id)
    {
        try {
            // Consulta SQL
            $vSql = "SELECT * FROM role WHERE id_role=$id";

            // Ejecutar la consulta
            $vResultado = $this->enlace->ExecuteSQL($vSql);

            // Retornar el resultado como un objeto role
            return $vResultado;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * Crea un nuevo role en la base de datos.
     *
     * @param object $objeto Un objeto role con los datos del nuevo role.
     * @return object|false Retorna un objeto role recién creado o false en caso de error.
     */
    public function create($objeto)
    {
        try {
            // Consulta SQL
            $vSql = "INSERT INTO role (name) VALUES ('$objeto->name')";

            // Ejecutar la consulta
            $vResultado = $this->enlace->executeSQL_DML_last($vSql);

            // Retornar el role recién creado
            return $this->get($vResultado);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * Actualiza un role existente en la base de datos.
     *
     * @param object $objeto Un objeto role con los datos actualizados del role.
     * @return object|false Retorna un objeto role actualizado o false en caso de error.
     */
    public function update($objeto)
    {
        try {
            // Consulta SQL
            $vSql = "UPDATE role SET name='$objeto->name' WHERE id_role=$objeto->id_role";

            // Ejecutar la consulta
            $vResultado = $this->enlace->executeSQL_DML($vSql);

            // Retornar el role actualizado
            return $this->get($objeto->id_role);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
