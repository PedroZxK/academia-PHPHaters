<?php

include '../conexao.php';
include '../validacao_adm.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['nome'], $_POST['senha'], $_POST['telefone'], $_POST['email'], $_POST['data_nascimento'])) {
        $nome = trim($_POST['nome']);
        $senha = password_hash(trim($_POST['senha']), PASSWORD_DEFAULT);  // Criptografando a senha
        $telefone = trim($_POST['telefone']);
        $email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
        $data_nascimento = $_POST['data_nascimento'];

        // Verificação de campos vazios
        if (empty($nome) || empty($senha) || empty($telefone) || empty($email) || empty($data_nascimento)) {
            echo 'Por favor, preencha todos os campos do formulário.';
            exit();
        }

        // Preparação do SQL
        $stmt = $mysqli->prepare("INSERT INTO instrutores (nome, senha, telefone, email, data_nascimento) VALUES (?, ?, ?, ?, ?)");
        if ($stmt) {
            $stmt->bind_param("sssss", $nome, $senha, $telefone, $email, $data_nascimento);

            // Execução da consulta
            if ($stmt->execute()) {
                echo '<script>alert("Instrutor cadastrado com sucesso!"); window.location.href="lista_instrutor.php";</script>';
            } else {
                echo 'Erro ao realizar cadastro: ' . $stmt->error;
            }

            $stmt->close();
        } else {
            echo 'Erro ao preparar a declaração: ' . $mysqli->error;
        }
    } else {
        echo 'Por favor, preencha todos os campos do formulário.';
    }
}

$mysqli->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Instrutor</title>
</head>
<body>
    <h1>Cadastro de Instrutor</h1>

    <form action="" method="POST">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required><br>

        <label for="senha">Senha:</label>
        <input type="password" name="senha" id="senha" required><br>

        <label for="telefone">Telefone:</label>
        <input type="text" name="telefone" id="telefone" required><br>

        <label for="data_nascimento">Data de Nascimento:</label>
        <input type="date" name="data_nascimento" id="data_nascimento" required><br>

        <button type="submit">Cadastrar</button>
    </form>

    <a href="lista_instrutor.php">Voltar para Lista de Instrutores</a>
</body>
</html>
