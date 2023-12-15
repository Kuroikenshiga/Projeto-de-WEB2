<?php

    class LivroGenero{
        private $livro;
        private $id;
        private $genero;
        public function __construct($genero,$livro, $id = null)
        {
            $this->livro = $livro;
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
        public function getLivro(){
            return $this->livro;
        }
        public function setLivro($a){
            $this->livro = $a;
        }
    }
?>