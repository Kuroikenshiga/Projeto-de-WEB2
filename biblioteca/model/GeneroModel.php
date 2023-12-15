<?php
    require_once("biblioteca/model/Model.php");
    class GeneroModel extends Model{

        public function __construct($c)
        {
            if(!$this->connectionIsOn()){
                $this->setConnection($c);
            }
        }

        public function insert($g){
            $q = "insert into generos(genero) values(?)";
            try{
                $stmt = $this->getConnection()->prepare($q);
                $stmt->bindValue(1,$g->getGenero());
                $stmt->execute();
            }
            catch(Exception $e){
                return false;
            }
            return true;
        }

        public function selectAll()
        {
            require_once("biblioteca/valueObject/Genero.php");
            $listaDeGeneros = array();
            $q = "select*from generos";
            try{
                $stmt = $this->getConnection()->prepare($q);
                $stmt->execute();

                while($row = $stmt->fetch()){
                    $g = new Genero($row["genero"]);
                    $g->setId($row["id_genero"]);
                    $listaDeGeneros[] = $g;
                }
                

            }
            catch(Exception $e){
                return false;
            }
            return $listaDeGeneros;
        }
        public function update($g){
            $q = "update generos set genero = ? where id_genero = ?";
            try{
                $stmt = $this->getConnection()->prepare($q);
                $stmt->bindValue(1,$g->getGenero());
                $stmt->bindValue(2,$g->getId());
                $stmt->execute();
            }
            catch(Exception $e){
                return false;
            }
            return true;
        }
        
        public function delete($id){
            $q = "delete from generos where id_genero = ?";
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
        public function selectById($id){
            require_once("biblioteca/valueObject/Genero.php");
            $q = "select*from generos where id_genero = ?";
            $stmt = $this->getConnection()->prepare($q);
            $g;
            try{
                $stmt->bindValue(1,$id);
                $stmt->execute();
            }
            catch(Exception $e){
                return false;
            }
            $row = $stmt->fetch();
            $g = new Genero($row["genero"]);
            $g->setId($row["id_genero"]);

            return $g;
             

        }
    }
    

?>