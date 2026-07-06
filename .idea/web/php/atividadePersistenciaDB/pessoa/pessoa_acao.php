<?php
include("../conexao.php");

$acao = $_REQUEST['acao'];

if($acao == "criar") {

    $id = $_POST['id'];
    $nome = $_POST['nome'];
$cidade_id = $_POST['cidade_id'];
$peso = $_POST['peso'];
$altura = $_POST['altura'];

    if($id == "") {

        $sql = "INSERT INTO pessoa(nome, cidade_id, peso, altura)
                VALUES('$nome', '$cidade_id', '$peso', '$altura')";

    } else {

        $sql = "UPDATE pessoa
                SET nome='$nome',
cidade_id='$cidade_id',
peso='$peso',
altura='$altura'
                WHERE id=$id";
    }

    $conn->query($sql);

    header("Location: pessoa_list.php");
}

if($acao == "deletar") {

    $id = $_GET['id'];

    $sql = "DELETE FROM pessoa WHERE id=$id";

    $conn->query($sql);

    header("Location: pessoa_list.php");
}
?>
