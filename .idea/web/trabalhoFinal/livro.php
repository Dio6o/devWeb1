<?php
require "db.php";

$id = (int) ($_GET["id"] ?? 0);

$stmt = $pdo->prepare("
    SELECT livros.titulo, livros.sinopse, livros.data_publicacao, autores.nome AS autor
    FROM livros
    JOIN autores ON livros.autor_id = autores.id
    WHERE livros.id = ?
");
$stmt->execute([$id]);
$livro = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $livro ? htmlspecialchars($livro['titulo']) : "Livro não encontrado" ?> - Livraria Online</title>
    <link rel="stylesheet" href="https://unpkg.com/bamboo.css">
</head>

<body>
    <div class="container">
        <?php include "cabecalho.infob" ?>
        <main>
            <section id="detalhe-livro">
                <?php if (!$livro): ?>
                    <h1>Livro não encontrado</h1>
                    <p><a href="catalogo.php">Voltar ao catálogo</a></p>
                <?php else: ?>
                    <article>
                        <h1><?= htmlspecialchars($livro['titulo']) ?></h1>
                        <p><strong>Autor:</strong> <?= htmlspecialchars($livro['autor']) ?></p>
                        <p><strong>Data de publicação:</strong>
                            <?= date("d/m/Y", strtotime($livro['data_publicacao'])) ?></p>
                        <p><?= nl2br(htmlspecialchars($livro['sinopse'] ?? "Sem sinopse cadastrada.")) ?></p>
                        <p><a href="catalogo.php">Voltar ao catálogo</a></p>
                    </article>
                <?php endif; ?>
            </section>
        </main>
        <?php include "rodape.infob" ?>
    </div>
</body>

</html>
