<?php
include('../../protect.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../img/favicon.ico" type="image/x-icon">
    <title>Home</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        body {
            margin: 0;
            font-family: "Segoe UI", Arial, sans-serif;
            background: #f4f7fb;
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
            cursor: pointer;
        }

        .logout {
            color: #fff;
            font-size: 1.8rem;
            text-decoration: none;
        }

        main {
            max-width: 1100px;
            margin: 50px auto;
            padding: 0 20px;
            text-align: center;
        }

        .profile {
            margin-bottom: 40px;
        }

        .profile img {
            width: 130px;
            border-radius: 50%;
            border: 3px solid #004B93;
        }

        .profile h1 {
            margin-top: 15px;
            font-size: 26px;
            color: #004B93;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 25px;
        }

        .card {
            background: #fff;
            border-radius: 12px;
            padding: 30px 20px;
            text-decoration: none;
            color: #004B93;
            font-weight: bold;
            font-size: 18px;
            box-shadow: 0px 4px 10px rgba(0,0,0,0.15);
            transition: all 0.3s ease;
        }

        .card:hover {
            background: #0099DA;
            color: #fff;
            transform: translateY(-6px);
            box-shadow: 0px 6px 14px rgba(0,0,0,0.25);
        }
    </style>
</head>

<body>
    <header>
        <a href="../logout.php" class="logout" title="Sair">
            <i class="bi bi-arrow-left-circle-fill"></i>
        </a>
        <a href="Home.php" title="logo estácio">
             <img src="../../img/estacio-logo.png" alt="Logo Estácio">
        </a>
    </header>

    <!-- Conteúdo principal -->
    <main>
        <div class="profile">
            <img src="../../img/imageHomeUser.png" alt="Usuário">
            <h1>Seja Bem-vindo(a) <?php echo $_SESSION['nome'] ?>!</h1>
        </div>

        <div class="cards">
            <a href="cadastro/cadastro-usuario.php" class="card">Cadastrar Usuário</a>
            <a href="cadastro/formulário.php" class="card">Cadastrar Prontuário</a>
            <a href="cadastro/anamnese.php" class="card">ANAMNESE</a>
            <a href="Evolucao.php" class="card">Evolução</a>
        </div>
    </main>

</body>

</html>