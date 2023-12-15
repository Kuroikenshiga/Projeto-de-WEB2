
function update(){
    let autor = new Object();
    let generosLiterarios = new Array();
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
    autor.id = document.querySelector("#id").value;

    let autoJson = JSON.stringify(autor);

    let xml = new XMLHttpRequest();

    xml.open("POST","index.php?classe=Autor&metodo=update",true);

    xml.setRequestHeader("Content-type","application/Json");

    xml.onreadystatechange = function(){
        if(xml.readyState == 4 && xml.status == 200){
            alert(xml.responseText=="index.php"?"Autor atualzado com sucesso":"erro na operação");
            window.location.href = xml.responseText;
        }
    }
    xml.send(autoJson);
}

function insert(){
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
           
            if(xml.responseText == "funcionou"){
                alert("Cadastrado com sucesso");
                window.location.href = "index.php?classe=autor&metodo=selectAll";
            }
            else{
                alert(xml.responseText);
            }
        }
    }
    xml.send(autoJson);
    
}
function criaTabela(autor){
    let tb = document.querySelector("#corpoTabela");
    tb.innerHTML += "<tr><td>"+autor.id+"</td><td><a href='index.php?classe=Autor&metodo=showMoreInfo&id="+autor.id+"'>"+autor.nome+"</a></td><td>"+autor.contato+"<button class='btn btn-danger' onclick='deletar("+autor.id+")' id='"+autor.id+"'>Apagar</button><a href='index.php?classe=Autor&metodo=showViewUpdate&id="+autor.id+"'><button class='btn btn-warning' id='"+autor.id+"'>Atualizar</button></a></td></tr>";
}
function deletar(id){
    
    xml = new XMLHttpRequest();
    xml.open("POST","index.php?classe=Autor&metodo=delete",true);
    xml.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    
    xml.onreadystatechange = function(){
        if(xml.status == 200 && xml.readyState == 4){
            
           //
           if(xml.responseText == "Erro1"){
                
            alert("Existem livros que tem apenas este autor. Por favor exclua esse livro primeiro");  
           }
            else{
                autores = JSON.parse(xml.responseText);
            let tb = document.querySelector("#corpoTabela");
            tb.innerHTML = "";
            for(let i = 0;i < autores.length;i++){
                criaTabela(autores[i]);
            }
        }
        }
    }
    xml.send("id="+id);
}
