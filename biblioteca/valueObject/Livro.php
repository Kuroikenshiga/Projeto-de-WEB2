<?php
    class Livro{
        private $id;
        private $titulo;
        private $autores;
        private $isbn;
        private $dataPublicacao;
        private $editora;
        private $sinopse;
        private $numeroPaginas;
        private $idioma;
        private $generos;

        public function __construct($titulo,$autor,$isbn,$dataPublicacao,$editora,$sinopse,$numeroPaginas,$idioma,$generos){
            $this->titulo = $titulo;
            $this->autores = $autor;
            $this->isbn = $isbn;
            $this->dataPublicacao = $dataPublicacao;
            $this->editora = $editora;
            $this->sinopse = $sinopse;
            $this->numeroPaginas = $numeroPaginas;
            $this->idioma = $idioma;
            $this->generos = $generos;
        }

        public function getId(){
            return $this->id;
        }
        public function setId($id){
            $this->id = $id;
        }

        public function getTitulo(){
            return $this->titulo;
        }
        public function setTitulo($titulo){
            $this->titulo = $titulo;
        }

        public function getAutores(){
            return $this->autores;
        }
        public function setAutores($autor){
            $this->autores = $autor;
        }
        
        public function getIsbn(){
            return $this->isbn;
        }
        public function setIsbn($isbn){
            $this->isbn = $isbn;
        }

        public function getDataPublicacao(){
            return $this->dataPublicacao;
        }
        public function setDatapublicacao($dataPublicacao){
            $this->dataPublicacao = $dataPublicacao;
        }

        public function getEditora(){
            return $this->editora;
        }
        public function setEditora($editora){
            $this->editora = $editora;
        }

        public function getNumeroPaginas(){
            return $this->numeroPaginas;
        }
        public function setNumeroPaginas($numeroPaginas){
            $this->numeroPaginas = $numeroPaginas;
        }

        public function getGeneros(){
            return $this->generos;
        }
        public function setGeneros($generos){
            $this->generos = $generos;
        }

        public function getSinopse(){
            return $this->sinopse;
        }
        public function setSinopse($s){
            $this->sinopse = $s;
        }

        public function getIdioma(){
            return $this->idioma;
        }
        public function setIdioma($i){
            $this->idioma = $i;
        }

        public function livroToJson(){
            $livroStdClass = new stdClass();
            
            $livroStdClass->id = $this->id;
            $livroStdClass->titulo = $this->titulo;
            $livroStdClass->autores =  $this->autores;
            $livroStdClass->isbn =  $this->isbn;
            $livroStdClass->dataPublicacao = $this->dataPublicacao;
            $livroStdClass->editora = $this->editora;
            $livroStdClass->sinopse =  $this->sinopse;
            $livroStdClass->numeroPaginas = $this->numeroPaginas;
            $livroStdClass->idioma = $this->idioma;
            $livroStdClass->generos =   $this->generos;
            
            return $livroStdClass;
        }
    }
?>