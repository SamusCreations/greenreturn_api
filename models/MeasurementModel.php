<?php
class MeasurementModel
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
     * Obtiene todos las medidas de la base de datos.
     *
     * @return array|false Retorna un array de objetos measurement o false en caso de error.
     */
    public function all()
    {
        try {
            // Consulta SQL
            $vSql = "SELECT * FROM measurement";

            // Ejecutar la consulta
            $vResultado = $this->enlace->ExecuteSQL($vSql);

            // Retornar el resultado como un array de objetos measurement
            return $vResultado;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * Obtiene una medida por su ID.
     *
     * @param int $id El ID del measurement a buscar.
     * @return object|false Retorna un objeto measurement o false en caso de error o si no se encuentra el measurement.
     */
    public function get($id)
    {
        try {
            // Consulta SQL
            $vSql = "SELECT * FROM measurement WHERE id_measurement=$id";

            // Ejecutar la consulta
            $vResultado = $this->enlace->ExecuteSQL($vSql);

            // Retornar el resultado como un objeto measurement
            return $vResultado;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * Crea una nueva medida en la base de datos.
     *
     * @param object $objeto Un objeto measurement con los datos del nuevo measurement.
     * @return object|false Retorna un objeto measurement recién creado o false en caso de error.
     */
    public function create($objeto)
    {
        try {
            // Consulta SQL
            $vSql = "INSERT INTO measurement (name, value) VALUES ('$objeto->name', '$objeto->value')";

            // Ejecutar la consulta
            $vResultado = $this->enlace->executeSQL_DML_last($vSql);

            // Retornar el measurement recién creado
            return $this->get($vResultado);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * Actualiza una medida existente en la base de datos.
     *
     * @param object $objeto Un objeto measurement con los datos actualizados del measurement.
     * @return object|false Retorna un objeto measurement actualizado o false en caso de error.
     */
    public function update($objeto)
    {
        try {
            // Consulta SQL
            $vSql = "UPDATE measurement SET name='$objeto->name', value='$objeto->value' WHERE id_measurement=$objeto->id_measurement";

            // Ejecutar la consulta
            $vResultado = $this->enlace->executeSQL_DML($vSql);

            // Retornar el measurement actualizado
            return $this->get($objeto->id_measurement);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
