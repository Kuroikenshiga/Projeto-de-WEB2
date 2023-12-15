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
    <h1 style="text-align: center;">Autores cadastrados</h1>
    
    <div id="principal">
        
        <table class="table table-ligth">
            
            <thead class="thead-dark th">
                <tr>
                <th scope="col">Identificador</th>
                <th scope="col">Nome</th>
                <th scope="col">Contato</th>
                <th scope="col" id="buttons"></th>
                </tr>
            </thead>
            <tbody id="corpoTabela">
                <?php 
                    foreach($autores as $aut){
                ?>
                    <tr>
                    <td><?=$aut->getId()?></td>
                    <td><a href='index.php?classe=Autor&metodo=showMoreInfo&id=<?=$aut->getId()?>'><?=$aut->getNome()?></a></td>
                    <td><?=$aut->getContato()?> </td>
                    <td><button class="btn btn-danger" onclick="deletar(<?=$aut->getId()?>)" id="<?=$aut->getId()?>">Apagar</button> <a href="index.php?classe=Autor&metodo=showViewUpdate&id=<?=$aut->getId()?>"><button class="btn btn-warning"  id="<?=$aut->getId()?>">Atualizar</button></a></td>                                                                                                                                       
                    </tr>
               <?php 
                }?>
            </tbody>
        </table>
        
    </div>
    <a href="index.php?classe=autor&metodo=showViewInsert"><button type="button" class="btn btn-outline-success">Cadastrar um autor</button></a>
    <a href="index.php"><button type="button" class="btn btn-outline-dark">Inicio</button></a>
    <script src="biblioteca/view/js/scriptAutor.js"></script>
</body>
</html>