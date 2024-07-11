<?php
//Incluyendo la conexión a la base de datos
require_once $dir_fc."connections/conn_data.php";

class Rol extends BD
{
    private $conn;

    function __construct()
    {
        //Esta es la que llama a la base de datos
        //parent::__construct();
        $this->conn = new BD();
    }

    public function getAllRegAjax()
    {

        try {
            $queryUser = "SELECT id, rol, descripcion, pag_ini,  activo
                          FROM ws_rol ORDER BY id DESC";

            $result = $this->conn->prepare($queryUser);
            $result->execute();

            return $result;
        }
        catch(\PDOException $e)
        {
            return "Error!: " . $e->getMessage();
        }
    }

    public function getAllReg( $limite, $inicio, $fin, $filtro ){

        try {
            
            $milimite = "";
            $condition = "";

            if ($limite == 1) {
                $milimite = " LIMIT " . $inicio . ", " . $fin;
            }

            if (is_array($filtro)){
            
                if(isset($filtro['rol']) && $filtro['rol'] != ""){
                    $condition = " AND rol LIKE '%".$filtro['rol']."%' ";
                }
                if(isset($filtro['descripcion']) && $filtro['descripcion'] != ""){
                    $condition = " AND descripcion LIKE '%".$filtro['descripcion']."%' ";
                }
    
            }

            $queryReg = "SELECT id_rol, 
                                rol, 
                                descripcion, 
                                activo
                           FROM ws_rol 
                           WHERE 1 $condition
                          ORDER BY id_rol DESC " . $milimite;

            $result = $this->conn->prepare($queryReg);
            $result->execute();
            return $result;

        }catch (\PDOException $e){
            return "Error!: " . $e->getMessage();
        }

    }

    public function getAllRoles(){
        try {
            $query = "SELECT id_rol, 
                             rol, 
                             descripcion  
                        FROM ws_rol 
                       WHERE activo = 1
                       ORDER BY id_rol ASC";

            $result = $this->conn->prepare($query);
            $result->execute();
            return $result;

        }catch (\PDOException $e){
            return "Error!: " . $e->getMessage();
        }
    }
    
    public function getUserByRol(){
        try {
            $query = "SELECT id_usuario 
                        FROM ws_usuario
                       WHERE id_rol = ".$this->get_id();

            $result = $this->conn->prepare($query);
            $result->execute();
            return $result;

        }catch (\PDOException $e){
            return "Error!: " . $e->getMessage();
        }
    }

    public function getReg(){
        try {
            $queryMP = "SELECT id_rol, rol, descripcion FROM ws_rol ORDER BY id_rol DESC";
            $result = $this->conn->prepare($queryMP);
            $result->execute();
            return $result;
        }
        catch(\PDOException $e)
        {
            return "Error!: " . $e->getMessage();
        }
    }

    public function getRolID( $id ){
        try {
            $queryReg = "SELECT id_rol, 
                                rol, 
                                descripcion, 
                                activo 
                           FROM ws_rol 
                          WHERE id_rol = ". $id." 
                          LIMIT 1";
            $result   = $this->conn->prepare($queryReg);
            $result->execute();
            return $result;
        }catch(\PDOException $e)
        {
            return "Error!: " . $e->getMessage();
        }
    }

    public function countRol_User($id_rol){
        try {
            $rw_res   = 0;
            $queryReg = "SELECT count(id_rol) as roles FROM ws_usuario
                          WHERE id_rol = $id_rol";
            $result = $this->conn->prepare($queryReg);
            $result->execute();
            if($result->rowCount() > 0){
                $registrosf = $result->fetch(PDO::FETCH_OBJ);
                $rw_res     = $registrosf->roles;
            }
            return $rw_res;
        }
        catch (\PDOException $e){
            return "Error!: " . $e->getMessage();
        }
    }

