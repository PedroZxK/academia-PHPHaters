<?php
include '../conexao.php';
include '../validacao_aluno.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Aluno</title>
    <link rel="stylesheet" href="..\assets\css\home_alunos.css">
    <link rel="shortcut icon" href="..\assets\img\logourl.png" type="image/x-icon">

</head>
<body>
    <div class="home-container">
        <h1>O que você deseja fazer?</h1>
        <div class="home-links">
            <a class="lista" href="lista_planos.php">Listar Planos</a>
            <a class="sair" href="../logout.php">Sair</a>
        </div>
    </div>
</body>
</html>
