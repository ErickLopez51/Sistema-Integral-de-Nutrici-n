<?php

/*
 Clase para generar los get y set de los campos de usuario
 */
 class EntidadesUsuario
 {

    //TABLA USUARIO
    private $idUsuario;
    private $nombre;
    private $ap;
    private $am;
    private $direccion;
    private $telefono;
    private $correo;
    private $contrasena;
    private $tipoUsuario;
    private $estatusUser;

    //TABLA PACIENTE
    private $idPaciente;
    private $nombrep;
    private $app;
    private $amp;
    private $fechaNac;
    private $ocupacion;
    private $estatura;
    private $ciudad;
    private $correop;
    private $contrasenap;
    private $estatusPaciente;
    private $direccionp;
    private $telefonop;
    private $idUserNutriologo;
    
    
    //TABLA USUARIO
    public function getIdUsuario(){
        return $this->idUsuario;
    }

    public function setIdUsuario($idUsuario){
        $this->idUsuario = $idUsuario;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function setNombre($nombre){
        $this->nombre = $nombre;
    }

    public function getAp(){
        return $this->ap;
    }

    public function setAp($ap){
        $this->ap = $ap;
    }

    public function getAm(){
        return $this->am;
    }

    public function setAm($am){
        $this->am = $am;
    }

    public function getDireccion(){
        return $this->direccion;
    }

    public function setDireccion($direccion){
        $this->direccion = $direccion;
    }

    public function getTelefono(){
        return $this->telefono;
    }

    public function setTelefono($telefono){
        $this->telefono = $telefono;
    }

    public function getCorreo(){
        return $this->correo;
    }

    public function setCorreo($correo){
        $this->correo = $correo;
    }

    public function getContrasena(){
        return $this->contrasena;
    }

    public function setContrasena($contrasena){
        $this->contrasena = $contrasena;
    }

    public function getTipoUusario(){
        return $this->tipoUsuario;
    }

    public function setTipoUsuario($tipoUsuario){
        $this->tipoUsuario = $tipoUsuario;
    }

    public function getEstatusUser(){
        return $this->estatusUser;
    }

    public function setEstatusUser($estatusUser){
        $this->estatusUser = $estatusUser;
    }

    //TABLA PACIENTE

    public function getIdPaciente(){
        return $this->idPaciente;
    }

    public function setIdPaciente($idPaciente){
        $this->idPaciente = $idPaciente;
    }

    public function getNombrep(){
        return $this->nombrep;
    }

    public function setNombrep($nombrep){
        $this->nombrep = $nombrep;
    }

    public function getApp(){
        return $this->app;
    }

    public function setApp($app){
        $this->app = $app;
    }

    public function getAmp(){
        return $this->amp;
    }

    public function setAmp($amp){
        $this->amp = $amp;
    }

    public function getFechaNac(){
        return $this->fechaNac;
    }

    public function setFechaNac($fechaNac){
        $this->fechaNac = $fechaNac;
    }

    public function getOcupacion(){
        return $this->ocupacion;
    }

    public function setOcupacion($ocupacion){
        $this->ocupacion = $ocupacion;
    }

    public function getEstatura(){
        return $this->estatura;
    }

    public function setEstatura($estatura){
        $this->estatura = $estatura;
    }

    public function getCiudad(){
        return $this->ciudad;
    }

    public function setCiudad($ciudad){
        $this->ciudad = $ciudad;
    }

    public function getCorreop(){
        return $this->correop;
    }

    public function setCorreop($correop){
        $this->correop = $correop;
    }

    public function getContrasenap(){
        return $this->contrasenap;
    }

    public function setContrasenap($contrasenap){
        $this->contrasenap = $contrasenap;
    }

    public function getEstatusPaciente(){
        return $this->estatusPaciente;
    }

    public function setEstatusPaciente($estatusPaciente){
        $this->estatusPaciente = $estatusPaciente;
    }

    public function getDireccionp(){
        return $this->direccionp;
    }

    public function setDireccionp($direccionp){
        $this->direccionp = $direccionp;
    }

    public function getTelefonop(){
        return $this->telefonop;
    }

    public function setTelefonop($telefonop){
        $this->telefonop = $telefonop;
    }

    public function getIdUserNutriologo(){
        return $this->idUserNutriologo;
    }

    public function setIdUserNutriologo($idUserNutriologo){
        $this->idUserNutriologo = $idUserNutriologo;
    }
}
?>