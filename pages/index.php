<?php
session_start();
session_destroy();

include('../db/conexao.php');

// $sql_insert_users = "INSERT INTO tbl_users (id, id_tipo_usuario, nome, matricula, cpf, senha) VALUES (NULL, ?, ?, ?, ?, ?)";
// $stmt_users = $mysqli->prepare($sql_insert_users);

// $id_tipo_usuario = 1;
// $nome = "admin";
// $matricula = "2025";
// $cpf = "11111111111";
// $senha = "1234";
// $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

// $stmt_users->bind_param("issss", $id_tipo_usuario, $nome, $matricula, $cpf, $senha_hash);
// $stmt_users->execute();

try {

    if((isset($_POST['matricula']) && isset($_POST['senha'])) && (!empty($_POST['matricula']) && !empty($_POST['senha']))) {
        if (strlen($_POST['matricula']) == 0) {
            echo "Preencha sua matricula";
        } else if (strlen($_POST['senha']) == 0) {
            echo "Preencha sua senha!";
        } else {
            //LIMPANDO MYSQLI PARA ANTI SQL INJECTION
            $matricula = $mysqli->real_escape_string($_POST['matricula']);
            $senha = $mysqli->real_escape_string($_POST['senha']);
    
            $sql_code = "SELECT * FROM tbl_users WHERE matricula = '$matricula' LIMIT 1";
            
            $sql_query = $mysqli->query($sql_code) or die("Falha na execução do codigo SQL: " . $mysqli);
    
            $quantidade = mysqli_num_rows($sql_query);
            // FAZENDO A AUTENTICAÇÃO E REDIRECIONANDO PARA O PAINEL
            if ($quantidade == 1) {
                $usuario = $sql_query->fetch_assoc();
                 if (password_verify($senha, $usuario['senha'])) {
                      session_start();
                     $_SESSION['id'] = $usuario['id'];
                     $_SESSION['nome'] = $usuario['nome'];
    
                     header("Location: Home.php");
                     exit();
                 }

    
                header("Location: index.php");
                echo "Ops... e-mail ou senha incorretos!";
            } else {
                echo "Ops... e-mail ou senha incorretos!";
            }
        }
    }

} catch(Exception $e) {
    echo "Error ". $e;
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">
    <title>login</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body, html {
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: Arial, sans-serif;
            background-color: #e26f99;
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            
        }

        .container img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            margin-bottom: 20px;
        }

        .card {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        .card input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .card button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .card button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

    <form method="post" class="container">
        <img src="../img/imageLogin.png" alt="Imagem Centralizada">
        <div class="card">
            <input type="text" name="matricula" placeholder="Matricula" required>
            <input type="senha" name="senha" placeholder="Senha" required>

            <button type="submit">Login</button>
        </div>
    </form>

</body>
</html>