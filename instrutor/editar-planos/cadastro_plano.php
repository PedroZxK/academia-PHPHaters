<?php
require_once 'conexao.php';
require_once 'validacao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['nome'], $_POST['descricao'], $_POST['preco'], $_POST['duracao'])) {
        $nome = $_POST['nome'];
        $descricao = $_POST['descricao'];
        $preco = $_POST['preco'];
        $duracao = $_POST['duracao'];

        if (empty($nome) || empty($descricao) || empty($preco) || empty($duracao)) {
            echo 'Por favor, preencha todos os campos do formulário.';
            exit();
        }

        // Prepara a instrução SQL para inserir os dados na tabela 'planos'
        $stmt = $mysqli->prepare("INSERT INTO planos (nome, descricao, preco, duracao) VALUES (?, ?, ?, ?)");
        if ($stmt) {
            $stmt->bind_param("ssis", $nome, $descricao, $preco, $duracao);

            if ($stmt->execute()) {
                echo '<script>alert("Plano cadastrado com sucesso!");window.location.href=("lista_planos.php");</script>';
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
    <title>Cadastrar Plano</title>
</head>
<body>
    <h1>Cadastro de Plano</h1>

    <form action="" method="POST">
        <label for="nome">Nome do Plano:</label>
        <input type="text" name="nome" required><br>

        <label for="descricao">Descrição:</label>
        <textarea name="descricao" required></textarea><br>

        <label for="preco">Preço (R$):</label>
        <input type="text" name="preco" required><br>

        <label for="duracao">Duração (em meses):</label>
        <input type="number" name="duracao" required><br>

        <button type="submit">Cadastrar</button>
    </form>

    <a href="lista_planos.php">Voltar para Lista de Planos</a>
</body>
</html>
