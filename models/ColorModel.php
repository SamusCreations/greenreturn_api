<?php
class ColorModel
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
     * Obtiene todos los colores de la base de datos.
     *
     * @return array|false Retorna un array de objetos Color o false en caso de error.
     */
    public function all()
    {
        try {
            // Consulta SQL
            $vSql = "SELECT * FROM color";

            // Ejecutar la consulta
            $vResultado = $this->enlace->ExecuteSQL($vSql);

            // Retornar el resultado como un array de objetos Color
            return $vResultado;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * Obtiene un color por su ID.
     *
     * @param int $id El ID del color a buscar.
     * @return object|false Retorna un objeto Color o false en caso de error o si no se encuentra el color.
     */
    public function get($id)
    {
        try {
            // Consulta SQL
            $vSql = "SELECT * FROM color WHERE id_color=$id";

            // Ejecutar la consulta
            $vResultado = $this->enlace->ExecuteSQL($vSql);

            // Retornar el resultado como un objeto Color
            return $vResultado;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * Obtiene todos los colores que no esten relacionados con un material.
     *
     * @return array|false Retorna un array de objetos Color o false en caso de error.
     */
    public function getAvailables($idMaterial)
    {
        try {
            // Consulta SQL
            $vSql = "  SELECT c.*
            FROM color c
            WHERE c.id_color NOT IN (SELECT id_color FROM material)
               OR c.id_color IN (SELECT id_color FROM material WHERE id_material = $idMaterial);";

            // Ejecutar la consulta
            $vResultado = $this->enlace->ExecuteSQL($vSql);

            // Retornar el resultado como un objeto Color
            return $vResultado;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * Crea un nuevo color en la base de datos.
     *
     * @param object $objeto Un objeto Color con los datos del nuevo color.
     * @return object|false Retorna un objeto Color recién creado o false en caso de error.
     */
    public function create($objeto)
    {
        try {
            // Consulta SQL
            $vSql = "INSERT INTO color (name, value) VALUES ('$objeto->name', '$objeto->value')";

            // Ejecutar la consulta
            $vResultado = $this->enlace->executeSQL_DML_last($vSql);

            // Retornar el color recién creado
            return $this->get($vResultado);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * Actualiza un color existente en la base de datos.
     *
     * @param object $objeto Un objeto Color con los datos actualizados del color.
     * @return object|false Retorna un objeto Color actualizado o false en caso de error.
     */
    public function update($objeto)
    {
        try {
            // Consulta SQL
            $vSql = "UPDATE color SET name='$objeto->name', value='$objeto->value' WHERE id_color=$objeto->id_color";

            // Ejecutar la consulta
            $vResultado = $this->enlace->executeSQL_DML($vSql);

            // Retornar el color actualizado
            return $this->get($objeto->id_color);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
