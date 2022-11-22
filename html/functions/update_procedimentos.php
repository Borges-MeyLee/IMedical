<?php
include "conexao_banco.php";

if(isset($_POST)){
    $id_procedimento = $_POST['id_procedimento'];
    $id_tipo_procedimento = $_POST['procedimento'];
    $descricao = $_POST['descricao'];
    $horario = date("Y-m-d H:i", strtotime($_POST['horario']));

    $sql = "UPDATE tb_procedimento SET id_tipo_procedimento = '{$id_tipo_procedimento}', descricao = '{$descricao}', 
            horario = '{$horario}' WHERE id_procedimento = '{$id_procedimento}'";
    if($conecta->query($sql) === TRUE){
        $conecta->close();
        header("Location: ../pag-edits-procedimentos.php?id={$id_procedimento}&sucesso");
        exit();

    }
    else{
        $conecta->close();
        header("Location: ../pag-edits-procedimentos.php?id={$id_procedimento}&erro");
        exit();
    }
}
//var_dump($_POST);