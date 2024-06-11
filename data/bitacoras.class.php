
<?php
require_once $dir_fc."connections/conn_data.php";

class cBitacoras extends BD
{
    private $conn;

    function __construct()
    {
        $this->conn = new BD();
    }

    public function getAllReg($limite, $inicio, $fin, $filtro) {
        $limit      = "";
        $condition  = "";
        $filterYear = "";
        $zona_filter = "";
        $actual = '2024-04-26';
        // $yesterday   =  date('Y-m-d', strtotime('yesterday') );
        $yesterday   =  date('Y-m-d', strtotime($actual. '-01') );

        $cond_depto  = " AND fecha between '$yesterday' and '$actual' ";


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

        // if( is_array($filterDepto) && count($filterDepto) > 0 ){
        //     $condition .= " AND B.id_departamento IN (". implode(', ', $filterDepto).")";
        // }

        // if (isset($id_zona) ) {            
        //     $zona_filter = " AND B.id_zona = ". $id_zona." ";
            
        // }

        try {
            $query = "  SELECT id_bitacora,
                                folio,
                                B.id_usuario,
                                B.id_zona,
                                B.id_departamento,
                                unidad, 
                                hora,
                                DATE_FORMAT(fecha, '%d-%m-%Y') AS fecha,
                                detalle,
                                CONCAT_WS(' ', U.nombre, U.apepa, U.apema) AS usuario, 
                                D.departamento
                            FROM tbl_bitacoras B
                            LEFT JOIN ws_usuario U ON U.id_usuario = B.id_usuario
                            LEFT JOIN cat_departamento D ON D.id_departamento = B.id_departamento
                            WHERE 1 = 1 $cond_depto $zona_filter $condition
                           ORDER BY folio DESC ".$limit;
                // echo die ($query);
            $result = $this->conn->prepare($query);            
            $result->execute();
            return $result;
        }
        catch(\PDOException $e)
        {
            return "Error!: " . $e->getMessage();
        }
    }

    public function getNmUsuario() {
    
        $datos = array();
        $query = "  SELECT id_usuario,
                           CONCAT_WS(' ', nombre, apepa, apema) AS nombrecompleto
                      FROM ws_usuario ";
        $result = $this->conn->prepare($query);
        $result->execute();
        while ($rw = $result->fetch(PDO::FETCH_OBJ)) {
            $datos[$rw->id_usuario] = $rw->nombrecompleto;
        }
        return $datos;
    
    }

    public function getCatDepartamento() {
    
        $datos = array();
        $query = "  SELECT id_departamento, departamento, abreviatura,
                            CONCAT_WS(' - ', abreviatura , departamento) as depto
                      FROM cat_departamento ";
        $result = $this->conn->prepare($query);
        $result->execute();
        while ($rw = $result->fetch(PDO::FETCH_OBJ)) {
            $datos[$rw->id_departamento] = $rw->depto;
        }
        return $datos;
    
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