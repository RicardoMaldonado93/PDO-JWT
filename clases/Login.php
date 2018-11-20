<?php

require_once './clases/AccesoDatos.php';


class Login{

    public static function loguear($user, $pass){
        try{
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            $consulta= $objetoAccesoDato->RetornarConsulta("SELECT * FROM usuarios Where nombre=:nombre AND pass=:pass");
            $consulta->bindValue(':nombre',$user, PDO::PARAM_STR);
            $consulta->bindValue(':pass',$pass, PDO::PARAM_STR);
            $consulta->execute();
            $Lista = $consulta->fetchAll(PDO::FETCH_CLASS, 'Login');
            
            return $Lista;
              
 
        
            }
        catch (PDOException $e){
            echo "*********** ERROR ***********<br>" . strtoupper($e->getMessage()); 
        }
    }
}
?>