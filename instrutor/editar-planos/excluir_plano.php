<?php
session_start();

include 'conexao.php';
include 'validacao.php';


if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Deleta o plano do banco de dados
    $stmt = $mysqli->prepare("DELETE FROM planos WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo '<script>alert("Plano excluído com sucesso!"); window.location.href="lista_planos.php";</script>';
    } else {
        echo 'Erro ao excluir plano: ' . $stmt->error;
    }

    $stmt->close();
}

$mysqli->close();
?>
