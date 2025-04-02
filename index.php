<?php
// Iniciar sessão
session_start();

// Incluir a conexão com o banco de dados
include('conexao.php');

// Consultar os alunos na base de dados
$sql = "SELECT id, nome, email, idade FROM alunos";
$result = $conn->query($sql);

// Criar um array vazio para armazenar os alunos
$alunos = array();

// Verificar se a consulta retornou resultados
if ($result->num_rows > 0) {
    // Adicionar os alunos do banco de dados à lista de alunos
    while ($row = $result->fetch_assoc()) {
        $alunos[] = $row;
    }
} else {
    echo "Nenhum aluno encontrado.";
}

$conn->close(); // Fechar a conexão com o banco de dados
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Alunos</title>
</head>
<body>
    <h1>Lista de Alunos</h1>
    <a href="inserir.php">Adicionar Novo Aluno</a><br><br>

    <?php
    // Verificar se existem alunos
    if (count($alunos) > 0) {
        echo "<table border='1'>
                <tr>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Idade</th>
                    <th>Ações</th>
                </tr>";
        
        // Exibir alunos
        foreach ($alunos as $aluno) {
            echo "<tr>
                    <td>" . $aluno['nome'] . "</td>
                    <td>" . $aluno['email'] . "</td>
                    <td>" . $aluno['idade'] . "</td>
                    <td>
                        <a href='editar.php?id=" . $aluno['id'] . "'>Editar</a> | 
                        <a href='apagar.php?id=" . $aluno['id'] . "'>Apagar</a>
                    </td>
                  </tr>";
        }

        echo "</table>";
    } else {
        echo "Nenhum aluno encontrado.";
    }
    ?>
</body>
</html>
