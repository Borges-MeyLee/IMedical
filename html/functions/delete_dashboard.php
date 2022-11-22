<?php
include "conexao_banco.php";

if(isset($_GET)){
    $id = $_GET['id'];
    $sql = "DELETE FROM tb_procedimento WHERE id_procedimento = '{$id}'";
    if($conecta->query($sql) === TRUE ){
        $conecta->close();
        header("Location: ../dashboard.php?sucesso=delete_procedimento");
        exit();
    }
    else{
        $conecta->close();
        header("Location: ../dashboard.php?erro=delete_erro");
        exit();
    }
}