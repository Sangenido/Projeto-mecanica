<?php
session_start();
require 'includes/conexao.php';

// Se já está logado, vai direto pro painel
if (isset($_SESSION['usuario_id'])) {
    header("Location: admin/painel.php");
    exit;
}

$erro = "";

// Processa o formulário de login
if (isset($_POST['entrar'])) {
    // mysqli_real_escape_string neutraliza caracteres que poderiam quebrar a query SQL
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $senha = $_POST['senha'];

    // Busca o usuário pelo e-mail
    $query = "SELECT * FROM usuarios WHERE email = '$email'";
    $resultado = mysqli_query($conn, $query);
    $usuario = mysqli_fetch_assoc($resultado);

    // Verifica se o usuário existe e se a senha está correta
    if ($usuario && password_verify($senha, $usuario['senha'])) {
        // Login correto: salva os dados na sessão
        $_SESSION['usuario_id']   = $usuario['id'];
        $_SESSION['usuario_nome'] = $usuario['nome'];
        $_SESSION['usuario_email'] = $usuario['email'];

        header("Location: admin/painel.php");
        exit;
    } else {
        $erro = "E-mail ou senha incorretos.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Box 377 Oficina</title>
    <link rel="stylesheet" href="css/login.css">
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;600;700;800&family=Hanken+Grotesk:wght@400;500;600&display=swap" rel="stylesheet">
</head>
<body>

    <div class="login-container">

        <div class="login-box">

            <div class="login-logo">
                <h1>Box 377</h1>
                <p>Painel Administrativo</p>
            </div>

            <?php if ($erro): ?>
                <p class="login-erro"><?php echo $erro; ?></p>
            <?php endif; ?>

            <form action="" method="post">

                <div class="campo">
                    <label for="email">E-mail</label>
                    <input type="email" id="email" name="email" placeholder="seu@email.com" required>
                </div>

                <div class="campo">
                    <label for="senha">Senha</label>
                    <input type="password" id="senha" name="senha" placeholder="••••••••" required>
                </div>

                <input type="submit" name="entrar" value="ENTRAR">

            </form>

            <a href="index.php" class="voltar">← Voltar ao site</a>

        </div>

    </div>

</body>
</html>
