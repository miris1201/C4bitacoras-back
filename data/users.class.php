<?php
require_once $dir_fc."connections/conn_data.php";

class cUsers extends BD
{
    private $conn;

    function __construct()
    {
        $this->conn = new BD();
    }

    public function getUser($user, $password)
    {
        
        try {

            $queryUser = "SELECT u.id_usuario, 
                                 u.id_rol, 
                                 u.usuario, 
                                 u.nombre, 
                                 u.admin,
                                 CONCAT_WS(' ', u.nombre, u.apepa, u.apema) AS nombrecompleto, 
                                 r.rol,
                                 u.sexo
					        FROM ws_usuario u
					   LEFT JOIN ws_rol r ON r.id_rol = u.id_rol
					       WHERE usuario = '" . $user . "'
					         AND clave = '" . $password . "'
                             AND u.activo = 1 LIMIT 1";
            // echo $queryUser;
            $result = $this->conn->prepare($queryUser);
            $result->execute();
            return $result;
        }
        catch(\PDOException $e)
        {
            return "Error!: " . $e->getMessage();
        }
    }

    public function getUserById($id)
    {
        try {

            $queryUser = "SELECT 
                            u.id_usuario,
                            u.id_rol, 
                            u.usuario, 
                            CONCAT_WS(' ', u.nombre, u.apepa, u.apema) AS nombrecompleto,
                            u.sexo
                           FROM ws_usuario u
					      WHERE id_usuario = '$id'
                            AND u.activo = 1 LIMIT 1";
            $result = $this->conn->prepare($queryUser);
            $result->execute();
            return $result;
        }
        catch(\PDOException $e)
        {
            return "Error!: " . $e->getMessage();
        }
    }

    public function getParametro($id)
    {
        //Verificando si existe el usuario a logearse
        try {
            $valor     = 0;

            $queryUser = "SELECT valor
					        FROM ws_parametro u 
                           WHERE id_parametro = $id";
            $result = $this->conn->prepare($queryUser);
            $result->execute();
            if($result->rowCount() >0 ){
                $rw = $result->fetch(PDO::FETCH_OBJ);
                $valor = $rw->valor;
            }
            return $valor;
        }
        catch(\PDOException $e)
        {
            return "Error!: " . $e->getMessage();
        }
    }

    public function getUserLock(){
        //Verificando si existe el usuario a logearse
        try {
            $queryUser = "SELECT id as id_usuario, 
                                 id_rol, 
                                 usuario, 
                                 name as nombre,
                                 CONCAT_WS(' ', name, apepa, apema) AS nombrecompleto,                                  
                                 sexo                                 
					        FROM ws_usuario 
                           where id='".$this->getIdUsuario()."' 
                             AND password='".$this->getClave()."'
					         AND activo = 1";
            $result = $this->conn->prepare($queryUser);
            $result->execute();
            return $result;
        }
        catch(\PDOException $e)
        {
            return "Error!: " . $e->getMessage();
        }
    }

    public function getRegbyid( $id ){
        try {
            $queryMP = "SELECT id_usuario, 
                               id_rol,
                               id_zona,
                               usuario,
                               no_empleado, 
                               nombre, 
                               apepa, 
                               apema, 
                               sexo, 
                               admin, 
                               activo
                          FROM ws_usuario 
                         WHERE id_usuario = ".$id ." 
                         LIMIT 1";
                         
            $result = $this->conn->prepare($queryMP);
            $result->execute();
            return $result;
        }
        catch(\PDOException $e)
        {
            return "Error!: " . $e->getMessage();
        }
    }
    
    public function getRegByUserName( $nameuser ){
        try {

            $isRepeat = false;

            $queryMP = "SELECT id_usuario
                          FROM ws_usuario 
                         WHERE usuario ='".$nameuser ."'
                         LIMIT 1";
                         
            $result = $this->conn->prepare($queryMP);
            $result->execute();

            if( $result->rowCount() > 0 ){

                $isRepeat = true;

            }
            return $isRepeat;
        }
        catch(\PDOException $e)
        {
            return "Error!: " . $e->getMessage();
        }
    }

