<?php
session_start();

include 'conexao.php';
include 'validacao.php';


if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Deleta a série do banco de dados
    $stmt = $mysqli->prepare("DELETE FROM series WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo '<script>alert("Série excluída com sucesso!"); window.location.href="lista_series.php";</script>';
    } else {
        echo 'Erro ao excluir série: ' . $stmt->error;
    }

    $stmt->close();
}

$mysqli->close();
?>
