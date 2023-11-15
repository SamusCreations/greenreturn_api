<?php
class DistrictModel
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
     * Obtiene todos los distritos de la base de datos.
     *
     * @return array|false Retorna un array de objetos District o false en caso de error.
     */
    public function all()
    {
        try {
            // Consulta SQL
            $vSql = "SELECT * FROM district";

            // Ejecutar la consulta
            $vResultado = $this->enlace->ExecuteSQL($vSql);

            // Retornar el resultado como un array de objetos District
            return $vResultado;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * Obtiene un distrito por su ID.
     *
     * @param int $id El ID del distrito a buscar.
     * @return object|false Retorna un objeto District o false en caso de error o si no se encuentra el distrito.
     */
    public function get($id)
    {
        try {
            // Consulta SQL
            $vSql = "SELECT * FROM district WHERE id_district=$id";

            // Ejecutar la consulta
            $vResultado = $this->enlace->ExecuteSQL($vSql);

            // Retornar el resultado como un objeto District
            return $vResultado;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * Obtiene un distrito por el ID del canton.
     *
     * @param int $id El ID del canton del distrito a buscar.
     * @return object|false Retorna un objeto District o false en caso de error o si no se encuentra el distrito.
     */
    public function getByCanton($id)
    {
        try {
            // Consulta SQL
            $vSql = "SELECT * FROM district WHERE id_canton=$id";

            // Ejecutar la consulta
            $vResultado = $this->enlace->ExecuteSQL($vSql);

            // Retornar el resultado como un objeto District
            return $vResultado;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * Crea un nuevo distrito en la base de datos.
     *
     * @param object $objeto Un objeto District con los datos del nuevo distrito.
     * @return object|false Retorna un objeto District recién creado o false en caso de error.
     */
    public function create($objeto)
    {
        try {
            // Consulta SQL
            $vSql = "INSERT INTO district (id_province, id_canton, name) VALUES ('$objeto->id_province', '$objeto->id_canton', '$objeto->name')";

            // Ejecutar la consulta
            $vResultado = $this->enlace->executeSQL_DML_last($vSql);

            // Retornar el distrito recién creado
            return $this->get($vResultado);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * Actualiza un distrito existente en la base de datos.
     *
     * @param object $objeto Un objeto District con los datos actualizados del distrito.
     * @return object|false Retorna un objeto District actualizado o false en caso de error.
     */
    public function update($objeto)
    {
        try {
            // Consulta SQL
            $vSql = "UPDATE district SET name='$objeto->name' WHERE id_district=$objeto->id_district";

            // Ejecutar la consulta
            $vResultado = $this->enlace->executeSQL_DML($vSql);

            // Retornar el distrito actualizado
            return $this->get($objeto->id_district);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
