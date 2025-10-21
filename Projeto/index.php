<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
session_start();
$logado = isset($_SESSION['email']);
if ($logado): 
    echo "<h1>Bem-vindo," . $_SESSION['email'] . "!</h1>"; 
    echo "<p>Você está logado com sucesso.</p>"; 
    echo "<a href='../logout.php'>Sair</a>";
else: //cu
    echo "<h1>Bem-vindo, visitante!</h1>";
    echo "<p>Você ainda não está logado.</p>";
    echo "<a href='../login.php'>Fazer login</a>";
    echo "<a href='../cadastro.php'>Cadastrar-se</a>";
endif

?>
</body>
</html>
