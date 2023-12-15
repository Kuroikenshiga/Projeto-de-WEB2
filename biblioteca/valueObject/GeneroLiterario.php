<?php

    class GeneroLiterario{
        private $autor;
        private $id;
        private $genero;
        public function __construct($genero,$autor, $id = null)
        {
            $this->autor = $autor;
            $this->id = $id;
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
        public function getAutor(){
            return $this->autor;
        }
        public function setAutor($a){
            $this->autor = $a;
        }
    }
?>