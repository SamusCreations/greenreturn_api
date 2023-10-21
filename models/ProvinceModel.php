<?php
class ProvinceModel
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
     * Obtiene todas las provincias de la base de datos.
     *
     * @return array|false Retorna un array de objetos Province o false en caso de error.
     */
    public function all()
    {
        try {
            // Consulta SQL
            $vSql = "SELECT * FROM province";

            // Ejecutar la consulta
            $vResultado = $this->enlace->ExecuteSQL($vSql);

            // Retornar el resultado como un array de objetos Province
            return $vResultado;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * Obtiene una provincia por su ID.
     *
     * @param int $id El ID de la provincia a buscar.
     * @return object|false Retorna un objeto Province o false en caso de error o si no se encuentra la provincia.
     */
    public function get($id)
    {
        try {
            // Consulta SQL
            $vSql = "SELECT * FROM province WHERE id_province=$id";

            // Ejecutar la consulta
            $vResultado = $this->enlace->ExecuteSQL($vSql);

            // Retornar el resultado como un objeto Province
            return $vResultado;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * Crea una nueva provincia en la base de datos.
     *
     * @param object $objeto Un objeto Province con los datos de la nueva provincia.
     * @return object|false Retorna un objeto Province recién creado o false en caso de error.
     */
    public function create($objeto)
    {
        try {
            // Consulta SQL
            $vSql = "INSERT INTO province (name) VALUES ('$objeto->name')";

            // Ejecutar la consulta
            $vResultado = $this->enlace->executeSQL_DML_last($vSql);

            // Retornar la provincia recién creada
            return $this->get($vResultado);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * Actualiza una provincia existente en la base de datos.
     *
     * @param object $objeto Un objeto Province con los datos actualizados de la provincia.
     * @return object|false Retorna un objeto Province actualizado o false en caso de error.
     */
    public function update($objeto)
    {
        try {
            // Consulta SQL
            $vSql = "UPDATE province SET name='$objeto->name' WHERE id_province=$objeto->id_province";

            // Ejecutar la consulta
            $vResultado = $this->enlace->executeSQL_DML($vSql);

            // Retornar la provincia actualizada
            return $this->get($objeto->id_province);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
