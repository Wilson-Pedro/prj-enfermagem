<?php
    include('../protect.php');

    $dateNow = new DateTime();
    $dateFormat = $dateNow->format('Y-m-d');
?>

<?php
    include('../db/conexao.php');

    if(isset($_POST['finalizar'])) {

        //DADOS PARA TBL_PRONTUARIO
        $concordo = $_POST['concordo'];
        $data_atendimento = $_POST['data_atendimento'];
        $numero_prontuario = $_POST['numero_prontuario'];

        //DADOS PARA TBL_PACIENTE
        $rg = $_POST['rg'];
        $cpf = $_POST['cpf'];
        $ssp = $_POST['ssp'];
        $nome = $_POST['nome'];
        $telefone = $_POST['telefone'];
        $nome_mae = $_POST['nome_mae'];
        $nome_pai = $_POST['nome_pai'];
        $cartao_sus = $_POST['cartao_sus'];
        $nome_mae_consta = empty($_POST['nao_consta_mae'])  ? $nao_consta_mae = 0 : $nao_consta_mae = 1;        ;
        $nome_pai_consta = empty($_POST['nao_consta_pai'])  ? $nao_consta_mae = 0 : $nao_consta_mae = 1;

        //empty($nao_consta_mae) ? $nao_consta_mae = 0 : $nao_consta_mae = 1;

        $data_nascimento = $_POST['data_nascimento'];

        //DADOS PARA TBL_ENDERECO
        $rua = $_POST['rua'];
        $bairro = $_POST['bairro'];
        $cidade = $_POST['cidade'];


        try {

            //INSERT EM TBL_ENDERECO
            $stmt_id_endereco = $mysqli->prepare("INSERT INTO tbl_endereco (id, rua, bairro, cidade) VALUES (NULL, ?, ?, ?);");
            $stmt_id_endereco->bind_param("sss", $rua, $bairro, $cidade);
            $stmt_id_endereco->execute();
            $id_endereco = $mysqli->insert_id;
            $stmt_id_endereco->close();

            //INSERT EM TBL_PACIENTE
            $stmt_id_paciente = $mysqli->prepare("INSERT INTO tbl_paciente 
            (id, nome, nome_pai, nome_pai_consta, nome_mae, nome_mae_consta, cpf, rg, ssp, telefone, cartao_sus, id_endereco) 
            VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt_id_paciente->bind_param("ssisisssssi", $nome, $nome_pai, $nome_pai_consta, $nome_mae, $nome_mae_consta, $cpf, $rg, $ssp, $telefone, $cartao_sus, $id_endereco);
            $stmt_id_paciente->execute();
            $id_paciente = $mysqli->insert_id;
            $stmt_id_paciente->close();

            //INSERT EM TBL_PRONTUARIO
            $stmt_prontuario = $mysqli->prepare("INSERT INTO tbl_prontuario (id, numero_prontuario, data_atendimento, id_paciente) 
            VALUES (NULL, ?, ?, ?);");
            $stmt_prontuario->bind_param("isi", $numero_prontuario, $data_atendimento, $id_paciente);
            $stmt_prontuario->execute();
            $stmt_prontuario->close();

            header('Location: cadastro-sucesso.php');

        } catch(Exception $e) {
            echo "Error " . $e;

        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/formulario.css">
    <title>Criar Formulário</title>
</head>
<body>

    <!-- Botão de Voltar -->
    <div class="back-btn">
        <a href="Home.php"><i class="bi bi-arrow-left-circle-fill" id="iconeVoltar"></i></a>
    </div>

    <form method="post" class="container">
        <h2>Formulário</h2>
        <div class="form-row">
            <div class="form-group">
                <label for="prontuario">Número do Prontuário</label>
                <input type="number" id="prontuario" name="numero_prontuario" placeholder="Nº Prontuário" required>
            </div>
            <div class="form-group">
                <label for="atendimento">Data do Atendimento</label>
                <input type="date" id="atendimento" name="data_atendimento" value="<?php echo $dateFormat ?>" placeholder="Dia / Mês / Ano" required>
            </div>
        </div>

        <div class="form-group">
            <label for="nome">Nome do Paciente</label>
            <input type="text" id="nome" name="nome" placeholder="Nome" required>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="cpf">CPF</label>
                <input type="text" id="cpf"name="cpf" placeholder="CPF" required>
            </div>
            <div class="form-group">
                <label for="nascimento">Data de Nascimento</label>
                <input type="date" id="nascimento"name="data_nascimento" placeholder="Dia / Mês / Ano" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="rg">RG</label>
                <input type="text" id="rg" name="rg" placeholder="RG" required>
            </div>
            <div class="form-group">
                <label for="ssp">SSP</label>
                <input type="text" id="ssp" name="ssp" placeholder="SSP" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="telefone">Telefone</label>
                <input type="text" id="telefone" name="telefone" placeholder="Telefone" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="nome-mae">Nome da Mãe</label>
                <input type="text" id="nome-mae" name="nome_mae" placeholder="Nome da Mãe" required>
            </div>
            <div class="form-group">
                <label for="nome-pai">Nome do Pai</label>
                <input type="text" id="nome-pai" name="nome_pai" placeholder="Nome do Pai" required>
            </div>
        </div>

        <div class="form-row">
            <div class="checkbox-group">
                <input type="checkbox" id="nao-consta-mae" name="nome_mae_consta">
                <label for="nao-consta-mae">Não Consta</label>
            </div>
            <div class="checkbox-group">
                <input type="checkbox" id="nao-consta-pai" name="nome_pai_consta">
                <label for="nao-consta-pai">Não Consta</label>
            </div>
        </div>
        <br>
        <div class="form-group">
            <label for="sus">Cartão do SUS</label>
            <input type="text" id="sus" name="cartao_sus" placeholder="SUS" required>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="bairro">Bairro</label>
                <input type="text" id="bairro" name="bairro" placeholder="Bairro" required>
            </div>
            <div class="form-group">
                <label for="rua">Rua</label>
                <input type="text" id="rua" name="rua" placeholder="Rua" required>
            </div>
        </div>

        <div class="form-group">
            <label for="cidade">Cidade</label>
            <input type="text" id="cidade" name="cidade" placeholder="Cidade" required>
        </div>

        <div class="checkbox-group">
            <input type="checkbox" id="concordo"  name="concordo" required>
            <label for="concordo">Concordo com o uso dos dados apresentados acima, conforme os termos destacados.</label>
        </div>

        <div class="submit-btn">
            <button type="submit" name="finalizar">Finalizar</button>
        </div>
    </form>

</body>
</html>