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
<h1 style="text-align: center;">Livros cadastrados</h1>
    <div id="principal">
        
        <table class="table table-ligth">
            
            <thead class="thead-dark th">
                <tr>
                <th scope="col">Identificador</th>
                <th scope="col">Titulo</th>
                <th scope="col">isbn</th>
                <th scope="col">Data de publicação</th>
                <th scope="col">Editora</th>
                <th scope="col" id="buttons"></th>
                </tr>
            </thead>
            <tbody id="corpoTabela">
                <?php foreach($livros as $l){ ?>
                    <tr>
                    <td><?=$l->getId()?></td>
                    <td><a href='index.php?classe=livro&metodo=showMoreInfo&id=<?=$l->getId()?>'><?=$l->getTitulo()?></a></td>
                    <td><?=$l->getIsbn()?> </td>
                    <td><?=$l->getDataPublicacao()?> </td>
                    <td><?=$l->getEditora()?> </td>
                    <td><button class="btn btn-danger" onclick="deletar(<?=$l->getId()?>)" id="<?=$l->getId()?>">Apagar</button> <a href="index.php?classe=Livro&metodo=showViewUpdate&id=<?=$l->getId()?>"><button class="btn btn-warning"  id="<?=$l->getId()?>">Atualizar</button></a></td>                                                                                                                                       
                    </tr>
               <?php }?>
            </tbody>
        </table>
        
    </div>
    <a href="index.php?classe=livro&metodo=showViewInsert"><button type="button" class="btn btn-outline-success">Cadastrar um livro</button></a>
    <a href="index.php"><button type="button" class="btn btn-outline-dark">Inicio</button></a>
    <script src="biblioteca/view/js/scriptLivro.js"></script>
</body>
</html>