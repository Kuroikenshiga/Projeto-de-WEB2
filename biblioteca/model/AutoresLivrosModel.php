<?php
    require_once("biblioteca/model/Model.php");
    class AutoresLivrosModel extends Model{

        public function __construct($c)
        {
            if(!$this->connectionIsOn()){
                $this->setConnection($c);
            }
        }
        
        public function insert($obj){
            $q = "insert into autores_livros (id_autor_fk,id_livro_fk) values(?,?)";
            try{
                $stmt = $this->getConnection()->prepare($q);
                $stmt->bindValue(1,$obj->getAutor());
                $stmt->bindValue(2,$obj->getLivro());
                $stmt->execute();
            }
            catch(Exception $e){
                return false;
            }
            return true;
        }

        public function delete($id){
            $q = "delete from autores_livros where id_autores_livro = ?";

            try{
                $stmt = $this->getConnection()->prepare($q);
                $stmt->bindValue(1,$id);
                $stmt->execute();
            }
            catch(Exception $e){
                return false;
            }
            return true;
        }
        public function deleteFromAutor($id){
            $q = "delete from autores_livros where id_autor_fk = ?";

            try{
                $stmt = $this->getConnection()->prepare($q);
                $stmt->bindValue(1,$id);
                $stmt->execute();
            }
            catch(Exception $e){
                return false;
            }
            return true;
    }
    public function deleteFromLivro($id){
        $q = "delete from autores_livros where id_livro_fk = ?";

        try{
            $stmt = $this->getConnection()->prepare($q);
            $stmt->bindValue(1,$id);
            $stmt->execute();
        }
        catch(Exception $e){
            return false;
        }
        return true;
}

    public function selectAll(){
        require_once("biblioteca/valueObject/AutorLivro.php");
        $array = array();
        $q = "select*from autores_livros";
        $stmt = $this->getConnection()->prepare($q);
        
        try{
            $stmt->execute();

            while($row = $stmt->fetch()){
                $array[] = new AutorLivro(null,$row["id_autor_fk"],$row["id_livro_fk"]);
            }
        }catch(Exception $e){
            return false;
        }
        return $array;
    }
    public function selectById($id){
        require_once("biblioteca/valueObject/AutorLivro.php");
        $q = "selet*from autores_livros where id_autores_livro = ?";

        $stmt = $this->getConnection()->prepare($q);
        $obj;
        try{
            $stmt->bindValue(1,$id);
            $stmt->execute();
            $row = $stmt->fetch();
            $obj = new AutorLivro($row["id_autores_livro"],$row["id_autor_fk"],$row["id_livro_fk"]);

        }
        catch(Exception $e){
            return false;
        }
        return $obj;
    }
    public function update($obj){
        $q = "update autores_livros set id_autor_fk = ?,id_livro_fk = ? where id_autores_livro = ?";

        try{
            $stmt = $this->getConnection()->prepare($q);
            $stmt->bindValue(1,$obj->geAutor());
            $stmt->bindValue(2,$obj->getLivro());
            $stmt->bindValue(3,$obj->getId());

            $stmt->execute();
        }
        catch(Exception $e){
            return false;
        }
        return true;
    }
    public function selectByLivro($livro){
        require_once("biblioteca/valueObject/AutorLivro.php");

        $q = "select*from autores_livros where id_livro_fk = (?)";
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

            $l[] = new AutorLivro($row["id_autores_livro"],$row["id_autor_fk"],$row["id_livro_fk"]);

        }
        return $l;
    }
    public function selectByAutor($autor){
        require_once("biblioteca/valueObject/AutorLivro.php");

        $q = "select*from autores_livros where id_autor_fk = (?)";
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

            $l[] = new AutorLivro($row["id_autores_livro"],$row["id_autor_fk"],$row["id_livro_fk"]);

        }
        return $l;
    }
    }
?>