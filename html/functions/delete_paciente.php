<?php

include "conexao_banco.php";

if (isset($_GET)) {
    $id = $_GET['id'];
    $sql = "DELETE FROM tb_paciente WHERE id_paciente = '{$id}'";
    if ($conecta->query($sql) === TRUE) {
        $conecta->close();
        header("Location: ../pag-pacientes-cadastrados.php?sucesso=delete_paciente");
        exit();
    } else {
        $conecta->close();
        header("Location: ../pag-pacientes-cadastrados.php?erro=delete_paciente_erro");
        exit();
    }
}