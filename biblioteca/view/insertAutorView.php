<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="biblioteca/view/css/bootstrap.css">
    <link rel="stylesheet" href="biblioteca/view/css/viewAutor.css">
</head>
<body>
    <div id="principal">
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
        <button type="butoon" class="btn btn-primary" onclick="insert()">Cadastrar</button>
        </div>
    </div>
    <script src="biblioteca/view/js/scriptAutor.js"></script>
</body>
</html>