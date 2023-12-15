<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="biblioteca/view/css/bootstrap.css">
    <link rel="stylesheet" href="biblioteca/view/css/viewAutor.css">
    <title>Document</title>
</head>
<body onload="searchAndFilterAutor()">
<div id="principal">
        <div id="formulario"> 
        <h1>Cadastro de livros</h1>
        <div class="form-group">
            <label for="nome">Titulo</label>
            <input name="titulo" type="text" class="form-control" id="titulo" aria-describedby="nome" placeholder="informe o titulo do livro">
            
        </div> 
        
        <div id="searchAutor">
            <div id="selectGroup">
                <select id="autorSelect1" onselect=" " class="form-select" aria-label="Default select example">
                    <option value='' selected>Selecione o autor do livro</option>
                    
                </select>
                
                
                
            </div>
           
            <button onclick="addSelect()" class="btn btn-primary"> 
                    <svg id="plus" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"/>
                    </svg>
                </button>
           <p>Não encontrou o autor? clique em adicionar autor</p>
                <button type="button" class="btn btn-info" onclick="showInsertAutorFromLivroView()">Adicionar autor</button>
        </div>
        
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
                    foreach($listaGeneros as $g){
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
            <input name="isbn" type="text" class="form-control" id="isbn" aria-describedby="nome" placeholder="informe o isbn do livro">
            
        </div> 
        <div class="form-group">
            <label for="data">Data de publicação</label>
            <input name="data" type="date" class="form-control" id="data" aria-describedby="nome" placeholder="informe a data de publicação do livro">
            
        </div> 
        <div class="form-group">
            <label for="nome">Editora</label>
            <input name="editora" type="text" class="form-control" id="editora" aria-describedby="nome" placeholder="informe a editora do livro">
            
        </div> 
        <div class="form-group">
            <label for="numero">Insira o numero de paginas do livro</label>
            <input type="number" class="form-control" id="numero" name="numero">   
        </div>
        <div class="form-group">
            <label for="sinopse">Insira a sinopse do livro</label><br>
            <textarea name="sinopse" id="sinopse" cols="92" rows="10" ></textarea>
        </div>
        <div class="form-group">
            <label for="idioma">Informe o idioma do livro</label>
            <input type="text" class="form-control" id="idioma" name="idioma">   
        </div>
        <h5>Selecione os generos literarios do livro</h5>
        <?php
            foreach($listaGeneros as $g){
        ?>
        <div class="form-check">
           
            <input class="form-check-input" type="checkbox" value="<?=$g->getId()?>" id="<?=$g->getGenero()?>" onclick="insertGeneros(this)">
            <label class="form-check-label" for="<?=$g->getGenero()?>">
                <?=$g->getGenero()?>
            </label>
        </div>
        <?php }?>
        <button type="butoon" class="btn btn-primary" onclick="insert()">Cadastrar</button>
        </div>
    </div>
    <script src="biblioteca/view/js/scriptLivro.js"></script>
</body>
</html>