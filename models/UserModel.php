<?php
class UserModel
{
    public $enlace;
    public function __construct()
    {
        $this->enlace = new MySqlConnect();
    }

    /*Listar todos los usuarios*/
    public function all()
    {
        try {
            //Consulta sql
            $vSql = "SELECT 
            u.id_user, 
            u.email, 
            u.id_role, 
            u.identification, 
            u.name, 
            u.surname, 
            u.telephone, 
            u.id_province,
            u.id_canton, 
            u.id_district, 
            u.address, 
            u.coin, 
            u.active,
            p.name AS province_name,
            c.name AS canton_name,
            d.name AS district_name
        FROM 
            user u
        JOIN 
            province p ON u.id_province = p.id_province
        JOIN 
            canton c ON u.id_canton = c.id_canton
        JOIN 
            district d ON u.id_district = d.id_district;
        ";

            //Ejecutar la consulta
            $vResultado = $this->enlace->ExecuteSQL($vSql);

            // Retornar el objeto
            return $vResultado;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /*Obtener el usuario según el id*/
    public function get($id)
    {
        try {
            //Consulta sql
            $vSql = "SELECT id_user, email, id_role, identification, name, surname, telephone, id_province,
            id_canton, id_district, address, coin, active FROM user where id_user=$id;";

            //Ejecutar la consulta
            $vResultado = $this->enlace->ExecuteSQL($vSql);
            if (!empty($vResultado)) {
                //Obtener objeto
                $vResultado = $vResultado[0];

                //---role
                $roleModel = new RoleModel();
                $role = $roleModel->get($vResultado->id_role);
                //Asignar role al objeto  
                $vResultado->role = $role[0];

                if (!empty($vResultado->id_province)) {
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

            }
            // Retornar el objeto
            return $vResultado;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /*Obtener los usuarios según el rol */
    public function getUserByRole($idRole)
    {
        try {
            //Consulta SQL
            $vSQL = "SELECT u.id_user, u.identification, u.`name`," .
                " u.surname, u.email, u.id_role, r.`name` as role_name, u.`active`" .
                " FROM `user` u, `role` r" .
                " where u.id_role=r.id_role and r.id_role=$idRole;";
            //Establecer conexión

            //Ejecutar la consulta
            $vResultado = $this->enlace->executeSQL($vSQL);
            //Retornar el resultado
            return $vResultado;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function getAvailableAdministrators($idCollectionCenter)
    {
        try {

            //Consulta SQL
            $vSQL = "SELECT u.*
            FROM user u
            LEFT JOIN collection_center c ON u.id_user = c.id_user
            WHERE u.id_role = 2
            AND (c.id_user IS NULL OR c.id_collection_center = $idCollectionCenter);";

            //Establecer conexión

            //Ejecutar la consulta
            $vResultado = $this->enlace->executeSQL($vSQL);
            //Retornar el resultado
            return $vResultado;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function create($objeto)
    {
        try {
            if (isset($objeto->password) && $objeto->password != null) {
                $crypt = password_hash($objeto->password, PASSWORD_BCRYPT);
                $objeto->password = $crypt;
            }
            //Consulta SQL
            $vSql = "INSERT INTO user (email, password, id_role, identification, name, surname, telephone, id_province, id_canton, id_district, address, coin, active) " .
                "VALUES ('$objeto->email', '$objeto->password', $objeto->id_role, $objeto->identification, '$objeto->name', '$objeto->surname', $objeto->telephone, $objeto->id_province, $objeto->id_canton, $objeto->id_district, '$objeto->address', $objeto->coin, $objeto->active)";

            //Ejecutar la consulta
            $vResultado = $this->enlace->executeSQL_DML_last($vSql);
            // Retornar el objeto creado
            return $this->get($vResultado);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function createForm($objeto)
    {
        try {
            if (isset($objeto->password) && $objeto->password != null) {
                $crypt = password_hash($objeto->password, PASSWORD_BCRYPT);
                $objeto->password = $crypt;
            }
            // Consulta SQL con sentencia preparada
            $vSql = "INSERT INTO user (email, password, id_role, identification, name, surname, active, coin) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

            // Preparar la declaración SQL
            $stmt = $this->enlace->prepare($vSql);

            // Vincular los parámetros
            $stmt->bind_param("ssisssii", $objeto->email, $objeto->password, $objeto->id_role, $objeto->identification, $objeto->name, $objeto->surname, $objeto->active, $objeto->coin);

            // Ejecutar la consulta preparada
            $stmt->execute();

            // Retornar el objeto creado
            return $this->get($stmt->insert_id);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }


    public function update($objeto)
    {
        try {
            // Inicializar parte de la consulta para actualizar contraseña
            $passwordUpdate = ", password = password";

            // Verificar si se proporcionó una nueva contraseña
            if (isset($objeto->password) && $objeto->password != null) {
                $crypt = password_hash($objeto->password, PASSWORD_BCRYPT);
                $passwordUpdate = ", password = '$crypt'";
            }

            // Consulta SQL
            $vSql = "UPDATE user SET email = '$objeto->email' $passwordUpdate, id_role = $objeto->id_role, identification = $objeto->identification, " .
                "name = '$objeto->name', surname = '$objeto->surname', telephone = $objeto->telephone, id_province = $objeto->id_province, " .
                "id_canton = $objeto->id_canton, id_district = $objeto->id_district, address = '$objeto->address', coin = $objeto->coin, active = $objeto->active " .
                "WHERE id_user = $objeto->id_user";

            // Ejecutar la consulta
            $vResultado = $this->enlace->executeSQL_DML($vSql);

            // Retornar el objeto actualizado
            return $this->get($objeto->id_user);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function changePassword($objeto)
    {
        try {

            // Verificar si se proporcionó una nueva contraseña
            if (isset($objeto->password) && $objeto->password != null) {
                $crypt = password_hash($objeto->password, PASSWORD_BCRYPT);
                $passwordUpdate = $crypt;
            }

            // Consulta SQL
            $vSql = "UPDATE user SET password = '$passwordUpdate'
                    WHERE id_user = $objeto->id_user";

            // Ejecutar la consulta
            $vResultado = $this->enlace->executeSQL_DML_last($vSql);

            // Retornar el objeto actualizado
            return $this->get($objeto->id_user);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function login($objeto)
    {
        try {

            $vSql = "SELECT * from User where email='$objeto->email'";

            //Ejecutar la consulta
            $vResultado = $this->enlace->ExecuteSQL($vSql);
            if (is_object($vResultado[0])) {
                $user = $vResultado[0];
                if (password_verify($objeto->password, $user->password)) {
                    return $this->get($user->id_user);
                }

            } else {
                return false;
            }

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function addCoins($objeto)
    {
        try {
            $vSQL = "UPDATE user SET coin = coin + $objeto->coin WHERE id_user = $objeto->id_user;";

            //Ejecutar la consulta
            $vResultado = $this->enlace->executeSQL_DML($vSQL);
            //Retornar el resultado
            return $this->get($objeto->id_user);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function discountCoins($objeto)
    {
        try {
            $vSQL = "UPDATE user SET coin = coin  $objeto->coin WHERE id_user = $objeto->id_user;";

            //Ejecutar la consulta
            $vResultado = $this->enlace->executeSQL_DML($vSQL);
            //Retornar el resultado
            return $this->get($objeto->id_user);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function getWallet($id)
    {
        try {
            //Total de ecomonedas disponibles
            $vSQL = "SELECT coin AS available FROM user WHERE id_user = $id";

            //Ejecutar la consulta
            $vResultado = $this->enlace->executeSQL($vSQL);

            if (!empty($vResultado)) {
                //Obtener objeto
                $vResultado = $vResultado[0];

                //Total de ecomonedas canjeadas por cupones
                $vSQL = "SELECT SUM(unit_cost) as exchanged
                FROM coupon_exchange
                WHERE id_user = $id
                GROUP BY id_user;";

                $vExchanged = $this->enlace->executeSQL($vSQL);
                $vResultado->exchanged = !empty($vExchanged) ? $vExchanged[0] : "0";

            }
            //Retornar el resultado
            return $vResultado;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function disable($objeto)
    {
        try {
            //Consulta SQL
            $vSql = "UPDATE user SET active = $objeto->active 
                WHERE id_user = $objeto->id_user;";

            //Ejecutar la consulta
            $vResultado = $this->enlace->executeSQL_DML($vSql);

            //Retornar centro de acopio
            return $this->get($objeto->id_user);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

}