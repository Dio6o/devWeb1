<?php
require "db.php";

$mensagem = "";

// Processa o envio do formulário
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $titulo = trim($_POST["titulo"] ?? "");
    $autorExistente = $_POST["autor_existente"] ?? "";
    $autorNovo = trim($_POST["autor_novo"] ?? "");
    $dataPublicacao = $_POST["data_publicacao"] ?? "";
    $sinopse = trim($_POST["sinopse"] ?? "");

    if ($titulo === "" || $dataPublicacao === "" || ($autorExistente === "" && $autorNovo === "")) {
        $mensagem = "Por favor, preencha todos os campos obrigatórios.";
    } else {
        // Define o autor: usa o existente ou cria um novo
        if ($autorNovo !== "") {
            $stmt = $pdo->prepare("INSERT INTO autores (nome) VALUES (?)");
            $stmt->execute([$autorNovo]);
            $autorId = $pdo->lastInsertId();
        } else {
            $autorId = (int) $autorExistente;
        }

        $stmt = $pdo->prepare(
            "INSERT INTO livros (titulo, autor_id, data_publicacao, sinopse) VALUES (?, ?, ?, ?)"
        );
        $stmt->execute([$titulo, $autorId, $dataPublicacao, $sinopse]);

        $mensagem = "Livro cadastrado com sucesso!";
    }
}

// Busca autores já existentes para popular o select
$autores = $pdo->query("SELECT id, nome FROM autores ORDER BY nome")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Livro - Livraria Online</title>
    <link rel="stylesheet" href="https://unpkg.com/bamboo.css">
</head>

<body>
    <div class="container">
        <?php include "cabecalho.infob" ?>
        <main>
            <section id="cadastro">
                <h1>Cadastrar novo livro</h1>

                <?php if ($mensagem): ?>
                    <p role="alert"><?= htmlspecialchars($mensagem) ?></p>
                <?php endif; ?>

                <form action="cadastrar.php" method="post">
                    <fieldset>
                        <legend>Dados do livro</legend>

                        <label for="titulo">Título *</label>
                        <input type="text" id="titulo" name="titulo" required>

                        <label for="data_publicacao">Data de publicação *</label>
                        <input type="date" id="data_publicacao" name="data_publicacao" required>

                        <label for="sinopse">Sinopse</label>
                        <textarea id="sinopse" name="sinopse" rows="4"></textarea>
                    </fieldset>

                    <fieldset>
                        <legend>Autor</legend>

                        <label for="autor_existente">Selecione um autor já cadastrado</label>
                        <select id="autor_existente" name="autor_existente">
                            <option value="">-- Selecione --</option>
                            <?php foreach ($autores as $autor): ?>
                                <option value="<?= $autor['id'] ?>"><?= htmlspecialchars($autor['nome']) ?></option>
                            <?php endforeach; ?>
                        </select>

                        <p>ou</p>

                        <label for="autor_novo">Cadastre um novo autor</label>
                        <input type="text" id="autor_novo" name="autor_novo" placeholder="Nome do novo autor">
                    </fieldset>

                    <input type="submit" value="Cadastrar livro">
                </form>
            </section>
        </main>
        <?php include "rodape.infob" ?>
    </div>
</body>

</html>
