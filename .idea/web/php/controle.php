<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <?php include "cabecalho.infob"; ?>

    <main>
        <section id="banner">
            <img src="img/banner.jpg" alt="banner">
        </section>

        <section id="destaques">
            <?php destaque("Destaque 1", "img/d1.jpg", "Texto do destaque 1."); ?>
            <?php destaque("Destaque 2", "img/d2.jpg", "Texto do destaque 2."); ?>
            <?php destaque("Destaque 3", "img/d3.jpg", "Texto do destaque 3."); ?>
        </section>

        <section id="noticias">
            <?php noticia("Noticia 1", "Texto da noticia 1.", "noticia1.php"); ?>
            <?php noticia("Noticia 2", "Texto da noticia 2.", "noticia2.php"); ?>
        </section>
    </main>

    <?php include "rodape.infob"; ?>
</div>
</body>
</html>

<?php
function destaque($titulo, $img, $texto) {
    echo "<div class='destaque_item'>";
    echo "<h2>$titulo</h2>";
    echo "<img src='$img' alt='$titulo' width='50' height='50'>";
    echo "<p>$texto</p>";
    echo "</div>";
}

function noticia($titulo, $texto, $link) {
    echo "<article class='noticia_item'>";
    echo "<h2>$titulo</h2>";
    echo "<p>$texto</p>";
    echo "<a href='$link'>leia mais</a>";
    echo "</article>";
}
?>
