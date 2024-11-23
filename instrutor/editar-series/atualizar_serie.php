<?php
include '../../conexao.php';
include '../../validacao_instrutor.php';

// Verifica se o usuário está logado
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: login.php');
    exit();
}

// Verifica se o formulário foi enviado com todos os dados necessários
if (
    isset($_POST['id']) &&
    isset($_POST['nome']) &&
    isset($_POST['descricao']) &&
    isset($_POST['duracao']) &&
    isset($_POST['nivel'])
) {
    // Obtém os dados do formulário
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $duracao = $_POST['duracao'];
    $nivel = $_POST['nivel'];

    // Prepara a consulta para atualizar os dados da série
    $stmt = $mysqli->prepare("UPDATE series_exercicios SET nome = ?, descricao = ?, duracao = ?, nivel = ? WHERE id = ?");
    $stmt->bind_param("ssisi", $nome, $descricao, $duracao, $nivel, $id);

    if ($stmt->execute()) {
        echo 'Dados da série atualizados com sucesso!';
        // Redireciona para a lista de séries
        header('Location: lista_series.php');
        exit();
    } else {
        echo 'Erro ao atualizar os dados da série.';
    }

    $stmt->close();
} else {
    echo 'Dados incompletos para atualização.';
}

$mysqli->close();
?>
