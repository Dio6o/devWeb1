<?php
include("../conexao.php");

$id = "";
$nome = "";
$autor = "";
$genero = "";
$descricao = "";

if(isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM livro WHERE id=$id";
    $result = $conn->query($sql);

    $dados = $result->fetch_assoc();

    $nome = $dados['nome'];
$autor = $dados['autor'];
$genero = $dados['genero'];
$descricao = $dados['descricao'];
}
?>

<form action="livro_acao.php" method="POST">

<input type="hidden" name="id" value="<?= $id ?>">

nome:<br><input type="text" name="nome" value="<?= $nome ?>"><br><br>
autor:<br><input type="text" name="autor" value="<?= $autor ?>"><br><br>
genero:<br><input type="text" name="genero" value="<?= $genero ?>"><br><br>
descricao:<br><textarea name="descricao"><?= $descricao ?></textarea><br><br>


<button type="submit" name="acao" value="criar">Salvar</button>

</form>
