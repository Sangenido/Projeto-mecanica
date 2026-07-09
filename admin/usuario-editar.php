<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../login.php");
    exit;
}
require '../includes/conexao.php';

$erro    = "";
$sucesso = "";

// Pega o ID da URL e força que seja um número inteiro (evita injeção de SQL)
$id = (int) $_GET['id'];
$query = "SELECT * FROM usuarios WHERE id = $id";
$resultado = mysqli_query($conn, $query);
$usuario = mysqli_fetch_assoc($resultado);

if (!$usuario) {
    header("Location: usuarios.php");
    exit;
}

if (isset($_POST['salvar'])) {
    // mysqli_real_escape_string neutraliza caracteres que poderiam quebrar a query SQL
    $nome  = mysqli_real_escape_string($conn, $_POST['nome']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $foto  = $usuario['foto']; // mantém a foto atual por padrão

    // --- ATUALIZAÇÃO DE FOTO ---
    if (!empty($_FILES['foto']['name'])) {
        $nomeArquivo    = $_FILES['foto']['name'];
        $nomeTemporario = $_FILES['foto']['tmp_name'];
        $tamanho        = $_FILES['foto']['size'];
        $tipo           = $_FILES['foto']['type'];
        $errosUpload    = array();

        $tamanhoMaximo   = 1024 * 1024 * 2;
        $extsPermitidas  = ["png", "jpg", "jpeg"];
        $typesPermitidos = ["image/png", "image/jpg", "image/jpeg"];

        if ($tamanho > $tamanhoMaximo) {
            $errosUpload[] = "Foto excede 2MB.";
        }

        $extensao = strtolower(pathinfo($nomeArquivo, PATHINFO_EXTENSION));
        if (!in_array($extensao, $extsPermitidas)) {
            $errosUpload[] = "Extensão não permitida.";
        }

        if (!in_array($tipo, $typesPermitidos)) {
            $errosUpload[] = "Tipo de arquivo não permitido.";
        }

        if (empty($errosUpload)) {
            // Garante que a pasta uploads existe
            if (!is_dir("../uploads")) {
                mkdir("../uploads", 0755, true);
            }
            // Remove a foto antiga do servidor antes de salvar a nova
            if ($usuario['foto'] && file_exists("../uploads/" . $usuario['foto'])) {
                unlink("../uploads/" . $usuario['foto']);
            }
            $novoNome = date("dmY_His") . "_" . $nomeArquivo;
            move_uploaded_file($nomeTemporario, "../uploads/" . $novoNome);
            $foto = $novoNome;
        } else {
            $erro = implode(" ", $errosUpload);
        }
    }

    // --- REMOVER FOTO ---
    // Só remove se NÃO foi enviada uma foto nova (senão a nova teria prioridade)
    if (isset($_POST['remover_foto']) && $usuario['foto'] && empty($_FILES['foto']['name'])) {
        if (file_exists("../uploads/" . $usuario['foto'])) {
            unlink("../uploads/" . $usuario['foto']);
        }
        $foto = NULL;
    }

    // Atualiza senha só se foi preenchida
    if (!empty($_POST['senha'])) {
        $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
        $queryUpdate = "UPDATE usuarios SET nome='$nome', email='$email', senha='$senha', foto='$foto' WHERE id=$id";
    } else {
        $queryUpdate = "UPDATE usuarios SET nome='$nome', email='$email', foto='$foto' WHERE id=$id";
    }

    if (empty($erro)) {
        if (mysqli_query($conn, $queryUpdate)) {
            $sucesso = "Usuário atualizado com sucesso!";
            // Recarrega os dados atualizados
            $resultado = mysqli_query($conn, "SELECT * FROM usuarios WHERE id = $id");
            $usuario = mysqli_fetch_assoc($resultado);
        } else {
            $erro = "Erro ao atualizar: " . mysqli_error($conn);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuário | Box 377 Admin</title>
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
            <h2>Editar Usuário</h2>
            <div class="admin-usuario">
                <span>👋 <strong><?php echo htmlspecialchars($_SESSION['usuario_nome']); ?></strong></span>
                <small><?php echo htmlspecialchars($_SESSION['usuario_email']); ?></small>
            </div>
        </header>

        <?php if ($erro):    echo "<p class='msg-erro'>$erro</p>";    endif; ?>
        <?php if ($sucesso): echo "<p class='msg-sucesso'>$sucesso</p>"; endif; ?>

        <div class="form-admin">

            <form action="" method="post" enctype="multipart/form-data">

                <div class="campo">
                    <label>Nome</label>
                    <input type="text" name="nome" value="<?php echo htmlspecialchars($usuario['nome']); ?>" required>
                </div>

                <div class="campo">
                    <label>E-mail</label>
                    <input type="email" name="email" value="<?php echo htmlspecialchars($usuario['email']); ?>" required>
                </div>

                <div class="campo">
                    <label>Nova Senha <small>(deixe em branco para manter a atual)</small></label>
                    <input type="password" name="senha">
                </div>

                <div class="campo">
                    <label>Foto</label>
                    <?php if ($usuario['foto']): ?>
                        <img src="../uploads/<?php echo $usuario['foto']; ?>" class="foto-preview" alt="Foto atual">
                        <label class="campo-checkbox">
                            <input type="checkbox" name="remover_foto"> Remover foto atual
                        </label>
                    <?php endif; ?>
                    <input type="file" name="foto" accept=".png,.jpg,.jpeg">
                </div>

                <div class="form-botoes">
                    <input type="submit" name="salvar" value="SALVAR">
                    <a href="usuarios.php" class="btn-cancelar">Cancelar</a>
                </div>

            </form>

        </div>

    </main>

</div>

</body>
</html>
