<?php 
   
   

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="biblioteca/view/css/bootstrap.css">
    <link rel="stylesheet" href="biblioteca/view/css/viewAutor.css">
    <title>Document</title>
</head>
<body >

<!-- <h1><?=implode("|",$aux)?></h1> -->
<!-- <h1><?=$objLivro->getDataPublicacao()?></h1> -->
<div id="principal">
    <div id="formulario"> 
        <input type="hidden" id="id" value="<?=$objLivro->getId()?>">
        <h1>Atualizar informações de livros</h1>
        <div class="form-group">
            <label for="nome">Titulo</label>
            <input name="titulo" value="<?=$objLivro->getTitulo()?>" type="text" class="form-control" id="titulo" aria-describedby="nome" placeholder="informe o titulo do livro">
            
        </div> 
        
        <div id="searchAutor">
            <div id="selectGroup">
                <?php if(sizeof($listaDeAutores)>0){?>
                <?php for($i = 0;$i < sizeof($listaDeAutores);$i++){ $alredySelected = false; ?>
                    <select id="autorSelect1" onselect=" " class="form-select" aria-label="Default select example">
                        <option value='' >Selecione o autor do livro</option>
                        
                        <?php foreach($autores as $aut){?>
                            
                            <option <?php if(in_array($aut->getId(),$aux) && !in_array($aut->getId(),$aux3) && !$alredySelected){$alredySelected=true;$aux3[]=$aut->getId();echo "selected";} ?> value="<?=$aut->getId()?>"><?=$aut->getNome()?></option>

                        <?php }?>
                    </select>
                
                <?php }?>
                <?php } else{?>
                
                    <select id="autorSelect1" onselect=" " class="form-select" aria-label="Default select example">
                        <option value='' >Selecione o autor do livro</option>
                        <?php foreach($autores as $aut){?>
                            
                            <option <?php if(in_array($aut->getId(),$aux) && !in_array($aut->getId(),$aux3) && !$alredySelected){$alredySelected=true;$aux3[]=$aut->getId();echo "selected";} ?> value="<?=$aut->getId()?>"><?=$aut->getNome()?></option>

                        <?php }?>
                    </select>
                <?php }?>
            </div>
            
            
        </div>
        <button onclick="addSelect()" class="btn btn-primary"> 
                            <svg id="plus" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"/>
                            </svg>
        </button>
        <p>Não encontrou o autor? clique em adicionar autor</p>
                <button type="button" class="btn btn-info" onclick="showInsertAutorFromLivroView()">Adicionar autor</button>
             <!-- Inicio Formulário do autor -->
             <div id="principalAutor">
                <div id="formulario"> 
                <h1>Cadastro de autores</h1>
                <div class="form-group">
                    <label for="nome">Nome do autor</label>
                    <input name="nome" type="text" class="form-control" id="nome" aria-describedby="nome" placeholder="informe o nome do autor">
                    
                </div> 
                <div class="form-group">
                    <label for="email">Informe o e-mail de contato do autor</label>
                    <input type="email" class="form-control" id="contato" name="contato">   
                </div>
                <div class="form-group">
                    <label for="bio">Biografia</label><br>
                    <textarea name="bio" id="bio" cols="92" rows="10" ></textarea>
                </div>
                <h5>Selecione os generos literarios do autor</h5>
                <?php
                    foreach($generos as $g){
                ?>
                <div class="form-check">
                
                    <input class="form-check-input" type="checkbox" value="<?=$g->getId()?>" id="<?=$g->getGenero()?>" onclick="insertGeneros(this)">
                    <label class="form-check-label" for="<?=$g->getGenero()?>">
                        <?=$g->getGenero()?>
                    </label>
                </div>
                <?php }?>
                <button type="butoon" class="btn btn-primary" onclick="insertAutorFromLivroView()">Cadastrar</button>
                </div>
            </div>
            <!-- Fim Formulário do autor -->
        <div class="form-group">
            <label for="isbn">Isbn</label>
            <input name="isbn" value="<?=$objLivro->getIsbn()?>" type="text" class="form-control" id="isbn" aria-describedby="nome" placeholder="informe o isbn do livro">
            
        </div> 
        <div class="form-group">
            <label for="data">Data de publicação</label>
            <input name="data" value="<?=$objLivro->getDataPublicacao()?>" type="date" class="form-control" id="data" aria-describedby="nome" placeholder="informe a data de publicação do livro">
            
        </div> 
        <div class="form-group">
            <label for="nome">Editora</label>
            <input name="editora" value="<?=$objLivro->getEditora()?>" type="text" class="form-control" id="editora" aria-describedby="nome" placeholder="informe a editora do livro">
            
        </div> 
        <div class="form-group">
            <label for="numero">Insira o numero de paginas do livro</label>
            <input type="number" value="<?=$objLivro->getNumeroPaginas()?>" class="form-control" id="numero" name="numero">   
        </div>
        <div class="form-group">
            <label for="sinopse">Insira a sinopse do livro</label><br>
            <textarea value="" name="sinopse" id="sinopse" cols="92" rows="10" ><?=$objLivro->getSinopse()?></textarea>
        </div>
        <div class="form-group">
            <label for="idioma">Informe o idioma do livro</label>
            <input type="text" value="<?=$objLivro->getIdioma()?>" class="form-control" id="idioma" name="idioma">   
        </div>
        <h5>Selecione os generos literarios do livro</h5>
        <?php
            foreach($generos as $g){
        ?>
        <div class="form-check">
           
            <input class="form-check-input" type="checkbox" <?=(in_array($g->getId(),$aux2)?"checked=true":"")?> value="<?=$g->getId()?>" id="<?=$g->getGenero()?>" >
            <label class="form-check-label" for="<?=$g->getGenero()?>">
                <?=$g->getGenero()?>
            </label>
        </div>
        <?php }?>
        <button type="butoon" class="btn btn-primary" onclick="update()">Atualizar</button>
        </div>
    </div>
    <script src="biblioteca/view/js/scriptLivro.js"></script>
  
</body>
</html>