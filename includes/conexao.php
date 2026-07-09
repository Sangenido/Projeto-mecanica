<?php
// Configurações do banco de dados
$host   = "localhost";
$usuario = "root";
$senha  = "";           // padrão XAMPP é sem senha
$banco  = "bd_mecanica";

// Conecta ao banco usando mysqli
$conn = mysqli_connect($host, $usuario, $senha, $banco);

// Verifica se conectou com sucesso
if (!$conn) {
    die("Erro na conexão: " . mysqli_connect_error());
}

// Define o charset para evitar problemas com acentos
mysqli_set_charset($conn, "utf8");
?>
