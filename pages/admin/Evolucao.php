<?php
include('../../protect.php');

include('../../db/conexao.php');

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
?>
<!DOCTYPE html>

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listagem de Prontuários | Estácio</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="shortcut icon" href="../../img/favicon.ico" type="image/x-icon">
<style>
    body {
        margin: 0;
        font-family: "Segoe UI", Arial, sans-serif;
        background: #f5f7fb;
        color: #333;
    }

    header {
        background: #004B93;
        color: #fff;
        padding: 15px 30px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        box-shadow: 0px 2px 8px rgba(0,0,0,0.2);
    }

    header img {
        height: 45px;
    }

    .back-btn {
        color: #fff;
        font-size: 1.8rem;
        text-decoration: none;
    }

    main {
        max-width: 1100px;
        margin: 40px auto;
        padding: 0 20px;
    }

    h1 {
        text-align: center;
        color: #004B93;
        font-size: 28px;
        margin-bottom: 30px;
    }

    .card-list {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 25px;
    }

    .card {
        background: #fff;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0px 4px 10px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0px 6px 14px rgba(0,0,0,0.2);
    }

    .card h2 {
        color: #004B93;
        font-size: 20px;
        margin-top: 0;
    }

    .info {
        margin-top: 10px;
        line-height: 1.6;
    }

    .info span {
        display: block;
        font-size: 15px;
        color: #444;
    }

    .info strong {
        color: #0099DA;
    }

    footer {
        text-align: center;
        padding: 20px;
        color: #777;
        font-size: 14px;
    }

    .voltar {
        color: #fff;
        font-size: 1.8rem;
        text-decoration: none;
    }

    .card-link {
        text-decoration: none;
    }
</style>

</head>
<body>
    <header>
        <a href="Home.php" class="voltar" title="Voltar">
            <i class="bi bi-arrow-left-circle-fill"></i>
        </a>
        <a href="Home.php" title="logo estácio">
             <img src="../../img/estacio-logo.png" alt="Logo Estácio">
        </a>
    </header>

    <main>
        <h1>Lista de Prontuários</h1>

        <div class="card-list">

            <?php
                try {

                    $sql = "SELECT pr.id, pr.numero_prontuario, pa.nome, pa.cpf, pa.data_nascimento, pa.nome_mae, pr.data_atendimento 
                    FROM tbl_prontuario pr 
                    JOIN tbl_paciente pa ON pa.id = pr.id_paciente 
                    ORDER BY pr.registro DESC;";

                    $result = $mysqli->query($sql);

                    if($result->num_rows === 0) {
                        echo "<p style='text-align:center; color:gray;'>Nenhum prontuário cadastrado.</p>";
                    } else {

                    while($row = $result->fetch_assoc()) {
                        $id = htmlspecialchars($row['id']);
                        $numero = htmlspecialchars($row['numero_prontuario']);
                        $nome = htmlspecialchars($row['nome']);
                        $cpf = htmlspecialchars($row['cpf']);
                        $data_nascimento = htmlspecialchars(date('d/m/Y', strtotime($row['data_nascimento'])));
                        $nome_mae = htmlspecialchars($row['nome_mae']);
                        $data_atendimento = htmlspecialchars(date('d/m/Y', strtotime($row['data_atendimento'])));
            ?>
                <a href="edit/formularioEdit.php?id=<?php echo $id ?>" class="card-link">
                    <div class="card">
                        <h2>Prontuário Nº <?php echo $row['numero_prontuario'] ?></h2>
                        <div class="info">
                            <span><strong>Nome:</strong> <?php echo $nome ?></span>
                            <span><strong>CPF:</strong> <?php echo $cpf ?></span>
                            <span><strong>Data de Nascimento:</strong> <?php echo $data_nascimento ?></span>
                            <span><strong>Nome da Mãe:</strong> <?php echo $nome_mae ?></span>
                            <span><strong>Data de Atendimento:</strong> <?php echo $data_atendimento ?></span>
                        </div>
                    </div>
                </a>

            <?php 
                        }
                    }
                } catch(Exception $e) {
                    echo "<p style='color:red; text-align:center;'>Erro ao carregar os prontuários.</p>";
                    error_log("Error ao listar prontuários " . $e->getMessage());
                }
            ?>

        </div>
    </main>

    <!-- Rodapé -->
    <footer>
        © 2025 Estácio - Sistema de Prontuários
    </footer>


</body>
</html>
