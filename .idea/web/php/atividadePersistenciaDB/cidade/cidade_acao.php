<?php
include("../conexao.php");

$acao = $_REQUEST['acao'];

if($acao == "criar") {

    $id = $_POST['id'];
    $nome = $_POST['nome'];
$estado_id = $_POST['estado_id'];

    if($id == "") {

        $sql = "INSERT INTO cidade(nome, estado_id)
                VALUES('$nome', '$estado_id')";

    } else {

        $sql = "UPDATE cidade
                SET nome='$nome',
estado_id='$estado_id'
                WHERE id=$id";
    }

    $conn->query($sql);

    header("Location: cidade_list.php");
}

if($acao == "deletar") {

    $id = $_GET['id'];

    $sql = "DELETE FROM cidade WHERE id=$id";

    $conn->query($sql);

    header("Location: cidade_list.php");
}
?>
