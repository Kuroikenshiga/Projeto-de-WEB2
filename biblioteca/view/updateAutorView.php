<?php 
    function checkValidation($lista,$g){
        for($i = 0;$i < sizeof($lista);$i++){
            if($g == $lista[$i]->getGenero()){
                return "checked='true'";
            }
        }
        
    }
?>
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
            <h1>Modificar dados do autor</h1>
            <div class="form-group">
                <label for="nome">Nome do autor</label>
                <input name="nome" value="<?=$autor->getNome()?>" type="text" class="form-control" id="nome" aria-describedby="nome" placeholder="informe o nome do autor">
                <input type="hidden" id="id" value="<?=$autor->getId()?>">
            </div> 
            <div class="form-group">
                <label for="contato">Informe o e-mail de contato do autor</label>
                <input type="email" value="<?=$autor->getContato()?>" class="form-control" id="contato" name="contato">   
            </div>
            <div class="form-group">
                <label for="bio">Biografia</label><br>
                <textarea name="bio" id="bio" cols="92" rows="10" value="" ><?=$autor->getBiografia()?></textarea>
            </div>
            <h5>Selecione os generos literarios do autor</h5>
            <?php
                foreach($listaGeneros as $g){
            ?>
            <div class="form-check">
                
                <input class="form-check-input" type="checkbox" <?=checkValidation($lista,$g->getId())?> value="<?=$g->getId()?>" id="<?=$g->getGenero()?>" >
                <label class="form-check-label" for="<?=$g->getGenero()?>">
                    <?=$g->getGenero()?>
                </label>
            </div>
            <?php }?>
            <button type="butoon" class="btn btn-primary" onclick="update()">Salvar modificações</button>
        </div>
    </div>
    <script src="biblioteca/view/js/scriptAutor.js"></script>
</body>
</html>