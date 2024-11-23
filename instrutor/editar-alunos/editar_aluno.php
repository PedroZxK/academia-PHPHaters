<?php
session_start();

include 'conexao.php';
include 'validacao.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Obtém os dados do aluno a ser editado
    $stmt = $mysqli->prepare("SELECT nome, idade, telefone, email FROM alunos WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($nome, $idade, $telefone, $email);
    
    if ($stmt->fetch()) {
        // Exibe o formulário com os dados atuais do aluno
        echo '<h1>Editar Aluno</h1>';
        echo '<form action="atualizar_aluno.php" method="POST">';
        echo '<input type="hidden" name="id" value="' . $id . '">';
        echo '<label for="nome">Nome:</label>';
        echo '<input type="text" name="nome" value="' . $nome . '" required><br>';
        echo '<label for="idade">Idade:</label>';
        echo '<input type="number" name="idade" value="' . $idade . '" required><br>';
        echo '<label for="telefone">Telefone:</label>';
        echo '<input type="text" name="telefone" value="' . $telefone . '" required><br>';
        echo '<label for="email">Email:</label>';
        echo '<input type="email" name="email" value="' . $email . '" required><br>';
        echo '<button type="submit">Atualizar</button>';
        echo '</form>';
    } else {
        echo 'Aluno não encontrado.';
    }

    $stmt->close();
}

$mysqli->close();
?>
