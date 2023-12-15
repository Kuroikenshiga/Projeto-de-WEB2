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
<h1 style="text-align: center;">Generos cadastrados</h1>
    <div id="principal">
        
        <table class="table table-ligth">
            
            <thead class="thead-dark th">
                <tr>
                <th scope="col">Identificador</th>
                <th scope="col">Genero</th>
                <th scope="col" id="buttons"></th>
                </tr>
            </thead>
            <tbody id="corpoTabela">
                <?php foreach($generos as $g){ ?>
                    <tr>
                    <td><?=$g->getId()?></td>
                    <td><?=$g->getGenero()?></td>
                    
                    <td><button class="btn btn-danger" onclick="deletar(<?=$g->getId()?>)" id="<?=$g->getId()?>">Apagar</button> <a href="index.php?classe=genero&metodo=showViewUpdate&id=<?=$g->getId()?>"><button class="btn btn-warning"  id="<?=$g->getId()?>">Atualizar</button></a></td>                                                                                                                                       
                    </tr>
               <?php }?>
            </tbody>
        </table><br>
        

    </div>
    <a href="index.php?classe=genero&metodo=showViewInsert"><button type="button" class="btn btn-outline-success">Cadastrar um gênero</button></a>
    <a href="index.php"><button type="button" class="btn btn-outline-dark">Inicio</button></a>
    <script src="biblioteca/view/js/scriptGenero.js"></script>
</body>
</html>