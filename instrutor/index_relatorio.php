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
    <link rel="stylesheet" href="../assets/css/relatorios.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="..\assets\img\logourl.png" type="image/x-icon">
</head>
<body>
<a href="home_instrutores.php" class="back-button">
        <i class="fas fa-arrow-left"></i>
    </a>
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
