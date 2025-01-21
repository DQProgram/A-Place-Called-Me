<?php 
include "connect.php"; 
SESSION_START();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>A place called Me</title>
    <link rel="stylesheet" href="css/loja.css">  
</head>
<body>
    <script src="javascript/loja.js"></script>
    <header>
        <nav>
            <ul>
             <!--<img src="LGO2.png"></a> !-->
             <li><a href="index.php">Home</a></li>
             <li><a href="#chat">Chat</a></li>
             <li><a href="loja.php">Loja</a></li>
             <li><a href="contacts.php" class="active">Contact</a></li>
             <li><a href="https://www.cuf.pt/saude-a-z/sindrome-de-asperger">About</a></li>
             </div>
            </ul>
        </nav>  
    </header>

    <section id="home">
        <h2>Welcome to A place called me</h2>
        <p>Your one-stop destination for all types of questions. Discover, read, and enjoy.</p>
        <p>We hope that you find the information that you seek.</p>
    </section>
    <section id="contact">
        <h2>Contact Us</h2>
        <form action="#" method="post">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            
            <label for="message">Message:</label>
            <textarea id="message" name="message" required></textarea>
            
            <button type="submit">Send</button>
        </form>
        <h3 class="instagram">Or you can contact us on instagram in @A_place_called_me</h3>
    </section>
    
<br>
<br>
<br>
<br>
    <footer>
        <p>&copy; 2024 A Place Called Me. All rights reserved.</p>
    </footer>
</body>
</html>