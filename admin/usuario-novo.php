<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../login.php");
    exit;
}
require '../includes/conexao.php';

$erro  = "";
$sucesso = "";

if (isset($_POST['salvar'])) {
    // mysqli_real_escape_string neutraliza caracteres que poderiam quebrar a query SQL
    $nome  = mysqli_real_escape_string($conn, $_POST['nome']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
    $foto  = NULL;

    // --- UPLOAD DE FOTO ---
    if (!empty($_FILES['foto']['name'])) {
        $nomeArquivo    = $_FILES['foto']['name'];
        $nomeTemporario = $_FILES['foto']['tmp_name'];
        $tamanho        = $_FILES['foto']['size'];
        $tipo           = $_FILES['foto']['type'];
        $errosUpload    = array();

        $tamanhoMaximo   = 1024 * 1024 * 2; // 2MB
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
            // Gera nome único para evitar conflitos
            $novoNome = date("dmY_His") . "_" . $nomeArquivo;
            move_uploaded_file($nomeTemporario, "../uploads/" . $novoNome);
            $foto = $novoNome;
        } else {
            $erro = implode(" ", $errosUpload);
        }
    }

    // Só insere se não houve erro no upload
    if (empty($erro)) {
        $query = "INSERT INTO usuarios (nome, email, senha, foto)
                  VALUES ('$nome', '$email', '$senha', '$foto')";

        if (mysqli_query($conn, $query)) {
            $sucesso = "Usuário cadastrado com sucesso!";
        } else {
            $erro = "Erro ao cadastrar: " . mysqli_error($conn);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Novo Usuário | Box 377 Admin</title>
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
            <h2>Novo Usuário</h2>
            <div class="admin-usuario">
                <span>👋 <strong><?php echo htmlspecialchars($_SESSION['usuario_nome']); ?></strong></span>
                <small><?php echo htmlspecialchars($_SESSION['usuario_email']); ?></small>
            </div>
        </header>

        <?php if ($erro):    echo "<p class='msg-erro'>$erro</p>";    endif; ?>
        <?php if ($sucesso): echo "<p class='msg-sucesso'>$sucesso</p>"; endif; ?>

        <div class="form-admin">

            <!-- enctype obrigatório para upload de arquivo -->
            <form action="" method="post" enctype="multipart/form-data">

                <div class="campo">
                    <label>Nome</label>
                    <input type="text" name="nome" required>
                </div>

                <div class="campo">
                    <label>E-mail</label>
                    <input type="email" name="email" required>
                </div>

                <div class="campo">
                    <label>Senha</label>
                    <input type="password" name="senha" required>
                </div>

                <div class="campo">
                    <label>Foto (PNG, JPG — máx. 2MB)</label>
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
