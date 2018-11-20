<?php

interface IApi {

    public static function AgregarUnCD( $request, $response, $args);
    public static function TraerTodos( $request, $response, $args);
    public static function TraerUnCd( $request, $response, $args);
    public static function BorrarUnCD( $request, $response, $args);
    public static function ModificarUnCD( $request, $response, $args);

}
?>