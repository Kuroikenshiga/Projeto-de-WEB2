<?php

    class AutorLivro{
        private $id;
        private $autor;
        private $livro;

        public function __construct($id,$autor,$livro)
        {
            $this->id = $id;
            $this->autor = $autor;
            $this->livro = $livro;    
        }

        public function getId(){
            return $this->id;
            }
        public function setId($id){
            $this->id = $id;
            }
            
        public function getAutor(){
            return $this->autor;
            }
        public function setAutor($autor){
            $this->autor = $autor;
            }
            
        public function getLivro(){
            return $this->livro;
            }
        public function setLivro($livro){
            $this->livro = $livro;
            }
    }
?>