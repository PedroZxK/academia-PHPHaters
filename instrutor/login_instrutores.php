<?php
session_start();

include 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Coleta os dados do formulário
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Valida os campos do formulário
    if (empty($email) || empty($password)) {
        echo 'Por favor, preencha todos os campos do formulário.';
        exit();
    } else {
        // Verifica se o email existe na tabela 'instrutores'
        $sql = "SELECT id, email, password FROM instrutores WHERE email = ?";
        $stmt = $mysqli->prepare($sql);

        if ($stmt) {
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $stmt->bind_result($id, $dbEmail, $dbPassword);

            // Se o instrutor for encontrado e a senha for válida
            if ($stmt->fetch() && password_verify($password, $dbPassword)) {
                // Cria uma sessão para o instrutor
                $_SESSION['logged_in'] = true;
                $_SESSION['instrutor_id'] = $id;
                $_SESSION['email'] = $email;
                $_SESSION['nome'] = $dbEmail; // Para exibir o nome do instrutor (se necessário)

                // Redireciona para a página principal do instrutor (exemplo: dashboard)
                header('Location: instrutor_dashboard.php');
                exit();
            } else {
                echo 'Credenciais incorretas.';
            }
            $stmt->close();
        } else {
            echo 'Erro ao preparar a declaração: ' . $mysqli->error;
        }
    }
}

$mysqli->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login de Instrutor</title>
</head>
<body>
    <h1>Login de Instrutor</h1>

    <form action="" method="POST">
        <label for="email">Email:</label>
        <input type="email" name="email" required><br>

        <label for="password">Senha:</label>
        <input type="password" name="password" required><br>

        <button type="submit">Entrar</button>
    </form>

    <a href="cadastro_instrutor.php">Cadastrar como Instrutor</a>
    <a href="recuperar_senha.php">Esqueceu a senha?</a>
</body>
</html>
