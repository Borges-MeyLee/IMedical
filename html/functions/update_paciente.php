<?php
include "conexao_banco.php";

if(isset($_POST)) {
    $id_paciente = $_POST['id_paciente'];
    $nome_paciente = $_POST['nome_paciente'];
    $dt_nascimento = $_POST['dt_nascimento'];
    $email_paciente = $_POST['email'];
    $endereco_paciente = $_POST['endereco'];
    $celular_paciente = $_POST['celular'];
    $observacao_pacientee = $_POST['observacao_paciente'];

    $sql = "UPDATE tb_paciente SET  nome = '{$nome_paciente}', dt_nascimento = '{$dt_nascimento}',
                       email = '{$email_paciente}', endereco = '{$endereco_paciente}', 
                       celular = '{$celular_paciente}', observacao = '{$observacao_pacientee}'
            WHERE id_paciente = '{$id_paciente}'";

    if ($conecta->query($sql) === TRUE) {
        $conecta->close();
        header("Location: ../pag-edits-pacientes.php?id={$id_paciente}&sucesso");
        exit();
    }
    else{
        $conecta->close();
        header("Location: ../pag-edits-pacientes.php?id={$id_paciente}&erro");
        exit();
    }
}
//var_dump($_POST);