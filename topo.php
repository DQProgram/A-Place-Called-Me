<header>
    <h1><?php 
    if (session_status() === PHP_SESSION_NONE) {
        session_start(); // Inicia a sessão se ainda não foi iniciada
    }

    $is_admin = false; // Inicializa como false por padrão

    if (isset($_SESSION['email'])) {
        // Sessão do usuário logado
        include "connect.php";
        
        $email_log = $_SESSION['email'];
        
        if ($email_log) {
            $query = "SELECT perfil, capa, Admin FROM tb_user WHERE email = '$email_log'";
            $result = mysqli_query($link, $query);
        
            if ($result && mysqli_num_rows($result) > 0) {
                $user = mysqli_fetch_assoc($result);
                $perfil_log = $user['perfil'];
                $capa_log = $user['capa'];
                $is_admin = $user['Admin'] == 1; // Verificar se o usuário é administrador (Admin = 1)
            } else {
                // Valores padrão se o utilizador não for encontrado
                $perfil_log = "usuario.png";
                $capa_log = "00068.png";
            }
        }
    } else {
        // Valores padrão se o utilizador não estiver autenticado
        $perfil_log = "usuario.png";
        $capa_log = "00068.png";
    } 
?>
</h1>
</header>

<figure id="img_perfil">
    <img src="<?php 
    if ($perfil_log == "usuario.png") {
        echo "imagens/$perfil_log";
    } else {
        echo 'users/'.$email_log.'/'.$perfil_log;
    }
    ?>" id="perfil">

<nav>
    <ul id="foto">
        <li><img src="imagens/cam.png" id="cam">
            <ul id="itens_menu">
                <li><a href="atualiza.php">Atualizar</a></li>
                <?php
                if ($perfil_log != "usuario.png" && $capa_log != "00068.png") {
                ?>
                <li><a href="remover_fotos.php">Remover fotos</a></li>
                <?php } ?>
            </ul>
        </li>
    </ul>
</nav>

<section id="menu_perfil">
    <a href="/admin/comentarios.php">Sobre</a>
    <a href="index.php">Atividades</a>
    <a href="postaguens.php">Posts</a>
    <a href="postagem.php">Nova Postagem</a>
    <?php if ($is_admin): ?>
        <!-- Adiciona a opção de "Admin" somente para administradores -->
        <a href="/admin/admin.php">Admin</a>
    <?php endif; ?>
    <a href="logout.php">Sair</a>

    
</section>
</figure>
