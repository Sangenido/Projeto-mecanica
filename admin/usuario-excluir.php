<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../login.php");
    exit;
}
require '../includes/conexao.php';

// Força que o ID seja um número inteiro (evita injeção de SQL)
$id = (int) $_GET['id'];

// Impede que o usuário logado exclua a própria conta
if ($id == $_SESSION['usuario_id']) {
    header("Location: usuarios.php?erro=nao_pode_excluir_proprio");
    exit;
}

// Busca a foto do usuário antes de excluir
$query = "SELECT foto FROM usuarios WHERE id = $id";
$resultado = mysqli_query($conn, $query);
$usuario = mysqli_fetch_assoc($resultado);

// Se o usuário não existe, volta para a listagem
if (!$usuario) {
    header("Location: usuarios.php");
    exit;
}

// Remove a foto do servidor se existir
if ($usuario['foto'] && file_exists("../uploads/" . $usuario['foto'])) {
    unlink("../uploads/" . $usuario['foto']);
}

// Exclui o usuário do banco
$queryExcluir = "DELETE FROM usuarios WHERE id = $id";
mysqli_query($conn, $queryExcluir);

// Volta para a listagem
header("Location: usuarios.php");
exit;
?>
