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
    <h1>Biblioteca</h1>
    <div id="principal">
        <div id="buttonsP">

            <div id="esq">
                <a href="index.php?classe=autor&metodo=showViewInsert"><button type="button" class="btn btn-outline-success">Cadastrar um autor</button></a><br>
                <a href="index.php?classe=livro&metodo=showViewInsert"><button type="button" class="btn btn-outline-success">Cadastrar um livro</button></a><br>
                <a href="index.php?classe=genero&metodo=showViewInsert"><button type="button" class="btn btn-outline-success">Cadastrar um gênero</button></a>
            </div>

            <div id="dir">
                <a href="index.php?classe=autor&metodo=selectAll"><button type="button" class="btn btn-outline-info">Autores cadastrados</button></a><br>
                <a href="index.php?classe=livro&metodo=selectAll"><button type="button" class="btn btn-outline-info">Livros cadastrados</button></a><br>
                <a href="index.php?classe=genero&metodo=selectAll"><button type="button" class="btn btn-outline-info">Generos cadastrados</button></a>
            </div>
        
        
        
        
        
        
        </div>
    </div>
</body>
</html>