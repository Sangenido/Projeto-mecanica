<?php
session_start();
if (!isset($_SESSION['usuario_id'])) { header("Location: ../login.php"); exit; }
require '../includes/conexao.php';

$id = (int) $_GET['id'];
$resultado = mysqli_query($conn, "SELECT * FROM servicos WHERE id = $id");
$servico = mysqli_fetch_assoc($resultado);

// Se o serviço não existe, volta para a listagem
if (!$servico) {
    header("Location: servicos.php");
    exit;
}

$sucesso = "";

if (isset($_POST['salvar'])) {
    $titulo    = mysqli_real_escape_string($conn, $_POST['titulo']);
    $descricao = mysqli_real_escape_string($conn, $_POST['descricao']);
    $categoria = mysqli_real_escape_string($conn, $_POST['categoria']);
    $query = "UPDATE servicos SET titulo='$titulo', descricao='$descricao', categoria='$categoria' WHERE id=$id";
    if (mysqli_query($conn, $query)) {
        $sucesso = "Serviço atualizado!";
        $resultado = mysqli_query($conn, "SELECT * FROM servicos WHERE id = $id");
        $servico = mysqli_fetch_assoc($resultado);
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Serviço | Box 377 Admin</title>
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
            <h2>Editar Serviço</h2>
        </header>

        <?php if ($sucesso): echo "<p class='msg-sucesso'>$sucesso</p>"; endif; ?>

        <div class="form-admin">
            <form action="" method="post">
                <div class="campo">
                    <label>Título</label>
                    <input type="text" name="titulo" value="<?php echo $servico['titulo']; ?>" required>
                </div>
                <div class="campo">
                    <label>Categoria</label>
                    <input type="text" name="categoria" value="<?php echo $servico['categoria']; ?>">
                </div>
                <div class="campo">
                    <label>Descrição</label>
                    <textarea name="descricao" rows="4" style="padding:10px;border:1px solid #ddd;border-radius:4px;font-family:inherit;font-size:0.95rem;" required><?php echo $servico['descricao']; ?></textarea>
                </div>
                <div class="form-botoes">
                    <input type="submit" name="salvar" value="SALVAR">
                    <a href="servicos.php" class="btn-cancelar">Cancelar</a>
                </div>
            </form>
        </div>
    </main>
</div>
</body>
</html>
