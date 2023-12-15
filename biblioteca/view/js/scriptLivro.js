var lastSelectAdd = 1;

function insert(){
    document.querySelector("#principalAutor").style.display = "none";
    let livro = new Object();
    livro.titulo = document.querySelector("#titulo").value;
    livro.isbn = document.querySelector("#isbn").value;
    livro.data = document.querySelector("#data").value;
    livro.autores = new Array();
    livro.editora = document.querySelector("#editora").value;
    livro.numeroPags = document.querySelector("#numero").value;
    livro.sinopse = document.querySelector("#sinopse").value;
    livro.idioma = document.querySelector("#idioma").value;
    livro.generos = new Array();

    let aux = document.querySelectorAll(".form-check-input");

    for(let i = 0;i < aux.length;i++){
        if(aux[i].checked == true){
            livro.generos.push(aux[i].value);
        }
    }

    let auxAutores = document.querySelectorAll(".form-select");
    
        for(let i = 0;i < auxAutores.length;i++){
            if(auxAutores[i].value != ""){
                livro.autores.push(auxAutores[i].value);
            }
        }
    livro.generos = [...new Set(livro.generos)];
    livro.autores = [...new Set(livro.autores)];
        
        
    livroJson = JSON.stringify(livro);

    let xml = new XMLHttpRequest();
    xml.open("POST","index.php?classe=livro&metodo=insert",true);
    xml.setRequestHeader("content-type","application/json");

    xml.onreadystatechange = function(){
        
        if(xml.readyState == 4 && xml.status == 200){
            if(xml.responseText == "Funcionou"){
                window.location.href = "index.php?classe=Livro&metodo=selectAll"
            }
            else{
                alert("Erro ao cadastrar o livro")
            }
        }
    }
    xml.send(livroJson);
}

function showInsertAutorFromLivroView(){
    document.querySelector("#bio").value = "";
    document.querySelector("#contato").value = "";
    document.querySelector("#nome").value = "";
    let gen = document.querySelectorAll(".form-check-input");
   for(let i = 0;i < gen.length;i++){

        if(gen[i].checked == true){
           gen[i].checked = false;
        }
   }
    document.querySelector("#principalAutor").style.display = "block";
}
function insertAutorFromLivroView(){
    let generosLiterarios = new Array();
    let autor = new Object();
    let gen = document.querySelectorAll(".form-check-input");
   for(let i = 0;i < gen.length;i++){

        if(gen[i].checked == true){
            generosLiterarios.push(gen[i].value);
        }
   }
    autor.nome = document.querySelector("#nome").value;
    autor.contato = document.querySelector("#contato").value;
    autor.bio = document.querySelector("#bio").value;
    autor.listaDeGeneros = generosLiterarios;

    let autoJson = JSON.stringify(autor);
    let xml = new XMLHttpRequest();
    xml.open("POST","index.php?classe=Autor&metodo=insert",true);
    
    xml.setRequestHeader("content-type","application/json");

    xml.onreadystatechange = function(){
        if(xml.status == 200 && xml.readyState == 4){
            
            alert(xml.responseText);
            document.querySelector("#principalAutor").style.display = "none";
            searchAndFilterAutor();
            
        }
    }
    xml.send(autoJson);
    
}

function update(){
    document.querySelector("#principalAutor").style.display = "none";
    let livro = new Object();
    livro.id = document.querySelector("#id").value;
    livro.titulo = document.querySelector("#titulo").value;
    livro.isbn = document.querySelector("#isbn").value;
    livro.data = document.querySelector("#data").value;
    livro.autores = new Array();
    livro.editora = document.querySelector("#editora").value;
    livro.numeroPags = document.querySelector("#numero").value;
    livro.sinopse = document.querySelector("#sinopse").value;
    livro.idioma = document.querySelector("#idioma").value;
    livro.generos = new Array();

    let aux = document.querySelectorAll(".form-check-input");

    for(let i = 0;i < aux.length;i++){
        if(aux[i].checked == true){
            livro.generos.push(aux[i].value);
        }
    }
    livro.generos = [...new Set(livro.generos)];
    let auxAutores = document.querySelectorAll(".form-select");
    
        for(let i = 0;i < auxAutores.length;i++){
            if(auxAutores[i].value != ""){
                livro.autores.push(auxAutores[i].value);
            }
        }

    livro.autores = [...new Set(livro.autores)];
        
        
    livroJson = JSON.stringify(livro);

    let xml = new XMLHttpRequest();
    xml.open("POST","index.php?classe=livro&metodo=update",true);
    xml.setRequestHeader("content-type","application/json");

    xml.onreadystatechange = function(){
        
        if(xml.readyState == 4 && xml.status == 200){
            if(xml.responseText == "Funcionou"){
                window.location.href = "index.php?classe=Livro&metodo=selectAll"
            }
            else{
                alert("Erro ao atualizar o livro")
            }
        }
    }
    xml.send(livroJson);
}
function deletar(id){
    let tbBody = document.querySelector("#corpoTabela");
    let xml = new XMLHttpRequest();

    xml.open("POST","index.php?classe=Livro&metodo=delete",true);

    xml.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    
    xml.onreadystatechange = function (){
        if(xml.readyState == 4 && xml.status == 200){
           // alert(xml.responseText)
            tbBody.innerHTML = "";
            let livros = JSON.parse(xml.responseText);
            for(let i = 0;i < livros.length;i++){
                tbBody.innerHTML += "<tr><td>"+livros[i].id+"</td><td><a href='index.php?classe=livro&metodo=showMoreInfo&id="+livros[i].id+"'>"+livros[i].titulo+"</a></td><td>"+livros[i].isbn+"</td><td>"+livros[i].dataPublicacao+"</td><td>"+livros[i].editora+"</td><td><button class='btn btn-danger' onclick='deletar("+livros[i].id+")' id='"+livros[i].id+"'>Apagar</button> <a href='index.php?classe=Livro&metodo=showViewUpdate&id="+livros[i].id+"'><button class='btn btn-warning'  id='"+livros[i].id+"'>Atualizar</button></a></td></tr>";
            }
        }
    }
    xml.send("id="+id);
}
function searchAndFilterAutor(){
    let id = "autorSelect"+lastSelectAdd;
    
    let select = document.getElementById(id);
    let selects = document.querySelectorAll(".form-select");
    let array = new Array();
    
    for(let i = 0;i < selects.length;i++){
        if(selects[i].value != ""){
            array.push(selects[i].value);
        }
    }

    let xml = new XMLHttpRequest();
    xml.open("POST","index.php?classe=Autor&metodo=selectByWhere",true);
    xml.setRequestHeader("Content-type","application/json");
    let aux;
    xml.onreadystatechange = function(){
        
        if(xml.status == 200 && xml.readyState == 4){
            
            
            let listaJson = xml.responseText;
            let lista = JSON.parse(listaJson);
            select.innerHTML = "<option selected value=''>Escolha o autor</option>"
            
            for(let i = 0;i < lista.length;i++){
                aux += " <option value='"+lista[i].id+"'>"+lista[i].nome+"</option>"
            }
            select.innerHTML += aux;
        }   
    }
    xml.send(JSON.stringify(array));
}

function addSelect(){
   let aux = "#autorSelect"+lastSelectAdd;

   if(document.querySelector(aux).value != ""){
        lastSelectAdd++;
        let selecionaAutor = document.querySelector("#selectGroup");
        let aux = document.createElement("select");
        aux.id = "autorSelect"+lastSelectAdd;
        aux.className = "form-select";
        
        selecionaAutor.appendChild(aux);

        searchAndFilterAutor();
   }
    

}


