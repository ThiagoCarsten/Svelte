<?php
session_start();
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/class/user.class.php';

$erro = '';
if ($tipo = 1) {
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $email = trim($_POST['email'] ?? '');
        $senha = trim($_POST['senha'] ?? '');
    
        if (!empty($email) && !empty($senha)) {
            $usuario = usuario::buscarPorEmail($email);
    
            if ($usuario && password_verify($senha, $usuario->getSenha())) {
                $_SESSION['email'] = $usuario->getEmail();
                $_SESSION['nome'] = $usuario->getNome();
                header("Location: public/index.php");
                exit;
            } else {
                $erro = "E-mail ou senha incorretos!";
            }
        } else {
            $erro = "Preencha todos os campos!";
  }     
}elseif ($tipo = 2) {
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $email = trim($_POST['email'] ?? '');
        $senha = trim($_POST['senha'] ?? '');
    
        if (!empty($email) && !empty($senha)) {
            $usuario = usuario::buscarPorEmail($email);
    
            if ($usuario && password_verify($senha, $usuario->getSenha())) {
                $_SESSION['email'] = $usuario->getEmail();
                $_SESSION['nome'] = $usuario->getNome();
                header("Location: admin/index.php");
                exit;
            } else {
                $erro = "E-mail ou senha incorretos!";
            }
        } else {
            $erro = "Preencha todos os campos!";
  }     
}
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login - Mente Misturada</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded-2xl shadow-md w-96">
        <h2 class="text-2xl font-bold text-center mb-6 text-purple-600">Login de Usuário</h2>

        <?php if (!empty($erro)): ?>
            <p class="bg-red-100 text-red-700 p-2 rounded mb-4 text-center"><?= htmlspecialchars($erro) ?></p>
        <?php endif; ?>

        <form method="POST" class="space-y-4">
            <div>
                <label for="email" class="block text-gray-700">E-mail:</label>
                <input type="email" name="email" id="email" required
                       class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-400">
            </div>

            <div>
                <label for="senha" class="block text-gray-700">Senha:</label>
                <input type="password" name="senha" id="senha" required
                       class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-400">
            </div>

            <div>
                <label for="tipo" class="block text-gray-700">Serás administrador ou usuer?:</label>
                <select name="tipo" id="tipo">
                    <option value="0">--selecione--</option>
                    <option value="1">Usuário</option>
                    <option value="2">Administrador</option>
                </select>
            </div>

            <button type="submit"
                    class="w-full bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 rounded-lg transition">
                Entrar
            </button>
        </form>

        <p class="text-center text-gray-600 text-sm mt-4">
            Ainda não tem conta?
            <a href="cadastro.php" class="text-purple-600 hover:underline">Cadastre-se</a>
        </p>
    </div>
</body>
</html>
