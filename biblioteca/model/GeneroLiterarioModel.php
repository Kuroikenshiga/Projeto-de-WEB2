<?php
    class GeneroLiterarioModel extends Model{
        
        public function __construct($c)
        {
            if(!$this->connectionIsOn()){
                $this->setConnection($c);
            }
        }
        public function insert($gl){

            $q = "insert into genero_literario(id_genero_fk,id_autor_fk) values(?,?)";
            try{
                $stmt = $this->getConnection()->prepare($q);
                $stmt->bindValue(1,$gl->getGenero());
                $stmt->bindValue(2,$gl->getAutor());
                $stmt->execute();
            }
            catch(Exception $e){
                return false;
            }
            return true;
        }
        public function selectAll(){
            
        }

        public function selectByAutor($autor){
            $q = "select*from genero_literario where id_autor_fk = (?)";
            require_once("biblioteca/valueObject/GeneroLiterario.php");
            $stmt = $this->getConnection()->prepare($q);
            try{
                $stmt->bindValue(1,$autor);
                $stmt->execute();
            }
            catch(Exception $e){
                return false;
            }
            $l = array();
            while($row = $stmt->fetch()){
                $ggg = new GeneroLiterario($row["id_genero_fk"],$row["id_autor_fk"],$row["id_genero_literario"]);
                $l[] = $ggg;

            }
            return $l;
        }

        public function delete($id){
            $q = "delete from genero_literario where id_genero_literario = (?)";
            $stmt = $this->getConnection()->prepare($q);
            try{
                $stmt->bindValue(1,$id);
                $stmt->execute();
            }
            catch(Exception $e){
                return false;
            }
            return true;
        }
        public function deleteFromAutor($id){
            $q = "delete from genero_literario where id_autor_fk = (?)";
            $stmt = $this->getConnection()->prepare($q);
            try{
                $stmt->bindValue(1,$id);
                $stmt->execute();
            }
            catch(Exception $e){
                return false;
            }
            return true;
        }
        public function deleteFromGenero($id){
            $q = "delete from genero_literario where id_genero_fk = (?)";
            $stmt = $this->getConnection()->prepare($q);
            try{
                $stmt->bindValue(1,$id);
                $stmt->execute();
            }
            catch(Exception $e){
                return false;
            }
            return true;
        }
        public function update($gl){

        }
        public function selectById($id){

        }
    }
?>