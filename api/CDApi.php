<?php

require_once "./clases/CD.php";
require_once "./clases/IApi.php";

class CDApi extends CD implements IApi{

    public static function AgregarUnCD( $request, $response, $args){

        $datos= $request->getParsedBody();
        $tit = $datos['tit'];
        $inte = $datos['inte'];
        $ed = $datos['ed'];
        $unCD = CD::agregarCD($tit, $inte, $ed);
        $newResponse = $response->withStatus(200);
        return $newResponse;

    }
    public static function TraerTodos( $request, $response, $args ){

        $lista = CD::mostrarTodos();
        $newResponse = $response->withJson($lista,200);
        return $newResponse;
    }

    public static function TraerUnCd( $request, $response, $args){

        $ID = $args['id'];
        $unCD = CD::mostrarUnCD($ID);
        $newResponse = $response->withJson($unCD,200);
        return $newResponse;
    }

    public static function BorrarUnCd( $request, $response, $args){

        $ID = $args['id'];
        $unCD = CD::borrarCD($ID);
        $newResponse = $response->withStatus(200);
        return $newResponse;
    }

    public static function ModificarUnCD($request, $response, $args){

        $datos= $request->getParsedBody();
        $ID = $args['id'];
        $tit = $datos['tit'];
        $inte = $datos['inte'];
        $ed = $datos['ed'];
        $unCD = CD::modificarCD($ID, $tit, $inte, $ed);
        $newResponse = $response->withStatus(200);
        return $newResponse;

    }
}
?>