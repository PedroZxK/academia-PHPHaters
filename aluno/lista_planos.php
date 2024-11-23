<?php

include '../conexao.php';
include '../validacao_aluno.php';
// Consulta para pegar os planos de treino e seus status de conclusão
$sql = "SELECT id, nome, descricao, valor, concluido FROM planos";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    // Exibe os planos de treino
    echo '<h1>Lista de Planos de Treino</h1>';
    echo '<form method="POST" action="marcar_conclusao.php">';
    echo '<table border="1">';
    echo '<thead>';
    echo '<tr>';
    echo '<th>ID</th>';
    echo '<th>Nome</th>';
    echo '<th>Descrição</th>';
    echo '<th>Valor</th>';
    echo '<th>Concluído</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    // Exibe os planos e marca o checkbox se o plano estiver concluído
    while ($row = $result->fetch_assoc()) {
        $checked = $row['concluido'] == 1 ? 'checked' : ''; // Verifica se está concluído
        echo '<tr>';
        echo '<td>' . $row['id'] . '</td>';
        echo '<td>' . $row['nome'] . '</td>';
        echo '<td>' . $row['descricao'] . '</td>';
        echo '<td>' . number_format($row['valor'], 2, ',', '.') . '</td>';
        echo '<td><input type="checkbox" name="concluido[]" value="' . $row['id'] . '" ' . $checked . '></td>';
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';
    echo '<button type="submit">Salvar Alterações</button>';
    echo '</form>';
} else {
    echo 'Não há planos cadastrados.';
}

$mysqli->close();
?>
