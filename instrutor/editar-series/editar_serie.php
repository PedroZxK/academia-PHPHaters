<?php
session_start();

include 'conexao.php';
include 'validacao.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Obtém os dados da série a ser editada
    $stmt = $mysqli->prepare("SELECT nome, descricao, duracao FROM series WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($nome, $descricao, $duracao);
    
    if ($stmt->fetch()) {
        // Exibe o formulário com os dados atuais da série
        echo '<h1>Editar Série</h1>';
        echo '<form action="atualizar_serie.php" method="POST">';
        echo '<input type="hidden" name="id" value="' . $id . '">';
        echo '<label for="nome">Nome:</label>';
        echo '<input type="text" name="nome" value="' . $nome . '" required><br>';
        echo '<label for="descricao">Descrição:</label>';
        echo '<textarea name="descricao" required>' . $descricao . '</textarea><br>';
        echo '<label for="duracao">Duração (minutos):</label>';
        echo '<input type="number" name="duracao" value="' . $duracao . '" required><br>';
        echo '<button type="submit">Atualizar</button>';
        echo '</form>';
    } else {
        echo 'Série não encontrada.';
    }

    $stmt->close();
}

$mysqli->close();
?>
