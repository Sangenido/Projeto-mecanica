<?php
session_start();

// Destrói todos os dados da sessão
session_destroy();

// Redireciona para o login
header("Location: ../login.php");
exit;
?>
