<?php
    class GeneroController{
        public function showViewInsert(){
            require_once("biblioteca/view/insertGeneroView.php");
        }
        public function insert(){
            $generoStdClass = json_decode(file_get_contents("php://input"));
            require_once("biblioteca/model/GeneroModel.php");
            require_once("biblioteca/valueObject/Genero.php");
            require_once("biblioteca/model/Model.php");
            $gm = new GeneroModel(Model::createConnection());
            $g = new Genero($generoStdClass->genero);

            if(!$gm->insert($g)){
                echo "Erro ao inserir o genero";
                die();
            }

            echo "Funcionou";

        }

        public function selectAll(){
            require_once("biblioteca/model/GeneroModel.php");
            require_once("biblioteca/model/Model.php");
            $gm = new GeneroModel(Model::createConnection());
            $generos = $gm->selectAll();
            //echo "????";
            require_once("biblioteca/view/listaGenerosView.php");
        }

        public function update(){
            $generoStdClass = json_decode(file_get_contents("php://input"));

            if($generoStdClass == null){
                echo "Dados não enviados";
                die();
            }
            
            require_once("biblioteca/model/GeneroModel.php");
            require_once("biblioteca/model/Model.php");
            require_once("biblioteca/valueObject/Genero.php");
            $g = new Genero($generoStdClass->genero);
            $g->setId($generoStdClass->id);
            $gm = new GeneroModel(Model::createConnection());

            if(!$gm->update($g)){
                echo "Não foi possível realizar as modificações";
                die();
            }
            
            echo "Funcionou";
            

        }

        public function showViewUpdate(){
            if(!isset($_GET["id"])){
                echo "Id não recebido";
                die();
            }
            $id = $_GET["id"];
            require_once("biblioteca/model/GeneroModel.php");
            require_once("biblioteca/model/Model.php");
            $gm = new GeneroModel(Model::createConnection());

            $g = $gm->selectById($id);
            if(!$g){
                echo "erro ao recuperar os dados";
                die();
            }
            require_once("biblioteca/view/updateGeneroView.php");
        }

        public function delete(){
            if(!isset($_POST["id"])){
                echo "Id não recebido";
                die();
            }
            $id = $_POST["id"];
            require_once("biblioteca/model/GeneroModel.php");
            require_once("biblioteca/model/Model.php");
            require_once("biblioteca/model/GeneroLiterarioModel.php");
            require_once("biblioteca/model/LivroGeneroModel.php");
            $gm = new GeneroModel(Model::createConnection());
            $glm = new GeneroLiterarioModel(Model::createConnection());
            $lgm = new LivroGeneroModel(Model::createConnection());

            $gm->getConnection()->beginTransaction();
            if(!$glm->deleteFromGenero($id)){
                echo "Não foi possivel excluir o genero(Autores)";
                $gm->getConnection()->rollBack();
                die();
            }
            if(!$lgm->deleteFromGenero($id)){
                echo "Não foi possivel excluir o genero(livros)";
                $gm->getConnection()->rollBack();
                die();
            }
            if(!$gm->delete($id)){
                echo "Não foi possivel excluir o genero";
                $gm->getConnection()->rollBack();
                die();
            }
            $gm->getConnection()->commit();
            $lista = array();
            $gs = $gm->selectAll();

            foreach($gs as $g){
                $lista[] = $g->generoToJson();
            }
            echo json_encode($lista);
        }
    }
?>