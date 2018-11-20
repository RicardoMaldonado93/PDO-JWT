<?php

require_once "./clases/AccesoDatos.php";

class CD {

    public static function agregarCD($tit, $inte, $edi){
        try{
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
            $consulta = $objetoAccesoDato->RetornarConsulta("INSERT INTO cds (titel, interpret, jahr) VALUES (:tit, :inte,:anio)");
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

    public static function mostrarTodos(){
        try{

            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
            $consulta = $objetoAccesoDato->RetornarConsulta('CALL traerCDS()');//("select * from cds" );
            $consulta->execute();

            $Lista = $consulta->fetchAll(PDO::FETCH_CLASS, 'CD'); // o $Lista = $consulta->fetchObject(__CLASS__);


            /*foreach( $Lista as $cd)
            {
                $JSON[]= array("Titulo"=>$cd{'titel'}, "Interprete"=>$cd{'interpret'}, "Edicion"=>$cd{'jahr'}, "ID"=>$cd{'id'});
            
            }*/

            return $Lista;
            
        }
        catch(PDOException $e){
            echo "*********** ERROR ***********<br>" . strtoupper($e->getMessage());
        }
    }

    public static function mostrarUnCD($id){
        try{
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            $consulta= $objetoAccesoDato->RetornarConsulta("SELECT * FROM cds Where id=:id");
            $consulta->bindValue(':id',$id, PDO::PARAM_INT);
            $consulta->execute();
            $Lista = $consulta->fetchAll(PDO::FETCH_CLASS, 'CD');
            if( $Lista != NULL)
                return $Lista;
            else
                echo "No se encuentra registro";
        
            }
        catch (PDOException $e){
            echo "*********** ERROR ***********<br>" . strtoupper($e->getMessage()); 
        }
    }

    public static function borrarCD($id){
        try{
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            $consulta= $objetoAccesoDato->RetornarConsulta("DELETE FROM cds WHERE id = :id");
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

    public static function modificarCD($id,$tit, $inte, $edi){
        try{
                $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
                $consulta =$objetoAccesoDato->RetornarConsulta("
                    update cds 
                    set titel=:titulo,
                    interpret=:cantante,
                    jahr=:anio
                    WHERE  id LIKE :id");
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
}

?>