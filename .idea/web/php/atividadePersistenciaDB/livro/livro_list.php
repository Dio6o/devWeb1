<?php
include("../conexao.php");

$sql = "SELECT * FROM livro";
$result = $conn->query($sql);
?>

<h2>livro</h2>

<a href="livro_cad.php">Novo</a>

<table border="1">
<tr>
<th>ID</th>
<th>nome</th><th>autor</th><th>genero</th><th>descricao</th>
<th>Ações</th>
</tr>

<?php while($row = $result->fetch_assoc()) { ?>

<tr>
<td><?= $row['id'] ?></td>
<td><?= $row['nome'] ?></td><td><?= $row['autor'] ?></td><td><?= $row['genero'] ?></td><td><?= $row['descricao'] ?></td>

<td>
<a href="livro_cad.php?id=<?= $row['id'] ?>">Editar</a>
<a href="livro_acao.php?acao=deletar&id=<?= $row['id'] ?>">Deletar</a>
</td>
</tr>

<?php } ?>

</table>
