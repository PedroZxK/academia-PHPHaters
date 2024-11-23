<?php
include '../../conexao.php';
include '../../validacao_instrutor.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Obtém os dados completos do aluno a ser editado
    $stmt = $mysqli->prepare("SELECT nome, idade, telefone, email, data_nascimento, peso, altura, genero, expectativas FROM alunos WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($nome, $idade, $telefone, $email, $data_nascimento, $peso, $altura, $genero, $expectativas);
    
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

        echo '<label for="data_nascimento">Data de Nascimento:</label>';
        echo '<input type="date" name="data_nascimento" value="' . $data_nascimento . '" required><br>';

        echo '<label for="peso">Peso (kg):</label>';
        echo '<input type="number" step="0.1" name="peso" value="' . $peso . '" required><br>';

        echo '<label for="altura">Altura (cm):</label>';
        echo '<input type="number" step="0.1" name="altura" value="' . $altura . '" required><br>';

        echo '<label for="genero">Gênero:</label>';
        echo '<input type="text" name="genero" value="' . $genero . '" required><br>';

        echo '<label for="expectativas">Expectativas:</label>';
        echo '<textarea name="expectativas" required>' . $expectativas . '</textarea><br>';

        echo '<button type="submit">Atualizar</button>';
        echo '</form>';
    } else {
        echo 'Aluno não encontrado.';
    }

    $stmt->close();
}

$mysqli->close();
?>
