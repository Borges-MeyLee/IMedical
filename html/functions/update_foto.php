<?php
include "conexao_banco.php";

if (isset($_POST)) {
    $id = $_POST['id_admin'];
    $diretorio = "../../assets/img/avatars/";
    if ($_FILES['foto_file']['name'] != '') {
        $tipo_arquivo = pathinfo(basename($_FILES['foto_file']['name'], PATHINFO_EXTENSION));
        //var_dump($tipo_arquivo);
        if (strtolower($tipo_arquivo['extension']) == 'jpeg' || strtolower($tipo_arquivo['extension']) == 'jpg' || strtolower($tipo_arquivo['extension']) == 'png') {
            $nome_foto = "U_{$id}_perfil_" . basename($_FILES['foto_file']['tmp_name'] . '.' . $tipo_arquivo['extension']);
            if (move_uploaded_file($_FILES['foto_file']['tmp_name'], $diretorio . $nome_foto)) {

                $sql = "UPDATE tb_admin SET foto = '{$nome_foto}' where id_admin = '{$id}'";
                if ($conecta->query($sql) === TRUE) {
                    session_start();
                    $_SESSION['foto_admin'] = $nome_foto;
                    $conecta->close();
                    header("Location: ../pag-conf-admin.php?sucesso=foto");
                    exit();
                } else {
                    $conecta->close();
                    header("Location: ../pag-conf-admin.php?erro=foto");
                    exit();
                }
            }
            else{
                $conecta->close();
                header("Location: ../pag-conf-admin.php?erro=foto");
                exit();
            }
        } else {
            $conecta->close();
            header("Location: ../pag-conf-admin.php?erro=foto");
            exit();
        }
    } else {
        $sql = "UPDATE tb_admin SET foto = '' where id_admin = '{$id}'";
        if($conecta->query($sql) === TRUE){
            session_start();
            $_SESSION['foto_admin'] = '';
            $conecta->close();
            header("Location: ../pag-conf-admin.php?sucesso=foto");
            exit();
        }
    }
} else {
    $conecta->close();
    header("Location: ../pag-conf-admin.php?erro=foto");
    exit();
}