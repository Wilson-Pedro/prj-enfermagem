<?php

session_start();
include("../db/conexao.php");

try {
    if(empty($_POST['matricula']) || empty($_POST['senha'])) {
        $_SESSION['error'] = "Preencha todos os campos";
        header("Location: index.php");
        exit;
    }

    $matricula = trim($_POST['matricula']);
    $senha = trim($_POST['senha']);

    $stmt_login = $mysqli->prepare("SELECT id, id_tipo_usuario, nome, senha FROM tbl_users WHERE matricula = ? LIMIT 1");
    $stmt_login->bind_param("s", $matricula);
    $stmt_login->execute();
    $result_stmt_login = $stmt_login->get_result();

    if($result_stmt_login->num_rows != 1) {
        $_SESSION['error'] = "Matricula ou senha incorretos!";
        header("Location: index.php");
        exit;
    }

    $usuario = $result_stmt_login->fetch_assoc();
    if(!password_verify($senha, $usuario['senha'])) {
        $_SESSION['error'] = "Matricula ou senha incorretos!";
        header("Location: index.php");
        exit;
    }

    $_SESSION['id'] = $usuario['id'];
    $_SESSION['nome'] = $usuario['nome'];
    $_SESSION['id_tipo_usuario'] = $usuario['id_tipo_usuario'];

    switch($usuario['id_tipo_usuario']) {
        case 1:
            header("Location: admin/Home.php");
            break;
        case 2:
            header("Location: professor/Home.php");
            break;
        case 3:
            header("Location: aluno/Home.php");
            break;
        default:
            session_destroy();
            $_SESSION['error'] = "Tipo de usuário inválido!";
            header("Location: index.php");
            break;
    }
    exit;



} catch(Exception $e) {
    error_log("Error no login: ". $e->getMessage());
    $_SESSION['error'] = "Ocorreu um error inesperado. Tente novamente";
    header("Location: index.php");
}