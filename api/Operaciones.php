<?php

require_once './api/AccesoDatos.php';

class Operaciones{
    
    private $objetoAccesoDato;

    function __construct(){ 

        try { 
            $this->objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        } 
        catch (PDOException $e) {
             echo "*********** ERROR ***********<br>" . strtoupper($e->getMessage());
            }
    }

    public static function __TraerTodos($param){

        try{
            $consulta = $this->objetoAccesoDato->RetornarConsulta("select * from ". $param );
            $consulta->execute();

            $Lista = $consulta->fetchAll(PDO::FETCH_CLASS, 'Operaciones');


            /*foreach( $Lista as $cd)
            {
                $JSON[]= array("Titulo"=>$cd{'titel'}, "Interprete"=>$cd{'interpret'}, "Edicion"=>$cd{'jahr'}, "ID"=>$cd{'id'});
            
            }*/

            return json_encode($Lista);
        }
        catch(PDOException $e){
            echo "*********** ERROR ***********<br>" . strtoupper($e->getMessage());
        }
    }

    function __guardar($tit, $inte, $edi){
        try{
            $consulta = $this->objetoAccesoDato->RetornarConsulta("INSERT INTO cds (titel, interpret, jahr) VALUES (:tit, :inte,:anio)");
            $consulta->bindValue(':tit', $tit, PDO::PARAM_STR);
            $consulta->bindValue(':anio', $edi, PDO::PARAM_INT);
            $consulta->bindValue(':inte', $inte, PDO::PARAM_STR);
            if($consulta->execute() == true)
                echo " ======== SE AGREGO CORRECTAMENTE ========<br>";
            else
                echo "*********** ERROR AL AGREGAR REGISTRO ***********";
        }
        catch( PDOException $e){
            echo "*********** ERROR ***********<br>" . strtoupper($e->getMessage()); 
        }
    }

    function __modificarCD($id,$tit, $inte, $edi)
	 {
	     try{
    			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
    			$consulta =$objetoAccesoDato->RetornarConsulta("
    				update cds 
    				set titel=:titulo,
    				interpret=:cantante,
    				jahr=:anio
    				WHERE id=:id");
    			$consulta->bindValue(':id',$id, PDO::PARAM_INT);
    			$consulta->bindValue(':titulo',$tit, PDO::PARAM_STR);
    			$consulta->bindValue(':anio', $edi, PDO::PARAM_INT);
    			$consulta->bindValue(':cantante', $inte, PDO::PARAM_STR);
    			if($consulta->execute() == true)
                echo " ======== SE MODIFICO CORRECTAMENTE EL REGISTRO ========<br>";
            else
                echo "*********** ERROR AL MODIFICAR REGISTRO ***********";
	        }
	    catch( PDOException $e){
	            echo "*********** ERROR ***********<br>" . strtoupper($e->getMessage()); 
	        }
	 }
	 
	function __borrar($id){
	    try{
	            $consulta= $this->objetoAccesoDato->RetornarConsulta("DELETE FROM cds WHERE id = :id");
	            $consulta->bindValue(':id',$id,PDO::PARAM_INT);
	             if($consulta->execute() == true)
                echo " ======== SE BORRO REGISTRO CORRECTAMENTE ========<br>";
            else
                echo "*********** ERROR AL BORRAR REGISTRO ***********";
	    }
	    catch(PDOException $e){
	         echo "*********** ERROR ***********<br>" . strtoupper($e->getMessage()); 
	    }
	}
	
	function __traerX($id){
	    try{
	            $consulta= $this->objetoAccesoDato->RetornarConsulta("SELECT * FROM cds Where id=:id");
	            $consulta->bindValue(':id',$id, PDO::PARAM_INT);
	            $consulta->execute();
	            $Lista = $consulta->fetchAll(PDO::FETCH_CLASS, 'Operaciones');
	            
	            return json_encode($Lista);
	        
	    }
	    catch(PDOException $e){
	        echo "*********** ERROR ***********<br>" . strtoupper($e->getMessage()); 
	    }
	}
}
?>