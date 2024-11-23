<?php
session_start();

include 'conexao.php';
include 'validacao.php';


// Consulta para pegar todos os equipamentos cadastrados
$sql = "SELECT id, nome, tipo, descricao, data_aquisicao FROM equipamentos";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    // Exibe os dados dos equipamentos
    echo '<h1>Lista de Equipamentos</h1>';
    echo '<table border="1">';
    echo '<thead>';
    echo '<tr>';
    echo '<th>ID</th>';
    echo '<th>Nome</th>';
    echo '<th>Tipo</th>';
    echo '<th>Descrição</th>';
    echo '<th>Data de Aquisição</th>';
    echo '<th>Ações</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    // Exibe cada equipamento
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row['id'] . '</td>';
        echo '<td>' . $row['nome'] . '</td>';
        echo '<td>' . $row['tipo'] . '</td>';
        echo '<td>' . $row['descricao'] . '</td>';
        echo '<td>' . $row['data_aquisicao'] . '</td>';
        echo '<td>';
        // Links para editar ou excluir
        echo '<a href="editar_equipamento.php?id=' . $row['id'] . '">Editar</a> | ';
        echo '<a href="excluir_equipamento.php?id=' . $row['id'] . '" onclick="return confirm(\'Tem certeza que deseja excluir este equipamento?\')">Excluir</a>';
        echo '</td>';
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';
} else {
    echo 'Não há equipamentos cadastrados.';
}

$mysqli->close();
?>

<!-- Link para adicionar novo equipamento -->
<a href="cadastro_equipamento.php">Cadastrar Novo Equipamento</a>
