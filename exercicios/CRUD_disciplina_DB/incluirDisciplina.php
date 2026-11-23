<?php
    require_once("conexao.php");
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $cod = $_GET['cod'];
        $nome = $_GET['nome'];
        $sigla = $_GET['sigla'];
        $carga = $_GET['carga'];

        $sql = "INSERT INTO disciplinas (cod, nome, sigla, carga) VALUES ('$cod', '$nome', '$sigla', '$carga')";
        
        $resultado = $con->query($sql);

        $retorno = json_encode($resultado);
        echo $retorno;
    }      
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Incluir Disciplina</title>
</head>
<body>
    <script>
        function incluirDisciplina(){
            let cod = document.getElementById("cod").value;
            let nome = document.getElementById("nome").value;
            let sigla = document.getElementById("sigla").value;
            let carga = document.getElementById("carga").value;
            console.log("Cod: " + cod + " nome: " + nome + " sigla: " + sigla + " carga: " + carga);

            if(cod = "" || nome = "" || sigla = "" || carga == ""){
                return false;
            }


            let xmlhhtp = new XMLHttpRequest();
            
            xmlhttp.onreadystatechance = function(){
                if((this.readyState == 4)&&(this.status == 20)){
                    document.getElementById("msg").innerHTML = this.responseText;
                }
                else if(ready.state == 4){
                    document.getElementById("msg").innerHTML = "Erro ao incluir usuário.";
                }
            };
            xmlhttp.open("GET","http://localhost/DAW/exercicios/CRUD_disciplina_DB/incluirDisciplina.php?cod=" 
                        + encodeURIComponent(cod) + "&nome=" + encodeURIComponent(nome) + "&sigla=" 
                        + encodeURIComponent(sigla) + "&carga=" + encodeURIComponent(carga));
            xmlhttp.send();
            console.log("Requisição enviada.");
        }
    </script>

    <form action="" method="GET">
        <label for="cod">Código da disciplina</label>
        <input type="number" id="cod" name="cod" required>

        <label for="nome">Nome da disciplina</label>
        <input type="text" id="nome" name="nome" required>

        <label for="sigla">Sigla da disciplina</label>
        <input type="text" id="sigla" name="sigla" required>

        <label for="carga">Carga Horária</label>
        <input type="number" id="carga" name="carga" required>
        
        <input type="button" value="Incluir Disciplina" onclick="incluirDisciplina()">
    </form>
    <p id="msg"></p>
</body>
</html>