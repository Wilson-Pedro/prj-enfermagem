<?php
    include('../../protect.php');

    include('../../db/conexao.php');

    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $mysqli->set_charset("utf8");


    $id_paciente = $_GET['id'] ?? '';
    $id_paciente = trim($id_paciente);

    $id_user = $_SESSION['id'];

    $dateNow = new DateTime();
    $dateFormat = $dateNow->format('Y-m-d');

    if(isset($_POST['cadastrar'])) {

        try {

            //DADOS PARA TBL_EVOLUCAO
            $data_atendimento = $_POST['data_atendimento'];
            $pressao = $_POST['pressao'];
            $glicemia = $_POST['glicemia'];
            $observacao = $_POST['observacao'];


            $stmt_evolucao = $mysqli->prepare("INSERT INTO tbl_evolucao (id, id_paciente, data_atendimento, pressao, glicemia, observacao, id_user) VALUES (NULL, ?, ?, ?, ?, ?, ?)");
            $stmt_evolucao->bind_param("issssi", $id_paciente, $data_atendimento, $pressao, $glicemia, $observacao, $id_user);
            $stmt_evolucao->execute();
            $stmt_evolucao->close();

            header('Location: ../evolucao/evolucao.php?id='.  $id_paciente);

        } catch(Exception $e) {

            echo "<script>alert('Error ao realizar cadastro')</script>";
            
            echo "Error ao cadastrar evolução" . $e->getMessage();
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../../css/formulario.css">
    <title>Cadastrar Evolução</title>
    <style>
        body {
            background: #146c8f;
            background: linear-gradient(180deg,rgba(20, 108, 143, 1) 0%, rgba(59, 157, 196, 1) 100%);  
        }
    </style>
</head>
<body>

    <!-- Botão de Voltar -->
    <div class="back-btn">
        <a href="../evolucao/prontuarios.php"><i class="bi bi-arrow-left-circle-fill" id="iconeVoltar"></i></a>
    </div>

    <?php
        //PEGAR NOME DO PACIENTE
        $stmt_nome_paciente = $mysqli->prepare("SELECT pa.nome FROM tbl_paciente pa WHERE pa.id = ?;");
        $stmt_nome_paciente->bind_param("i", $id_paciente);
        $stmt_nome_paciente->execute();
        $nome_paciente = null;

        $result = $stmt_nome_paciente->get_result();

        if($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $nome_paciente = htmlspecialchars($row['nome']);
        } else {
            $nome_paciente = htmlspecialchars("");
        }
    ?>

    <form method="post" class="container">
        <h2>Cadastrar Evolução</h2>

        <div class="form-row">
            <div class="form-group">
                <label for="prontuario">Nome do paciente</label>
                <input type="text" id="nome" value="<?php echo $nome_paciente ?>" name="nome" placeholder="nome" disabled>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="atendimento">Data do Atendimento</label>
                <input type="date" id="data_atendimento" value="<?php echo $dateFormat ?>" name="data_atendimento" placeholder="Dia / Mês / Ano" required>
            </div>
            <div class="form-group">
                <label for="prontuario">Pressão</label>
                <input type="number" id="pressao" value="" name="pressao" placeholder="Pressão" required>
            </div>
        </div>

        <div class="form-group">
            <div class="form-group">
                <label for="rua">Glicemia</label>
                <input type="text" id="glicemia" value="" name="glicemia" placeholder="Glicemia" required>
            </div>
        </div>

        <div class="form-group">
            <div class="form-group">
                <label for="cidade">Observação</label>
                <textarea rows="5" cols="30" id="observacao" name="observacao" placeholder="Observação"></textarea>
            </div>
        </div>

        <div class="submit-btn">
            <button type="submit" name="cadastrar">Cadastrar</button>
        </div>
    </form>

</body>
</html>