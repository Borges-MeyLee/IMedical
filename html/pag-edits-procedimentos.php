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

    <title>Imedical</title>

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
                <!-- Content -->
                <div class="container-xxl flex-grow-1 container-p-y">
                    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Pacientes/</span> Editar
                        procedimento</h4>
                    <?php
                    if (isset($_GET['sucesso'])) {
                        $msg = "Procedimento editado com sucesso!";
                        ?>
                        <div class="alert alert-success" role="alert">
                            <?= $msg; ?>

                        </div>
                        <?php
                    }
                    ?>
                    <?php
                    if (isset($_GET['erro'])) {
                        ?>
                        <div class="alert alert-danger" role="alert">
                            <?= $msg = "Procedimento não pode ser editado." ?>
                        </div>
                        <?php
                    }
                    ?>

                    <div class="row">
                        <div class="col-xl">
                            <div class="card mb-4">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0">Novo procedimento</h5>
                                </div>
                                <div class="card-body">
                                    <form action="functions/update_procedimentos.php" method="post">
                                        <input type="hidden" value="<?= $_GET['id'] ?>" name="id_procedimento">
                                        <?php
                                        $sql_procedimento = "SELECT * FROM tb_procedimento as proc 
                                                             INNER JOIN tb_paciente as pac
                                                             on proc.fk_paciente = pac.id_paciente
                                                             WHERE proc.id_procedimento = '{$_GET['id']}'";
                                        $resultado = $conecta->query($sql_procedimento);
                                        $row_procedimento = $resultado->fetch_assoc();
                                        ?>
                                        <div class="mb-3 row">
                                        </div>

                                        <div class="mb-3">
                                        </div>

                                        <div class="mb-3">
                                        </div>

                                        <div class="mb-3">
                                            <label for="escolher-paciente" class="form-label">Qual o nome paciente?
                                            </label>
                                            <input type="text" class="form-control" value="<?= $row_procedimento['nome']?>" disabled>
                                        </div>
                                        <div class="mb-3">
                                            <label for="procedimento" class="form-label">Procedimento
                                            </label>
                                            <select class="form-select"
                                                    id="procedimento"
                                                    name="procedimento">
                                                <option selected>Selecione qual o cuidado com o paciente</option>
                                                <?php
                                                $sql = "SELECT * FROM tb_tipo_procedimento";
                                                $resultado = $conecta->query($sql);
                                                while ($procedimento = $resultado->fetch_assoc()) {
                                                    ?>
                                                    <option <?php if($procedimento['id_tipo_procedimento'] == $row_procedimento['id_tipo_procedimento']){echo "selected";} ?> value="<?= $procedimento['id_tipo_procedimento'] ?>">
                                                        <?= $procedimento['descricao'] ?></option>
                                                    <?php
                                                }
                                                ?>

                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label"
                                                   for="descricao">Médicações/Curativos</label>
                                            <textarea
                                                    id="descricao"
                                                    name="descricao"
                                                    class="form-control"
                                                    required="required"
                                                    placeholder="Escreva o nome do medicamento e/ou cuidado de enfermagem"><?= $row_procedimento['descricao']?></textarea>
                                            <div class="form-text">*Obrigatório</div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="horario" class="col-md-2 col-form-label">Data/Horário</label>
                                            <div class="col-md-3">
                                                <input class="form-control"
                                                       type="datetime-local"
                                                       value="<?= date('Y-m-d\TH:i:s', strtotime($row_procedimento['horario']))?>"
                                                       id="horario"
                                                       name="horario"
                                                       required="required"/>
                                            </div>
                                            <div class="form-text">*Obrigatório</div>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Salvar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
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
