<?php
session_start();
if (!isset($_SESSION['usuario_id'])) { header("Location: ../login.php"); exit; }
require '../includes/conexao.php';

$sucesso = "";
$erro    = "";

// INSERIR novo serviço
if (isset($_POST['salvar'])) {
    $titulo    = mysqli_real_escape_string($conn, $_POST['titulo']);
    $descricao = mysqli_real_escape_string($conn, $_POST['descricao']);
    $categoria = mysqli_real_escape_string($conn, $_POST['categoria']);
    $query = "INSERT INTO servicos (titulo, descricao, categoria) VALUES ('$titulo','$descricao','$categoria')";
    if (mysqli_query($conn, $query)) { $sucesso = "Serviço adicionado!"; }
    else { $erro = "Erro: " . mysqli_error($conn); }
}

// EXCLUIR serviço
if (isset($_GET['excluir'])) {
    $id = (int) $_GET['excluir'];
    mysqli_query($conn, "DELETE FROM servicos WHERE id = $id");
    header("Location: servicos.php");
    exit;
}

// Busca todos os serviços
$resultado = mysqli_query($conn, "SELECT * FROM servicos");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Serviços | Box 377 Admin</title>
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
            <a href="servicos.php" class="ativo">🔧 Serviços</a>
            <a href="depoimentos.php">💬 Depoimentos</a>
            <a href="mensagens.php">✉ Mensagens</a>
            <a href="../index.php" target="_blank">🌐 Ver Site</a>
            <a href="logout.php" class="logout">🚪 Sair</a>
        </nav>
    </aside>

    <main class="admin-main">

        <header class="admin-header">
            <h2>Serviços</h2>
            <div class="admin-usuario">
                <span>👋 <strong><?php echo htmlspecialchars($_SESSION['usuario_nome']); ?></strong></span>
                <small><?php echo htmlspecialchars($_SESSION['usuario_email']); ?></small>
            </div>
        </header>

        <?php if ($sucesso): echo "<p class='msg-sucesso'>$sucesso</p>"; endif; ?>
        <?php if ($erro):    echo "<p class='msg-erro'>$erro</p>";    endif; ?>

        <!-- Formulário para adicionar novo serviço -->
        <div class="form-admin" style="margin-bottom: 30px;">
            <h3 style="margin-bottom: 16px;">Novo Serviço</h3>
            <form action="" method="post">
                <div class="campo">
                    <label>Título</label>
                    <input type="text" name="titulo" required>
                </div>
                <div class="campo">
                    <label>Categoria</label>
                    <input type="text" name="categoria" placeholder="Ex: SAFETY & PERFORMANCE">
                </div>
                <div class="campo">
                    <label>Descrição</label>
                    <textarea name="descricao" rows="3" style="padding:10px;border:1px solid #ddd;border-radius:4px;font-family:inherit;font-size:0.95rem;" required></textarea>
                </div>
                <div class="form-botoes">
                    <input type="submit" name="salvar" value="ADICIONAR">
                </div>
            </form>
        </div>

        <!-- Listagem de serviços -->
        <table class="tabela-admin">
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Categoria</th>
                    <th>Descrição</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($s = mysqli_fetch_assoc($resultado)): ?>
                <tr>
                    <td><?php echo $s['titulo']; ?></td>
                    <td><?php echo $s['categoria']; ?></td>
                    <td><?php echo mb_strimwidth($s['descricao'], 0, 60, '...'); ?></td>
                    <td class="acoes">
                        <a href="servico-editar.php?id=<?php echo $s['id']; ?>" class="btn-editar">Editar</a>
                        <a href="servicos.php?excluir=<?php echo $s['id']; ?>" class="btn-excluir"
                           onclick="return confirm('Excluir este serviço?')">Excluir</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

    </main>
</div>
</body>
</html>
