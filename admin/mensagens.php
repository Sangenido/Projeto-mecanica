<?php
session_start();
if (!isset($_SESSION['usuario_id'])) { header("Location: ../login.php"); exit; }
require '../includes/conexao.php';

// Marcar como lida ao abrir o detalhe
if (isset($_GET['ver'])) {
    $id = (int) $_GET['ver'];
    mysqli_query($conn, "UPDATE mensagens SET lida = 1 WHERE id = $id");
}

// Excluir mensagem
if (isset($_GET['excluir'])) {
    $id = (int) $_GET['excluir'];
    mysqli_query($conn, "DELETE FROM mensagens WHERE id = $id");
    header("Location: mensagens.php");
    exit;
}

// Busca mensagem selecionada para exibir o detalhe
$mensagemDetalhe = null;
if (isset($_GET['ver'])) {
    $id = (int) $_GET['ver'];
    $res = mysqli_query($conn, "SELECT * FROM mensagens WHERE id = $id");
    $mensagemDetalhe = mysqli_fetch_assoc($res);
}

// Lista todas as mensagens (não lidas primeiro)
$resultado = mysqli_query($conn, "SELECT * FROM mensagens ORDER BY lida ASC, data_envio DESC");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Mensagens | Box 377 Admin</title>
    <link rel="stylesheet" href="../css/admin.css">
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;600;700;800&family=Hanken+Grotesk:wght@400;500;600&display=swap" rel="stylesheet">
</head>
<body>
<div class="admin-layout">

    <aside class="sidebar">
        <div class="sidebar-logo"><h2>BOX 377</h2><span>Admin</span></div>
        <nav class="sidebar-nav">
            <a href="painel.php">🏠 Dashboard</a>
            <a href="usuarios.php">👤 Usuários</a>
            <a href="servicos.php">🔧 Serviços</a>
            <a href="depoimentos.php">💬 Depoimentos</a>
            <a href="mensagens.php" class="ativo">✉ Mensagens</a>
            <a href="../index.php" target="_blank">🌐 Ver Site</a>
            <a href="logout.php" class="logout">🚪 Sair</a>
        </nav>
    </aside>

    <main class="admin-main">

        <header class="admin-header">
            <h2>Mensagens do Formulário</h2>
        </header>

        <!-- Detalhe da mensagem selecionada -->
        <?php if ($mensagemDetalhe): ?>
        <div class="form-admin" style="margin-bottom:30px;">
            <h3 style="margin-bottom:16px;">Mensagem de: <?php echo htmlspecialchars($mensagemDetalhe['nome']); ?></h3>
            <table class="tabela-dados">
                <tr><th>Nome</th>    <td><?php echo htmlspecialchars($mensagemDetalhe['nome']); ?></td></tr>
                <tr><th>E-mail</th>  <td><?php echo htmlspecialchars($mensagemDetalhe['email']); ?></td></tr>
                <tr><th>Telefone</th><td><?php echo htmlspecialchars($mensagemDetalhe['telefone']); ?></td></tr>
                <tr><th>Data</th>    <td><?php echo date('d/m/Y H:i', strtotime($mensagemDetalhe['data_envio'])); ?></td></tr>
                <tr><th>Mensagem</th><td><?php echo nl2br(htmlspecialchars($mensagemDetalhe['mensagem'])); ?></td></tr>
            </table>
            <div style="margin-top:16px;">
                <a href="mensagens.php" class="btn-cancelar">← Voltar</a>
            </div>
        </div>
        <?php endif; ?>

        <!-- Listagem de mensagens -->
        <table class="tabela-admin">
            <thead>
                <tr>
                    <th>Status</th>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Data</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($m = mysqli_fetch_assoc($resultado)): ?>
                <tr style="<?php echo $m['lida'] == 0 ? 'font-weight:600;' : 'opacity:0.6;'; ?>">
                    <td><?php echo $m['lida'] == 0 ? '🔴 Nova' : '✅ Lida'; ?></td>
                    <td><?php echo htmlspecialchars($m['nome']); ?></td>
                    <td><?php echo htmlspecialchars($m['email']); ?></td>
                    <td><?php echo date('d/m/Y H:i', strtotime($m['data_envio'])); ?></td>
                    <td class="acoes">
                        <a href="mensagens.php?ver=<?php echo $m['id']; ?>" class="btn-editar">Ver</a>
                        <a href="mensagens.php?excluir=<?php echo $m['id']; ?>" class="btn-excluir"
                           onclick="return confirm('Excluir esta mensagem?')">Excluir</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

    </main>
</div>
</body>
</html>
