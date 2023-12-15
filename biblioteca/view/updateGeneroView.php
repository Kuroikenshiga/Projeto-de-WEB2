<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="biblioteca/view/css/bootstrap.css">
    <link rel="stylesheet" href="biblioteca/view/css/viewAutor.css">
</head>
<body>
<div id="principal">
    <div class="form-group">
            <input type="hidden" name="" id="id" value="<?=$g->getId()?>">
            <label for="genero">Gênero</label>
            <input name="genero" type="text" value="<?=$g->getGenero()?>" class="form-control" id="genero" aria-describedby="nome" placeholder="insira o novo gênero">
            <button type="butoon" class="btn btn-primary" onclick="update()">Atualizar</button>
        </div> 
    </div>
    <script src="biblioteca/view/js/scriptGenero.js"></script>
</body>
</html>