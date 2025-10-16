<?php
include('../../protect.php');

$sql = "SELECT pr.numero_prontuario, pa.nome, pa.cpf, pa.data_nascimento, pa.nome_mae, pr.data_atendimento 
            FROM tbl_prontuario pr 
            JOIN tbl_paciente pa ON pa.id = pr.id_paciente 
            ORDER BY pr.registro DESC;";
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

            <div class="card">
                <h2>Prontuário Nº 001</h2>
                <div class="info">
                    <span><strong>Nome:</strong> João Silva</span>
                    <span><strong>CPF:</strong> 123.456.789-00</span>
                    <span><strong>Data de Nascimento:</strong> 12/03/1990</span>
                    <span><strong>Nome da Mãe:</strong> Maria Silva</span>
                    <span><strong>Data de Atendimento:</strong> 10/10/2025</span>
                </div>
            </div>

            <div class="card">
                <h2>Prontuário Nº 002</h2>
                <div class="info">
                    <span><strong>Nome:</strong> Ana Costa</span>
                    <span><strong>CPF:</strong> 987.654.321-00</span>
                    <span><strong>Data de Nascimento:</strong> 22/08/1985</span>
                    <span><strong>Nome da Mãe:</strong> Helena Costa</span>
                    <span><strong>Data de Atendimento:</strong> 05/10/2025</span>
                </div>
            </div>

            <div class="card">
                <h2>Prontuário Nº 003</h2>
                <div class="info">
                    <span><strong>Nome:</strong> Pedro Oliveira</span>
                    <span><strong>CPF:</strong> 456.789.123-00</span>
                    <span><strong>Data de Nascimento:</strong> 30/01/1995</span>
                    <span><strong>Nome da Mãe:</strong> Luciana Oliveira</span>
                    <span><strong>Data de Atendimento:</strong> 12/10/2025</span>
                </div>
            </div>
        </div>
    </main>

    <!-- Rodapé -->
    <footer>
        © 2025 Estácio - Sistema de Prontuários
    </footer>


</body>
</html>
