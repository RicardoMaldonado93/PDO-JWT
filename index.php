<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require_once './vendor/autoload.php';
require_once './api/CDApi.php';
require_once './api/LoginApi.php';
require_once './clases/Token.php';

$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;

$app = new \Slim\App(["settings" => $config]);





$logIn = function($request, $response, $next){

        $dato = $request->getHeader('token');
        $token = $dato[0];

        
        if(!Token::VerificarToken($token))
            $nresponse = $next($request, $response);
        else
            $nresponse = $response->withJson('error',404);
        
            return $nresponse;
};


$app->group('/cds', function(){

   

    $this->get('/traerTodos', \CDApi::class . ':TraerTodos');

    $this->get('/{id}', \CDApi::class . ':TraerUnCD');

    $this->post('/', \CDApi::class . ':AgregarUnCD')->add(\LoginApi::class . ':ValidarUsr');

    $this->delete('/', \CDApi::class . ':BorrarUnCD')->add(\LoginApi::class . ':ValidarUsr');
    
    $this->put('/', \CDApi::class . ':ModificarUnCD')->add(\LoginApi::class . ':ValidarUsr');

})->add($logIn)->add(\LoginApi::class . ':Login');

$app->run();
?>