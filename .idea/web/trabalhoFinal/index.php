<?php
require "db.php";

// Busca os 3 livros mais recentes para exibir em destaque
$stmt = $pdo->query("
    SELECT livros.id, livros.titulo, livros.sinopse, autores.nome AS autor
    FROM livros
    JOIN autores ON livros.autor_id = autores.id
    ORDER BY livros.criado_em DESC
    LIMIT 3
");
$destaques = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livraria Online</title>
    <link rel="stylesheet" href="https://unpkg.com/bamboo.css">
</head>

<body>
    <div class="container">
        <?php include "cabecalho.infob" ?>
        <main>

            <section id="banner">
                <img src="#" alt="Banner da livraria" width="1000" height="100">
            </section>

            <section id="destaques">
                <h1>Livros em destaque</h1>
                <?php if (empty($destaques)): ?>
                    <p>Nenhum livro cadastrado ainda. <a href="cadastrar.php">Cadastre o primeiro!</a></p>
                <?php else: ?>
                    <?php foreach ($destaques as $livro): ?>
                        <article class="destaque_item">
                            <h2><?= htmlspecialchars($livro['titulo']) ?></h2>
                            <img src="#" alt="Capa do livro <?= htmlspecialchars($livro['titulo']) ?>" width="50" height="50">
                            <span>
                                <p><strong>Autor:</strong> <?= htmlspecialchars($livro['autor']) ?></p>
                                <p><?= htmlspecialchars(mb_strimwidth($livro['sinopse'] ?? '', 0, 180, '...')) ?></p>
                            </span>
                            <a href="livro.php?id=<?= $livro['id'] ?>">leia mais</a>
                        </article>
                    <?php endforeach; ?>
                <?php endif; ?>
            </section>

            <section id="chamada">
                <article>
                    <h2>Explore nosso catálogo completo</h2>
                    <p>Confira todos os livros e autores cadastrados no nosso acervo.</p>
                    <a href="catalogo.php">Ver catálogo</a>
                </article>
                <article>
                    <h2>Cadastre um novo livro</h2>
                    <p>Adicione um novo título e autor ao nosso acervo digital.</p>
                    <a href="cadastrar.php">Cadastrar</a>
                </article>
            </section>

        </main>
        <?php include "rodape.infob" ?>
    </div>
</body>

</html>
