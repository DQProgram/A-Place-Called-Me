<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Inicia a sessão se ainda não foi iniciada
}
include "connect.php";

// Verificar se o usuário logado é um administrador

if (!isset($_SESSION['email']) || $_SESSION['email'] == '' || $_SESSION['Admin'] != 1) {
    header("Location: index.php"); // Redireciona caso não seja admin
    exit();
}

// Consultar todos os usuários
$query = "SELECT id_user, nome, email, perfil, Admin FROM tb_user";
$result = mysqli_query($link, $query);

?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Gestão de Utilizadores - Admin</title>
    <link rel="stylesheet" href="styles.css"> <!-- Assumindo que você tem um arquivo CSS para estilo -->
</head>
<body>

<h1>Gestão de Utilizadores</h1>

<table border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Perfil</th>
            <th>Admin</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($user = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $user['id_user'] . "</td>";
                echo "<td>" . $user['nome'] . "</td>";
                echo "<td>" . $user['email'] . "</td>";
                echo "<td><img src='users/" . $user['email'] . "/" . $user['perfil'] . "' alt='Perfil' width='50'></td>";
                echo "<td>" . ($user['Admin'] == 1 ? "Sim" : "Não") . "</td>";
                echo "<td>";
                echo "<a href='editar_usuario.php?id=" . $user['id_user'] . "'>Editar</a> | ";
                echo "<a href='excluir_usuario.php?id=" . $user['id_user'] . "' onclick='return confirm(\"Tem certeza que deseja excluir este usuário?\")'>Excluir</a>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>Nenhum usuário encontrado.</td></tr>";
        }
        ?>
    </tbody>
</table>

<a href="topo.php">Voltar ao Menu Principal</a>

</body>
</html>
