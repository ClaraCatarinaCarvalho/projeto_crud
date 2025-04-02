<?php
// Iniciar sessão
session_start();
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Aluno</title>
</head>
<body>
    <h1>Adicionar Aluno</h1>
    <form method="POST" action="processar_insercao.php">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" required><br>

        <label for="idade">Idade:</label>
        <input type="number" name="idade" required><br>

        <button type="submit">Adicionar</button>
    </form>
    <a href="index.php">Voltar à lista de alunos</a>
</body>
</html>