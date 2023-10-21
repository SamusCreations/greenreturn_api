<?php
class CantonModel
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
     * Obtiene todos los cantones de la base de datos.
     *
     * @return array|false Retorna un array de objetos Canton o false en caso de error.
     */
    public function all()
    {
        try {
            // Consulta SQL
            $vSql = "SELECT * FROM canton";

            // Ejecutar la consulta
            $vResultado = $this->enlace->ExecuteSQL($vSql);

            // Retornar el resultado como un array de objetos Canton
            return $vResultado;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * Obtiene un cantón por su ID.
     *
     * @param int $id El ID del cantón a buscar.
     * @return object|false Retorna un objeto Canton o false en caso de error o si no se encuentra el cantón.
     */
    public function get($id)
    {
        try {
            // Consulta SQL
            $vSql = "SELECT * FROM canton WHERE id_canton=$id";

            // Ejecutar la consulta
            $vResultado = $this->enlace->ExecuteSQL($vSql);

            // Retornar el resultado como un objeto Canton
            return $vResultado;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * Crea un nuevo cantón en la base de datos.
     *
     * @param object $objeto Un objeto Canton con los datos del nuevo cantón.
     * @return object|false Retorna un objeto Canton recién creado o false en caso de error.
     */
    public function create($objeto)
    {
        try {
            // Consulta SQL
            $vSql = "INSERT INTO canton (id_province, name) VALUES ('$objeto->id_province', '$objeto->name')";

            // Ejecutar la consulta
            $vResultado = $this->enlace->executeSQL_DML_last($vSql);

            // Retornar el cantón recién creado
            return $this->get($vResultado);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * Actualiza un cantón existente en la base de datos.
     *
     * @param object $objeto Un objeto Canton con los datos actualizados del cantón.
     * @return object|false Retorna un objeto Canton actualizado o false en caso de error.
     */
    public function update($objeto)
    {
        try {
            // Consulta SQL
            $vSql = "UPDATE canton SET name='$objeto->name' WHERE id_canton=$objeto->id_canton";

            // Ejecutar la consulta
            $vResultado = $this->enlace->executeSQL_DML($vSql);

            // Retornar el cantón actualizado
            return $this->get($objeto->id_canton);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
