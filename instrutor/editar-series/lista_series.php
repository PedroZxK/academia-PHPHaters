<?php
session_start();

include 'conexao.php';
include 'validacao.php';

// Consulta para pegar todas as séries cadastradas
$sql = "SELECT id, nome, descricao, duracao FROM series";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    // Exibe os dados das séries
    echo '<h1>Lista de Séries</h1>';
    echo '<table border="1">';
    echo '<thead>';
    echo '<tr>';
    echo '<th>ID</th>';
    echo '<th>Nome</th>';
    echo '<th>Descrição</th>';
    echo '<th>Duração</th>';
    echo '<th>Ações</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    // Exibe cada série
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row['id'] . '</td>';
        echo '<td>' . $row['nome'] . '</td>';
        echo '<td>' . $row['descricao'] . '</td>';
        echo '<td>' . $row['duracao'] . ' minutos</td>';
        echo '<td>';
        // Links para editar ou excluir
        echo '<a href="editar_serie.php?id=' . $row['id'] . '">Editar</a> | ';
        echo '<a href="excluir_serie.php?id=' . $row['id'] . '" onclick="return confirm(\'Tem certeza que deseja excluir esta série?\')">Excluir</a>';
        echo '</td>';
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';
} else {
    echo 'Não há séries cadastradas.';
}

$mysqli->close();
?>

<!-- Link para adicionar nova série -->
<a href="cadastro_serie.php">Cadastrar Nova Série</a>
