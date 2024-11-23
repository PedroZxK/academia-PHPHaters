<?php
include '../conexao.php';
include '../validacao_instrutor.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Instrutor</title>
    <link rel="stylesheet" href="../assets/css/home_instrutor.css"> <!-- Referência ao CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="..\assets\img\logourl.png" type="image/x-icon">
</head>
<body>
    <div class="container">
        <h1>Bem-vindo, Instrutor!</h1>
        <p>O que você deseja fazer?</p>
        <div class="menu">
            <a class="btn" href="editar-alunos/alterar_alunos.php">Alteração dos Alunos</a>
            <a class="btn"href="editar-equipamentos/alterar_equipamentos.php">Alteração dos Equipamentos</a>
            <a class="btn"href="editar-series/alterar_series.php">Alteração das Séries</a>
            <a class="btn"href="dashboard_analitico.php">Dashboard Analítico</a>
            <a class="btn"  href="index_relatorio.php">Gerar Relatório</a>
            <a href="../logout.php" class="logout">Sair</a>
        </div>
    </div>
</body>
</html>
