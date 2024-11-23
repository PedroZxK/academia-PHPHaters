<?php
session_start();

include 'conexao.php';
include 'validacao.php';


if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Obtém os dados do equipamento a ser editado
    $stmt = $mysqli->prepare("SELECT nome, tipo, descricao, data_aquisicao FROM equipamentos WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($nome, $tipo, $descricao, $data_aquisicao);
    
    if ($stmt->fetch()) {
        // Exibe o formulário com os dados atuais do equipamento
        echo '<h1>Editar Equipamento</h1>';
        echo '<form action="atualizar_equipamento.php" method="POST">';
        echo '<input type="hidden" name="id" value="' . $id . '">';
        echo '<label for="nome">Nome:</label>';
        echo '<input type="text" name="nome" value="' . $nome . '" required><br>';
        echo '<label for="tipo">Tipo:</label>';
        echo '<input type="text" name="tipo" value="' . $tipo . '" required><br>';
        echo '<label for="descricao">Descrição:</label>';
        echo '<textarea name="descricao" required>' . $descricao . '</textarea><br>';
        echo '<label for="data_aquisicao">Data de Aquisição:</label>';
        echo '<input type="date" name="data_aquisicao" value="' . $data_aquisicao . '" required><br>';
        echo '<button type="submit">Atualizar</button>';
        echo '</form>';
    } else {
        echo 'Equipamento não encontrado.';
    }

    $stmt->close();
}

$mysqli->close();
?>
