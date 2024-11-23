<?php
include '../../conexao.php';
include '../../validacao_instrutor.php';

// Consulta para pegar todos os dados dos alunos cadastrados
$sql = "SELECT id, nome, email, data_nascimento, telefone, peso, altura, idade, genero, expectativas FROM alunos";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    // Exibe os dados dos alunos
    echo '<h1>Lista de Alunos</h1>';
    echo '<table border="1">';
    echo '<thead>';
    echo '<tr>';
    echo '<th>ID</th>';
    echo '<th>Nome</th>';
    echo '<th>Email</th>';
    echo '<th>Data de Nascimento</th>';
    echo '<th>Telefone</th>';
    echo '<th>Peso (kg)</th>';
    echo '<th>Altura (cm)</th>';
    echo '<th>Idade</th>';
    echo '<th>Gênero</th>';
    echo '<th>Expectativas</th>';
    echo '<th>Ações</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    // Exibe cada aluno com os dados adicionais
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row['id'] . '</td>';
        echo '<td>' . $row['nome'] . '</td>';
        echo '<td>' . $row['email'] . '</td>';
        echo '<td>' . $row['data_nascimento'] . '</td>';
        echo '<td>' . $row['telefone'] . '</td>';
        echo '<td>' . $row['peso'] . '</td>';
        echo '<td>' . $row['altura'] . '</td>';
        echo '<td>' . $row['idade'] . '</td>';
        echo '<td>' . $row['genero'] . '</td>';
        echo '<td>' . $row['expectativas'] . '</td>';
        echo '<td>';
        // Links para editar ou excluir
        echo '<a href="editar_aluno.php?id=' . $row['id'] . '">Editar</a> | ';
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
<a href="alterar_alunos.php">home alterar alunos</a>
