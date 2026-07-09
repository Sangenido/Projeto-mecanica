<?php
session_start();
if (!isset($_SESSION['usuario_id'])) { header("Location: ../login.php"); exit; }
require '../includes/conexao.php';

$sucesso = "";

// INSERIR depoimento
if (isset($_POST['salvar'])) {
    $nome    = mysqli_real_escape_string($conn, $_POST['nome']);
    $texto   = mysqli_real_escape_string($conn, $_POST['texto']);
    $cliente = mysqli_real_escape_string($conn, $_POST['cliente']);
    mysqli_query($conn, "INSERT INTO depoimentos (nome, texto, cliente) VALUES ('$nome','$texto','$cliente')");
    $sucesso = "Depoimento adicionado!";
}

// EXCLUIR depoimento
if (isset($_GET['excluir'])) {
    $id = (int) $_GET['excluir'];
    mysqli_query($conn, "DELETE FROM depoimentos WHERE id = $id");
    header("Location: depoimentos.php");
    exit;
}

$resultado = mysqli_query($conn, "SELECT * FROM depoimentos");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Depoimentos | Box 377 Admin</title>
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
            <a href="depoimentos.php" class="ativo">💬 Depoimentos</a>
            <a href="mensagens.php">✉ Mensagens</a>
            <a href="../index.php" target="_blank">🌐 Ver Site</a>
            <a href="logout.php" class="logout">🚪 Sair</a>
        </nav>
    </aside>

    <main class="admin-main">

        <header class="admin-header">
            <h2>Depoimentos</h2>
        </header>

        <?php if ($sucesso): echo "<p class='msg-sucesso'>$sucesso</p>"; endif; ?>

        <!-- Novo depoimento -->
        <div class="form-admin" style="margin-bottom:30px;">
            <h3 style="margin-bottom:16px;">Novo Depoimento</h3>
            <form action="" method="post">
                <div class="campo">
                    <label>Nome do Cliente</label>
                    <input type="text" name="nome" required>
                </div>
                <div class="campo">
                    <label>Identificação (ex: Cliente há 3 anos)</label>
                    <input type="text" name="cliente">
                </div>
                <div class="campo">
                    <label>Depoimento</label>
                    <textarea name="texto" rows="3" style="padding:10px;border:1px solid #ddd;border-radius:4px;font-family:inherit;font-size:0.95rem;" required></textarea>
                </div>
                <div class="form-botoes">
                    <input type="submit" name="salvar" value="ADICIONAR">
                </div>
            </form>
        </div>

        <!-- Listagem -->
        <table class="tabela-admin">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Depoimento</th>
                    <th>Identificação</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($d = mysqli_fetch_assoc($resultado)): ?>
                <tr>
                    <td><?php echo $d['nome']; ?></td>
                    <td><?php echo mb_strimwidth($d['texto'], 0, 70, '...'); ?></td>
                    <td><?php echo $d['cliente']; ?></td>
                    <td class="acoes">
                        <a href="depoimentos.php?excluir=<?php echo $d['id']; ?>" class="btn-excluir"
                           onclick="return confirm('Excluir este depoimento?')">Excluir</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

    </main>
</div>
</body>
</html>
