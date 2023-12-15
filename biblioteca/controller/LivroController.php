<?php 
    class LivroController{
        public function showViewInsert(){
            
            require_once("biblioteca/model/Model.php");
            require_once("biblioteca/model/GeneroModel.php");
            $gm = new GeneroModel(Model::createConnection());
            $listaGeneros = $gm->selectAll();
            require_once("biblioteca/view/insertLivroView.php");
        }
        public function insert(){
            require_once("biblioteca/model/AutoresLivrosModel.php");
            require_once("biblioteca/valueObject/AutorLivro.php");
            require_once("biblioteca/valueObject/GeneroLiterario.php");
            require_once("biblioteca/model/GeneroLiterarioModel.php");
            require_once("biblioteca/model/LivroGeneroModel.php");
            require_once("biblioteca/valueObject/LivroGenero.php");
            $livroStdClass = json_decode(file_get_contents("php://input"));
            require_once("biblioteca/valueObject/Livro.php");
            $livro = new Livro($livroStdClass->titulo,$livroStdClass->autores,$livroStdClass->isbn,$livroStdClass->data,$livroStdClass->editora,$livroStdClass->sinopse,$livroStdClass->numeroPags,$livroStdClass->idioma,$livroStdClass->generos);
            //echo implode($livroStdClass->autores);
            require_once("biblioteca/model/LivroModel.php");
            require_once("biblioteca/model/Model.php");
            $lm = new LivroModel(Model::createConnection());
            $lm->getConnection()->beginTransaction();

            $lastIdLivro = $lm->insert($livro);

            if(!$lastIdLivro){
                echo "Erro ao cadastrar livro";
                $lm->getConnection()->rollBack();
                die();
            }
            
            $alm = new AutoresLivrosModel(Model::createConnection());

            foreach($livro->getAutores() as $aut){
                if(!$alm->insert(new AutorLivro(null,$aut,$lastIdLivro))){
                    $lm->getConnection()->rollBack();
                    echo "erro no cadastro de autores do livro";
                    die();
                }
            }
            $lgm = new LivroGeneroModel(Model::createConnection());
            foreach($livro->getGeneros() as $g){
                if(!$lgm->insert(new LivroGenero($g,$lastIdLivro,null))){
                    $lm->getConnection()->rollBack();
                    echo "Erro ao cadastrar o genero do livro";
                    die();
                }
            }
            $lm->getConnection()->commit();
            echo "Funcionou";


            
        }
        public function selectAll(){
            require_once("biblioteca/model/LivroModel.php");
            require_once("biblioteca/model/Model.php");
            $lm = new LivroModel(Model::createConnection());
            $livros = $lm->selectAll();
            require_once("biblioteca/view/listaLivroView.php");
        }

        public function showViewUpdate(){
            $id = $_GET["id"];
            require_once("biblioteca/model/Model.php");
            require_once("biblioteca/model/LivroModel.php");
            require_once("biblioteca/model/LivroGeneroModel.php");
            require_once("biblioteca/model/AutoresLivrosModel.php");
            require_once("biblioteca/model/AutorModel.php");
            require_once("biblioteca/model/GeneroModel.php");

            $lm = new LivroModel(Model::createConnection());
            $lgm = new LivroGeneroModel(Model::createConnection());
            $alm = new AutoresLivrosModel(Model::createConnection());
            $am = new AutorModel(Model::createConnection());
            $gm = new GeneroModel(Model::createConnection());
            $filtros = array();

            $objLivro = $lm->selectById($id);
            $listaGeneros = $lgm->selectByLivro($id);
            $listaDeAutores = $alm->selectByLivro($id);
            $autores = $am->selectAll();
            $generos = $gm->selectAll();
            $aux = array();
            foreach($listaDeAutores as $l){$aux[] = $l->getAutor();}
            $aux2 = array();foreach($listaGeneros as $lg){$aux2[] = $lg->getGenero();} $aux3 = array();
            require_once("biblioteca/view/updateLivroView.php");
        }

        public function update(){
            $livroStdClass = json_decode(file_get_contents("php://input"));
            require_once("biblioteca/model/Model.php");
            require_once("biblioteca/model/LivroGeneroModel.php");
            require_once("biblioteca/model/LivroModel.php");
            require_once("biblioteca/model/AutoresLivrosModel.php");
            require_once("biblioteca/valueObject/Livro.php");
            require_once("biblioteca/valueObject/LivroGenero.php");
            require_once("biblioteca/valueObject/AutorLivro.php");

            $livro = new Livro($livroStdClass->titulo,$livroStdClass->autores,$livroStdClass->isbn,$livroStdClass->data,$livroStdClass->editora,$livroStdClass->sinopse,$livroStdClass->numeroPags,$livroStdClass->idioma,$livroStdClass->generos);
            $livro->setId($livroStdClass->id);

            $lm = new LivroModel(model::createConnection());
            $lgm = new LivroGeneroModel(Model::createConnection());
            $alm = new AutoresLivrosModel(Model::createConnection());

            $lm->getConnection()->beginTransaction();

            if(!$lm->update($livro)){
                $lm->getConnection()->rollBack();
                echo "erro em livro";
                die();
            }
            if(!$lgm->deleteFromLivro($livro->getId())){
                $lm->getConnection()->rollBack();
                echo "erro ao deletar o genero do livro";
                die();
            }
            foreach($livro->getGeneros() as $g){
                if(!$lgm->insert(new LivroGenero($g,$livro->getId(),null))){
                    $lm->getConnection()->rollBack();
                    echo "Erro ao cadastrar os generos do livro";
                    die();
                }
            }
            if(!$alm->deleteFromLivro($livro->getId())){
                $lm->getConnection()->rollBack();
                echo "Erro ao deletar a relação de autor e livro";
                die();
            }
            foreach($livro->getAutores() as $aut){
                if(!$alm->insert(new AutorLivro(null,$aut,$livro->getId()))){
                    $lm->getConnection()->rollBack();
                    echo "Erro ao ligar autor ao livro";
                    die();
                }
            }
            echo "Funcionou";
            $lm->getConnection()->commit();
        }

        public function delete(){
            $id = $_REQUEST["id"];
            require_once("biblioteca/model/Model.php");
            require_once("biblioteca/model/LivroGeneroModel.php");
            require_once("biblioteca/model/AutoresLivrosModel.php");
            require_once("biblioteca/model/LivroModel.php");

            $lm = new LivroModel(Model::createConnection());
            $alm = new AutoresLivrosModel(Model::createConnection());
            $lgm = new LivroGeneroModel(Model::createConnection());

            $lm->getConnection()->beginTransaction();

            if(!$lgm->deleteFromLivro($id)){
                echo "Erro ao deletar generos do livro";
                $lm->getConnection()->rollback();
                die();
            }
            if(!$alm->deleteFromLivro($id)){
                echo "Erro ao deletar relações entre autores e livros";
                $lm->getConnection()->rollback();
                die();
            }
            if(!$lm->delete($id)){
                echo "Erro ao deletar o livro";
                $lm->getConnection()->rollback();
                die();
            }
            
            $lm->getConnection()->commit();

            $aux = $lm->selectAll();
            $livrosStdClass = array();
            
            foreach($aux as $l){
                $livrosStdClass[] = $l->livroToJson();
            }

            echo json_encode($livrosStdClass);
        }

        public function showMoreInfo(){
            if(!isset($_GET["id"])){
                echo "Id não recebido";
                die();

            }
            $id = $_GET["id"];
            require_once("biblioteca/model/AutorModel.php");
            require_once("biblioteca/model/Model.php");
            require_once("biblioteca/model/LivroGeneroModel.php");
            require_once("biblioteca/model/GeneroModel.php");
            require_once("biblioteca/model/AutoresLivrosModel.php");
            require_once("biblioteca/model/LivroModel.php");
          

            $gm = new GeneroModel(Model::createConnection());
            $lgm = new LivroGeneroModel(Model::createConnection());
            $am = new AutorModel(Model::createConnection());
            $alm = new AutoresLivrosModel(Model::createConnection());
            $lm = new LivroModel(Model::createConnection());

            $livro = $lm->selectById($id);
            $autoresIds = $alm->selectByLivro($id);
            $generoIds = $lgm->selectByLivro($id);
            $auxAutores = array();
            $auxG = array();
            
            foreach($autoresIds as $a){
                $auxAutores[] = $am->selectById($a->getAutor());
            }
            foreach($generoIds as $g){
                $auxG[] = $gm->selectById($g->getGenero());
            }
            require_once("biblioteca/view/moreInfoLivro.php");
        }
    }

?>