<?php 
    class Empleado{
        public $nombre;
        public $email;
        public $sexo;
        public $area;
        public $boletin;
        public $descripcion;
        public $roles;
        
        public function __construct($nombre, $email, $sexo, $area, $boletin, $descripcion, $roles)
        {
            $this->nombre = $nombre;
            $this->email = $email;
            $this->sexo = $sexo;
            $this->area = $area;
            $this->boletin = $boletin;
            $this->descripcion = $descripcion;
            $this->roles = $roles;
        }
    }
?>