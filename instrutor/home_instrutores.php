<?php
include '../conexao.php';
include '../validacao_instrutor.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login instrutor</title>
</head>
<body>

<h1>O que voce deseja fazer</h1>
    <a href="editar-alunos/alterar_alunos.php">alteração dos alunos</a>
    <a href="editar-equipamentos/alterar_equipamentos.php">alteração dos equipamentos</a>
    <a href="editar-series/alterar_series.php">alteração das series</a>
    <a href="dashboard_analitico.php">dashboard analitico</a>
    <a href="gerar_relatorio.php">gerar relatorio</a>
    <a href="../logout.php">sair</a>
</body>
</html>