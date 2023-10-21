<?php
class CategoryModel
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
     * Obtiene todos los category de la base de datos.
     *
     * @return array|false Retorna un array de objetos category o false en caso de error.
     */
    public function all()
    {
        try {
            // Consulta SQL
            $vSql = "SELECT * FROM category";

            // Ejecutar la consulta
            $vResultado = $this->enlace->ExecuteSQL($vSql);

            // Retornar el resultado como un array de objetos category
            return $vResultado;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * Obtiene un category por su ID.
     *
     * @param int $id El ID del category a buscar.
     * @return object|false Retorna un objeto category o false en caso de error o si no se encuentra el category.
     */
    public function get($id)
    {
        try {
            // Consulta SQL
            $vSql = "SELECT * FROM category WHERE id_category=$id";

            // Ejecutar la consulta
            $vResultado = $this->enlace->ExecuteSQL($vSql);

            // Retornar el resultado como un objeto category
            return $vResultado;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * Crea un nuevo category en la base de datos.
     *
     * @param object $objeto Un objeto category con los datos del nuevo category.
     * @return object|false Retorna un objeto category recién creado o false en caso de error.
     */
    public function create($objeto)
    {
        try {
            // Consulta SQL
            $vSql = "INSERT INTO category (name) VALUES ('$objeto->name')";

            // Ejecutar la consulta
            $vResultado = $this->enlace->executeSQL_DML_last($vSql);

            // Retornar el category recién creado
            return $this->get($vResultado);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * Actualiza un category existente en la base de datos.
     *
     * @param object $objeto Un objeto category con los datos actualizados del category.
     * @return object|false Retorna un objeto category actualizado o false en caso de error.
     */
    public function update($objeto)
    {
        try {
            // Consulta SQL
            $vSql = "UPDATE category SET name='$objeto->name' WHERE id_category=$objeto->id_category";

            // Ejecutar la consulta
            $vResultado = $this->enlace->executeSQL_DML($vSql);

            // Retornar el category actualizado
            return $this->get($objeto->id_category);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
