<?php
include("../conexao.php");

$acao = $_REQUEST['acao'];

if($acao == "criar") {

    $id = $_POST['id'];
    $nome = $_POST['nome'];
$autor = $_POST['autor'];
$genero = $_POST['genero'];
$descricao = $_POST['descricao'];

    if($id == "") {

        $sql = "INSERT INTO livro(nome, autor, genero, descricao)
                VALUES('$nome', '$autor', '$genero', '$descricao')";

    } else {

        $sql = "UPDATE livro
                SET nome='$nome',
autor='$autor',
genero='$genero',
descricao='$descricao'
                WHERE id=$id";
    }

    $conn->query($sql);

    header("Location: livro_list.php");
}

if($acao == "deletar") {

    $id = $_GET['id'];

    $sql = "DELETE FROM livro WHERE id=$id";

    $conn->query($sql);

    header("Location: livro_list.php");
}
?>
