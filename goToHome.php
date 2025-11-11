<?php
    include('./protect.php');

    $tipo_usuario = $_SESSION['id_tipo_usuario'];

    switch($tipo_usuario) {
        case 1:
            header("Location: ./pages/admin/Home.php");
            break;
        case 2:
            header("Location: ./pages/professor/Home.php");
            break;
        case 3:
            header("Location: ./pages/aluno/Home.php");
            break;
        default:
            header("Location: index.php");
            break;
    }
?>