    public function getRegbyPW(){
        try {
            $queryMP = "SELECT id as id_usuario, 
                               usuario 
                          FROM ws_usuario
		                 WHERE id_usuario = ".$this->getIdUsuario()." 
                           AND password='".$this->getClave()."' 
                         LIMIT 1";

            $result = $this->conn->prepare($queryMP);
            $result->execute();
            $registrosf = $result->rowCount();
            return $registrosf;
        }
        catch(\PDOException $e)
        {
            return "Error!: " . $e->getMessage();
        }
    }

    public function foundUser(){
        try {
            $queryMP = "SELECT usuario 
                          FROM ws_usuario
                         WHERE usuario='".$this->getUsuario()."'";
            $result = $this->conn->prepare($queryMP);
            $result->execute();
            $registrosf = $result->rowCount();
            return $registrosf;
        }
        catch(\PDOException $e)
        {
            return "Error!: " . $e->getMessage();
        }
    }

    public function menuGeneral( $id_grupo){

        try {
            $conn = new BD();
            $queryMP = "SELECT id_menu,
                               link,
                               texto,
                               class,
                               orden
                          FROM ws_menu m 
		 			     WHERE m.id_grupo = $id_grupo  
                           AND m.activo = 1 
                         ORDER BY id_menu ASC ";
            // echo $queryMP;
            $result = $conn->prepare($queryMP);
            $result->execute();
            return $result;
        }
        catch(\PDOException $e)
        {
            return "Error!: " . $e->getMessage();
        }
    }
    
    public function menuGeneralByUsr( $id_grupo, $id_usuario){

        try {
            $conn = new BD();
            $queryMP = "SELECT id_menu,
                               link,
                               texto,
                               class,
                               orden
                          FROM ws_menu m 
		 			     WHERE m.id_grupo = $id_grupo  
                           AND m.activo = 1 
                           AND id_menu 
                           IN ( SELECT id_menu FROM ws_usuario_menu WHERE id_usuario = $id_usuario)
                         ORDER BY m.orden ASC ";
            $result = $conn->prepare($queryMP);
            $result->execute();
            return $result;
        }
        catch(\PDOException $e)
        {
            return "Error!: " . $e->getMessage();
        }
    }

    public function validateOnUsrMenu( $id, $id_menu ){

        try {
            $conn = new BD();
            $queryMP = "SELECT imp,
                               edit,
                               elim,
                               nuevo,
                               exportar
                          FROM ws_usuario_menu m 
		 			     WHERE m.id_usuario = $id
                           AND m.id_menu = $id_menu";

            $result = $conn->prepare($queryMP);
            $result->execute();
            return $result;
        }
        catch(\PDOException $e)
        {
            return "Error!: " . $e->getMessage();
        }
    }

    public function checarRol_user(){
        try {
            $queryCM = "SELECT id_rol_usuario 
                          FROM ws_rol_usuario 
                         WHERE id_rol = '" . $this->getIdRol() . "' 
                           AND id_usuario='" . $this->getIdUsuario() . "'";
            $result = $this->conn->prepare($queryCM);
            $result->execute();
            $registrosf = $result->rowCount();
            return $registrosf;
        }
        catch (\PDOException $e){
            return "Error!: " . $e->getMessage();
        }
    }

    public function getRolUser(){
        try {
            $queryCM = "SELECT id_rol 
                          FROM ws_rol_usuario
                         WHERE id_usuario='" . $this->getIdUsuario() . "'";
            $result = $this->conn->prepare($queryCM);
            $result->execute();
            return $result;
        }
        catch (\PDOException $e){
            return "Error!: " . $e->getMessage();
        }
    }

