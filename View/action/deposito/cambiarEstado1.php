<?php
include_once("../../../config.php");
$datos = data_submitted();

$retorno = array();

if (isset($datos['idcompraestado']) && isset($datos['idcompra']) && isset($datos['idcompraestadotipo']) && isset($datos['cefechaini']) && isset($datos['cefechafin'])) {
    $controller = new CompraEstadoController();
    if ($datos['idcompraestadotipo'] != 4) {
        $datos['idcompraestadotipo'] = $datos['idcompraestadotipo'] + 1;
    } else {
        $datos['idcompraestadotipo'] = 1;
    }
    $resp = $controller->modificacion($datos);
    $retorno['errorMsg'] = $datos['idcompraestado'];
} else {
    $resp = false;
    $retorno['errorMsg'] = "No se pudo MODIFICAR el estado.";
}
$retorno = $resp;
echo json_encode($retorno);
