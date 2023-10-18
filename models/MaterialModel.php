<?php
class MaterialModel
{
	public $enlace;
	public function __construct()
	{

		$this->enlace = new MySqlConnect();

	}
	public function all()
	{
		try {
			//Consulta sql
			$vSql = "SELECT * FROM material;";

			//Ejecutar la consulta
			$vResultado = $this->enlace->ExecuteSQL($vSql);

			// Retornar el objeto
			return $vResultado;
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function get($id)
	{
		try {
			//Consulta sql
			$vSql = "SELECT * FROM material where id_material=$id";

			//Ejecutar la consulta
			$vResultado = $this->enlace->ExecuteSQL($vSql);
			// Retornar el objeto
			return $vResultado;
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}
	public function getMaterialColor($idMaterial)
	{
		try {
			//Consulta sql
			$vSql = "SELECT m.id_material, m.`name`, c.id_color, c.`name` as `color`  
            FROM material m, color c
            where m.id_color=c.id_color and m.id_material=$idMaterial";

			//Ejecutar la consulta
			$vResultado = $this->enlace->ExecuteSQL($vSql);
			// Retornar el objeto
			return $vResultado;
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}
	public function create($objeto)
	{
		try {
			//Consulta sql
			//Identificador autoincrementable

			$vSql = "Insert into material (name, description, image_url, measurement_unit, unit_cost, id_color)" .
				"Values ('$objeto->name', '$objeto->description', '$objeto->image_url', '$objeto->measurement_unit', '$objeto->unit_cost', '$objeto->id_color')";

			//Ejecutar la consulta
			$vResultado = $this->enlace->executeSQL_DML_last($vSql);
			// Retornar el objeto creado
			return $this->get($vResultado);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}
	public function update($objeto)
	{
		try {
			//Consulta sql
			$vSql = "Update material SET name ='$objeto->name', description = '$objeto->description', image_url = '$objeto->image_url'," .
			"measurement_unit = '$objeto->measurement_unit', unit_cost = '$objeto->unit_cost', id_color = '$objeto->id_color' Where id_material=$objeto->id_material";

			//Ejecutar la consulta
			$vResultado = $this->enlace->executeSQL_DML($vSql);
			// Retornar el objeto actualizado
			return $this->get($objeto->id_material);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}
}