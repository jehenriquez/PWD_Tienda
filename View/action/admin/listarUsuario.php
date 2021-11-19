<?php
include_once("../../../config.php");

$data = data_submitted();
$controller = new UsuarioController();
$resp = $controller->buscar($data);
$formatResp = array();

//Se necesita formatear la respuesta a un json

foreach ($resp as $usuario) {
    $elem['idusuario'] = $usuario->getIdusuario();
    $elem['usnombre'] = $usuario->getUsnombre();
    $elem['uspass'] = $usuario->getUspass();
    $elem['usmail'] = $usuario->getUsmail();
    $elem['usdeshabilitado'] = $usuario->getUsdeshabilitado();
    array_push($formatResp, $elem);
}

echo json_encode($formatResp);
?>