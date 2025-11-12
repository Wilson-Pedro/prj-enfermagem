<?php
include('../../protect.php');

include('../../db/conexao.php');

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$where = "";
$busca = isset($_GET['busca']) ? $_GET['busca'] : '';

if(!empty($busca)) {
    $where = "WHERE pa.nome LIKE '%" . mysqli_real_escape_string($mysqli, $busca) . "%'";
}

?>
<!DOCTYPE html>

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listagem de Prontuários | Estácio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
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
        /* grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); */
        gap: 25px;
    }

    .card {
        background: #fff;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0px 4px 10px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
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

    .info button {
        margin-top: 2%;
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

    .barra-busca {
        width: 200px;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 1em;
    }


    .barra-busca:focus {
        width: 300px;
        outline: none;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
    }

    button {
        background: none;
        border: none;
        cursor: pointer;
    }

    .nome-user {
        margin-top: 1.5%;
    }

    .nome-user strong {
        color: gray;
    }

</style>

</head>
<body>
    <header>
        <a href="../../goToHome.php" class="voltar" title="Voltar">
            <i class="bi bi-arrow-left-circle-fill"></i>
        </a>
        <a href="../../goToHome.php" title="logo estácio">
             <img src="../../img/estacio-logo.png" alt="Logo Estácio">
        </a>
    </header>

    <main>
        <h1>Lista de Prontuários</h1>
        <form action="" method="GET">
            <input type="text" name="busca" placeholder="Pesquisar..." class="barra-busca" value="<?php htmlspecialchars($busca); ?>">
            <button type="submit">
                <i class="bi bi-search"></i>
            </button>
        </form> <br>

        <div class="card-list">

            <?php
                try {

                    $sql = "SELECT pr.id, pr.numero_prontuario, pa.nome, pa.cpf, pa.data_nascimento, pa.nome_mae, pr.data_atendimento, 
                                us.nome AS nome_user, pr.id_paciente  
                                FROM tbl_prontuario pr 
                                JOIN tbl_paciente pa ON pa.id = pr.id_paciente 
                                JOIN tbl_users us ON us.id = pr.id_user
                                $where
                                ORDER BY pr.registro DESC
                                LIMIT 10";

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
                        $nome_user = htmlspecialchars($row['nome_user']);
                        $id_paciente = htmlspecialchars($row['id_paciente']);
            ?>
                    <div class="card">
                        <h2>Prontuário Nº <?php echo $row['numero_prontuario'] ?></h2>
                        <div class="info">
                            <span><strong>Nome:</strong> <?php echo $nome ?></span>
                            <span><strong>CPF:</strong> <?php echo $cpf ?></span>
                            <span><strong>Data de Nascimento:</strong> <?php echo $data_nascimento ?></span>
                            <span><strong>Nome da Mãe:</strong> <?php echo $nome_mae ?></span>
                            <span><strong>Data de Atendimento:</strong> <?php echo $data_atendimento ?></span>
                            <span class="nome-user"><strong>Realizado por:</strong> <?php echo $nome_user ?></span>

                            <a href="../cadastro/cadastrar-evolucao.php?id=<?php echo $id_paciente ?>" class="card-link">
                                <button type="button" class="btn btn-primary">Fazer Evolução</button>
                            </a>

                            <a href="../edit/formularioEdit.php?id=<?php echo $id ?>" class="card-link">
                                <button type="button" class="btn btn-primary">Editar Formulário</button>
                            </a>

                            <a href="evolucao.php?id=<?php echo $id_paciente ?>" class="card-link">
                                <button type="button" class="btn btn-primary">Ver Evoluções</button>
                            </a>
                        </div>
                    </div>

            <?php 
                        }
                    }
                } catch(Exception $e) {
                    echo "<p style='color:grey; text-align:center;'>Nehnhum formulário encontrada.</p>";
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
