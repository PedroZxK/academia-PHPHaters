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
    isset($_POST['tipo']) &&
    isset($_POST['quantidade']) &&
    isset($_POST['descricao'])
) {
    // Obtém os dados do formulário
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $tipo = $_POST['tipo'];
    $quantidade = $_POST['quantidade'];
    $descricao = $_POST['descricao'];

    // Prepara a consulta para atualizar os dados do equipamento
    $stmt = $mysqli->prepare("UPDATE equipamentos SET nome = ?, tipo = ?, quantidade = ?, descricao = ? WHERE id = ?");
    $stmt->bind_param("ssisi", $nome, $tipo, $quantidade, $descricao, $id);

    if ($stmt->execute()) {
        echo 'Dados do equipamento atualizados com sucesso!';
        // Redireciona para uma página de confirmação ou para a lista de equipamentos
        header('Location: lista_equipamentos.php');
        exit();
    } else {
        echo 'Erro ao atualizar os dados do equipamento.';
    }

    $stmt->close();
} else {
    echo 'Dados incompletos para atualização.';
}

$mysqli->close();
?>
