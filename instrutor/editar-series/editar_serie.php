<?php
include '../../conexao.php';
include '../../validacao_instrutor.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Obtém os dados completos da série a ser editada
    $stmt = $mysqli->prepare("SELECT nome, descricao, duracao, nivel FROM series_exercicios WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($nome, $descricao, $duracao, $nivel);
    
    if ($stmt->fetch()) {
        // Exibe o formulário com os dados atuais da série
        echo '<h1>Editar Série de Exercícios</h1>';
        echo '<form action="atualizar_serie.php" method="POST">';
        echo '<input type="hidden" name="id" value="' . $id . '">';

        echo '<label for="nome">Nome da Série:</label>';
        echo '<input type="text" name="nome" value="' . $nome . '" required><br>';

        echo '<label for="descricao">Descrição:</label>';
        echo '<textarea name="descricao" required>' . $descricao . '</textarea><br>';

        echo '<label for="duracao">Duração (em minutos):</label>';
        echo '<input type="number" name="duracao" value="' . $duracao . '" required><br>';

        echo '<label for="nivel">Nível:</label>';
        echo '<select name="nivel" required>';
        echo '<option value="Iniciante"' . ($nivel == 'Iniciante' ? ' selected' : '') . '>Iniciante</option>';
        echo '<option value="Intermediário"' . ($nivel == 'Intermediário' ? ' selected' : '') . '>Intermediário</option>';
        echo '<option value="Avançado"' . ($nivel == 'Avançado' ? ' selected' : '') . '>Avançado</option>';
        echo '</select><br>';

        echo '<button type="submit">Atualizar</button>';
        echo '</form>';
    } else {
        echo 'Série não encontrada.';
    }

    $stmt->close();
}

$mysqli->close();
?>
