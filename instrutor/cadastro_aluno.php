<?php
require_once 'conexao.php';
require_once 'validacao.php';

// Inicia a sessão
session_start();

// Verifica se o usuário está logado e se é instrutor ou administrador
if (!isset($_SESSION['usuario_id']) || !in_array($_SESSION['tipo_usuario'], ['instrutor', 'administrador'])) {
    echo '<script>alert("Acesso restrito! Apenas instrutores e administradores podem acessar esta página.");window.location.href="login.php";</script>';
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['nome'], $_POST['idade'], $_POST['telefone'], $_POST['email'], $_POST['senha'], $_POST['data_nascimento'], $_POST['peso'], $_POST['altura'], $_POST['genero'], $_POST['expectativas'])) {
        $nome = $_POST['nome'];
        $idade = $_POST['idade'];
        $telefone = $_POST['telefone'];
        $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
        $senha = $_POST['senha'];
        $data_nascimento = $_POST['data_nascimento'];
        $peso = $_POST['peso'];
        $altura = $_POST['altura'];
        $genero = $_POST['genero'];
        $expectativas = $_POST['expectativas'];

        // Validando os campos obrigatórios
        if (empty($nome) || empty($idade) || empty($telefone) || empty($email) || empty($senha) || empty($data_nascimento) || empty($peso) || empty($altura) || empty($genero) || empty($expectativas)) {
            echo 'Por favor, preencha todos os campos do formulário.';
            exit();
        }

        // Criptografando a senha
        $senha_criptografada = password_hash($senha, PASSWORD_DEFAULT);

        // Preparando a consulta SQL para inserir os dados na tabela de alunos
        $stmt = $mysqli->prepare("INSERT INTO alunos (nome, idade, telefone, email, senha, data_nascimento, peso, altura, genero, expectativas) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        
        if ($stmt) {
            // Vinculando os parâmetros
            $stmt->bind_param("sissssddss", $nome, $idade, $telefone, $email, $senha_criptografada, $data_nascimento, $peso, $altura, $genero, $expectativas);

            // Executando a consulta
            if ($stmt->execute()) {
                echo '<script>alert("Aluno cadastrado com sucesso!");window.location.href=("lista_alunos.php");</script>';
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
    <title>Cadastrar Aluno</title>
</head>
<body>
    <h1>Cadastro de Aluno</h1>

    <form action="" method="POST">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" required><br>

        <label for="idade">Idade:</label>
        <input type="number" name="idade" required><br>

        <label for="telefone">Telefone:</label>
        <input type="text" name="telefone" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" required><br>

        <label for="senha">Senha:</label>
        <input type="password" name="senha" required><br>

        <label for="data_nascimento">Data de Nascimento:</label>
        <input type="date" name="data_nascimento" required><br>

        <label for="peso">Peso (kg):</label>
        <input type="number" name="peso" step="0.1" required><br>

        <label for="altura">Altura (m):</label>
        <input type="number" name="altura" step="0.01" required><br>

        <label for="genero">Gênero:</label>
        <select name="genero" required>
            <option value="masculino">Masculino</option>
            <option value="feminino">Feminino</option>
            <option value="outro">Outro</option>
        </select><br>

        <label for="expectativas">Expectativas:</label>
        <textarea name="expectativas" required></textarea><br>

        <button type="submit">Cadastrar</button>
    </form>

    <a href="lista_alunos.php">Voltar para Lista de Alunos</a>
</body>
</html>
