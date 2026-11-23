<?php
    require_once("conexao.php");

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $cod = trim($_POST['cod']);
        $sql = "DELETE FROM disciplinass WHERE cod = ($cod)";

        $resultado = $con->query($sql);

        if (!$stmt) {
            die("Erro ao preparar exclusão: " . $con->error);
        }

        $stmt->close();
        $con->close();

        $retorno = json_encode($resultado);
        echo $retorno;
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excluir Disciplina</title>
</head>
<body>
    <script>
        function excluirDisciplina(){
            let cod = document.getElementById("cod").value;

            if(cod == ""){
                return false;
            }

            let xmlhttp = new XMLHttpRequest();

            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("msg").innerHTML = this.responseText;
                }
                else if (this.readyState == 4) {
                    document.getElementById("msg").innerHTML = "Erro ao excluir disciplina.";
                }
            };
            xmlhttp.open("POST", "http://localhost/DAW/exercicios/CRUD_disciplina_DB/excluirDisciplina.php", true);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send("cod=" + encodeURIComponent(cod));
        }
    </script>

    <h1>Deseja excluir uma disciplina?</h1>
    <form action="" method="POST">
        <label for="cod">Forneca o código da disciplina</label>
        <input type="number" id="cod" name="cod" required>
        <br>    
        <input type="button" value="Confirmar exclusão" onclick="excluirDisciplina()">

    </form>
    <p id="msg"></p>
</body>
</html>