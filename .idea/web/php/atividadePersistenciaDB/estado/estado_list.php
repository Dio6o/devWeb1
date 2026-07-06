<?php
include("../conexao.php");

$sql = "SELECT * FROM estado";
$result = $conn->query($sql);
?>

<h2>estado</h2>

<a href="estado_cad.php">Novo</a>

<table border="1">
<tr>
<th>ID</th>
<th>nome</th><th>sigla</th>
<th>Ações</th>
</tr>

<?php while($row = $result->fetch_assoc()) { ?>

<tr>
<td><?= $row['id'] ?></td>
<td><?= $row['nome'] ?></td><td><?= $row['sigla'] ?></td>

<td>
<a href="estado_cad.php?id=<?= $row['id'] ?>">Editar</a>
<a href="estado_acao.php?acao=deletar&id=<?= $row['id'] ?>">Deletar</a>
</td>
</tr>

<?php } ?>

</table>
