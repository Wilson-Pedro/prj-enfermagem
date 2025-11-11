<?php
    include('../../protect.php');

    include('../../db/conexao.php');

    try {

        if(isset($_POST['finalizar'])) {
            // ANAMNESE
            $paciente = $_POST['paciente'];

            $motivo_consulta = $_POST['motivo_consulta'];

            $inicio_sintomas = $_POST['inicio_sintomas'];

            $descricao_sintomas = $_POST['descricao_sintomas'];

            $rh = $_POST['rh'];

            $sinais_vitais = $_POST['sinais_vitais'];

            $aconteceu_antes = $_POST['aconteceu_antes'];

            $tem_doencas_cronicas = $_POST['doenca_cronica'];
            $doencas_cronicas_descricao = !empty($_POST['doencas_cronicas_descricao']) ? $_POST['doencas_cronicas_descricao']  : 'sem doenças crônicas';

            $tem_alergias = $_POST['alergias'];
            $alergias_descricao = !empty($_POST['alergias_descricao']) ? $_POST['alergias_descricao']  : 'sem alergias';

            $medicamentos = $_POST['medicamentos'];
            $medicamentos_descricao = !empty($_POST['medicamentos_descricao']) ? $_POST['medicamentos_descricao']  : 'não toma medicamentos contínuos';

            $doencas_familiares = $_POST['doencas_familiares'];
            $doencas_familiares_descricao = !empty($_POST['doencas_familiares_descricao']) ? $_POST['doencas_familiares_descricao']  : 'Não tem doenças familiares';

            $drogas = $_POST['drogas'];
            $drogas_descricao = !empty($_POST['drogas_descricao']) ? $_POST['drogas_descricao']  : 'Não tem doenças familiares';

            $fuma = $_POST['fuma'];

            $alcool = $_POST['alcool'];

            $atividade_fisica = $_POST['atividade_fisica'];
    
            $stmt_anamnese = $mysqli->prepare("INSERT INTO tbl_anamnese 
            (id, id_paciente, motivo, inicio_sintoma, descricao_sintoma, rh, sinais_vitais, ja_aconteceu_antes, tem_doencas_cronicas, doencas_cronicas, tem_alergias, alergias, 
            usa_medicamentos_continuos, medicamentos_continuos, tem_doencas_familia, doencas_familia, outras_drogas, outras_drogas_descricao, 
            fuma, ingere_alcool, atividade_fisica) 
            VALUES (NULL,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
            $stmt_anamnese->bind_param("isssssiisisisisisiii", 
            $paciente, $motivo_consulta, $inicio_sintomas, $descricao_sintomas, $rh, $sinais_vitais, $aconteceu_antes, $tem_doencas_cronicas, $doencas_cronicas_descricao, 
            $tem_alergias, $alergias_descricao, $medicamentos, $medicamentos_descricao, $doencas_familiares, $doencas_familiares_descricao, $drogas, $drogas_descricao,
            $fuma, $alcool, $atividade_fisica);
            $stmt_anamnese->execute();
            $stmt_anamnese->close();

            // EXAME FÍSICO
            $pa = $_POST['pa'];
            $glicemia = $_POST['glicemia'];
            $peso = $_POST['peso'];
            $altura = $_POST['altura'];
            $tipagem_sanguinea = $_POST['tipagem_sanguinea'];

            $stmt_exame_fisico = $mysqli->prepare("INSERT INTO tbl_exame_fisico 
            (id, id_paciente, pa, glicemia, peso, altura, tipagem_sanguinea) 
            VALUES (NULL,?,?,?,?,?,?)");
            $stmt_exame_fisico->bind_param("isssss", $paciente, $pa, $glicemia, $peso, $altura, $tipagem_sanguinea);
            $stmt_exame_fisico->execute();
            $stmt_exame_fisico->close();

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
    <link rel="stylesheet" href="../../css/anamnese.css">
    <title>ANAMNESE</title>
    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #146c8f;
            background: linear-gradient(180deg,rgba(20, 108, 143, 1) 0%, rgba(59, 157, 196, 1) 100%);  
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
        <a href="../../goToHome.php"><i class="bi bi-arrow-left-circle-fill" id="iconeVoltar"></i></a>
    </div>

    <form method="post" class="container">
        <div class="formContainer">
            <h2>Anamnese</h2>
            <div class="form-group">
                <label for="motivo-consulta">Paciente</label>
                <select name="paciente" required>
                    <option value='' disabled selected> </option>
                    <?php
                        $sql_paciente = "SELECT id, nome FROM tbl_paciente";
                        $result_paciente = mysqli_query($mysqli, $sql_paciente);
                        while ($row_paciente = mysqli_fetch_assoc($result_paciente)) {
                    ?>
                            <option value='<?php echo $row_paciente['id'] ?>'> <?php echo $row_paciente['nome'] ?> </option>
                    <?php
                        }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="motivo-consulta">Queixa principal</label>
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
                <label for="rh">RH</label>
                <input type="text" id="rh" name="rh" placeholder="RH" required>
            </div>
            <div class="form-group">
                <label for="sinais-vitais">Sinais Vitais</label>
                <input type="text" id="sinais-vitais" name="sinais_vitais" placeholder="Sinais Vitais" required>
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
                <label for="drogas">Outras drogas?</label>
                <div class="checkbox-group">
                    <input type="radio" id="drogas-sim" name="drogas" value="1" required>
                    <label for="drogas-sim">Sim</label>
                    <input type="radio" id="drogas-nao" name="drogas" value="0" style="margin-left: 15px;" required>
                    <label for="drogas-nao">Não</label>
                </div>
                <input type="text" id="drogas" name="drogas_descricao" placeholder="Se sim, quais?" style="margin-top: 10px;">
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
        </div>

        <div class="formContainer">
            <h2>Exame Físico</h2>

            <div class="form-group">
                <label for="motivo-consulta">PA</label>
                <input type="text" id="pa" name="pa" placeholder="PA" required>
            </div>

            <div class="form-group">
                <label for="inicio-sintomas">Glicemia</label>
                <input type="text" id="glicemia" name="glicemia" placeholder="Glicemia" required>
            </div>

            <div class="form-group">
                <label for="rh">Peso</label>
                <input type="text" id="peso" name="peso" placeholder="Peso" required>
            </div>

            <div class="form-group">
                <label for="sinais-vitais">Altura</label>
                <input type="text" id="altura" name="altura" placeholder="Altura" required>
            </div>

            <div class="form-group">
                <label for="sinais-vitais">Tipagem Sanguínea</label>
                <input type="text" id="tipagem-sanguinea" name="tipagem_sanguinea" placeholder="Tipagem Sanguínea" required>
            </div>
        </div>

        <div class="submit-btn">
            <button type="submit" name="finalizar">Finalizar</button>
        </div>

    </form>

</body>
</html>