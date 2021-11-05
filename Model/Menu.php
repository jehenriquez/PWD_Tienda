<?php
class Menu{
    private $idmenu;
    private $menombre;
    private $medescripcion;
    private $idpadre;
    private $medeshabilitado;
    private $mensajeoperacion;

    public function __construct(){
        $this->idmenu="";
        $this->menombre="";
        $this->medescripcion="";
        $this->idpadre=null;
        $this->medeshabilitado=null;
        $this->mensajeoperacion="";
    }
    public function getIdmenu(){
        return $this->idmenu;
    }
    public function setIdmenu($valor){
        $this->idmenu = $valor;
    }
    public function getMenombre(){
        return $this->menombre;
    }
    public function setMenombre($valor){
        $this->menombre = $valor;
    }
    public function getMedescripcion(){
        return $this->medescripcion;
    }
    public function setMedescripcion($valor){
        $this->medescripcion = $valor;
    }
    public function getIdpadre(){
        return $this->idpadre;
    }
    public function setIdpadre($valor){
        $this->idpadre = $valor;
    }
    public function getMedeshabilitado(){
        return $this->medeshabilitado;
    }
    public function setMedeshabilitado($valor){
        $this->medeshabilitado = $valor;
    }    
    public function getMensajeoperacion(){
        return $this->mensajeoperacion;
    }
    public function setMensajeoperacion($mensajeoperacion){
        $this->mensajeoperacion = $mensajeoperacion;
    }

    public function setear($idmenu, $menombre, $medescripcion, $idpadre, $medeshabilitado){
        $this->setIdmenu($idmenu);
        $this->setMenombre($menombre);
        $this->setMedescripcion($medescripcion);
        $this->setIdpadre($idpadre);
        $this->setMedeshabilitado($medeshabilitado);
    }    
    
    public function cargar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="SELECT * FROM menu WHERE idmenu = ".$this->getIdmenu();
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if($res>-1){
                if($res>0){
                    $row = $base->Registro();
                    $this->setear($row['idmenu'], $row['menombre'], $row['medescripcion'], $row['idpadre'], $row['medeshabilitado'] );
                    
                }
            }
        } else {
            $this->setmensajeoperacion("Menu->listar: ".$base->getError());
        }
        return $resp;
        
        
    }
    
    public function insertar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="INSERT INTO menu(menombre, medescripcion, idpadre, medeshabilitado)  VALUES(".$this->getMenombre()."," . $this->getMedescripcion() . "," . $this->getIdpadre() . "," . $this->getMedeshabilitado() . ");";
        
        if ($base->Iniciar()) {
            if ($elid = $base->Ejecutar($sql)) {
                $this->setIdmenu($elid);
                $resp = true;
            } else {
                $this->setmensajeoperacion("Menu->insertar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("Menu->insertar: ".$base->getError());
        }
        return $resp;
    }
    
    public function modificar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="UPDATE menu SET menombre='{$this->getMenombre()}', medescripcion = '{$this->getMedescripcion()}',idpadre='{$this->getIdpadre()}', medeshabilitado = '{$this->getMedeshabilitado()}' WHERE idmenu=".$this->getIdmenu();

        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
                
            } else {
                $this->setmensajeoperacion("Menu->modificar 1: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("Menu->modificar 2: ".$base->getError());
        }
        return $resp;
    }
    
    public function eliminar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="DELETE FROM menu WHERE idmenu =".$this->getIdmenu();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion("Menu->eliminar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("Menu->eliminar: ".$base->getError());
        }
        return $resp;
    }
    
    public  function listar($parametro=""){
        $arreglo = array();
        $base=new BaseDatos();
        $sql="SELECT * FROM menu ";
        if ($parametro!="") {
            $sql.='WHERE '.$parametro;
        }
        $res = $base->Ejecutar($sql);
        if($res>-1){
            if($res>0){
                
                while ($row = $base->Registro()){
                    $obj= new Rol();
                    $obj->setear($row['idmenu'], $row['menombre'], $row['medescripcion'], $row['idpadre'], $row['medeshabilitado']);
                    array_push($arreglo, $obj);
                }
                
            }
            
        } else {
            // $this->setmensajeoperacion("Tabla->listar: ".$base->getError());
        }
        
        return $arreglo;
    }
    
    
    
}

?>