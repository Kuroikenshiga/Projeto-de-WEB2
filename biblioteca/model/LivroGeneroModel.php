<?php
    class LivroGeneroModel extends Model{
        
        public function __construct($c)
        {
            if(!$this->connectionIsOn()){
                $this->setConnection($c);
            }
        }
        public function insert($gl){

            $q = "insert into livro_generos(id_livro_fk,id_genero_fk) values(?,?)";
            try{
                $stmt = $this->getConnection()->prepare($q);
                $stmt->bindValue(1,$gl->getLivro());
                $stmt->bindValue(2,$gl->getGenero());
                $stmt->execute();
            }
            catch(Exception $e){
                echo $e->getMessage();
                return false;
                
            }
            return true;
        }
        public function selectAll(){
            
        }

        public function selectByLivro($livro){
            require_once("biblioteca/valueObject/LivroGenero.php");
            $q = "select*from livro_generos where id_livro_fk = (?)";
            $stmt = $this->getConnection()->prepare($q);
            try{
                $stmt->bindValue(1,$livro);
                $stmt->execute();
            }
            catch(Exception $e){
                return false;
            }
            $l = array();
            while($row = $stmt->fetch()){

                $l[] = new LivroGenero($row["id_genero_fk"],$row["id_livro_fk"],$row["id_genero_livro"]);

            }
            return $l;
        }

        public function delete($id){
            $q = "delete from livro_generos where id_genero_livro = (?)";
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
        public function deleteFromLivro($id){
            $q = "delete from livro_generos where id_livro_fk = (?)";
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
            $q = "delete from livro_generos where id_genero_fk = (?)";
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