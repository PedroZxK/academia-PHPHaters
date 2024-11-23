<?php
include '../../conexao.php';
include '../../validacao_instrutor.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Deleta a série do banco de dados
    $stmt = $mysqli->prepare("DELETE FROM series_exercicios WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo '<script>alert("Série de Exercícios excluída com sucesso!"); window.location.href="lista_series.php";</script>';
    } else {
        echo 'Erro ao excluir série: ' . $stmt->error;
    }

    $stmt->close();
}

$mysqli->close();
?>
