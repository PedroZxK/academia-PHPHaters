<?php
include '../../conexao.php';
include '../../validacao_adm.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Deleta o instrutor do banco de dados
    $stmt = $mysqli->prepare("DELETE FROM instrutores WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo '<script>alert("Instrutor excluído com sucesso!"); window.location.href="../lista_instrutor.php";</script>';
    } else {
        echo 'Erro ao excluir instrutor: ' . $stmt->error;
    }

    $stmt->close();
}

$mysqli->close();
?>
