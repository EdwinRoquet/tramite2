<?php 

require_once 'db.php';


/**
 * Clase : DocInt
 */
class DocInt
{

 /* ==========================================
   ACTUALIZAR DOCUMENTO INTERNO
   ========================================== */
   public static function ActualizarUsuario($id,$nomdocint,$estdocint){

		$pdo=Conexion::conectar();

        $query = $pdo->prepare('UPDATE tra_tbdocumentosinternos
                                SET desdocint  = :desdocint,
                                    estdocint  = :estdocint
                                WHERE id = :id');
                                 

        $query->execute([ 'desdocint' => $nomdocint,
                          'estdocint' => $estdocint,
                          'id'        => $id]);
 	}

 /* ==========================================
   INSERTAR DOCUMENTO INTERNO
   ========================================== */
   public static function InsertarDocumentoInterno($nomdocint,$estdocint){

		$pdo=Conexion::conectar();

        $query = $pdo->prepare('INSERT INTO tra_tbdocumentosinternos(desdocint,estdocint) VALUES (:desdocint,:estdocint)');

        if($query->execute(['desdocint' => $nomdocint,'estdocint' => $estdocint])){

            $lastInsertId = $pdo->lastInsertId();

        }else{
           
            $lastInsertId = 0;
            echo $query->errorInfo()[2];

        }

        return  $lastInsertId;

   }


   /* ==========================================
   EDITAR DOCUMENTO INTERNO
   ========================================== */
   public static function EditarDocInt($id){

        $query = Conexion::conectar()->prepare('SELECT  id,
                                                        desdocint,
                                                        estdocint
                                                FROM tra_tbdocumentosinternos WHERE id = :id');
        // bindeo de datos
        $query->execute(['id' => $id]);

        return $query -> fetch();

   }

	/*========================================
	LISTA DE DOCUMENTOS INTERNOS
	==========================================*/
	public function listarDocumentosInternos($nomdocint)
	{
		$query = Conexion::conectar()->prepare("SELECT id,desdocint,estdocint, concat(id,'-',estdocint) as est FROM tra_tbdocumentosinternos WHERE desdocint like :nomdocint");
    	
    	$query->execute(['nomdocint' => $nomdocint]);

    	return $query -> fetchAll();

	  	$query->close();	
	}

}
 ?>