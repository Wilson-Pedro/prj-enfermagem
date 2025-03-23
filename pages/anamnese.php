<?php
    include('../db/conexao.php');

    try {

        if(isset($_POST['finalizar'])) {
            $motivo_consulta = $_POST['motivo_consulta'];
            $inicio_sintomas = $_POST['inicio_sintomas'];
            $descricao_sintomas = $_POST['descricao_sintomas'];
            $aconteceu_antes = $_POST['aconteceu_antes'];
            $tem_doencas_cronicas = $_POST['doenca_cronica'];
            $doencas_cronicas_descricao = !empty($_POST['doencas_cronicas_descricao']) ? $_POST['doencas_cronicas_descricao']  : 'sem doenças crônicas';
            $tem_alergias = $_POST['alergias'];
            $alergias_descricao = !empty($_POST['alergias_descricao']) ? $_POST['alergias_descricao']  : 'sem alergias';
            $medicamentos = $_POST['medicamentos'];
            $medicamentos_descricao = !empty($_POST['medicamentos_descricao']) ? $_POST['medicamentos_descricao']  : 'não toma medicamentos contínuos';
            $doencas_familiares = $_POST['doencas_familiares'];
            $doencas_familiares_descricao = !empty($_POST['doencas_familiares_descricao']) ? $_POST['doencas_familiares_descricao']  : 'Não tem doenças familiares';
            $fuma = $_POST['fuma'];
            $alcool = $_POST['alcool'];
            $atividade_fisica = $_POST['atividade_fisica'];
    
            $stmt_anamnese = $mysqli->prepare("INSERT INTO tbl_anamnese 
            (id, motivo, inicio_sintoma, descricao_sintoma, ja_aconteceu_antes, tem_doencas_cronicas, doencas_cronicas, tem_alergias, alergias, usa_medicamentos_continuos, medicamentos_continuos, tem_doencas_familia, doencas_familia, fuma, ingere_alcool, atividade_fisica) 
            VALUES (NULL,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
            $stmt_anamnese->bind_param("sssiisisisisiii", 
            $motivo_consulta, $inicio_sintomas, $descricao_sintomas, $aconteceu_antes, $tem_doencas_cronicas, $doencas_cronicas_descricao, 
            $tem_alergias, $alergias_descricao, $medicamentos, $medicamentos_descricao, $doencas_familiares, $doencas_familiares_descricao, 
            $fuma, $alcool, $atividade_fisica);
            $stmt_anamnese->execute();
            $stmt_anamnese->close();

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
    <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/anamnese.css">
    <title>ANAMNESE</title>
</head>
<body>

    <!-- Botão de Voltar -->
    <div class="back-btn">
        <a href="Home.php"><i class="bi bi-arrow-left-circle-fill" id="iconeVoltar"></i></a>
    </div>

    <form method="post" class="container">
        <h2>Anamnese</h2>

        <div class="form-group">
            <label for="motivo-consulta">Motivo da consulta</label>
            <input type="text" id="motivo-consulta" name="motivo_consulta" placeholder="Motivo da consulta" required>
        </div>

        <div class="form-group">
            <label for="inicio-sintomas">Início dos sintomas</label>
            <input type="date" id="inicio-sintomas" name="inicio_sintomas" placeholder="Dia / Mês / Ano" required>
        </div>

        <div class="form-group">
            <label for="descricao-sintomas">Descrição dos sintomas</label>
            <textarea id="descricao-sintomas" name="descricao_sintomas" rows="4" placeholder="Descreva os sintomas..." required></textarea>
        </div>

        <div class="form-group">
            <label>Já aconteceu antes?</label>
            <div class="checkbox-group">
                <input type="radio" id="aconteceu-sim" name="aconteceu_antes" value="1" required>
                <label for="aconteceu-sim">Sim</label>

                <input type="radio" id="aconteceu-nao" name="aconteceu_antes" value="0" style="margin-left: 15px;" required>
                <label for="aconteceu-nao">Não</label>
            </div>
        </div>

        <div class="form-group">
            <label for="doencas-cronicas">Doenças crônicas?</label>
            <div class="checkbox-group">
                <input type="radio" id="doenca-cronica-sim" name="doenca_cronica" value="1" required>
                <label for="doenca-cronica-sim">Sim</label>

                <input type="radio" id="doenca-cronica-nao" name="doenca_cronica" value="0" style="margin-left: 15px;" required>
                <label for="doenca-cronica-nao">Não</label>
            </div>
            <input type="text" id="quais-doencas" name="doencas_cronicas_descricao" placeholder="Se sim, quais?" style="margin-top: 10px;">
        </div>

        <div class="form-group">
            <label for="alergias">Alergias?</label>
            <div class="checkbox-group">
                <input type="radio" id="alergias-sim" name="alergias" value="1" required>
                <label for="alergias-sim">Sim</label>

                <input type="radio" id="alergias-nao" name="alergias" value="0" style="margin-left: 15px;" required>
                <label for="alergias-nao">Não</label>
            </div>
            <input type="text" id="quais-alergias"name="alergias_descricao" placeholder="Se sim, quais?" style="margin-top: 10px;">
        </div>

        <div class="form-group">
            <label for="medicamentos">Medicamentos contínuos?</label>
            <div class="checkbox-group">
                <input type="radio" id="medicamentos-sim" name="medicamentos" value="1" required>
                <label for="medicamentos-sim">Sim</label>

                <input type="radio" id="medicamentos-nao" name="medicamentos" value="0" style="margin-left: 15px;" required>
                <label for="medicamentos-nao">Não</label>
            </div>
            <input type="text" id="quais-medicamentos" name="medicamentos_descricao" placeholder="Se sim, quais?" style="margin-top: 10px;">
        </div>

        <div class="form-group">
            <label for="doencas-familia">Doenças na família?</label>
            <div class="checkbox-group">
                <input type="radio" id="doenca-familia-sim" name="doencas_familiares" value="1" required>
                <label for="doenca-familia-sim">Sim</label>

                <input type="radio" id="doenca-familia-nao" name="doencas_familiares" value="0" style="margin-left: 15px;" required>
                <label for="doenca-familia-nao">Não</label>
            </div>
            <input type="text" id="quais-doencas-familia" name="doencas_familiares_descricao" placeholder="Se sim, quais?" style="margin-top: 10px;">
        </div>

        <div class="form-group">
            <label>Fuma?</label>
            <div class="checkbox-group">
                <input type="radio" id="fuma-sim" name="fuma" value="1" required>
                <label for="fuma-sim">Sim</label>

                <input type="radio" id="fuma-nao" name="fuma" value="0" style="margin-left: 15px;" required>
                <label for="fuma-nao">Não</label>
            </div>
        </div>

        <div class="form-group">
            <label>Ingere álcool?</label>
            <div class="checkbox-group">
                <input type="radio" id="alcohol-sim" name="alcool" value="1" required>
                <label for="alcohol-sim">Sim</label>

                <input type="radio" id="alcohol-nao" name="alcool" value="0" style="margin-left: 15px;" required>
                <label for="alcohol-nao">Não</label>
            </div>
        </div>

        <div class="form-group">
            <label>Pratica atividade física?</label>
            <div class="checkbox-group">
                <input type="radio" id="atividade-fisica-sim" name="atividade_fisica" value="1" required>
                <label for="atividade-fisica-sim">Sim</label>

                <input type="radio" id="atividade-fisica-nao" name="atividade_fisica" value="0" style="margin-left: 15px;" required>
                <label for="atividade-fisica-nao">Não</label>
            </div>
        </div>

        <div class="submit-btn">
            <button type="submit" name="finalizar">Próximo</button>
        </div>

    </form>

</body>
</html>