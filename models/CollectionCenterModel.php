<?php
class CollectionCenterModel
{
    public $enlace;
    public function __construct()
    {
        $this->enlace = new MySqlConnect();
    }

    /*Listar todos los centros de acopio*/
    public function all()
    {
        try {
            //Consulta sql
            $vSql = "SELECT 
            collection_center.*,
            province.name AS province_name,
            canton.name AS canton_name,
            district.name AS district_name,
            CONCAT(user.name, ' ', user.surname) AS admin_name,
            GROUP_CONCAT(material_collection.id_material) AS materials
        FROM 
            collection_center
        JOIN province ON collection_center.id_province = province.id_province
        JOIN canton ON collection_center.id_canton = canton.id_canton
        JOIN district ON collection_center.id_district = district.id_district
        JOIN user ON collection_center.id_user = user.id_user
        LEFT JOIN material_collection ON collection_center.id_collection_center = material_collection.id_collection_center
        GROUP BY collection_center.id_collection_center;
        ";

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

            $vSql = "SELECT * from collection_center where id_collection_center = $id";

            //Ejecutar la consulta sql
            $vResultado = $this->enlace->executeSQL($vSql);
            if (!empty($vResultado)) {
                //Obtener objeto
                $vResultado = $vResultado[0];

                //---adminCC
                $userModel = new UserModel();
                $adminCC = $userModel->get($vResultado->id_user);
                //Asignar adminCC al objeto  
                $vResultado->administrator = $adminCC;

                //---materiales 
                //Consulta sql
                $vSql = "SELECT m.*, c.name as color_name, c.value as color_value 
                FROM material m
                JOIN material_collection mc ON m.id_material = mc.id_material
                JOIN color c ON m.id_color = c.id_color
                WHERE mc.id_collection_center = $id;
                ";

                //Ejecutar la consulta
                $listadoMaterial = $this->enlace->ExecuteSQL($vSql);

                //Asignar materiales al objeto
                $vResultado->materials = $listadoMaterial;

                //---province
                $provinceModel = new ProvinceModel();
                $province = $provinceModel->get($vResultado->id_province);
                //Asignar province al objeto  
                $vResultado->province = $province[0];

                //---canton
                $cantonModel = new cantonModel();
                $canton = $cantonModel->get($vResultado->id_canton);
                //Asignar canton al objeto  
                $vResultado->canton = $canton[0];

                //---district
                $districtModel = new districtModel();
                $district = $districtModel->get($vResultado->id_district);
                //Asignar district al objeto  
                $vResultado->district = $district[0];

            }
            //Retornar la respuesta
            return $vResultado;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function getByUser($idUser)
    {
        try {

            $vSql = "SELECT * from collection_center where id_user = $idUser";

            //Ejecutar la consulta sql
            $vResultado = $this->enlace->executeSQL($vSql);
            if (!empty($vResultado)) {
                //Obtener objeto
                $vResultado = $vResultado[0];

                //---adminCC
                $userModel = new UserModel();
                $adminCC = $userModel->get($vResultado->id_user);
                //Asignar adminCC al objeto  
                $vResultado->administrator = $adminCC;

                //---materiales 
                //Consulta sql
                $vSql = "SELECT m.*, c.name as color_name, c.value as color_value 
                FROM material m
                JOIN material_collection mc ON m.id_material = mc.id_material
                JOIN color c ON m.id_color = c.id_color
                WHERE mc.id_collection_center = $vResultado->id_collection_center;
                ";

                //Ejecutar la consulta
                $listadoMaterial = $this->enlace->ExecuteSQL($vSql);

                //Asignar materiales al objeto
                $vResultado->materials = $listadoMaterial;

                //---province
                $provinceModel = new ProvinceModel();
                $province = $provinceModel->get($vResultado->id_province);
                //Asignar province al objeto  
                $vResultado->province = $province[0];

                //---canton
                $cantonModel = new cantonModel();
                $canton = $cantonModel->get($vResultado->id_canton);
                //Asignar canton al objeto  
                $vResultado->canton = $canton[0];

                //---district
                $districtModel = new districtModel();
                $district = $districtModel->get($vResultado->id_district);
                //Asignar district al objeto  
                $vResultado->district = $district[0];

            }
            //Retornar la respuesta
            return $vResultado;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function create($objeto)
    {
        try {
            //Consulta SQL
            $vSql = "INSERT INTO collection_center (name, id_province, id_canton, id_district, address, telephone, schedule, id_user, active) " .
                "VALUES ('$objeto->name', $objeto->id_province, $objeto->id_canton, $objeto->id_district, '$objeto->address', $objeto->telephone, '$objeto->schedule', $objeto->id_user, $objeto->active)";

            //Ejecutar la consulta
            $vResultado = $this->enlace->executeSQL_DML_last($vSql);

            //--- Material ---
            //Crear elementos a insertar en material_collection
            $materials = $objeto->materials;

            foreach ($materials as $materialID) {
                $sql = "INSERT INTO material_collection (id_material, id_collection_center) VALUES ($materialID, $vResultado)";
                $this->enlace->executeSQL_DML($sql);
            }

            //Retornar centro de acopio
            return $this->get($vResultado);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function update($objeto)
    {
        try {
            //Consulta SQL
            $vSql = "UPDATE collection_center SET name = '$objeto->name', id_province = $objeto->id_province, id_canton = $objeto->id_canton, id_district = $objeto->id_district, " .
                "address = '$objeto->address', telephone = $objeto->telephone, schedule = '$objeto->schedule', id_user = $objeto->id_user, active = $objeto->active " .
                "WHERE id_collection_center = $objeto->id_collection_center";

            //Ejecutar la consulta
            $vResultado = $this->enlace->executeSQL_DML($vSql);

            //--- Materiales ---
            //Borrar materiales existentes asignados
            $vSql = "Delete from material_collection Where id_collection_center = $objeto->id_collection_center";
            $vResultado = $this->enlace->executeSQL_DML($vSql);

            //Crear elementos a insertar en material_collection
            $materials = $objeto->materials;

            foreach ($materials as $materialID) {
                $sql = "INSERT INTO material_collection (id_material, id_collection_center) VALUES ($materialID, $objeto->id_collection_center)";
                $this->enlace->executeSQL_DML($sql);
            }

            //Retornar centro de acopio
            return $this->get($objeto->id_collection_center);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function disable($objeto)
    {
        try {
            //Consulta SQL
            $vSql = "UPDATE collection_center SET active = $objeto->active 
                WHERE id_collection_center = $objeto->id_collection_center";

            //Ejecutar la consulta
            $vResultado = $this->enlace->executeSQL_DML($vSql);

            //Retornar centro de acopio
            return $this->get($objeto->id_collection_center);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

}