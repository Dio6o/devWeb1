<?php
include("../conexao.php");

$sql = "SELECT * FROM cidade";
$result = $conn->query($sql);
?>

<h2>cidade</h2>

<a href="cidade_cad.php">Novo</a>

<table border="1">
<tr>
<th>ID</th>
<th>nome</th><th>estado_id</th>
<th>Ações</th>
</tr>

<?php while($row = $result->fetch_assoc()) { ?>

<tr>
<td><?= $row['id'] ?></td>
<td><?= $row['nome'] ?></td><td><?= $row['estado_id'] ?></td>

<td>
<a href="cidade_cad.php?id=<?= $row['id'] ?>">Editar</a>
<a href="cidade_acao.php?acao=deletar&id=<?= $row['id'] ?>">Deletar</a>
</td>
</tr>

<?php } ?>

</table>