    public function foundUserConcidencia(){
        //Busca si existe un usuario con el nombre
        try{
            $queryUser = "SELECT usuario 
                            FROM ws_usuario 
                           WHERE usuario='".$this->getUsuario()."' 
                             AND id_usuario = '".$this->getIdUsuario()."'";
            //Ejecutando la consulta
            $result    = $this->conn->prepare($queryUser);
            $result->execute();
            //Regresando el resultado.
            $registrosf = $result->rowCount();
            return $registrosf;
        }
        catch (\PDOException $e){
            return "Error: ". $e->getMessage();
        }

    }

    public function getAllReg($limite, $inicio, $fin, $filtro)
    {
        $limit      = "";
        $condition  = "";
        if ($limite == 1){ $limit = " LIMIT ".$inicio.", ".$fin;}
        
        if (is_array($filtro)){
            
            if(isset($filtro['nombre']) && $filtro['nombre'] != ""){
                $condition = " AND CONCAT_WS(' ', nombre, apepa, apema) LIKE '%".$filtro['nombre']."%' ";
            }
            if(isset($filtro['no_empleado']) && $filtro['no_empleado'] != ""){
                $condition = " AND u.no_empleado = ".$filtro['no_empleado']." ";
            }
            if(isset($filtro['usuario']) && $filtro['usuario'] != ""){
                $condition = " AND u.usuario LIKE '%".$filtro['usuario']."%' ";
            }
        }

        try {
            $queryUser = "SELECT u.id_usuario, 
                                 u.id_zona,
                                 u.no_empleado,   
                                 u.usuario, 
                                 CONCAT_WS(' ', u.nombre, u.apepa, apema) AS nombre,
                                 u.sexo,
                                 u.admin,
                                 u.activo 
                            FROM ws_usuario as u
                           WHERE 1 $condition 
                           ORDER BY u.id_usuario DESC ".$limit;
            $result = $this->conn->prepare($queryUser);
            
            $result->execute();
            return $result;
        }
        catch(\PDOException $e)
        {
            return "Error!: " . $e->getMessage();
        }
    }

    public function checarMenuUser(){
        try {
            $queryCM = "SELECT id_usuario_menu, 
                               imp, 
                               edit, 
                               elim, 
                               nuevo, 
                               exportar
                          FROM ws_usuario_menu
                         WHERE id_menu = '" . $this->get_id_menu() . "' 
                          AND id_usuario='" . $this->getIdUsuario() . "'";
            $result = $this->conn->prepare($queryCM);
            $result->execute();
            //echo $queryCM;
            return $result;
        }
        catch (\PDOException $e){
            return "Error!: " . $e->getMessage();
        }
    }

    public function insertReg( $data ){
        $correcto= 1;
        
        $exec = $this->conn->conexion();
        try {
            $queryMP = "INSERT INTO ws_usuario(
                            id_rol,
                            id_zona, 
                            usuario, 
                            no_empleado,
                            nombre,
                            apepa, 
                            apema,
                            admin, 
                            clave, 
                            sexo, 
                            activo
                            )
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
                            ?)";

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
    
