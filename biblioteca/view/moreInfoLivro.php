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
        <h1><?=$livro->getTitulo()?></h1>
        <p><Span>Isbn:</Span> <?=$livro->getIsbn()?></p>
        <p><Span>Idioma:</Span> <?=$livro->getIdioma()?></p>
        <p><Span>Data de publicação:</Span> <?=date('d-m-y',strtotime($livro->getDataPublicacao()))?></p>
        <div id="lista">
            <h3>Generos do livro</h3>
            <ul class="list-group">
                <?php foreach($auxG as $g){ ?>
                <li class="list-group-item"><?=$g->getGenero()?></li>
                <?php }?>
            </ul>
        </div>
        
        <h3>Sinopse</h3>
        <div id="sinContainer"><div id="sinopseD"><br><p><?=$livro->getSinopse()?></p><br></div></div>
        
                    <h2>Autores</h2>
        <div id="tabela">
        <table class="table table-ligth">
            
            <thead class="thead-dark th">
                <tr>
                <th scope="col">Identificador</th>
                <th scope="col">Nome</th>
                <th scope="col">Contato</th>
               
                
                </tr>
            </thead>
            <tbody id="corpoTabela">
                <?php foreach($auxAutores as $a){ ?>
                    <tr>
                    <td><?=$a->getId()?></td>
                    <td><?=$a->getNome()?></td>
                    <td><?=$a->getContato()?> </td>
                    
                    </tr>
               <?php }?><br>
            </tbody>
        </table>
        </div>

       
    </div>
</body>
</html>