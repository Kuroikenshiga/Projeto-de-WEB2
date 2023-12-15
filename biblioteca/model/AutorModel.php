<?php
require_once("biblioteca/model/Model.php");
    class AutorModel extends Model{

        public function __construct($c)
        {
            if(!$this->connectionIsOn()){
                $this->setConnection($c);
            }
        }
        public function insert($a){
            $q = "insert into autores(nome,biografia,contato) values(?,?,?) returning id_autor";
            $statement = $this->getConnection()->prepare($q);
            try{    
               
                $statement->bindValue(1,$a->getNome());
                $statement->bindValue(2,$a->getBiografia());
                $statement->bindValue(3,$a->getContato());
                $statement->execute();
            }catch(Exception $e){
                return false;
            }
            return $statement->fetch()["id_autor"];
        }
        
        public function selectAll(){
            require_once("biblioteca/valueObject/Autor.php");
            $q = "select*from autores";
            $autores = array();
            try{
                $stm = $this->getConnection()->prepare($q);
                $stm->execute();
                while($row = $stm->fetch()){
                    $a = new Autor($row["nome"],$row["biografia"],$row["contato"]);
                    $a->setId($row["id_autor"]);
                    $autores[] = $a;
                }
            }
            catch(Exception $e){
                return false;
            }
            return $autores;
        }
        public function lastRow(){
            $q = "select LASTVAL() from autores";
            try{
                $stmt = $this->getConnection()->prepare($q);
                $stmt->execute();
            }
            catch(Exception $e){
                return false;
            }
            return $stmt->fetch()["lastval"];
        }
        public function delete($id){
            $q = "delete from autores where id_autor = (?)";
            $stmt = $this->getConnection()->prepare($q);
            try{
                
                $stmt->bindValue(1,$id);
                $stmt->execute();
           }
            catch(Exception $e){
                echo $e->getMessage();
                return false;
           }
           return true;
    }
    public function update($a){
        
        $q = "update autores set nome=(?),biografia=(?),contato=(?) where id_autor = (?)";
        try{
            $stmt = $this->getConnection()->prepare($q);
            $stmt->bindValue(1,$a->getNome());
            $stmt->bindValue(2,$a->getBiografia());
            $stmt->bindValue(3,$a->getContato());
            $stmt->bindValue(4,$a->getId());
            $stmt->execute();
        }catch(Exception $e){
            return false;
        }
        return true;
    }
    public function selectById($id){
        require_once("biblioteca/valueObject/Autor.php");
        $q = "select * from autores where id_autor = (?)";

        $stmt = $this->getConnection()->prepare($q);
        try{
            $stmt->bindValue(1,$id);
            $stmt->execute();
        }catch(Exception $e){
            return false;
        }
        $row = $stmt->fetch();
        $autor = new Autor($row["nome"],$row["biografia"],$row["contato"],null);
        $autor->setId($row["id_autor"]);

        
        return $autor;
    }
    public function selectFilterAutorName($autor){
        
            require_once("biblioteca/valueObject/Autor.php");
            $q = "select * from autores where nome like (?)";
            $b = "%";
            $autores = array();
            try{
                $stmt = $this->getConnection()->prepare($q);
                $stmt->bindValue(1,$b.$autor.$b);
               // echo $stmt->$queryString;
                $stmt->execute();
                while($row = $stmt->fetch()){
                    $a = new Autor($row["nome"],$row["biografia"],$row["contato"]);
                    $a->setId($row["id_autor"]);
                    $autores[] = $a;
                }
            }
            catch(Exception $e){
                return false;
            }
            return $autores;
        
    }
    public function selectByWhere($array){   
        
        require_once("biblioteca/valueObject/Autor.php");
        $condicao = "";
        if(sizeof($array) > 0){
           
            $aux = $array[0];
            $condicao = "where id_autor != $aux ";

            for($i = 1; $i < sizeof($array);$i++){
                $aux = $array[$i];
                $condicao.="and id_autor != $aux ";
            }
            
            
            }
            $q = "select * from autores $condicao";
           
            $autores = array();
            try{
                $stmt = $this->getConnection()->prepare($q);
                
               // echo $stmt->$queryString;
                $stmt->execute();
                while($row = $stmt->fetch()){
                    $a = new Autor($row["nome"],$row["biografia"],$row["contato"]);
                    $a->setId($row["id_autor"]);
                    $autores[] = $a;
                }
            }
            catch(Exception $e){
                echo $e->getMessage();
                return false;
            }
            return $autores;
        
    
    }
    }
?>