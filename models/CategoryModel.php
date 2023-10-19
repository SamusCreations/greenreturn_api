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
        $this->enlace = new MySqlConnect(); // Reemplaza 'MySqlConnect' con tu clase de conexión a la base de datos.
    }

    /**
     * Obtiene todas las categorías de la base de datos.
     *
     * @return array|false Retorna un array de objetos Category o false en caso de error.
     */
    public function all()
    {
        try {
            // Consulta SQL
            $vSql = "SELECT * FROM category";

            // Ejecutar la consulta
            $vResultado = $this->enlace->ExecuteSQL($vSql);

            // Retornar el resultado como un array de objetos Category
            return $vResultado;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * Obtiene una categoría por su ID.
     *
     * @param int $id El ID de la categoría a buscar.
     * @return object|false Retorna un objeto Category o false en caso de error o si no se encuentra la categoría.
     */
    public function get($id)
    {
        try {
            // Consulta SQL
            $vSql = "SELECT * FROM category WHERE id_category = $id";

            // Ejecutar la consulta
            $vResultado = $this->enlace->ExecuteSQL($vSql);

            // Retornar el resultado como un objeto Category
            return $vResultado;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * Crea una nueva categoría en la base de datos.
     *
     * @param object $objeto Un objeto Category con los datos de la nueva categoría.
     * @return object|false Retorna un objeto Category recién creado o false en caso de error.
     */
    public function create($objeto)
    {
        try {
            // Consulta SQL
            $vSql = "INSERT INTO category (name) " .
                "VALUES ('$objeto->name')";

            // Ejecutar la consulta
            $vResultado = $this->enlace->executeSQL_DML_last($vSql);

            // Retornar la categoría recién creada
            return $this->get($vResultado);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * Actualiza una categoría existente en la base de datos.
     *
     * @param object $objeto Un objeto Category con los datos actualizados de la categoría.
     * @return object|false Retorna un objeto Category actualizado o false en caso de error.
     */
    public function update($objeto)
    {
        try {
            // Consulta SQL
            $vSql = "UPDATE category SET name = '$objeto->name' " .
                "WHERE id_category = $objeto->id_category";

            // Ejecutar la consulta
            $vResultado = $this->enlace->executeSQL_DML($vSql);

            // Retornar la categoría actualizada
            return $this->get($objeto->id_category);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}

