<?php
require_once("biblioteca/model/Model.php");
    class LivroModel extends Model{
        public function __construct($c)
        {
            if(!$this->connectionIsOn()){
                $this->setConnection($c);
            }
        }
        public function insert($obj){
            $q = "insert into livros (titulo,isbn,data_publicacao,editora,sinopse,numero_paginas,idioma) values (?,?,?,?,?,?,?) returning id_livro";
            try{
                $stmt = $this->getConnection()->prepare($q);
                $stmt->bindValue(1,$obj->getTitulo());
                $stmt->bindValue(2,$obj->getIsbn());
                $stmt->bindValue(3,$obj->getDataPublicacao());
                $stmt->bindValue(4,$obj->getEditora());
                $stmt->bindValue(5,$obj->getSinopse());
                $stmt->bindValue(6,$obj->getNumeroPaginas());
                $stmt->bindValue(7,$obj->getIdioma());
                $stmt->execute();
            }
            catch(Exception $e){
                
                return false;
            }
            return $stmt->fetch()["id_livro"];
        }
        
        public function delete($id){
            $q = "delete from livros where id_livro = ?";

            try{
                $stmt = $this->getConnection()->prepare($q);
                $stmt->bindValue(1,$id);
                $stmt->execute();
            }
            catch(Exception $e){
                echo $e->getMessage();
                return false;
            }
            return true;
        }
        public function selectAll(){
            require_once("biblioteca/valueObject/Livro.php");
            $q = "select*from livros";
            $stmt = $this->getConnection()->prepare($q);
            $livros = array();
            try{
                $stmt->execute();
                while($row = $stmt->fetch()){
                    $l = new Livro($row["titulo"],null,$row["isbn"],Date("d-m-y",strtotime($row["data_publicacao"])),$row["editora"],$row["sinopse"],$row["numero_paginas"],$row["idioma"],null);
                    $l->setId($row["id_livro"]);
                    $livros[] = $l;
                }
            }
            catch(Exception $e){
                return false;
            }

           
                
            return $livros;


        }
        public function lastRow(){
            $q = "select LASTVAL() from livros";
            try{
                $stmt = $this->getConnection()->prepare($q);
                $stmt->execute();
            }
            catch(Exception $e){
                return false;
            }
            return $stmt->fetch()["lastval"];
        }

        public function update($obj){
            $q = "update livros set titulo=?,isbn=?,data_publicacao=?,editora=?,sinopse=?,numero_paginas=?,idioma=? where id_livro=?";

            try{
                $stmt = $this->getConnection()->prepare($q);
                $stmt->bindValue(1,$obj->getTitulo());
                $stmt->bindValue(2,$obj->getIsbn());
                $stmt->bindValue(3,$obj->getDataPublicacao());
                $stmt->bindValue(4,$obj->getEditora());
                $stmt->bindValue(5,$obj->getSinopse());
                $stmt->bindValue(6,$obj->getNumeroPaginas());
                $stmt->bindValue(7,$obj->getIdioma());
                $stmt->bindValue(8,$obj->getId());
                $stmt->execute();
                
            }
            catch(Exception $e){
                echo $e->getMessage();
                return false;
            }
            return true;
            
        }
        public function selectById($id){
            require_once("biblioteca/valueObject/Livro.php");
            $q = "select * from livros where id_livro = ?";
            $stmt = $this->getConnection()->prepare($q);

            try{
                $stmt->bindValue(1,$id);
                $stmt->execute();
            }
            catch(Exception $e){
                return false;
            }
            $row = $stmt->fetch();

            $l = new Livro($row["titulo"],null,$row["isbn"],$row["data_publicacao"],$row["editora"],$row["sinopse"],$row["numero_paginas"],$row["idioma"],null);
            $l->setId($row["id_livro"]);
            return $l;

        }
    }
?>