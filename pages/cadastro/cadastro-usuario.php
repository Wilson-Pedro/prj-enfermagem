<?php
    include('../../protect.php');
?>

<?php
    include('../../db/conexao.php');

    try {

        if(isset($_POST['finalizar'])) {
            // ANAMNESE

            $nome = $_POST['nome_completo'];

            $cpf = $_POST['cpf'];

            $matricula = $_POST['matricula'];

            $senha = $_POST['senha'];

            $id_tipo_usuario = $_POST['usuario'];

            $stmt_usuario = $mysqli->prepare("INSERT INTO tbl_users (id, id_tipo_usuario, nome, matricula, cpf, senha) VALUES (NULL, ?, ?, ?, ?, ?)");

            $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

            $stmt_usuario->bind_param("issss", $id_tipo_usuario, $nome, $matricula, $cpf, $senha_hash);
            $stmt_usuario->execute();
            $stmt_usuario->close();

            header('Location: cadastro-sucesso.php');
        }

    } catch(Exception $e) {
        echo "Error: " . $e;
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!-- <link rel="stylesheet" href="../css/anamnese.css"> -->
    <title>ANAMNESE</title>
    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(180deg, rgb(230, 82, 107), rgb(234, 126, 144));
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding: 20px;
            min-height: 100vh;
        }

        .container {
            max-width: 1200px;
            width: 50%;
        }

        .formContainer {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            background-color: white;
            padding: 30px;
            border-radius: 15px;
            margin-bottom: 5%;
        }

        .container h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        

        .form-group {
            display: flex;
            flex-direction: column;
            margin-bottom: 15px;
            width: 100%;
        }

        .form-group label {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-group input, .form-group textarea {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 100%;
        }

        .form-group select {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 100%;
        }

        .form-row {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .form-row .form-group {
            flex: 0 0 48%;
            margin-bottom: 20px;
        }

        @media (max-width: 768px) {
            .form-row .form-group {
                flex: 0 0 100%;
            }
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .checkbox-group input[type="checkbox"] {
            margin-right: 10px;
        }

        .checkbox-group label {
            margin-left: 5px;
        }

        .submit-btn {
            margin-top: 5%;
            display: flex;
            justify-content: flex-end;
        }

        .submit-btn button {
            padding: 10px 20px;
            margin: auto;
            background-color: rgb(230, 82, 107);
            border: none;
            border-radius: 5px;
            color: white;
            cursor: pointer;
            font-size: 16px;
        }

        .submit-btn button:hover {
            background-color: #f06292;
        }

        /* Botão Voltar no canto superior esquerdo */
        .back-btn {
            position: fixed;
            top: 20px;
            left: 20px;
            background-color: #f48fb1;
            color: white;
            border: none;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 18px;
            cursor: pointer;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
        }

        .back-btn:hover {
            background-color: #f06292;
        }

        #iconeVoltar {
            color: white;
            font-size: 250%;
            margin-left: 2%;
            cursor: pointer;
        }

        #iconeVoltar:hover {
            cursor: pointer;
            color: rgb(255, 43, 78);
        }
    </style>
</head>
<body>

    <!-- Botão de Voltar -->
    <div class="back-btn">
        <a href="../Home.php"><i class="bi bi-arrow-left-circle-fill" id="iconeVoltar"></i></a>
    </div>

    <form method="post" class="container">
        <div class="formContainer">
            <h2>Anamnese</h2>
            <div class="form-group">
                <label for="motivo-consulta">Nome Completo</label>
                <input type="text" id="nome-completo" name="nome_completo" placeholder="Nome Completo" required>
            </div>
            <div class="form-group">
                <label for="inicio-sintomas">CPF</label>
                <input type="text" id="cpf" name="cpf" placeholder="CPF" required>
            </div>
            <div class="form-group">
                <label for="rh">Matricula</label>
                <input type="text" id="matricula" name="matricula" placeholder="Matricula" required>
            </div>

            <div class="form-group">
                <label for="rh">Senha</label>
                <input type="password" id="senha" name="senha" placeholder="Senha" required>
            </div>
            <br>
            <div class="form-group">
                <label for="motivo-consulta">Usuário</label>
                <select name="usuario" required>
                    <option value='' disabled selected> </option>
                    <?php
                        $sql_usuario = "SELECT id, tipo_usuario FROM tbl_tipo_usuario";
                        $result_usuario = mysqli_query($mysqli, $sql_usuario);
                        while ($row_usuario = mysqli_fetch_assoc($result_usuario)) {
                    ?>
                            <option value='<?php echo $row_usuario['id'] ?>'> <?php echo $row_usuario['tipo_usuario'] ?> </option>
                    <?php
                        }
                    ?>
                </select>
            </div>

        <div class="submit-btn">
            <button type="submit" name="finalizar">Cadastrar</button>
        </div>
        <div>

    </form>
    
</body>
</html>