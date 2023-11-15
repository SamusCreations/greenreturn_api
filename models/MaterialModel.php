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
			$vSql = "SELECT m.*, c.name AS color_name, c.value AS color_value, me.name AS measurement_name, me.value AS measurement_value
			FROM material m
			INNER JOIN color c ON m.id_color = c.id_color
			INNER JOIN measurement me ON m.id_measurement = me.id_measurement";

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
			if (!empty($vResultado)) {
				//Obtener objeto
				$vResultado = $vResultado[0];

				//---color
				$colorModel = new ColorModel();
				$color = $colorModel->get($vResultado->id_color);
				//Asignar color al objeto  
				$vResultado->color = $color[0];

				//---measurement
				$measurementModel = new measurementModel();
				$measurement = $measurementModel->get($vResultado->id_measurement);
				//Asignar measurement al objeto  
				$vResultado->measurement = $measurement[0];

			}
			// Retornar el objeto
			return $vResultado;
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function getColorByMaterialId($materialID)
	{
		try {
			// Consulta SQL para obtener el color asociado al material
			$sql = "SELECT c.* 
                FROM color c
                INNER JOIN material m ON c.id_color = m.id_color
                WHERE m.id_material = $materialID";

			// Ejecutar la consulta
			$result = $this->enlace->ExecuteSQL($sql);

			// Comprobar si se encontró un resultado
			if ($result) {
				// Retornar el resultado como un objeto Color
				return $result;
			} else {
				// En caso de no encontrar un resultado, puedes devolver un valor nulo o lanzar una excepción según tus necesidades.
				return null;
			}
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function uploadImagen($imagen, $imagenName) {
		$fileTmpPath = $imagen['tmp_name'];

		$destination = __DIR__ . '/../assets/material_images/'.$imagenName;

		return move_uploaded_file($fileTmpPath, $destination);
}




	public function create($objeto, $fileToUpload)
	{
		try {
			//Consulta sql
			//Identificador autoincrementable
			$target_dir = __DIR__ . "/photos/";
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		$imageReference = $target_file .'.'. $imageFileType;
				if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
					echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";
				} else {
					echo "Sorry, there was an error uploading your file.";
				}
			
		
			
			$vSql = "Insert into material (name, description,image_url, id_measurement, unit_cost, id_color)" .
				"Values ('" . $objeto['name'] . "', '" .
				 $objeto['description'] . "','" .
				  $imageReference . "','" . 
				  $objeto['id_measurement'] . "','" . 
				  $objeto["unit_cost"] ."','".
				  $objeto["id_color"] . "')";

				   

			//Ejecutar la consulta
			$vResultado = $this->enlace->executeSQL_DML_last($vSql);
			// Retornar el objeto creado
			return $this->get($vResultado);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}
	public function update($objeto, $fileToUpload)
	{
		try {
			//Consulta sql

			$target_dir = __DIR__ . "/photos/";
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		$imageReference = $target_file .'.'. $imageFileType;
				if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
					echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";
				} else {
					echo "Sorry, there was an error uploading your file.";
				}

			$vSql = "UPDATE material 
			SET name = '$objeto->name',
				description = '$objeto->description',
				image_url = '$imageReference',
				id_measurement = '$objeto->id_measurement',
				unit_cost = '$objeto->unit_cost',
				id_color = '$objeto->id_color' 
			WHERE id_material = $objeto->id_material";

			//Ejecutar la consulta
			$vResultado = $this->enlace->executeSQL_DML($vSql);
			// Retornar el objeto actualizado
			return $this->get($objeto->id_material);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function getImages() {
        $target_dir = __DIR__ . "/photos/";
        $images = [];
        $files = scandir($target_dir);

        foreach ($files as $file) {
            if ($file !== '.' && $file !== '..') {
                $images[] = [
                    'image_url' => 'http://localhost/greenreturn_api/models/photos/' . $file,
                ];
            }
        }

        return $images;
    }
}