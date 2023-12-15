function insert(){
    let g = new Object();
    g.genero = document.querySelector("#genero").value;

    let gJson = JSON.stringify(g);

    let xml = new XMLHttpRequest();
    xml.open("POST","index.php?classe=genero&metodo=insert",true);
    xml.setRequestHeader("Content-type","application/json");

    xml.onreadystatechange = function(){
        if(xml.readyState == 4 && xml.status == 200){
            if(xml.responseText == "Funcionou"){
                alert("Novo gênero inserido com sucesso")
                window.location.href = "index.php?classe=genero&metodo=selectAll";
            }
            else{
                alert(xml.responseText);
            }
        }
    }
    xml.send(gJson);
}
function update(){
    let g = new Object();
    g.id = document.querySelector("#id").value;
    g.genero = document.querySelector("#genero").value;

    let gJson = JSON.stringify(g);

    let xml = new XMLHttpRequest();
    xml.open("POST","index.php?classe=genero&metodo=update",true);
    xml.setRequestHeader("Content-type","application/json");

    xml.onreadystatechange = function(){
        if(xml.readyState == 4 && xml.status == 200){
            if(xml.responseText == "Funcionou"){
                alert("Gênero Atualizado com sucesso")
                window.location.href = "index.php?classe=genero&metodo=selectAll";
            }
            else{
                alert(xml.responseText);
            }
        }
    }
    xml.send(gJson);
}

function isJson(s){
    try{
        JSON.parse(s);
    }
    catch(e){
        return false;
    }
    return true;
}

function deletar(id){
    
    let xml = new XMLHttpRequest();
    
    xml.open("POST","index.php?classe=genero&metodo=delete",true);
    xml.setRequestHeader("Content-type","application/x-www-form-urlencoded");

    xml.onreadystatechange = function(){
        if(xml.readyState == 4 && xml.status == 200){
            let tb = document.querySelector("#corpoTabela");
            if(isJson(xml.responseText)){
                let l = JSON.parse(xml.responseText);
                tb.innerHTML = "";
                for(let i = 0;i < l.length;i++){
                    tb.innerHTML += "<td>"+l[i].id+"</td><td>"+l[i].genero+"</td><td><button class='btn btn-danger' onclick=deletar('"+l[i].id+"') id='"+l[i].id+"'>Apagar</button> <a href='index.php?classe=genero&metodo=showViewUpdate&id="+l[i].id+"'><button class='btn btn-warning' id='"+l[i].id+"'>Atualizar</button></a></td>";
                    
                }
            }
            else{
                alert(xml.responseText);
            }
        }
    }
    xml.send("id="+id);
}