<?php
include("../conexao.php");

$id = "";
$nome = "";
$sigla = "";

if(isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM estado WHERE id=$id";
    $result = $conn->query($sql);

    $dados = $result->fetch_assoc();

    $nome = $dados['nome'];
$sigla = $dados['sigla'];
}
?>

<form action="estado_acao.php" method="POST">

<input type="hidden" name="id" value="<?= $id ?>">

nome:<br><input type="text" name="nome" value="<?= $nome ?>"><br><br>
sigla:<br><input type="text" name="sigla" value="<?= $sigla ?>"><br><br>


<button type="submit" name="acao" value="criar">Salvar</button>

</form>
