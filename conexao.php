<?php
// Configurações da conexão com o banco de dados
$servername = "localhost"; // Nome do servidor MySQL
$username = "root";        // Nome do usuário MySQL
$password = "";            // Senha do usuário MySQL
$dbname = "escola";        // Nome do banco de dados

// Criar a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar se ocorreu algum erro na conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
?>