<?php
session_start();

include 'conexao.php';
include 'validacao.php';

// Consulta para pegar todos os alunos cadastrados
$sql = "SELECT id, nome, idade, telefone, email FROM alunos";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    // Exibe os dados dos alunos
    echo '<h1>Lista de Alunos</h1>';
    echo '<table border="1">';
    echo '<thead>';
    echo '<tr>';
    echo '<th>ID</th>';
    echo '<th>Nome</th>';
    echo '<th>Idade</th>';
    echo '<th>Telefone</th>';
    echo '<th>Email</th>';
    echo '<th>Ações</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    // Exibe cada aluno
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row['id'] . '</td>';
        echo '<td>' . $row['nome'] . '</td>';
        echo '<td>' . $row['idade'] . '</td>';
        echo '<td>' . $row['telefone'] . '</td>';
        echo '<td>' . $row['email'] . '</td>';
        echo '<td>';
        // Links para editar ou excluir
        echo '<a href="editar_aluno.php?id=' . $row['iexd'] . '">Editar</a> | ';
        echo '<a href="excluir_aluno.php?id=' . $row['id'] . '" onclick="return confirm(\'Tem certeza que deseja excluir este aluno?\')">Excluir</a>';
        echo '</td>';
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';
} else {
    echo 'Não há alunos cadastrados.';
}

$mysqli->close();
?>

<!-- Link para adicionar novo aluno -->
<a href="cadastro_aluno.php">Cadastrar Novo Aluno</a>
