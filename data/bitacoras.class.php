
<?php
require_once $dir_fc."connections/conn_data.php";

class cBitacoras extends BD
{
    private $conn;

    function __construct()
    {
        $this->conn = new BD();
    }


    public function getAllReg($limite, $inicio, $fin, $filtro, $id_departamento, $id_zona) {
        $limit      = "";
        $condition  = "";
        $cond_depto  = "";
        $estatus_filter = "";
        
        if ($limite == 1){ $limit = " LIMIT ".$inicio.", ".$fin;}
        
        if (is_array($filtro)){
            
            if(isset($filtro['folio']) && $filtro['folio'] != ""){
                $condition .= " AND folio = ".$filtro['folio']." ";
            }

            if(isset($filtro['id_departamento']) && $filtro['id_departamento'] != ""){
                $condition .= " AND id_departamento = ".$filtro['id_departamento']." ";
            }

            if(isset($filtro['fecha_inicial']) && $filtro['fecha_inicial'] != ""){
                if(isset($filtro['fecha_final']) && $filtro['fecha_final'] != ""){
                    $condition .= " AND fecha BETWEEN '".$filtro['fecha_inicial']."' AND '".$filtro['fecha_final']."' ";
                } else {
                    $condition .= " AND fecha = '".$filtro['fecha_inicial']."' ";
                }
            }
            
        }

        if (isset($id_departamento) ) {            
            $cond_depto = " AND id_departamento = ". $id_departamento."";
            
        }

        if (!empty($id_zona)) {
            if (is_array($id_zona)) {
                $str = implode(",", $id_zona);
                $estatus_filter = "  AND id_zona in ($str)";
            }
        }

        try {
            $query = "  SELECT id_bitacora,
                                folio,
                                B.id_usuario,
                                B.id_zona,
                                B.id_departamento
                                unidad, 
                                hora,
                                fecha,
                                detalle,
                                CONCAT_WS(' ', U.nombre, U.apepa, U.apema) AS nombrecompleto, 
                                D.departamento
                            FROM tbl_bitacoras B
                            LEFT JOIN ws_usuario U ON U.id_usuario = B.id_usuario
                            LEFT JOIN cat_departamento D ON D.id_departamento = B.id_departamento
                            WHERE 1 $cond_depto $estatus_filter $condition
                           ORDER BY folio DESC ".$limit;
                // echo $query;
            $result = $this->conn->prepare($query);
            
            $result->execute();
            return $result;
        }
        catch(\PDOException $e)
        {
            return "Error!: " . $e->getMessage();
        }
    }

    
    public function insertReg( $data ){
        $correcto= 1;
        
        $exec = $this->conn->conexion();
        try {
            $queryMP = "INSERT INTO tbl_bitacoras(
                            folio, 
                            fecha_captura,
                            id_usuario, 
                            id_zona, 
                            id_departamento,
                            unidad,
                            fecha,
                            hora,
                            detalle )
                        VALUES (
                            ?, 
                            ?,
                            ?, 
                            ?, 
                            ?,
                            ?,
                            ?,
                            ?,
                            ? )";

            $result = $this->conn->prepare($queryMP);
            $exec->beginTransaction();

            $result->execute($data);

            if ($correcto == 1){
                $correcto= $exec->lastInsertId();
            }

            $exec->commit();
            return $correcto;
        }
        catch(\PDOException $e)
        {
            $exec->rollBack();
            return "Error!: " . $e->getMessage();
        }
    }

    public function updateReg( $data ){
        $correcto   = 1;
        $exec       = $this->conn->conexion();

        try {

            $queryUpdate = "UPDATE cat_colonias
                               SET nombre = ?,
                                   tipo = ?,
                                   sector = ?,
                                   region = ?
                             WHERE id_colonia = ?";
            
                         $result = $this->conn->prepare($queryUpdate);

            $exec->beginTransaction();
            $result->execute($data);

            $exec->commit();
        }catch (\PDOException $e){
            $exec->rollBack();
            $correcto =  "Error!: " . $e->getMessage();
        }
        return $correcto;
    }

}