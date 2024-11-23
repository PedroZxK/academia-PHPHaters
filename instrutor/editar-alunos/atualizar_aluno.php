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
    isset($_POST['idade']) &&
    isset($_POST['telefone']) &&
    isset($_POST['email']) &&
    isset($_POST['data_nascimento']) &&
    isset($_POST['peso']) &&
    isset($_POST['altura']) &&
    isset($_POST['genero']) &&
    isset($_POST['expectativas'])
) {
    // Obtém os dados do formulário
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $idade = $_POST['idade'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $data_nascimento = $_POST['data_nascimento'];
    $peso = $_POST['peso'];
    $altura = $_POST['altura'];
    $genero = $_POST['genero'];
    $expectativas = $_POST['expectativas'];

    // Prepara a consulta para atualizar os dados do aluno
    $stmt = $mysqli->prepare("UPDATE alunos SET nome = ?, idade = ?, telefone = ?, email = ?, data_nascimento = ?, peso = ?, altura = ?, genero = ?, expectativas = ? WHERE id = ?");
    $stmt->bind_param("sisssddssi", $nome, $idade, $telefone, $email, $data_nascimento, $peso, $altura, $genero, $expectativas, $id);

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
