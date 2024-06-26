
<?php
require_once $dir_fc."connections/conn_data.php";

class cServicios extends BD
{
    private $conn;

    function __construct()
    {
        $this->conn = new BD();
    }

    private $id_rol;

    public function getAllReg($limite, $inicio, $fin, $filtro, $filtroD, $id_rol, $id_zona) {
        $limit      = "";
        $condition  = "";
        $zona_filter = "";
        $depto_filter = " ";
        $actual = '2024-06-17';
        // $yesterday   =  date('Y-m-d', strtotime('yesterday') );
        $yesterday   =  date('Y-m-d', strtotime($actual. '-01') );
        $cond_date  = " AND fecha between '$yesterday' and '$actual' ";


        if ($limite == 1){ $limit = " LIMIT ".$inicio.", ".$fin;}
        
        if (is_array($filtro)){
            
            
            if(isset($filtro['folio']) && $filtro['folio'] != ""){
                $condition .= " AND folio = ".$filtro['folio']." ";
                $cond_date = "";
            }

            if(isset($filtro['id_emergencia']) && $filtro['id_emergencia'] != ""){
                $condition .= " AND S.id_emergencia = ".$filtro['id_emergencia']." ";    
            }
            
            if(isset($filtro['fecha_final']) && $filtro['fecha_inicial'] != ""){
                if(isset($filtro['fecha_final']) && $filtro['fecha_final'] != ""){
                    $condition .= " AND fecha BETWEEN '".$filtro['fecha_inicial']."' AND '".$filtro['fecha_final']."' ";
                } else {
                    $condition .= " AND fecha = '".$filtro['fecha_inicial']."' ";
                }

                $cond_date = "";
            }
            
        }        
        
        if( is_array($filtroD) && count($filtroD) > 0 ){
            $depto_filter = " AND E.id_departamento IN (". implode(', ', $filtroD).")";
        }

        if ($id_rol > 1) {
            if (isset($id_zona) ) {
                $zona_filter = " AND B.id_zona = ". $id_zona." ";
                
            }
        }        

        try {
            $query = "  SELECT id_servicio,
                                folio,                       
                                S.id_zona,
                                S.id_status,
                                S.id_emergencia,
                                DATE_FORMAT(fecha, '%d-%m-%Y') AS fecha,
                                hora,
                                observaciones,
                                S.id_emergencia,
                                E.descripcion AS emergencia,
                                D.id_departamento,
                                D.departamento, 
                                CS.descripcion AS estatus,
                                CS.class_name
                            FROM tbl_servicios S
                            LEFT JOIN cat_estatus CS ON S.id_status = CS.id_estatus
                            LEFT JOIN cat_emergencia E ON S.id_emergencia = E.id_emergencia
                            LEFT JOIN cat_departamento D ON D.id_departamento = E.id_departamento
                            WHERE 1 = 1 $depto_filter $cond_date $zona_filter $condition
                           ORDER BY S.id_status ASC, folio DESC ".$limit;
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

    public function getAllExport($filtro, $filtroD, $id_rol, $id_zona) {
        $condition  = "";
        $zona_filter = "";
        $depto_filter = "";
        $actual = '2024-06-17';
        // $yesterday   =  date('Y-m-d', strtotime('yesterday') );
        $yesterday   =  date('Y-m-d', strtotime($actual. '-01') );
        $cond_date  = " AND fecha between '$yesterday' and '$actual' ";

        if (is_array($filtro)){
            
            if(isset($filtro['folio']) && $filtro['folio'] != ""){
                $condition .= " AND folio = ".$filtro['folio']." ";
                $cond_date = "";
            }

            if(isset($filtro['fecha_inicial']) && $filtro['fecha_inicial'] != ""){
                $cond_date = "";
                if(isset($filtro['fecha_final']) && $filtro['fecha_final'] != ""){
                    $condition .= " AND fecha BETWEEN '".$filtro['fecha_inicial']."' AND '".$filtro['fecha_final']."' ";
                } else {
                    $condition .= " AND fecha = '".$filtro['fecha_inicial']."' ";
                }
            }

        }        

        if( is_array($filtroD) && count($filtroD) > 0 ){
            $depto_filter .= " AND B.id_departamento IN (". implode(', ', $filtroD).")";
        }

        if ($id_rol == 3) {
            if (isset($id_zona) ) {            
                $zona_filter = " AND B.id_zona = ". $id_zona." ";
                
            }
        }

        try {
            $query = "  SELECT folio AS FOLIO,
                                CONCAT_WS(' ', DATE_FORMAT(fecha, '%d-%m-%Y'), hora) AS FECHA, 
                                CASE WHEN B.id_zona = 1 THEN 'PONIENTE' ELSE 'ORIENTE' END AS ZONA,
                                D.departamento AS DEPARTAMENTO,
                                CONCAT_WS(' ', U.nombre, U.apepa, U.apema) AS USUARIO,
                                unidad AS UNIDAD, 
                                detalle AS DETALLE
                            FROM tbl_bitacoras B
                            LEFT JOIN ws_usuario U ON U.id_usuario = B.id_usuario
                            LEFT JOIN cat_departamento D ON D.id_departamento = B.id_departamento
                            WHERE 1 = 1 $zona_filter $depto_filter $cond_date $condition
                           ORDER BY folio DESC ";

            $result = $this->conn->prepare($query);            
            $result->execute();
            return $result;
        }
        catch(\PDOException $e)
        {
            return "Error!: " . $e->getMessage();
        }
    }

    public function getCatEstatus(){
        try {
            $query = "SELECT id_estatus, descripcion, icon_class, class_name, activo
                        FROM cat_estatus 
                       WHERE activo = 1
                       ORDER BY id_estatus ASC";

            $result = $this->conn->prepare($query);
            $result->execute();
            return $result;

        }catch (\PDOException $e){
            return "Error!: " . $e->getMessage();
        }
    }

    public function getRegbyid( $id ){
        try {
            $queryMP = "SELECT id_servicio,
                                folio,
                                S.id_zona,
                                S.id_status,
                                S.id_emergencia,
                                S.id_turno,
                                S.fecha,
                                hora,
                                observaciones,
                                S.nombre,
                                S.telefono,
                                S.calle,
                                S.calle1,
                                S.id_emergencia,
                                CONCAT_WS(' - ', D.abreviatura, E.descripcion)  AS emergencia,
                                D.id_departamento,
                                D.departamento, 
                                CS.descripcion AS estatus,
                                CS.icon_class,
                                CS.class_name,
                                S.id_colonia, 
                                CONCAT_WS(' - ', C.tipo, C.nombre) AS colonia,
                                S.id_llamada,
                                S.id_operativo,
                                O.descripcion as operativo,
                                S.otros_operativos
                            FROM tbl_servicios S
                            LEFT JOIN cat_estatus CS ON S.id_status = CS.id_estatus
                            LEFT JOIN cat_emergencia E ON S.id_emergencia = E.id_emergencia
                            LEFT JOIN cat_departamento D ON D.id_departamento = E.id_departamento
                            LEFT JOIN cat_colonias C ON S.id_colonia = C.id_colonia
                            LEFT JOIN cat_operativo O ON S.id_operativo = O.id_operativo
                         WHERE id_servicio = ".$id ." 
                         LIMIT 1";
                // echo $queryMP;
            $result = $this->conn->prepare($queryMP);
            $result->execute();
            return $result;
        }
        catch(\PDOException $e)
        {
            return "Error!: " . $e->getMessage();
        }
    }

    public function getDataIdServicio( $id ){
        try {
            $queryMP = "SELECT id_servicio, folio
                            FROM tbl_servicios 
                         WHERE id_servicio = ".$id ." 
                         LIMIT 1";
                // echo $queryMP;
            $result = $this->conn->prepare($queryMP);
            $result->execute();
            while ($rw = $result->fetch(PDO::FETCH_OBJ)) {
                $id = $rw->folio ;
            }
            return $id;
        }
        catch(\PDOException $e)
        {
            return "Error!: " . $e->getMessage();
        }
    }

    public function getDataDtl( $id ){
        try {
            $query = "  SELECT  id_servicio_dtl, 
                                id_servicio, 
                                id_zona, 
                                resultado, 
                                unidad, 
                                hrecibe, 
                                hasignacion, 
                                harribo, 
                                DTL.id_emergencia_cierre, 
                                E.descripcion AS emergencia_cierre, 
                                DTL.id_tipo_cierre, 
                                TC.descripcion AS tipo_cierre,
                                DTL.id_tipo_emergencia,
                                TE.descripcion AS tipo_emergencia
                          FROM tbl_servicios_dtl DTL
                          LEFT JOIN cat_emergencia E ON DTL.id_emergencia_cierre = E.id_emergencia
                          LEFT JOIN cat_tipo_cierre TC ON DTL.id_tipo_cierre = TC.id_tipo_cierre
                          LEFT JOIN cat_tipo_emergencia TE ON DTL.id_tipo_emergencia = TE.id_tipo_emergencia
                        WHERE id_servicio = ".$id ." 
                         LIMIT 1";
            $result = $this->conn->prepare($query);
            $result->execute();
            return $result;
        }
        catch(\PDOException $e)
        {
            return "Error!: " . $e->getMessage();
        }
    }

    public function getDataVehiculo( $id ){
        try {
            $query = "  SELECT id_robo, id_servicio, 
                                placas, modelo, marca, 
                                subMarca, color, serie
                          FROM tbl_robo_vehicular 
                        WHERE id_servicio = ".$id ." 
                         LIMIT 1";
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

    public function getFolioMax(){

        $query = "  SELECT MAX(folio) AS folio
                      FROM tbl_servicios";
        $result = $this->conn->prepare($query);
        $result->execute();
        while ($rw = $result->fetch(PDO::FETCH_OBJ)) {
            $id = $rw->folio + 1;
        }
        return $id;
    }

    public function checkFolioDuplicado( $folio ){
        $query = "  SELECT folio 
                      FROM tbl_servicios
                    WHERE folio = $folio ";       
        // echo $query;               
        $result = $this->conn->prepare($query);
        $result->execute();
        return $result->rowCount();

    }
    
    public function insertReg( $data ){
        $correcto= 1;
        
        $exec = $this->conn->conexion();
        try {
            $queryMP = "INSERT INTO tbl_servicios(
                            folio,
                            fecha_captura,
                            id_usuario, 
                            id_zona,
                            id_status,
                            fecha,
                            hora,
                            calle, 
                            calle1,
                            calle2,
                            id_colonia, 
                            nombre,
                            telefono,
                            observaciones,
                            id_emergencia, 
                            id_operativo,
                            id_llamada,
                            id_turno,
                            id_cuadrante )
                        VALUES (
                            ?,
                            ?,
                            ?,
                            ?,
                            ?,
                            ?,
                            ?,
                            ?,
                            ?,
                            ?,
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