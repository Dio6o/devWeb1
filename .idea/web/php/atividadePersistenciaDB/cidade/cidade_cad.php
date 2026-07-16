<?php
include("../conexao.php");

$id = "";
$nome = "";
$estado_id = "";

if(isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM cidade WHERE id=$id";
    $result = $conn->query($sql);

    $dados = $result->fetch_assoc();

    $nome = $dados['nome'];
$estado_id = $dados['estado_id'];
}
?>

<form action="cidade_acao.php" method="POST">

<input type="hidden" name="id" value="<?= $id ?>">

nome:<br><input type="text" name="nome" value="<?= $nome ?>"><br><br>
estado_id:<br><input type="text" name="estado_id" value="<?= $estado_id ?>"><br><br>


<button type="submit" name="acao" value="criar">Salvar</button>

</form>
