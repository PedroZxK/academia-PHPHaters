<?php
session_start();

include 'conexao.php';
include '../validacao.php';

// Consulta para pegar todos os planos cadastrados
$sql = "SELECT id, nome, descricao, valor FROM planos";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    // Exibe os dados dos planos
    echo '<h1>Lista de Planos</h1>';
    echo '<table border="1">';
    echo '<thead>';
    echo '<tr>';
    echo '<th>ID</th>';
    echo '<th>Nome</th>';
    echo '<th>Descrição</th>';
    echo '<th>Valor</th>';
    echo '<th>Ações</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    // Exibe cada plano
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row['id'] . '</td>';
        echo '<td>' . $row['nome'] . '</td>';
        echo '<td>' . $row['descricao'] . '</td>';
        echo '<td>' . number_format($row['valor'], 2, ',', '.') . '</td>';
        echo '<td>';
        // Links para editar ou excluir
        echo '<a href="editar_plano.php?id=' . $row['id'] . '">Editar</a> | ';
        echo '<a href="excluir_plano.php?id=' . $row['id'] . '" onclick="return confirm(\'Tem certeza que deseja excluir este plano?\')">Excluir</a>';
        echo '</td>';
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';
} else {
    echo 'Não há planos cadastrados.';
}

$mysqli->close();
?>