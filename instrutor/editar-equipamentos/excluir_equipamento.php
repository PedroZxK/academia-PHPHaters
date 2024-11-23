<?php
session_start();

include 'conexao.php';
include 'validacao.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Deleta o equipamento do banco de dados
    $stmt = $mysqli->prepare("DELETE FROM equipamentos WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo '<script>alert("Equipamento excluído com sucesso!"); window.location.href="lista_equipamentos.php";</script>';
    } else {
        echo 'Erro ao excluir equipamento: ' . $stmt->error;
    }

    $stmt->close();
}

$mysqli->close();
?>
