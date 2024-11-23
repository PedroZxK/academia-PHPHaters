<?php
session_start();

include 'conexao.php';

// Verifica se o usuário está logado
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: login.php');
    exit();
}

// Verifica se o formulário foi enviado com todos os dados necessários
if (isset($_POST['id']) && isset($_POST['nome']) && isset($_POST['idade']) && isset($_POST['telefone']) && isset($_POST['email'])) {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $idade = $_POST['idade'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];

    // Prepara a consulta para atualizar os dados do aluno
    $stmt = $mysqli->prepare("UPDATE alunos SET nome = ?, idade = ?, telefone = ?, email = ? WHERE id = ?");
    $stmt->bind_param("sisii", $nome, $idade, $telefone, $email, $id);

    if ($stmt->execute()) {
        echo 'Dados do aluno atualizados com sucesso!';
        // Redireciona para uma página de confirmação ou para a lista de alunos
        header('Location: lista_alunos.php');
        exit();
    } else {
        echo 'Erro ao atualizar os dados do aluno.';
    }

    $stmt->close();
} else {
    echo 'Dados incompletos para atualização.';
}

$mysqli->close();
?>
