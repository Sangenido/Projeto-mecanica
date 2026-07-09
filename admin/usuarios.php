<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../login.php");
    exit;
}
require '../includes/conexao.php';

// Mensagem se tentou excluir a própria conta
$erro = "";
if (isset($_GET['erro']) && $_GET['erro'] == 'nao_pode_excluir_proprio') {
    $erro = "Você não pode excluir seu próprio usuário enquanto estiver logado.";
}

// Busca todos os usuários no banco
$query = "SELECT * FROM usuarios";
$resultado = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuários | Box 377 Admin</title>
    <link rel="stylesheet" href="../css/admin.css">
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;600;700;800&family=Hanken+Grotesk:wght@400;500;600&display=swap" rel="stylesheet">
</head>
<body>

<div class="admin-layout">

    <aside class="sidebar">
        <div class="sidebar-logo">
            <h2>Box 377</h2>
            <span>Admin</span>
        </div>
        <nav class="sidebar-nav">
            <a href="painel.php">🏠 Dashboard</a>
            <a href="usuarios.php" class="ativo">👤 Usuários</a>
            <a href="servicos.php">🔧 Serviços</a>
            <a href="depoimentos.php">💬 Depoimentos</a>
            <a href="mensagens.php">✉ Mensagens</a>
            <a href="../index.php" target="_blank">🌐 Ver Site</a>
            <a href="logout.php" class="logout">🚪 Sair</a>
        </nav>
    </aside>

    <main class="admin-main">

        <header class="admin-header">
            <h2>Usuários</h2>
            <div class="admin-usuario">
                <span>👋 <strong><?php echo htmlspecialchars($_SESSION['usuario_nome']); ?></strong></span>
                <small><?php echo htmlspecialchars($_SESSION['usuario_email']); ?></small>
            </div>
        </header>

        <div class="admin-toolbar">
            <a href="usuario-novo.php" class="btn-acao">+ Novo Usuário</a>
        </div>

        <?php if ($erro): echo "<p class='msg-erro'>$erro</p>"; endif; ?>

        <table class="tabela-admin">
            <thead>
                <tr>
                    <th>Foto</th>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($usuario = mysqli_fetch_assoc($resultado)): ?>
                <tr>
                    <td>
                        <?php if ($usuario['foto']): ?>
                            <img src="../uploads/<?php echo $usuario['foto']; ?>" class="foto-lista" alt="Foto">
                        <?php else: ?>
                            <div class="foto-vazia">?</div>
                        <?php endif; ?>
                    </td>
                    <td><?php echo htmlspecialchars($usuario['nome']); ?></td>
                    <td><?php echo htmlspecialchars($usuario['email']); ?></td>
                    <td class="acoes">
                        <a href="usuario-editar.php?id=<?php echo $usuario['id']; ?>" class="btn-editar">Editar</a>
                        <?php if ($usuario['id'] != $_SESSION['usuario_id']): ?>
                        <a href="usuario-excluir.php?id=<?php echo $usuario['id']; ?>" class="btn-excluir"
                           onclick="return confirm('Tem certeza que deseja excluir este usuário?')">Excluir</a>
                        <?php else: ?>
                        <span class="badge-voce">Você</span>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

    </main>

</div>

</body>
</html>
