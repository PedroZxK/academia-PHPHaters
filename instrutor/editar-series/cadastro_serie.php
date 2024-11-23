<?php
require_once 'conexao.php';
require_once 'validacao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['nome'], $_POST['descricao'], $_POST['duracao'], $_POST['nivel'])) {
        $nome = $_POST['nome'];
        $descricao = $_POST['descricao'];
        $duracao = $_POST['duracao'];
        $nivel = $_POST['nivel'];

        // Validação dos campos
        if (empty($nome) || empty($descricao) || empty($duracao) || empty($nivel)) {
            echo 'Por favor, preencha todos os campos do formulário.';
            exit();
        }

        // Inserção no banco de dados
        $stmt = $mysqli->prepare("INSERT INTO series_exercicios (nome, descricao, duracao, nivel) VALUES (?, ?, ?, ?)");
        if ($stmt) {
            $stmt->bind_param("ssis", $nome, $descricao, $duracao, $nivel);

            if ($stmt->execute()) {
                echo '<script>alert("Série de Exercícios cadastrada com sucesso!"); window.location.href="lista_series.php";</script>';
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
    <title>Cadastrar Série de Exercícios</title>
</head>
<body>
    <h1>Cadastro de Série de Exercícios</h1>

    <form action="" method="POST">
        <label for="nome">Nome da Série:</label>
        <input type="text" name="nome" required><br>

        <label for="descricao">Descrição:</label>
        <textarea name="descricao" required></textarea><br>

        <label for="duracao">Duração (em minutos):</label>
        <input type="number" name="duracao" required><br>

        <label for="nivel">Nível:</label>
        <select name="nivel" required>
            <option value="Iniciante">Iniciante</option>
            <option value="Intermediário">Intermediário</option>
            <option value="Avançado">Avançado</option>
        </select><br>

        <button type="submit">Cadastrar</button>
    </form>

    <a href="lista_series.php">Voltar para Lista de Séries</a>
</body>
</html>
