<?php
session_start();

include 'conexao.php';
include 'validacao.php';


if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Obtém os dados do plano a ser editado
    $stmt = $mysqli->prepare("SELECT nome, descricao, valor FROM planos WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($nome, $descricao, $valor);
    
    if ($stmt->fetch()) {
        // Exibe o formulário com os dados atuais do plano
        echo '<h1>Editar Plano</h1>';
        echo '<form action="atualizar_plano.php" method="POST">';
        echo '<input type="hidden" name="id" value="' . $id . '">';
        echo '<label for="nome">Nome:</label>';
        echo '<input type="text" name="nome" value="' . $nome . '" required><br>';
        echo '<label for="descricao">Descrição:</label>';
        echo '<textarea name="descricao" required>' . $descricao . '</textarea><br>';
        echo '<label for="valor">Valor:</label>';
        echo '<input type="text" name="valor" value="' . number_format($valor, 2, ',', '.') . '" required><br>';
        echo '<button type="submit">Atualizar</button>';
        echo '</form>';
    } else {
        echo 'Plano não encontrado.';
    }

    $stmt->close();
}

$mysqli->close();
?>
