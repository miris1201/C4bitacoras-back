<?php

require_once $dir_fc . "connections/conn_data.php";

class cTags extends BD
{
    private $conn;

    function __construct()
    {
        //Esta es la que llama a la base de datos
        //parent::__construct();
        $this->conn = new BD();
    }


    public function getRegbyid($id)
    {
        try {
            $queryMP = "SELECT 
                            id,
                            nombre, 
                            activo, 
                            created_at,
                            updated_at
                          FROM tags 
                         WHERE id=" . $id . " 
                         LIMIT 1";

            $result = $this->conn->prepare($queryMP);
            $result->execute();
            return $result;
        } catch (\PDOException $e) {
            return "Error!: " . $e->getMessage();
        }
    }

    public function getAllReg($limite, $inicio, $fin, $filtro)
    {
        $limit      = "";
        $condition  = "";

        if ($limite == 1) {
            $limit = " LIMIT " . $inicio . ", " . $fin;
        }

        if (is_array($filtro)) {

            if ($filtro['nombre'] != "") {
                $condition = " AND nombre LIKE '%$filtro%' ";
            }
            /* if ($filtro['uuid'] != "") {
                $condition = " AND uuid LIKE '%$filtro%' ";
            } 
            if ($filtro['activo'] != "") {
                $condition = " AND activo = $filtro ";
            } */
        }

        try {
            $queryUser = "SELECT 
                            id,
                            nombre, 
                            activo, 
                            created_at,
                            updated_at,
                            deleted_at
                            FROM tags
                           WHERE 1 $condition 
                           ORDER BY id DESC " . $limit;

            $result = $this->conn->prepare($queryUser);
            //echo $queryUser;

            $result->execute();
            return $result;
        } catch (\PDOException $e) {
            return "Error!: " . $e->getMessage();
        }
    }

    public function insertReg($data)
    {
        $correcto = 0;

        $exec = $this->conn->conexion();
        try {
            $queryMP = "INSERT INTO tags(
                            nombre,                          
                            created_at,
                            activo
                            )
                             VALUES (
                            ?,
                            ?,
                            ?)";

            $result = $this->conn->prepare($queryMP);
            $exec->beginTransaction();

            $result->execute($data);
            $correcto = $exec->lastInsertId();

            $exec->commit();
            return $correcto;
        } catch (\PDOException $e) {
            $exec->rollBack();
            return "Error!: " . $e->getMessage();
        }
    }

    public function updateReg($data)
    {
        $correcto   = 1;
        $exec       = $this->conn->conexion();

        try {

            $queryUpdate = "UPDATE tags
                               SET 
                                nombre = ?,
                                updated_at = ?
                             WHERE id = ?";

            $result = $this->conn->prepare($queryUpdate);

            $exec->beginTransaction();

            $result->execute($data);

            $exec->commit();
        } catch (\PDOException $e) {
            $exec->rollBack();
            $correcto =  "Error!: " . $e->getMessage();
        }
        return $correcto;
    }

    public function updateStatus($activo, $id)
    {
        $correcto   = 1;
        $exec = $this->conn->conexion();

        try {
            $queryMP = "UPDATE tags 
                           SET activo = ?
    				     WHERE id = ?";
            $result = $this->conn->prepare($queryMP);

            $exec->beginTransaction();

            $array_val = array(
                $activo,
                $id
            );

            $result->execute($array_val);
            $exec->commit();

            return $correcto;
        } catch (\PDOException $e) {
            return "Error!: " . $e->getMessage();
        }
    }

    public function deleteReg($id)
    {
        $correcto   = 2;
        try {
            $queryMP = "DELETE FROM tags 
                              WHERE id = " . $id;
            $result = $this->conn->prepare($queryMP);
            $result->execute();

            return $correcto;
        } catch (\PDOException $e) {
            return "Error!: " . $e->getMessage();
        }
    }
}
