<?php
include "functions/logout.php";
include "functions/conexao_banco.php";
?>
<!DOCTYPE html>
<html
        lang="pt-br"
        class="light-style layout-menu-fixed"
        dir="ltr"
        data-theme="theme-default"
        data-assets-path="../assets/"
        data-template="vertical-menu-template-free"
>
<head>
    <meta charset="utf-8"/>
    <meta
            name="viewport"
            content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>IMedical</title>

    <meta name="description" content=""/>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/logo_comp.png"/>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
    <link
            href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
            rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="../assets/vendor/fonts/boxicons.css"/>

    <!-- Core CSS -->
    <link rel="stylesheet" href="../assets/vendor/css/core.css" class="template-customizer-core-css"/>
    <link rel="stylesheet" href="../assets/vendor/css/theme-default.css" class="template-customizer-theme-css"/>
    <link rel="stylesheet" href="../assets/css/demo.css"/>

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css"/>

    <link rel="stylesheet" href="../assets/vendor/libs/apex-charts/apex-charts.css"/>

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="../assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../assets/js/config.js"></script>
</head>

<body>
<!-- Layout wrapper -->
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <!-- Menu -->
        <?php
        include("blocos/menu.php");
        ?>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
            <!-- Navbar -->

            <?php
            include "blocos/nav.php";
            ?>

            <!-- / Navbar -->

            <!-- Content wrapper -->
            <div class="content-wrapper">
                <!-- Lista paciente -->

                <div class="container-xxl flex-grow-1 container-p-y">
                    <?php
                    if(isset($_GET['sucesso'])){
                        $msg="Status atualizado com sucesso! Após 1 minuto o procedimento não será exibido.";
                        if($_GET['sucesso'] == 'delete_procedimento'){
                            $msg = 'Procedimento deletado com sucesso';
                        }
                        ?>
                        <div class="alert alert-success" role="alert">
                            <?= $msg; ?>

                        </div>
                        <?php
                    }
                    ?>
                    <?php
                    if(isset($_GET['erro'])){
                        if($_GET['erro'] == 'update_status'){
                            $msg = "Erro ao atualizar Status.";
                        }
                        elseif($_GET['erro'] == 'delete_erro'){
                            $msg = "Erro ao deletar procedimento";
                        }
                        ?>
                        <div class="alert alert-danger" role="alert">
                            <?= $msg?>
                        </div>
                        <?php
                    }
                    ?>

                    <div class="row">
                        <div class="col-lg-12 mb-4 order-0">
                            <div class="card">
                                <div class="d-flex align-items-end row">
                                    <div class="col-sm-7">
                                        <div class="card-body">
                                            <h5 class="card-title text-primary">
                                                Bem-vindo, <?= $_SESSION['nome_admin'] ?>! 🎉</h5>
                                            <p class="mb-4">
                                                Estes são seus <span class="fw-bold">pacientes</span> Bom trabalho.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-sm-5 text-center text-sm-left">
                                        <div class="card-body pb-0 px-0 px-md-4">
                                            <img
                                                    src="../assets/img/illustrations/man-with-laptop-light.png"
                                                    height="140"
                                                    alt="View Badge User"
                                                    data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                                    data-app-light-img="illustrations/man-with-laptop-light.png"
                                            />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <?php
                        $expire = date('Y-m-d H:i:s', strtotime("-1 minute"));
                        $sql_pacientes = "SELECT DISTINCT pac.nome, pac.dt_nascimento, pac.id_paciente, pac.observacao, 
                                                (select COUNT(*) from tb_procedimento as p where p.fk_paciente = pac.id_paciente AND (p.status = 'Pendente' 
                                                OR p.hr_executado >= '{$expire}')) as qtd FROM tb_procedimento as proc 
                                                INNER JOIN tb_paciente as pac 
                                                on proc.fk_paciente = pac.id_paciente 
                                                WHERE pac.fk_admin = '{$_SESSION['id_admin']}'";
                        $resultado_paciente = $conecta->query($sql_pacientes);
                        while ($row_paciente = $resultado_paciente->fetch_assoc()) {

                            if($row_paciente['qtd'] > 0){
                            $id_paciente = $row_paciente['id_paciente'];
                            ?>
                            <div class="col-lg-12 mb-4 order-0">
                                <div class="card">
                                    <div class="d-flex align-items-end row">
                                        <div class="col-sm-12">
                                            <div class="card-body">
                                                <h5 class="card-title text-primary"><?= $row_paciente['nome'] ?></h5>
                                                <p class="mb-4">
                                                    <span class="fw-bold">Data de nascimento: </span> <?= date('d/m/Y', strtotime($row_paciente['dt_nascimento'])) ?>
                                                </p>
                                                <strong>Obsservação: </strong><?= $row_paciente['observacao']?>
                                                <div class="table-responsive text-nowrap">
                                                    <table class="table">
                                                        <thead>
                                                        <tr>
                                                            <th>Tipo</th>
                                                            <th>Descrição</th>
                                                            <th>Horário</th>
                                                            <th>Status</th>
                                                            <th>Ações</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody class="table-border-bottom-0">
                                                        <?php
                                                        $sql_procedimentos = "SELECT proc.*, tp.descricao as 'dsc_tipo_proc'
                                                                        FROM tb_procedimento as proc
                                                                        INNER JOIN tb_tipo_procedimento as tp
                                                                        ON proc.id_tipo_procedimento = tp.id_tipo_procedimento 
                                                                        WHERE proc.fk_paciente = '{$id_paciente}'";
                                                        $resultado_procedimento = $conecta->query($sql_procedimentos);
                                                        while($row_procedimento = $resultado_procedimento->fetch_assoc()){
                                                            $expire = date('Y-m-d H:i:s', strtotime('+1  min', strtotime($row_procedimento['hr_executado'])));
                                                            $now = date('Y-m-d H:i:s');
                                                            if($row_procedimento['hr_executado'] == '' || $expire >= $now ){

                                                        ?>
                                                        <tr>
                                                            <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                                                <strong><?= $row_procedimento['dsc_tipo_proc']?></strong></td>
                                                            <td><?= $row_procedimento['descricao']?></td>
                                                            <td><span class="badge bg-label-dark me-1"><?= date('d/m/Y H:i', strtotime($row_procedimento['horario']))?></span>
                                                            </td>
                                                            <td>
                                                                <?php
                                                                if($row_procedimento['status'] == 'Realizado'){
                                                                    $class_status = 'success';
                                                                }
                                                                else{
                                                                    $class_status = 'warning';
                                                                }
                                                                ?>
                                                                <span class="badge bg-label-<?= $class_status?> me-1"><?= $row_procedimento['status']?></span>
                                                            </td>
                                                            <td>
                                                                <div class="dropdown">
                                                                    <button type="button"
                                                                            class="btn p-0 dropdown-toggle hide-arrow"
                                                                            data-bs-toggle="dropdown">
                                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                                    </button>
                                                                    <div class="dropdown-menu" style="position: relative">
                                                                        <a class="dropdown-item"
                                                                           href="pag-edits-procedimentos.php?id=<?= $row_procedimento['id_procedimento']?>"
                                                                        ><i class="bx bx-edit-alt me-1"></i> Editar</a
                                                                        >
                                                                        <a class="dropdown-item"
                                                                           href="functions/delete_dashboard.php?id=<?= $row_procedimento['id_procedimento']?>"
                                                                        ><i class="bx bx-trash me-1"></i> Deletar</a
                                                                        >
                                                                        <?php
                                                                        if($row_procedimento['status'] != 'Realizado'){

                                                                        ?>
                                                                        <a class="dropdown-item"
                                                                           href="functions/update_status.php?id=<?= $row_procedimento['id_procedimento']?>"
                                                                        ><i class="bx bx-check-circle me-1"></i> Realizado</a
                                                                        >
                                                                        <?php
                                                                        }
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                        }
                                                        ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <?php
                        }
                        }
                        ?>
                    </div>
                </div>
                <!-- / Content -->

                <!-- Footer -->
                <?php
                include "blocos/footer.php"
                ?>
                <!-- / Footer -->

                <div class="content-backdrop fade"></div>
            </div>
            <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
    </div>

    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
</div>
<!-- / Layout wrapper -->

<!-- Core JS -->
<!-- build:js assets/vendor/js/core.js -->
<script src="../assets/vendor/libs/jquery/jquery.js"></script>
<script src="../assets/vendor/libs/popper/popper.js"></script>
<script src="../assets/vendor/js/bootstrap.js"></script>
<script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

<script src="../assets/vendor/js/menu.js"></script>
<!-- endbuild -->

<!-- Vendors JS -->
<script src="../assets/vendor/libs/apex-charts/apexcharts.js"></script>

<!-- Main JS -->
<script src="../assets/js/main.js"></script>

<!-- Page JS -->
<script src="../assets/js/dashboards-analytics.js"></script>

<!-- Place this tag in your head or just before your close body tag. -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
</body>
</html>
