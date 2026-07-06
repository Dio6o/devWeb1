<?php
include("../conexao.php");

$acao = $_REQUEST['acao'];

if($acao == "criar") {

    $id = $_POST['id'];
    $nome = $_POST['nome'];
$sigla = $_POST['sigla'];

    if($id == "") {

        $sql = "INSERT INTO estado(nome, sigla)
                VALUES('$nome', '$sigla')";

    } else {

        $sql = "UPDATE estado
                SET nome='$nome',
sigla='$sigla'
                WHERE id=$id";
    }

    $conn->query($sql);

    header("Location: estado_list.php");
}

if($acao == "deletar") {

    $id = $_GET['id'];

    $sql = "DELETE FROM estado WHERE id=$id";

    $conn->query($sql);

    header("Location: estado_list.php");
}
?>
