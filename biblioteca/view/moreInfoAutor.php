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
    <div id="principalInfo">
        <h1><?=$autor->getNome()?></h1>
        <p><Span>Contato:</Span> <?=$autor->getContato()?></p>
        <div id="lista">
            <h3>Generos que o autor escreve</h3>
            <ul class="list-group">
                <?php foreach($auxG as $g){ ?>
                <li class="list-group-item"><?=$g->getGenero()?></li>
                <?php }?>
            </ul>
        </div>
        
        <h3>Biografia</h3>
        <br><p><?=$autor->getBiografia()?></p><br>

        <div id="tabela">
        <table class="table table-ligth">
            
            <thead class="thead-dark th">
                <tr>
                <th scope="col">Identificador</th>
                <th scope="col">Titulo</th>
                <th scope="col">isbn</th>
                <th scope="col">Data de publicação</th>
                <th scope="col">Editora</th>
                
                </tr>
            </thead>
            <tbody id="corpoTabela">
                <?php foreach($auxL as $l){ ?>
                    <tr>
                    <td><?=$l->getId()?></td>
                    <td><?=$l->getTitulo()?></td>
                    <td><?=$l->getIsbn()?> </td>
                    <td><?=$l->getDataPublicacao()?> </td>
                    <td><?=$l->getEditora()?> </td>
                    
                    </tr>
               <?php }?><br>
            </tbody>
        </table>
        </div>

       
    </div>
</body>
</html>