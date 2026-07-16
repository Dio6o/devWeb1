<?php
include("../conexao.php");

$sql = "SELECT * FROM pessoa";
$result = $conn->query($sql);
?>

<h2>pessoa</h2>

<a href="pessoa_cad.php">Novo</a>

<table border="1">
<tr>
<th>ID</th>
<th>nome</th><th>cidade_id</th><th>peso</th><th>altura</th>
<th>Ações</th>
</tr>

<?php while($row = $result->fetch_assoc()) { ?>

<tr>
<td><?= $row['id'] ?></td>
<td><?= $row['nome'] ?></td><td><?= $row['cidade_id'] ?></td><td><?= $row['peso'] ?></td><td><?= $row['altura'] ?></td>

<td>
<a href="pessoa_cad.php?id=<?= $row['id'] ?>">Editar</a>
<a href="pessoa_acao.php?acao=deletar&id=<?= $row['id'] ?>">Deletar</a>
</td>
</tr>

<?php } ?>

</table>
