<?php
include "conexao_banco.php";
$now = date('Y-m-d H:i:s');

if(isset($_GET)){
    $id = $_GET['id'];
    $sql = "UPDATE tb_procedimento SET status = 'Realizado', hr_executado = '{$now}' WHERE id_procedimento = '{$id}'";
    if($conecta->query($sql) === TRUE ){
        $conecta->close();
        header("Location: ../dashboard.php?sucesso=status_ok");
        exit();
    }
    else{
        $conecta->close();
        header("Location: ../dashboard.php?erro=status_erro");
        exit();
    }
}