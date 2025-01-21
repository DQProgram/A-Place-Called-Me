<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Inicia a sessão se ainda não foi iniciada
}
include "../connect.php";

// Verificar se o usuário logado é um administrador
if (!isset($_SESSION['email']) || $_SESSION['email'] == '' || $_SESSION['is_admin'] != 1) {
    echo "Sessão inválida ou não é admin!";
    var_dump($_SESSION);  // Isso irá mostrar o conteúdo da sessão, para verificar o que está armazenado
    header("Location: ../index.php");
    exit();
}

// Consultar todos os comentários
$query = "SELECT c.id_comentario, c.comentario, c.data_comentario, u.nome AS usuario_nome, p.postagem 
          FROM tb_comentarios c
          JOIN tb_user u ON c.id_user = u.id_user
          JOIN tb_postagens p ON c.id_postagem = p.id_postagem
          ORDER BY c.data_comentario DESC";
$result = mysqli_query($link, $query);
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Gestão de Comentários - Admin</title>
    <link rel="stylesheet" href="styles.css"> <!-- Assumindo que você tem um arquivo CSS para estilo -->
</head>
<body>

<!-- Menu de Navegação -->
<div class="menu">
    <ul>
        <li><a href="admin.php">Usuários</a></li>
        <li><a href="comentarios.php">Comentários</a></li>
        <li><a href="../index.php">Voltar</a></li>
        <li><a href="../logout.php">Sair</a></li>
    </ul>
</div>

<h1>Gestão de Comentários</h1>

<table border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>Comentário</th>
            <th>Data</th>
            <th>Usuário</th>
            <th>Postagem</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($comentario = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $comentario['id_comentario'] . "</td>";
                echo "<td>" . htmlspecialchars($comentario['comentario']) . "</td>";
                echo "<td>" . $comentario['data_comentario'] . "</td>";
                echo "<td>" . $comentario['usuario_nome'] . "</td>";
                echo "<td>" . $comentario['postagem'] . "</td>";
                echo "<td>";
                echo "<a href='editar_comentario.php?id=" . $comentario['id_comentario'] . "'>Editar</a> | ";
                echo "<a href='excluir_comentario.php?id=" . $comentario['id_comentario'] . "' onclick='return confirm(\"Tem certeza que deseja excluir este comentário?\")'>Excluir</a>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>Nenhum comentário encontrado.</td></tr>";
        }
        ?>
    </tbody>
</table>

<style>
/* Estilo básico para o menu */
.menu {
    background-color: #333;
    padding: 10px;
}

.menu ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
}

.menu li {
    display: inline-block;
    margin-right: 15px;
}

.menu li a {
    display: block;
    color: white;
    padding: 10px;
    text-decoration: none;
    text-align: center;
}

.menu li a:hover {
    background-color: #111;
}

</style>
<a href="../index.php">Voltar ao Menu Principal</a>

</body>
</html>
