
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

    public function getAllReg($limite, $inicio, $fin, $filtro, $filtroD, $filtroS, $id_rol, $id_zona) {
        $limit      = "";
        $condition  = "";
        $zona_filter = "";
        $depto_filter = "";
        $status_filter = "";
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

        if( is_array($filtroS) && count($filtroS) > 0 ){
            $status_filter = " AND s.id_status IN (". implode(', ', $filtroS).")";
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
                            WHERE 1 = 1 $depto_filter $status_filter $cond_date $zona_filter $condition
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

    public function getAllExport($filtro, $filtroD, $filtroS, $id_rol, $id_zona) {
        $condition  = "";
        $zona_filter = "";
        $depto_filter = "";
        $status_filter = "";
        $actual = '2024-06-17';
        // $yesterday   =  date('Y-m-d', strtotime('yesterday') );
        $yesterday   =  date('Y-m-d', strtotime($actual. '-01') );
        $cond_date  = " AND S.fecha between '$yesterday' and '$actual' ";

        if (is_array($filtro)){
            
            if(isset($filtro['folio']) && $filtro['folio'] != ""){
                $condition .= " AND S.folio = ".$filtro['folio']." ";
                $cond_date = "";
            }

            if(isset($filtro['id_emergencia']) && $filtro['id_emergencia'] != ""){
                $condition .= " AND S.id_emergencia = ".$filtro['id_emergencia']." ";    
            }

            if(isset($filtro['fecha_inicial']) && $filtro['fecha_inicial'] != ""){
                $cond_date = "";
                if(isset($filtro['fecha_final']) && $filtro['fecha_final'] != ""){
                    $condition .= " AND S.fecha BETWEEN '".$filtro['fecha_inicial']."' AND '".$filtro['fecha_final']."' ";
                } else {
                    $condition .= " AND S.fecha = '".$filtro['fecha_inicial']."' ";
                }
            }

        }        

        if( is_array($filtroD) && count($filtroD) > 0 ){
            $depto_filter .= " AND D.id_departamento IN (". implode(', ', $filtroD).")";
        }

        if( is_array($filtroS) && count($filtroS) > 0 ){
            $status_filter = " AND S.id_status IN (". implode(', ', $filtroS).")";
        }


        if ($id_rol == 3) {
            if (isset($id_zona) ) {            
                $zona_filter = " AND S.id_zona = ". $id_zona." ";
                
            }
        }

        try {
            $query = "  SELECT  CASE S.id_turno
                                    WHEN 1 THEN 'PRIMERO' 
                                    WHEN 2 THEN 'SEGUNDO'  
                                    WHEN 3 THEN 'TERCERO' 
                                END AS TURNO,
                                S.folio AS FOLIO,                       
                                DATE_FORMAT(S.fecha, '%d-%m-%Y') AS FECHA,
                                hora AS HORA,
                                P.descripcion AS MEDIO,
                                CASE S.id_zona
                                    WHEN 1 THEN 'PONIENTE'
                                    WHEN 2 THEN 'ORIENTE'
                                END AS ZONA,
                                C.region AS REGIÓN,
                                C.sector AS SECTOR,
                                CONCAT_WS(' - ', C.tipo, C.nombre) AS COLONIA,
                                S.calle AS CALLE,
                                S.calle1 AS ESQUINA,
                                CONCAT_WS(' ', WS.nombre, WS.apepa, WS.apema) AS OPERADOR,
                                S.nombre AS NOMBRE,
                                S.telefono AS TELEFONO,
                                D.departamento AS DEPARTAMENTO, 
                                DTL.hasignacion AS ASIGNACIÓN,
                                DTL.harribo AS ARRIBO,
                                DTL.hrecibe AS TERMINO,
                                DTL.unidad AS UNIDAD,
                                O.descripcion AS OPERATIVO,
                                E.descripcion AS EMERGENCIA_INICIAL,
                                S.observaciones AS DETALLE_INICIAL,
                                DTL.resultado AS DETALLE_FINAL,
                                CE.descripcion AS EMERGENCIA_FINAL,
                                TE.descripcion AS TIPO_EMERGENCIA,
                                TC.descripcion AS TIPO_CIERRE,
                                CONCAT_WS(' ', UC.nombre, UC.apepa, UC.apema) AS OPERADOR_CIERRE
                            FROM tbl_servicios S
                            LEFT JOIN tbl_servicios_dtl DTL ON S.folio = DTL.folio
                            LEFT JOIN cat_procedencia P ON S.id_llamada = P.id_procedencia
                            LEFT JOIN cat_colonias C ON S.id_colonia = C.id_colonia
                            LEFT JOIN ws_usuario WS ON S.id_usuario = WS.id_usuario
                            LEFT JOIN cat_operativo O ON S.id_operativo = O.id_operativo
                            LEFT JOIN cat_emergencia E ON S.id_emergencia = E.id_emergencia
                            LEFT JOIN cat_departamento D ON D.id_departamento = E.id_departamento
                            LEFT JOIN cat_emergencia CE ON DTL.id_emergencia_cierre = CE.id_emergencia
                            LEFT JOIN cat_tipo_emergencia TE ON DTL.id_tipo_emergencia = TE.id_tipo_emergencia
                            LEFT JOIN cat_tipo_cierre TC ON DTL.id_tipo_cierre = TC.id_tipo_cierre
                            LEFT JOIN ws_usuario UC ON DTL.id_usuario_cierre = UC.id_usuario
                            WHERE 1 = 1 $zona_filter $depto_filter $status_filter $cond_date $condition
                           ORDER BY folio DESC ";
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
                                S.otros_operativos,
                                S.id_cuadrante,
                                CC.sector,
                                CC.cuadrante,
                                C.region
                            FROM tbl_servicios S
                            LEFT JOIN cat_estatus CS ON S.id_status = CS.id_estatus
                            LEFT JOIN cat_emergencia E ON S.id_emergencia = E.id_emergencia
                            LEFT JOIN cat_departamento D ON D.id_departamento = E.id_departamento
                            LEFT JOIN cat_colonias C ON S.id_colonia = C.id_colonia
                            LEFT JOIN cat_operativo O ON S.id_operativo = O.id_operativo
                            LEFT JOIN cat_cuadrantes CC ON S.id_cuadrante = CC.id_cuadrante
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
                                DTL.id_servicio, 
                                DTL.id_zona, 
                                DATE_FORMAT(DTL.fecha_captura, '%d-%m-%Y') AS fecha_captura_dtl,
                                CONCAT_WS(' ', US.nombre, US.apepa, US.apema) AS usuario_dtl,
                                resultado, 
                                unidad, 
                                hrecibe, 
                                hasignacion, 
                                harribo, 
                                DATE_FORMAT(DTL.fecha_cierre, '%d-%m-%Y %H:%i') AS fecha_cierre,
                                CONCAT_WS(' ', WS.nombre, WS.apepa, WS.apema) AS usuario_cierre,
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
                          LEFT JOIN ws_usuario US ON US.id_usuario = DTL.id_usuario_dtl
                          LEFT JOIN ws_usuario WS ON WS.id_usuario = DTL.id_usuario_cierre
                        WHERE folio = ".$id ." 
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

    public function getDataNotas( $id ){
        try {
            $query = "  SELECT id_nota, id_servicio, 
                               id_usuario, fecha_captura, 
                               id_zona, descripcion
                          FROM tbl_notas 
                        WHERE id_servicio = ".$id ;
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
                            id_colonia, 
                            nombre,
                            telefono,
                            observaciones,
                            id_emergencia, 
                            id_operativo,
                            otros_operativos,
                            id_llamada,
                            id_turno)
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

    public function insertRegVehicular( $data ){
        $correcto= 1;
        
        $exec = $this->conn->conexion();
        try {
            $queryMP = "INSERT INTO tbl_robo_vehicular(
                            id_servicio,
                            placas,
                            modelo, 
                            marca,
                            subMarca,
                            color,
                            serie)
                        VALUES (
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

    public function insertAsignacion( $data ){
        $correcto= 1;
        
        $exec = $this->conn->conexion();
        try {
            $queryUP = "INSERT INTO tbl_servicios_dtl(
                            id_servicio,
                            folio,
                            id_zona, 
                            fecha_captura,
                            id_usuario_dtl,
                            unidad, 
                            hasignacion)
            VALUES (
                ?,
                ?,
                ?,
                ?,
                ?,
                ?,
                ? )";
            $result = $this->conn->prepare($queryUP);

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

    public function insertResultado( $data ){
        $correcto= 1;
        
        $exec = $this->conn->conexion();
        try {
            $queryUP = " UPDATE tbl_servicios_dtl
                            SET resultado = ?, 
                                hrecibe = ?, 
                                harribo = ?, 
                                id_emergencia_cierre = ?, 
                                id_usuario_cierre = ?,
                                fecha_cierre = ?, 
                                id_tipo_cierre = ?, 
                                id_tipo_emergencia = ? 
                          WHERE folio = ? ";
            $result = $this->conn->prepare($queryUP);

            $exec->beginTransaction();
            $result->execute($data);

            $exec->commit();
            return $correcto;
        }
        catch(\PDOException $e)
        {
            $exec->rollBack();
            return "Error!: " . $e->getMessage();
        }
    }

    public function insertNotas( $data ){
        $correcto= 1;
        
        $exec = $this->conn->conexion();
        try {
            $queryUP = "INSERT INTO tbl_notas(
                            id_servicio,
                            id_usuario,
                            fecha_captura,
                            id_zona,
                            descripcion)
            VALUES (
                ?,
                ?,
                ?,
                ?,
                ? )";
            $result = $this->conn->prepare($queryUP);

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

    public function updateCuadranteServicio( $id_cuadrante, $folio ){
        $correcto = 1;
        
        $exec = $this->conn->conexion();
        try {
            $queryUP = " UPDATE tbl_servicios
                            SET id_cuadrante = $id_cuadrante
                          WHERE folio = $folio ";
            $result = $this->conn->prepare($queryUP);

            $exec->beginTransaction();
            $result->execute(  );

            $exec->commit();
            return $correcto;
        }
        catch(\PDOException $e)
        {
            $exec->rollBack();
            return "Error!: " . $e->getMessage();
        }
    }

    public function updateStatusServicio( $status, $folio ){
        $correcto = 1;
        
        $exec = $this->conn->conexion();
        try {
            $queryUP = " UPDATE tbl_servicios
                            SET id_status = $status
                          WHERE folio = $folio ";
            $result = $this->conn->prepare($queryUP);

            $exec->beginTransaction();
            $result->execute();

            $exec->commit();
            return $correcto;
        }
        catch(\PDOException $e)
        {
            $exec->rollBack();
            return "Error!: " . $e->getMessage();
        }
    }

}