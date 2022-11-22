<?php
include "conexao_banco.php";

if(isset($_POST)){
    $id_paciente = $_POST['escolher-paciente'];
    $id_procedimento = $_POST['procedimento'];
    $descricao = $_POST['descricao'];
    $horario = date("Y-m-d H:i", strtotime($_POST['horario']));

    $sql = "INSERT INTO tb_procedimento(descricao, horario, fk_paciente, id_tipo_procedimento)
             VALUES ('{$descricao}', '{$horario}', '{$id_paciente}', '{$id_procedimento}')";
    if ($conecta->query($sql) === TRUE) {
        $conecta->close();
        header("Location: ../pag-novo-procedimentos.php?sucesso");
        exit();
    }
    else{
        $conecta->close();
        header("Location: ../pag-novo-procedimentos.php?erro");
        exit();
    }
}