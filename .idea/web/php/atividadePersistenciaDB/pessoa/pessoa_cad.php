<?php
include("../conexao.php");

$id = "";
$nome = "";
$cidade_id = "";
$peso = "";
$altura = "";

if(isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM pessoa WHERE id=$id";
    $result = $conn->query($sql);

    $dados = $result->fetch_assoc();

    $nome = $dados['nome'];
$cidade_id = $dados['cidade_id'];
$peso = $dados['peso'];
$altura = $dados['altura'];
}
?>

<form action="pessoa_acao.php" method="POST">

<input type="hidden" name="id" value="<?= $id ?>">

nome:<br><input type="text" name="nome" value="<?= $nome ?>"><br><br>
cidade_id:<br><input type="text" name="cidade_id" value="<?= $cidade_id ?>"><br><br>
peso:<br><input type="text" name="peso" value="<?= $peso ?>"><br><br>
altura:<br><input type="text" name="altura" value="<?= $altura ?>"><br><br>


<button type="submit" name="acao" value="criar">Salvar</button>

</form>
