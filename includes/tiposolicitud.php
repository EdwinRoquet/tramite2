<?php 

require_once "db.php";

class TipSolicitud {
    private $id;
    private $tipdoc;

/* ==========================================
   LISTAR TIPOS DE DOCUMENTOS
   ==========================================*/
   public function listarTipSol(){
   	
   	$query = Conexion::conectar()->prepare("SELECT id,destipsol,flgmsaprt 
                                            FROM tra_tbTipoSolicitud 
                                            WHERE flgmsaprt = 'S'
                                            ORDER BY destipsol ASC");
    
    $query->execute();

    return $query -> fetchAll();

	  $query->close();

   }
}

 ?>