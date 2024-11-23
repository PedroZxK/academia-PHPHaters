<?php
include '../../conexao.php';
include '../../validacao_instrutor.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['nome'], $_POST['tipo'], $_POST['quantidade'], $_POST['descricao'])) {
        $nome = $_POST['nome'];
        $tipo = $_POST['tipo'];
        $quantidade = $_POST['quantidade'];
        $descricao = $_POST['descricao'];

        if (empty($nome) || empty($tipo) || empty($quantidade) || empty($descricao)) {
            echo 'Por favor, preencha todos os campos do formulário.';
            exit();
        }

        $stmt = $mysqli->prepare("INSERT INTO equipamentos (nome, tipo, quantidade, descricao) VALUES (?, ?, ?, ?)");
        if ($stmt) {
            $stmt->bind_param("ssis", $nome, $tipo, $quantidade, $descricao);

            if ($stmt->execute()) {
                echo '<script>alert("Equipamento cadastrado com sucesso!");window.location.href=("lista_equipamentos.php");</script>';
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
    <title>Cadastrar Equipamento</title>
</head>
<body>
    <h1>Cadastro de Equipamento</h1>

    <form action="" method="POST">
        <label for="nome">Nome do Equipamento:</label>
        <input type="text" name="nome" required><br>

        <label for="tipo">Tipo de Equipamento:</label>
        <input type="text" name="tipo" required><br>

        <label for="quantidade">Quantidade:</label>
        <input type="number" name="quantidade" required><br>

        <label for="descricao">Descrição:</label>
        <textarea name="descricao" required></textarea><br>

        <button type="submit">Cadastrar</button>
    </form>

    <a href="lista_equipamentos.php">Voltar para Lista de Equipamentos</a>
</body>
</html>
