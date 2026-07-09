<?php
session_start();
if (!isset($_SESSION['usuario_id'])) { header("Location: ../login.php"); exit; }
require '../includes/conexao.php';

// Contadores dinâmicos para o dashboard
$totalUsuarios   = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM usuarios"))['total'];
$totalServicos   = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM servicos"))['total'];
$totalMensagens  = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM mensagens"))['total'];
$novasMensagens  = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM mensagens WHERE lida = 0"))['total'];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Painel | Box 377 Admin</title>
    <link rel="stylesheet" href="../css/admin.css">
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;600;700;800&family=Hanken+Grotesk:wght@400;500;600&display=swap" rel="stylesheet">
</head>
<body>
<div class="admin-layout">

    <aside class="sidebar">
        <div class="sidebar-logo"><h2>BOX 377</h2><span>Admin</span></div>
        <nav class="sidebar-nav">
            <a href="painel.php" class="ativo">🏠 Dashboard</a>
            <a href="usuarios.php">👤 Usuários</a>
            <a href="servicos.php">🔧 Serviços</a>
            <a href="depoimentos.php">💬 Depoimentos</a>
            <a href="mensagens.php">✉ Mensagens <?php if ($novasMensagens > 0): ?><span style="background:#e63b2e;color:#fff;border-radius:50%;padding:1px 6px;font-size:0.7rem;"><?php echo $novasMensagens; ?></span><?php endif; ?></a>
            <a href="../index.php" target="_blank">🌐 Ver Site</a>
            <a href="logout.php" class="logout">🚪 Sair</a>
        </nav>
    </aside>

    <main class="admin-main">

        <header class="admin-header">
            <h2>Dashboard</h2>
            <div class="admin-usuario">
                <span>👋 Olá, <strong><?php echo htmlspecialchars($_SESSION['usuario_nome']); ?></strong></span>
                <small><?php echo htmlspecialchars($_SESSION['usuario_email']); ?></small>
            </div>
        </header>

        <!-- Cards com dados reais do banco -->
        <section class="admin-cards">
            <div class="card">
                <h3>Usuários</h3>
                <p class="card-numero"><?php echo $totalUsuarios; ?></p>
                <span>cadastrados</span>
            </div>
            <div class="card">
                <h3>Serviços</h3>
                <p class="card-numero"><?php echo $totalServicos; ?></p>
                <span>disponíveis</span>
            </div>
            <div class="card">
                <h3>Mensagens</h3>
                <p class="card-numero"><?php echo $totalMensagens; ?></p>
                <span><?php echo $novasMensagens; ?> não lida(s)</span>
            </div>
        </section>

        <!-- Dados do usuário logado -->
        <section class="admin-perfil">
            <h3>Seus Dados</h3>
            <table class="tabela-dados">
                <tr><th>Nome</th>  <td><?php echo htmlspecialchars($_SESSION['usuario_nome']); ?></td></tr>
                <tr><th>E-mail</th><td><?php echo htmlspecialchars($_SESSION['usuario_email']); ?></td></tr>
            </table>
        </section>

    </main>
</div>
</body>
</html>