    public function insertRegdtluser( $array_val ){
        $exec = $this->conn->conexion();
        try {
            $correcto   = 1;
            $insert_dtl ="INSERT INTO ws_usuario_menu(
                                id_usuario, 
                                id_menu, 
                                imp,
                                edit,
                                elim,
                                nuevo,
                                exportar) 
                               VALUES (
                                ?,
                                ?,
                                ?,
                                ?,
                                ?,
                                ?,
                                ?)";

            $result = $this->conn->prepare($insert_dtl);

            $exec->beginTransaction();

            $result->execute($array_val);

            if ($correcto == 1){
                $correcto= $exec->lastInsertId();
            }

            $exec->commit();
            return $correcto;
        }
        catch (\PDOException $e){
            return "Error!: " . $e->getMessage();
        }

    }

    public function updateReg( $data ){
        $correcto   = 1;
        $exec       = $this->conn->conexion();

        try {

            $queryUpdate = "UPDATE ws_usuario
                               SET id_rol = ?, 
                                   id_zona = ?, 
                                   usuario = ?, 
                                   no_empleado = ?,
                                   nombre = ?, 
                                   apepa = ?,
                                   apema = ?, 
                                   sexo  = ?,
                                   admin = ? 
                             WHERE id_usuario = ?";
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
    
    public function updateRegacount(){
        $correcto   = 1;
        $exec       = $this->conn->conexion();

        try {
            $queryUpdate = "UPDATE ws_usuario
                           SET usuario = ?, 
                               sexo = ?,
                               name = ?, 
                               apepa =?,
                               apema =?
                         WHERE id_usuario = ?";
            $result = $this->conn->prepare($queryUpdate);

            $exec->beginTransaction();

            $array_val = array(
                $this->getUsuario(),
                $this->getNombre(),
                $this->getApePa(),
                $this->getApeMa(),
                $this->getIdUsuario()
            );

            $result->execute($array_val);

            $exec->commit();
            return $correcto;
        }catch (\PDOException $e){
            $exec->rollBack();
            return "Error!: " . $e->getMessage();
        }
    }

    public function updateRegwop($id_usuario,
                                 $usuario, 
                                 $nombre, 
                                 $apepat, 
                                 $apemat, 
                                 $correo, 
                                 $sexo){

        if($sexo == 1){
            $img= "avatar5.png";
        }else{
            $img= "avatar2.png";
        }

        $correcto    = 1;
        $exec        = $this->conn->conexion();

        try {
            $queryUpdate = "UPDATE ws_usuario
                           SET usuario = ?, 
                               sexo = ?, 
                               name = ?, 
                               apepa = ?,
                               apema= ?, 
                               email = ?, 
                               img = ?
                         WHERE id_usuario = ?";
            $result = $this->conn->prepare($queryUpdate);

            $exec->beginTransaction();

            $array_val = array(
                $usuario,
                $sexo,
                $nombre,
                $apepat,
                $apemat,
                $correo,
                $img,
                $id_usuario
            );

            $result->execute($array_val);

            $exec->commit();
            return $correcto;
        }catch (\PDOException $e){
            $exec->rollBack();
            return "Error!: " . $e->getMessage();
        }
    }

    public function updateRegPW( $id, $password ){
        $correcto   = 1;
        $exec = $this->conn->conexion();

        try {
            $queryMP = "UPDATE ws_usuario
                           SET clave = ?
                         WHERE id_usuario = ?";

            $result = $this->conn->prepare($queryMP);

            $exec->beginTransaction();

            $array_val = array(
                hash('sha256',$password),
                $id
            );

            $result->execute($array_val);

            $exec->commit();
        }
        catch(\PDOException $e)
        {
            $exec->rollBack();
            $correcto   = 0;
            print "Error!: " . $e->getMessage();
        }
        return $correcto;
    }

    public function updateStatus( $tipo, $id_delete ){
        $correcto   = 1;
        $exec = $this->conn->conexion();
        
        try {
            $queryMP = "UPDATE ws_usuario 
                           SET activo = ?
    				     WHERE id_usuario = ?";
            $result = $this->conn->prepare($queryMP);

            $exec->beginTransaction();

            $array_val = array(
                $tipo,
                $id_delete
            );

            $result->execute($array_val);
            $exec->commit();

            return $correcto;
        }
        catch(\PDOException $e)
        {
            return "Error!: " . $e->getMessage();
        }
    }

    public function deleteReg( $id_user ){
        $correcto   = 2;
        try {
            $queryMP = "DELETE FROM ws_usuario 
                              WHERE id_usuario = ".$id_user;
            $result = $this->conn->prepare($queryMP);
            $result->execute();

            return $correcto;
        }
        catch(\PDOException $e)
        {
            return "Error!: " . $e->getMessage();
        }
    }

    public function deleteRegUsMenu( $id_usr ){
        $correcto   = 2;
        try {
            $delete     = "DELETE FROM ws_usuario_menu WHERE id_usuario = ".$id_usr;

            $result = $this->conn->prepare($delete);
            $result->execute();

            return $correcto;
        }
        catch(\PDOException $e)
        {
            return "Error!: " . $e->getMessage();
        }
    }


   
}