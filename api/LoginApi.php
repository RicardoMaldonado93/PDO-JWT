<?php

require_once "./clases/Login.php";
require_once "./clases/IApi2.php";
require_once './clases/Token.php';

class LoginApi extends Login implements IApi2{

    public static function Login( $request, $response, $next){
        
        $datos = $request->getParsedBody();
        $user = $datos['nombre'];
        $pass = $datos['pass'];
        $login = Login::loguear($user, $pass);
    
        
        if( $login != NULL ){
            
            //$newResponse = $response->withAddedHeader(json_encode(Token::crearToken($login)), 'token');//withJson(Token::crearToken($login),200);
            //$newResponse = $response->withAddedHeader('asd', 'token');//
        
            $newResponse = $response->withJson(Token::crearToken($login),200);
            //var_dump(Token::crearToken($login));
            $newResponse= $next( $request, $response);
        }
        else
            $newResponse = $response->withJson("USUARIO NO VALIDO",404);

        return $newResponse;
    }

    public static function ValidarUsr( $request, $response, $next){
        
        $dato = $request->getHeader('token');
        $token = $dato[0];
    
        
        if( Token::ObtenerData($token)[0]->{'nombre'} != 'admin' )
            $nresponse = $response->withJson('error',404);
        else
            $nresponse = $next($request, $response);

        return $nresponse;
    }
  }
?>