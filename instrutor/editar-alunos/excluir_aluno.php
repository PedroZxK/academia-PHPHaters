<?php
session_start();

include 'conexao.php';
include 'validacao.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Deleta o aluno do banco de dados
    $stmt = $mysqli->prepare("DELETE FROM alunos WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo '<script>alert("Aluno excluído com sucesso!"); window.location.href="lista_alunos.php";</script>';
    } else {
        echo 'Erro ao excluir aluno: ' . $stmt->error;
    }

    $stmt->close();
}

$mysqli->close();
?>
