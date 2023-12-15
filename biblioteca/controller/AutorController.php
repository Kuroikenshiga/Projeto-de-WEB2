<?php


    class AutorController{

        public function showMoreInfo(){
            if(!isset($_GET["id"])){
                echo "Id não recebido";
                die();
            }
            $id = $_GET["id"];
            require_once("biblioteca/model/AutorModel.php");
            require_once("biblioteca/model/Model.php");
            require_once("biblioteca/model/GeneroLiterarioModel.php");
            require_once("biblioteca/model/GeneroModel.php");
            require_once("biblioteca/model/AutoresLivrosModel.php");
            require_once("biblioteca/model/LivroModel.php");
          

            $gm = new GeneroModel(Model::createConnection());
            $glm = new GeneroLiterarioModel(Model::createConnection());
            $am = new AutorModel(Model::createConnection());
            $alm = new AutoresLivrosModel(Model::createConnection());
            $lm = new LivroModel(Model::createConnection());

            $autor = $am->selectById($id);
            $generosIds = $glm->selectByAutor($id);
            $AutorLivros = $alm->selectByAutor($id);
            $auxG = array();
            $auxL = array();
            foreach($generosIds as $a){
                $auxG[] = $gm->selectById($a->getGenero());
            }
            foreach($AutorLivros as $l){
                $auxL[] = $lm->selectById($l->getLivro());
            }

            require_once("biblioteca/view/moreInfoAutor.php");
        }

        public function showViewInsert(){
            require_once("biblioteca/model/GeneroModel.php");
            require_once("biblioteca/model/Model.php");
            $gm = new GeneroModel(Model::createConnection());
            $listaGeneros = $gm->selectAll();
            require_once("biblioteca/view/insertAutorView.php");
        }
        public function showViewUpdate(){
            
            $id = $_GET["id"];
            require_once("biblioteca/model/Model.php");
            require_once("biblioteca/model/AutorModel.php");
            require_once("biblioteca/model/GeneroModel.php");
            require_once("biblioteca/model/GeneroLiterarioModel.php");
            $gm = new GeneroModel(Model::createConnection());
            $listaGeneros = $gm->selectAll();
            
            $am = new AutorModel(Model::createConnection());
            $autor = $am->selectById($id);
            $glm = new GeneroLiterarioModel(Model::createConnection());
            $lista = $glm->selectByAutor($id);
            
            require_once("biblioteca/view/updateAutorView.php");
        }

        public function update(){
            require_once("biblioteca/valueObject/Autor.php");
            require_once("biblioteca/model/AutorModel.php");
            require_once("biblioteca/model/Model.php");
            require_once("biblioteca/model/GeneroLiterarioModel.php");
            require_once("biblioteca/valueObject/GeneroLiterario.php");
            
            $autorStdClass = json_decode(file_get_contents("php://input"));

            $autor = new Autor($autorStdClass->nome,$autorStdClass->bio,$autorStdClass->contato,$autorStdClass->listaDeGeneros);
            $autor->setId($autorStdClass->id);
           

            $am = new AutorModel(Model::createConnection());
            $glm = new GeneroLiterarioModel(Model::createConnection());

            $am->getConnection()->beginTransaction();

            if(!$glm->deleteFromAutor($autor->getId())){
                $am->getConnection()->rollBack();
                echo "Não funcionou delete generos";
                die();
            }

            if(!$am->update($autor)){
                $am->getConnection()->rollBack();
                echo "Não funcionou autores";
                die();
            }
           
            foreach($autor->getListaDeGeneros() as $g){
                $gl = new GeneroLiterario($g,$autor->getId(),null);
                if(!$glm->insert($gl)){
                    $am->getConnection()->rollBack();
                    echo "Não funcionou insert generos";
                    die();
                }
            }

            $am->getConnection()->Commit();
            echo "index.php";
            

        }

        public function insert(){
            $a = json_decode(file_get_contents("php://input"));
            require_once("biblioteca/valueObject/Autor.php");
            require_once("biblioteca/model/AutorModel.php");
            require_once("biblioteca/model/Model.php");
            require_once("biblioteca/valueObject/GeneroLiterario.php");
            require_once("biblioteca/model/GeneroLiterarioModel.php");
            $glm = new GeneroLiterarioModel(Model::createConnection());
            $am = new AutorModel(Model::createConnection());
            
            $autor = new Autor($a->nome,$a->bio,$a->contato,$a->listaDeGeneros);
            $am->getConnection()->beginTransaction();
            //Model::modelBegin();
            $ultimoAutor = $am->insert($autor);
            if(!$ultimoAutor){
                echo("não funcionou");
                $am->getConnection()->rollBack();
                die();
                
            }
            foreach($autor->getListaDeGeneros() as $g){
                if(!($glm->insert(new GeneroLiterario($g,$ultimoAutor,null)))){
                    $am->getConnection()->rollBack();
                    echo("não funcionou");die();
                    //Model::modelRollback();
                    break;
                    
                }
                
            }
            echo "funcionou";
            $am->getConnection()->commit();
            //Model::modelCommit();
        }
        public function selectAll(){
            require_once("biblioteca/model/Model.php");
            require_once("biblioteca/model/AutorModel.php");
            
            $am = new AutorModel(Model::createConnection());
            $autores = $am->selectAll();
           
            require_once("biblioteca/view/listaAutorView.php");
        }
        public function delete(){
            $id = $_POST["id"];
            require_once("biblioteca/model/Model.php");
            require_once("biblioteca/model/GeneroLiterarioModel.php");
            require_once("biblioteca/model/AutorModel.php");
            require_once("biblioteca/model/AutoresLivrosModel.php");

            $alm = new AutoresLivrosModel(Model::createConnection());
            $am = new AutorModel(Model::createConnection());
            $glm = new GeneroLiterarioModel(Model::createConnection());
            $am->getConnection()->beginTransaction();
            if(!$glm->deleteFromAutor($id)){
                
               $am->getConnection()->rollBack();
                echo "Não funcionou genero";
                die();
                
                
            }
            $livrosDoAutor = $alm->selectByAutor($id);
            $permiteExcluir = true;
            foreach($livrosDoAutor as $l){
                
                if(count($alm->selectByLivro($l->getLivro())) == 1){
                    
                    $permiteExcluir = false;
                    break;
                    
                }
            }
          
            if(!$permiteExcluir){

                $am->getConnection()->rollBack();
                echo "Erro1";
                die();
            }
            if(!$alm->deleteFromAutor($id)){
                $am->getConnection()->rollBack();
                echo "Não foi possivel excluir autor";
                die();
            }
            if(!$am->delete($id)){
                $am->getConnection()->rollBack();
                echo "erro autor";
                die();

            }
            
            
            
            $am->getConnection()->commit();
            
             $autores = $am->selectAll();

             $autoresJson = array();
     
             foreach($autores as $a){
                 $autoresJson[] = $a->autorToJson();
             }
             echo json_encode($autoresJson);
        }
        public function selectFilter(){
            $nome = $_POST["nome"];
            require_once("biblioteca/model/AutorModel.php");
            require_once("biblioteca/model/Model.php");
            $am = new AutorModel(Model::createConnection());
            $autores = $am->selectFilterAutorName($nome);

            $listaDeAutores = array();

            foreach($autores as $a){
                $listaDeAutores[] = $a->autorToJson();
            }

            echo json_encode($listaDeAutores);
        }

        public function selectByWhere(){
            $array = json_decode(file_get_contents("php://input"));
            //$condicao = "";
           
            require_once("biblioteca/model/AutorModel.php");
            require_once("biblioteca/model/Model.php");
            $am = new AutorModel(Model::createConnection());
            $autores = $am->selectByWhere($array);

            $listaDeAutores = array();

            foreach($autores as $a){
                $listaDeAutores[] = $a->autorToJson();
            }
            echo json_encode($listaDeAutores);
        }
    }
    
?>