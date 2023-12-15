<?php
    class Genero{
        private $id;
        private $genero;

        public function __construct($genero)
        {
            $this->genero = $genero;
        }

        public function getId(){
            return $this->id;
        }
        public function setId($id){
            $this->id = $id;
        }

        public function getGenero(){
            return $this->genero;
        }
        public function setGenero($g){
            $this->genero = $g;
        }
        public function generoToJson(){
            $g = new stdClass();
            $g->id = $this->id;
            $g->genero = $this->genero;
            return $g;
        }
    }
?>