    public function insertReg( $data ){
        $exec = $this->conn->conexion();
        try {
            $correcto   = 1;
            $insert     = "INSERT INTO ws_rol(rol, 
                                              descripcion)
                           VALUES (?,
                                   ?)";
            $result = $this->conn->prepare($insert);
            $exec->beginTransaction();
            $result->execute($data);
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

    public function insertRegdtl( $array_val ){
        $exec = $this->conn->conexion();
        try {
            $correcto   = 1;
            $insert_dtl ="INSERT INTO ws_rol_menu (id_rol, 
                                                   id_menu, 
                                                   imp,
                                                   edit,
                                                   elim,
                                                   nuevo,
                                                   exportar) 
                               VALUES (?,
                                       ?,
                                       ?,
                                       ?,
                                       ?,
                                       ?,
                                       ?)";

            $result = $this->conn->prepare($insert_dtl);
            $exec->beginTransaction();
            $result->execute( $array_val );
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
    
    public function insertRegdtlByRol($id_usuario){
        $exec = $this->conn->conexion();
        try {
            $correcto   = 1;
            $insert_dtl ="INSERT INTO ws_usuario_menu(id_usuario, id_menu, imp,edit,elim,nuevo,exportar) 
                               SELECT '$id_usuario', id_menu, imp,edit,elim,nuevo,exportar 
                                 FROM ws_rol_menu 
                                 WHERE id_rol = ".$this->get_id();

            $result = $this->conn->prepare($insert_dtl);
            $exec->beginTransaction();
            $result->execute();
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

    public function actualizaReg($tipo, $id){
        $correcto   = 1;
        $exec       = $this->conn->conexion();
        try{
            $queryUpdate ="UPDATE ws_rol SET activo = $tipo
    				        WHERE id_rol = '$id'";

            $result = $this->conn->prepare($queryUpdate);
            $exec->beginTransaction();
            $result->execute();
            $exec->commit();
        }catch (\PDOException $e){
            $exec->rollBack();
            $correcto =  "Error!: " . $e->getMessage();
        }
        return $correcto;

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
            $result = $conn->prepare($queryMP);
            $result->execute();
            return $result;
        }
        catch(\PDOException $e)
        {
            return "Error!: " . $e->getMessage();
        }
    }

    public function validateOnRol( $id_rol, $id_menu ){

        try {
            $conn = new BD();
            $queryMP = "SELECT imp,
                               edit,
                               elim,
                               nuevo,
                               exportar
                          FROM ws_rol_menu m 
		 			     WHERE m.id_rol = $id_rol 
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

    public function parentsMenu(){
        try {
        $query= "SELECT id_menu, id_grupo, texto, link  FROM ws_menu
                  WHERE id_grupo = 0 ORDER BY id_menu ASC";
            $result = $this->conn->prepare($query);
            $result->execute();
            return $result;
        }catch (\PDOException $e){
            return "Error!: " . $e->getMessage();
        }
    }

    public function parentsMenuByRol(){
        try {
        $query= "SELECT m.id_menu, m.id_grupo, m.texto, m.link  
                   FROM ws_menu as m
                   INNER JOIN ws_rol_menu as rm ON m.id_menu = rm.id_menu
                  WHERE m.id_grupo = 0 AND rm.id_rol = ".$this->get_id()." ORDER BY id ASC";
            $result = $this->conn->prepare($query);
            $result->execute();
            return $result;
        }catch (\PDOException $e){
            return "Error!: " . $e->getMessage();
        }
    }

    public function childsMenu($id_menu){
        try {
        $query= "SELECT id_menu, id_grupo, texto, link  FROM ws_menu
                WHERE id_grupo = $id_menu ORDER BY id_menu ASC";
            $result = $this->conn->prepare($query);
            $result->execute();
            return $result;
        }catch (\PDOException $e){
            return "Error!: " . $e->getMessage();
        }
    }

    public function checarRol_menu(){
        try {
            $queryCM ="SELECT id_menu, imp, edit, nuevo, elim, exportar 
                         FROM ws_rol_menu 
                        WHERE id_menu ='".$this->get_id_menu()."' AND id_rol='".$this->get_id()."'";
            $result = $this->conn->prepare($queryCM);
            $result->execute();
            //echo $queryCM;
            //$rows = $result->rowCount();
            return $result;
        }catch (\PDOException $e){
            return "Error!: " . $e->getMessage();
        }
    }

    public function checarUser_menu(){
        try {
            $queryCM ="SELECT id_usuario_menu as id, imp, edit, nuevo, elim, exportar 
                         FROM ws_usuario_menu 
                        WHERE id_menu='".$this->get_id_menu()."' AND id_usuario ='".$this->getIdUsuario()."'";
            $result = $this->conn->prepare($queryCM);
            $result->execute();
            //$rows = $result->rowCount();
            return $result;
        }catch (\PDOException $e){
            return "Error!: " . $e->getMessage();
        }
    }

    public function updateReg( $data ){
        $correcto   = 1;
        $exec       = $this->conn->conexion();
        try{
            $queryUpdate = "UPDATE ws_rol 
                               SET rol = ?, 
                                   descripcion= ?
                             WHERE id_rol = ?";
            $result = $this->conn->prepare($queryUpdate);
            $exec->beginTransaction();
            $result->execute( $data );
            $exec->commit();
        }catch (\PDOException $e){
            $exec->rollBack();
            $correcto =  "Error!: " . $e->getMessage();
        }
        return $correcto;
    }

    public function deleteRegRM( $id ){
        $correcto   = 2;
        try {
            $delete     = "DELETE FROM ws_rol_menu WHERE id_rol = ".$id;

            $result = $this->conn->prepare($delete);
            $result->execute();

            return $correcto;
        }
        catch(\PDOException $e)
        {
            return "Error! al eliminar configuración anterior: " . $e->getMessage();
        }
    }
    public function deleteRegByRolUser(){
        $correcto   = 2;
        try {
            $delete     = "DELETE FROM ws_usuario_menu 
                                 WHERE id_usuario IN 
                                 (SELECT id_usuario FROM ws_usuario WHERE id_rol = ".$this->get_id().")";

            $result = $this->conn->prepare($delete);
            $result->execute();

            return $correcto;
        }
        catch(\PDOException $e)
        {
            return "Error!: " . $e->getMessage();
        }
    }

    public function deleteRegUsMenu(){
        $correcto   = 2;
        try {
            $delete     = "DELETE FROM ws_usuario_menu WHERE id_usuario = ".$this->getIdUsuario();

            $result = $this->conn->prepare($delete);
            $result->execute();

            return $correcto;
        }
        catch(\PDOException $e)
        {
            return "Error!: " . $e->getMessage();
        }
    }

    public function updateStatus($tipo, $id){
        $correcto   = 1;
        $exec       = $this->conn->conexion();
        try{
            $queryUpdate ="UPDATE ws_rol SET activo = $tipo
    				    WHERE id_rol = ".$id;
            $result = $this->conn->prepare($queryUpdate);
            $exec->beginTransaction();
            $result->execute();
            $exec->commit();
        }catch (\PDOException $e){
            $exec->rollBack();
            $correcto =  "Error!: " . $e->getMessage();
        }
        return $correcto;
    }

    public function deleteReg($id_delete){
        $correcto   = 2;
        try {
            $delete     = "DELETE FROM ws_rol WHERE id_rol = ".$id_delete;

            $result = $this->conn->prepare($delete);
            $result->execute();

            return $correcto;
        }
        catch(\PDOException $e)
        {
            return "Error!: " . $e->getMessage();
        }
    }

    public function foundRol(){
        try {
            $queryCM ="SELECT rol FROM ws_rol WHERE rol ='".$this->get_rol()."'";
            $result = $this->conn->prepare($queryCM);
            $result->execute();
            $rows = $result->rowCount();
            return $rows;
        }catch (\PDOException $e){
            return "Error!: " . $e->getMessage();
        }
    }
}