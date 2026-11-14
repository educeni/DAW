<?php
    $cpf = "";
    $nome = "";
    $email = "";
    $senha = "";

    if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['cpf'])) {
        $cpf = trim($_GET['cpf']);
        $arqUsuario = fopen("usuarios.txt", "r") or die("erro ao abrir arquivo");

        while(($linha=fgets($arqUsuario)) != false){

            $colunaDados = explode(";", $linha);

            if($colunaDados[0] == $cpf){
                $nome = trim($colunaDados[1]);
                $email = trim($colunaDados[2]);
                $senha = trim($colunaDados[3]);
                break;
            }
        }
        fclose($arqUsuario);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar Usuario</title>
</head>
<body>
    <script>
        function AlterarUsuario() {
            let nome = document.getElementById("nome").value;
            let email = document.getElementById("email").value;
            let senha = document.getElementById("senha").value;
            let cpf = document.getElementById("cpf").value;

            if (nome === "" || email === "" || senha === "" || cpf === "") {
                alert("Todos os campos são obrigatórios.");
                return false;
            }

            let xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("msg").innerHTML = this.responseText;
                }
                else if (this.readyState == 4) {
                    document.getElementById("msg").innerHTML = "Erro ao alterar usuário.";
                }
            };
            console.log("Enviando dados para o servidor...");
            xmlhttp.open("POST", "http://localhost/DAW/exercicios/AV1_JS/usuario/alterarUsuarioFinal.php", true);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send("nome=" + encodeURIComponent(nome) + "&email=" + encodeURIComponent(email) + "&senha=" + encodeURIComponent(senha) + 
                                "&cpf=" + encodeURIComponent(cpf));

            console.log("Dados enviados para o servidor.");

            
        }
    
    </script>

    <form action="alterarUsuarioFinal.php" method="POST">
        <label for="cpf">Cpf</label>
        <input type="text" name="cpf" id="cpf" value="<?php echo $cpf; ?>" readonly>
        <br>
        <label for="nome">Nome</label>
        <input type="text" name="nome" id="nome" value="<?php echo $nome; ?>" >
        <br>
        <label for="email">Email</label>
        <input type="text" name="email" id="email" value="<?php echo $email; ?>" >
        <br>
        <label for="senha">Senha</label>
        <input type="password" name="senha" id="senha" value="<?php echo $senha; ?>" >
        <br>
        <input type="button" value="Confirmar alteracao" onclick="AlterarUsuario()">
        <br>
    </form>
    <p id="msg"></p>
    <a href="../index.html">Voltar para tela inicial</a>
</body>
</html>