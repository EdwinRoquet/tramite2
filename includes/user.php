<?php
require_once "db.php";
class User{
    private $id;
    private $nombre;
    private $username;
    private $flgTipUsr;
    private $area;
    private $desarea;
    private $idperfil;

/* ==========================================
   ACTUALIZAR USUARIO (SISTEMA)
   ========================================== */
   public function ActualizarUsuario($id,$tipdoc,$nrodoc,$nomraz,$direma,$numtel,$passwd,$idarea,$nombre, $apepat,$apemat,$idcargo,$idperfil){
        $pdo=Conexion::conectar();
        $query = $pdo->prepare('CALL usp_actualizar_usuario(:id,:tipdoc,:nrodoc,:nomraz,:direma,:numtel,:passwd,:idarea,:nombre,:apepat,:apemat,:idcargo,:idperfil)');
        $query->execute([
                        'id'      =>$id,
                        'tipdoc'  => $tipdoc,
                        'nrodoc'  => $nrodoc,
                        'nomraz'  => $nomraz,
                        'direma'  => $direma,
                        'numtel'  => $numtel,
                        'passwd'  => $passwd,
                        'idarea'  => $idarea,
                        'nombre'  => $nombre,
                        'apepat'  => $apepat,
                        'apemat'  => $apemat,
                        'idcargo' => $idcargo,
                        'idperfil'=>$idperfil]);
            
        return $query;
        $query->close();
                  

   }

/* ==========================================
   INSERTAR USUARIO (SISTEMA)
   ========================================== */
   public function InsertarUsuario($tipdoc,$nrodoc,$direma,$numtel,$passwd,$flgTipUsr,$idarea,$nombre,$apepat,$apemat,$idcargo,$idperfil,$idest){
        
        $pdo=Conexion::conectar();

        $query = $pdo->prepare('INSERT INTO tra_tbusuario(tipdoc,nrodoc,direma,numtel,passwd,flgTipUsr,idarea,nombre,apepat,apemat,idcargo,idperfil,idest) 
                                                 VALUES (:tipdoc,:nrodoc,:direma,:numtel,:passwd,:flgTipUsr,:idarea,:nombre,:apepat,:apemat,:idcargo,:idperfil,:idest)');

        if($query->execute(['tipdoc'    => $tipdoc,
                            'nrodoc'    => $nrodoc,
                            'direma'    => $direma,
                            'numtel'    => $numtel,
                            'passwd'    => $passwd,
                            'flgTipUsr' => $flgTipUsr,
                            'idarea'    => $idarea,
                            'nombre'    => $nombre,
                            'apepat'    => $apepat,
                            'apemat'    => $apemat,
                            'idcargo'   => $idcargo,
                            'idperfil'  => $idperfil,
                            'idest'     => $idest])){

            $lastInsertId = $pdo->lastInsertId();

        }else{
           
            $lastInsertId = 0;
            echo $query->errorInfo()[2];

        }

        return  $lastInsertId;
   }

/* ==========================================
   EDITAR USUARIO
   ========================================== */
   public static function EditarUsuario($id){

        $query = Conexion::conectar()->prepare('SELECT  id,
                                                        tipdoc,
                                                        nrodoc,
                                                        nomraz,
                                                        direma,
                                                        numtel,
                                                        passwd,
                                                        flgTipUsr,
                                                        idarea,
                                                        nombre,
                                                        apepat,
                                                        apemat,
                                                        idcargo,
                                                        idperfil,
                                                        idest
                                                FROM tra_tbusuario WHERE id = :id');
        // bindeo de datos
        $query->execute(['id' => $id]);

        return $query -> fetch();

   }
/* ==========================================
   LISTAR USUARIOS POR AREA
   ========================================== */
    public function ListarUsuariosXArea($idArea){

        $query = Conexion::conectar()->prepare('select id,apepat,apemat,nombre from tra_tbusuario where idarea = :idarea');

        $query->execute(['idarea' => $idArea]);

        return $query -> fetchAll();
    }

/* ==========================================
   Listar usuarios
   ========================================== */
    public function ListarUsuarios($nomusu,$doiusr){
        
        $query = Conexion::conectar()->prepare('SELECT  0 as row,
                                                        u.id, 
                                                        u.tipdoc,
                                                        u.nrodoc,
                                                        u.nomraz,
                                                        u.direma,
                                                        u.numtel,
                                                        u.passwd,
                                                        u.flgTipUsr,
                                                        u.idarea,
                                                        a.desarea,
                                                        u.nombre,
                                                        u.apepat,
                                                        u.apemat,
                                                        u.idcargo,
                                                        c.descargo,
                                                        u.idest,
                                                        e.desestreg,
                                                        CONCAT(u.id,"-",u.idest) AS est
                                                FROM tra_tbusuario u
                                                INNER JOIN tra_tbarea a
                                                ON u.idarea = a.id
                                                INNER JOIN tra_tbcargo c
                                                ON u.idcargo = c.id
                                                INNER JOIN tra_tbestadoreg e
                                                ON u.idest = e.id
                                                WHERE u.flgTipUsr = "I"
                                                AND CONCAT(u.nombre,u.apepat,u.apemat) LIKE :nomusu
                                                AND u.nrodoc LIKE :nrodoc');

        $query->execute(['nomusu' => $nomusu,
                         'nrodoc' => $doiusr]);

        return $query -> fetchAll();

    }

/* ==========================================
   Obtener contraseña
   ========================================== */
    public function getUserInf($id){

        $query = Conexion::conectar()->prepare('SELECT  u.id, 
                                                        u.tipdoc,
                                                        t.tipdoc as destipdoc,
                                                        u.nrodoc,
                                                        u.nomraz,
                                                        u.direma,
                                                        u.numtel,
                                                        u.passwd,
                                                        p.flgusuario,
                                                        p.flgdocinterno,
                                                        p.flgmesapartes,
                                                        p.flgatencion,
                                                        p.flgatendidos
                                                FROM tra_tbusuario u 
                                                INNER JOIN tra_tbtipdoc t on u.tipdoc = t.id
                                                LEFT JOIN tra_tbperfil p on u.idperfil = p.id
                                                WHERE u.id = :id');
        // bindeo de datos
        $query->execute(['id' => $id]);

        return $query -> fetch();

    }

/* ==========================================
   Validar datos de usuario
   ========================================== */
    public function userExists($user, $pass){
        //$md5pass = md5($pass);
          $md5pass = $pass;

        $query = Conexion::conectar()->prepare('SELECT * FROM tra_tbusuario WHERE direma = :user AND passwd = :pass');

        // bindeo de datos
        $query->execute(['user' => $user, 'pass' => $md5pass]);

        if($query->rowCount()){
            return true;
        }else{
            return false;
        }
    }
/* =============================================
   Validamos y correo ya se encuentra registrado
   ============================================= */
    public function mailExists($user){
        $query = Conexion::conectar()->prepare('SELECT * FROM tra_tbusuario WHERE direma = :user');

        // bindeo de datos
        $query->execute(['user' => $user]);

        if($query->rowCount()){
            return true;
        }else{
            return false;
        }
    }

/* ===========================================================
   Validamos si documento de identidad se encuentra registrado
   =========================================================== */
    public function nrodocExists($tipdoc,$nrodoc){
        $query = Conexion::conectar()->prepare('SELECT * FROM tra_tbusuario WHERE tipdoc = :tipdoc AND nrodoc = :nrodoc');

        // bindeo de datos
        $query->execute(['tipdoc' => $tipdoc, 'nrodoc' => $nrodoc]);

        if($query->rowCount()){
            return true;
        }else{
            return false;
        }
    }

/* ==========================================
   Asignar usuario a variables de sistema
   ========================================== */
    public function setUser($user){
      
        $query = Conexion::conectar()->prepare('SELECT  u.id,
                                                        u.tipdoc,
                                                        u.nrodoc,u.nomraz,u.direma,
                                                        u.numtel,u.passwd,u.flgTipUsr,
                                                        u.idarea,
                                                        a.desarea,
                                                        u.nombre,
                                                        u.apepat,u.apemat,
                                                        u.idcargo,
                                                        u.idperfil,
                                                        u.idest 
                                                FROM tra_tbusuario u 
                                                LEFT JOIN tra_tbarea a ON u.idarea = a.id
                                                WHERE direma = :user');
        $query->execute(['user' => $user]);
        
        foreach ($query as $currentUser) {
            $this->id = $currentUser['id'];
            $this->nombre = $currentUser['nomraz'];
            $this->username = $currentUser['direma'];
            $this->flgTipUsr = $currentUser['flgTipUsr'];
            $this->area = $currentUser['idarea'];
            $this->desarea = $currentUser['desarea'];
            $this->idperfil = $currentUser['idperfil'];

        }
    }
    /* =======================================
    Retornar Nombre
    ======================================= */
    public function getPerfil(){ return $this->idperfil; }

    /* =======================================
    Retornar Nombre
    ======================================= */
    public function getNombre(){ return $this->nombre; }

    /* =======================================
    Retornar Id
    ======================================= */
    public function getId(){ return $this->id;}

    /* =======================================
    Retornar Email
    ======================================= */
    public function getUserName(){return $this->username;}

    /* =======================================
    Retornar Area
    ======================================= */
    public function getArea(){return $this->area;}
    public function getDesArea(){return $this->desarea;}

    /* =======================================
    Retornar Indicador de Tipo de Usuario
    ======================================= */
    public function getflgTipUsr(){ return $this->flgTipUsr; }

    /* =======================================
    Retonar contraseña
    ======================================= */
    public function getPass($user){
        $query = Conexion::conectar()->prepare('SELECT passwd FROM tra_tbusuario WHERE direma = :user');
        $query->execute(['user' => $user]);
        return $query -> fetch();
    }

/* ==========================================
   Registrar Usuario
   ========================================== */
   public function newUser($tipdoc,$nrodoc,$nomraz,$direma,$numtel,$passwd){
        
        $pdo = Conexion::conectar();

        $query = $pdo->prepare('INSERT INTO tra_tbusuario(tipdoc,nrodoc,nomraz,direma,numtel,passwd,flgTipUsr,idest) 
                                                VALUES (:tipdoc,:nrodoc,:nomraz,:direma,:numtel,:passwd,"E","H")');

        if($query->execute(['tipdoc' => $tipdoc,
                         'nrodoc' => $nrodoc,
                         'nomraz' => $nomraz, 
                         'direma' => $direma,
                         'numtel' => $numtel,
                         'passwd' => $passwd])){

            $lastInsertId = $pdo->lastInsertId();
        }else{
            //Pueden haber errores, como clave duplicada
            $lastInsertId = 0;
            echo $query->errorInfo()[2];
        } 
        
        return  $lastInsertId;
   }

/* ==========================================
   Actualizar datos
   ========================================== */
   public static function UpdInfo($idUsr,$numtel,$passwd){
        
 
      echo "<script>console.log( 'Debug Objects: " . $passwd . "' );</script>";

      if ($passwd == '') {

        $query = Conexion::conectar()->prepare('UPDATE tra_tbusuario SET numtel = :numtel WHERE id = :id');

        $query->execute( ['id' => $idUsr,'numtel' => $numtel ]);

      }else {
        
        $query = Conexion::conectar()->prepare('UPDATE tra_tbusuario SET numtel = :numtel, passwd = :passwd WHERE id = :id');

        $query->execute( ['id' => $idUsr,'numtel' => $numtel,'passwd' => $passwd ]);

      }
        
   }
   /* ============================
        Devolver datos de usuario
   ==============================*/
   public function DatosUsuario($email){
        $query = Conexion::conectar()->prepare('SELECT  id,tipdoc,nrodoc,nomraz,direma,numtel,passwd,flgTipUsr,
                                                        idarea,nombre,apepat,apemat,idcargo,idperfil,idest 
                                                FROM tra_tbusuario u 
                                                WHERE direma = :email');
        $query->execute(['email' => $email]);

        return $query -> fetch();
        
    }
}
?>