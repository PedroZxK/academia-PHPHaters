<?php
include '../conexao.php';
include '../validacao_aluno.php';

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatórios</title>
</head>
<body>
    <h1>Seleção de Relatórios</h1>

    <form action="gerar_relatorio.php" method="GET">
        <label for="tipo_relatorio">Escolha o tipo de relatório:</label>
        <select name="tipo_relatorio" id="tipo_relatorio">
            <option value="presenca">Presença dos Alunos</option>
            <option value="atividades">Atividades Realizadas</option>
            <option value="desempenho">Desempenho dos Alunos</option>
        </select>
        <button type="submit">Gerar Relatório</button>
    </form>
</body>
</html>
