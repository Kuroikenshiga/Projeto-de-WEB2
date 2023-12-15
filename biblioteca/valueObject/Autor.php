<?php
    class Autor{
        private $id;
        private $nome;
        private $biografia;
        private $contato;
        private $listaDeGeneros = array();
        
        public function __construct($nome,$biografia,$contato,$listaDeGeneros = null)
        {
            
            $this->nome = $nome;
            $this->biografia = $biografia;
            $this->contato = $contato;
            $this->listaDeGeneros = $listaDeGeneros;
        }
        public function getId(){
            return $this->id;
        }
        public function setId($id){
            $this->id = $id;
        }
        public function getnome(){
            return $this->nome;
        }
        public function setNome($nome){
            $this->nome = $nome;
        }

        public function getBiografia(){
            return $this->biografia;
        }
        public function setBiografia($biografia){
            $this->biografia = $biografia;
        }

        public function getContato(){
            return $this->contato;
        }
        public function setContato($contato){
            $this->contato = $contato;
        }
        public function getListaDeGeneros(){
            return $this->listaDeGeneros;
        }
        public function setListaDeGeneros($l){
            $this->listaDeGeneros = $l;
        }
        public function  autorToJson(){
            $autor = new stdClass();
            $autor->id = $this->id;
            $autor->nome = $this->nome;
            $autor->biografia = $this->biografia;
            $autor->contato = $this->contato;
            $autor->getListaDeGeneros = $this->listaDeGeneros;
            return $autor;
        }

    }
?>