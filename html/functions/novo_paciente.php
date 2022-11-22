<?php
include "conexao_banco.php";
session_start();

if(isset($_POST)) {
    $nome_paciente = $_POST['nome_paciente'];
    $dt_nascimento = $_POST['dt_nascimento'];
    $email_paciente = $_POST['email_paciente'];
    $endereco_paciente = $_POST['endereco_paciente'];
    $celular_paciente = $_POST['celular_paciente'];
    $observacao_pacientee = $_POST['observacao_pacientee'];
    $fk_admin = $_SESSION['id_admin'];

    $sql = "INSERT INTO tb_paciente(nome, dt_nascimento, email, endereco, celular, 
                        observacao, fk_admin)
             VALUES ('{$nome_paciente}', '{$dt_nascimento}', '{$email_paciente}', '{$endereco_paciente}', 
                     '{$celular_paciente}', '{$observacao_pacientee}', '{$fk_admin}')";
    if ($conecta->query($sql) === TRUE) {
        $conecta->close();
        header("Location: ../pag-novo-paciente.php?sucesso");
        exit();
    }
    else{
        $conecta->close();
        header("Location: ../pag-novo-paciente.php?erro");
        exit();
    }
}
//var_dump($_POST);