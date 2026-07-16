<?php
require "db.php";

$busca = trim($_GET["busca"] ?? "");

if ($busca !== "") {
    $stmt = $pdo->prepare("
        SELECT livros.id, livros.titulo, livros.data_publicacao, autores.nome AS autor
        FROM livros
        JOIN autores ON livros.autor_id = autores.id
        WHERE livros.titulo LIKE ? OR autores.nome LIKE ?
        ORDER BY livros.titulo
    ");
    $termo = "%$busca%";
    $stmt->execute([$termo, $termo]);
} else {
    $stmt = $pdo->query("
        SELECT livros.id, livros.titulo, livros.data_publicacao, autores.nome AS autor
        FROM livros
        JOIN autores ON livros.autor_id = autores.id
        ORDER BY livros.titulo
    ");
}

$livros = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo - Livraria Online</title>
    <link rel="stylesheet" href="https://unpkg.com/bamboo.css">
</head>

<body>
    <div class="container">
        <?php include "cabecalho.infob" ?>
        <main>
            <section id="catalogo">
                <h1>Catálogo de livros</h1>

                <?php if ($busca !== ""): ?>
                    <p>Resultados para: <strong><?= htmlspecialchars($busca) ?></strong> —
                        <a href="catalogo.php">limpar busca</a></p>
                <?php endif; ?>

                <?php if (empty($livros)): ?>
                    <p>Nenhum livro encontrado.</p>
                <?php else: ?>
                    <table>
                        <thead>
                            <tr>
                                <th>Título</th>
                                <th>Autor</th>
                                <th>Publicação</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($livros as $livro): ?>
                                <tr>
                                    <td><?= htmlspecialchars($livro['titulo']) ?></td>
                                    <td><?= htmlspecialchars($livro['autor']) ?></td>
                                    <td><?= date("d/m/Y", strtotime($livro['data_publicacao'])) ?></td>
                                    <td><a href="livro.php?id=<?= $livro['id'] ?>">ver detalhes</a></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </section>
        </main>
        <?php include "rodape.infob" ?>
    </div>
</body>

</html>
