<?php
session_start();

include '../conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Coleta os dados do formulário
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Valida os campos do formulário
    if (empty($email) || empty($password)) {
        echo 'Por favor, preencha todos os campos do formulário.';
        exit();
    } else {
        // Verifica se o email existe na tabela 'alunos'
        $sql = "SELECT id, email, senha FROM alunos WHERE email = ?";
        $stmt = $mysqli->prepare($sql);

        if ($stmt) {
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $stmt->bind_result($id, $dbEmail, $dbPassword);

            // Se o aluno for encontrado e a senha for válida
            if ($stmt->fetch() && password_verify($password, $dbPassword)) {
                // Cria uma sessão para o aluno
                $_SESSION['logged_in'] = true;
                $_SESSION['aluno_id'] = $id;
                $_SESSION['email'] = $email;
                $_SESSION['nome'] = $dbEmail; // Para exibir o nome do aluno (se necessário)

                // Redireciona para a página principal do aluno (exemplo: dashboard)
                header('Location: home_aluno.php');
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
    <title>Login de Aluno</title>
    <link rel="stylesheet" href="..\assets\css\login_alunos.css">
    <link rel="shortcut icon" href="..\assets\img\logourl.png" type="image/x-icon">
</head>
<body>
    <div class="login-container">
        <h1>Login de Aluno</h1>

        <form action="" method="POST" class="login-form">
            <label for="email">Email:</label>
            <input type="email" name="email" required>

            <label for="password">Senha:</label>
            <input type="password" name="password" required>

            <button type="submit">Entrar</button>
        </form>

        <div class="links">
            <a href="recuperar_senha.php">Esqueceu a senha?</a>
        </div>
    </div>
</body>
</html>
