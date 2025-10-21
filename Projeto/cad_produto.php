<?php 
require_once(__DIR__ . '/config/database.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'] ?? '';
    $preco = $_POST['preco'] ?? '';
    $descricao = $_POST['descricao'] ?? '';

    $pdo = conectarPDO();
    $sql = "INSERT INTO produto (nome, preco, descricao) VALUES (:nome, :preco, :descricao)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':preco', $preco);
    $stmt->bindParam(':descricao', $descricao);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Erro ao cadastrar produto']);
    }
    exit;
}
?>
<script>
  let nome = '';
  let preco = '';
  let descricao = '';
  let mensagem = '';

  async function cadastrarProduto() {
    const formData = new FormData();
    formData.append('nome', nome);
    formData.append('preco', preco);
    formData.append('descricao', descricao);

    const res = await fetch('/cadastro_produto.php', {
      method: 'POST',
      body: formData
    });

    const data = await res.json();
    if (data.success) {
      mensagem = 'Produto cadastrado com sucesso!';
      nome = preco = descricao = '';
    } else {
      mensagem = data.error || 'Erro ao cadastrar produto.';
    }
  }
</script>

<style>
body {
  background: linear-gradient(135deg, #e0e7ff 0%, #f1f5f9 100%);
  font-family: 'Segoe UI', 'Roboto', Arial, sans-serif;
  margin: 0;
  padding: 0;
}
.cadastro-produto-form {
  background: #fff;
  max-width: 400px;
  margin: 48px auto;
  padding: 32px 24px;
  border-radius: 16px;
  box-shadow: 0 8px 32px rgba(60, 72, 88, 0.12);
  border: 1px solid #e5e7eb;
}
.cadastro-produto-form h1 {
  font-size: 2rem;
  font-weight: 700;
  color: #2563eb;
  margin-bottom: 24px;
  text-align: center;
}
.cadastro-produto-form label {
  display: block;
  font-size: 1rem;
  color: #374151;
  margin-bottom: 6px;
  font-weight: 500;
}
.cadastro-produto-form input,
.cadastro-produto-form textarea {
  width: 100%;
  padding: 10px 12px;
  border: 1px solid #cbd5e1;
  border-radius: 8px;
  font-size: 1rem;
  margin-bottom: 18px;
  background: #f8fafc;
  transition: border-color 0.2s;
}
.cadastro-produto-form input:focus,
.cadastro-produto-form textarea:focus {
  border-color: #2563eb;
  outline: none;
  background: #fff;
}
.cadastro-produto-form button {
  width: 100%;
  background: linear-gradient(90deg, #2563eb 60%, #60a5fa 100%);
  color: #fff;
  font-weight: 600;
  font-size: 1.1rem;
  padding: 12px 0;
  border: none;
  border-radius: 8px;
  cursor: pointer;
  box-shadow: 0 2px 8px rgba(37, 99, 235, 0.08);
  transition: background 0.2s;
}
.cadastro-produto-form button:hover {
  background: linear-gradient(90deg, #1d4ed8 60%, #3b82f6 100%);
}
.cadastro-produto-form .mensagem {
  margin-top: 16px;
  text-align: center;
  font-size: 1rem;
  font-weight: 500;
  color: #059669;
}
.cadastro-produto-form .mensagem.erro {
  color: #dc2626;
}
</style>
<form on:submit|preventDefault={cadastrarProduto} class="bg-white shadow-md rounded px-8 pt-6 pb-8 w-full max-w-md" class="cadastro-produto-form">
  <h1 id="cd1" class="text-2xl font-bold mb-6 text-center text-gray-800">Cadastro de Produto</h1>
  <div class="mb-4">
    <label class="block text-gray-700 text-sm font-bold mb-2">Nome</label>
    <input bind:value={nome} required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring" />
  </div>
  <div class="mb-4">
    <label class="block text-gray-700 text-sm font-bold mb-2">Preço</label>
    <input type="number" step="0.01" bind:value={preco} required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring" />
  </div>
  <div class="mb-6">
    <label class="block text-gray-700 text-sm font-bold mb-2">Descrição</label>
    <textarea bind:value={descricao} class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring"></textarea>
  </div>
  <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:ring">
    Cadastrar
  </button>

    <div class="mt-4 text-center text-green-700"></div>
      
</form>